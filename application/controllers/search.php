<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller for search
 *
 * @package 	icsls
 * @category 	Controller
 * @author 		Team 5
 * @version 	1.0
*/

class Search extends CI_Controller{
	public function Search(){
		parent::__construct();
		//load libraries,models, helpers
		$this->load->library('pagination');
	}

	public function index(){
		$data['title'] = "Search - ICS OnLib";
		$data['header'] = "Search";

		$config['per_page'] = 10;
		$config['base_url'] = base_url("index.php/search/?keyword=");
		$config['num_links']= 1;
		$config['page_query_string'] = TRUE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<div class="pagination_table"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';
		$config['prev_link'] = '&lt; Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next &gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;

		if(!isset($_GET['per_page']))
			$_GET['per_page'] = 0;
		
		$order2  = array('\\','\/','@','!','#','&','$','%','^','*','(',')','+','=',',','\"','.','<','>','?','[',']',':','\'','a','b','c',
			'd','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G',
			'H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			
			$temporary = $_GET['per_page'];
			$temporary = str_replace($order2, '', $temporary);
			$result1 = $this->user_model->search_reference_materials('',$config['per_page'],$temporary);
			
			$data['flags'] = FALSE;
			if($result1 != NULL){
				$data['rows'] = $result1->result();
				$config['total_rows'] = $this->user_model->search_reference_materials2('')->num_rows();
				//^we get all rows
				
				$this->pagination->initialize($config);

				$data['totalrefmat'] = $config['total_rows'];//we use this to display some info

				$data['flags'] = FALSE;
			}
			
		$this->load->view("search_view", $data);
	}

	/**
	 * Function for calling the search_reference_materials function to get search results based on the User's search input
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function search_rm(){
		$data["title"] = "Search - ICS OnLib";

		$keyword = $this->input->get('keyword');
		$keyword = htmlspecialchars($keyword,ENT_QUOTES);
		$keyword = ltrim($keyword);
		$keyword = rtrim($keyword);

		//replace special characters with nothing
		$order  = array('\\','\/','@','!','#','&','$','%','^','*','(',')','+','=',',','\"','.','<','>','?','[',']',':','\'');
		$keyword = str_replace($order, '', $keyword);

		$sessionData=array('keyword'=>$keyword);
		$this->session->set_userdata($sessionData);
		$config['per_page'] = 10;
		$config['base_url'] = base_url("index.php/search/search_rm?keyword={$_GET['keyword']}");
		$config['num_links']= 1;
		$config['page_query_string'] = TRUE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<div class="pagination_table"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';
		$config['prev_link'] = '&lt; Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next &gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		if($keyword==null){
			redirect('search');
			//empty keyword
		}
		else{
			if(!isset($_GET['per_page']))//used for pagination
				$_GET['per_page'] = 0;
			$order2  = array('\\','\/','@','!','#','&','$','%','^','*','(',')','+','=',',','\"','.','<','>','?','[',']',':','\'','a','b','c',
			'd','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G',
			'H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			
			$temporary = $_GET['per_page'];
			$temporary = str_replace($order2, '', $temporary);
			$result1 = $this->user_model->search_reference_materials($keyword,$config['per_page'],$temporary);
			
			$data['flags'] = FALSE;
			if($result1->num_rows() > 0){
				$data['rows'] = $result1->result();
				$config['total_rows'] = $this->user_model->search_reference_materials2($keyword)->num_rows();
				//^we get all rows
				
				$this->pagination->initialize($config);

				$data['totalrefmat'] = $config['total_rows'];//we use this to display some info

				$data['flags'] = FALSE;
				$this->load->view('search_result_view', $data);
			}
			//if there are no results, it means there are more keywords
			else{
				$data['rows'] = null;	// resets to null
				//get the rows with tokenizer
				$result = $this->user_model->search_reference_materials_token($keyword,$config['per_page'],$_GET['per_page']);

				$data['rows'] = $result->result();
				$temp = $this->user_model->search_reference_materials_token2($keyword);
				$config['total_rows'] = $temp->num_rows();
				$this->pagination->initialize($config);

				$data['totalrefmat'] = $temp->num_rows();
				if($result != NULL)
					$data['flags'] = FALSE;
				else $data['flags'] = TRUE;//no materials found
				$this->load->view('search_result_view', $data);
			}			
		}
	}

	/**
	 * Function for reserving and waitlisting
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function transaction(){
		$data['title'] = "Search - ICS OnLib";
		$data['header'] = "Search";
		$data['flags']=FALSE;

		$referenceId = $this->input->get('id');
		$referenceTitle = $this->input->get('booktitle');
		$referenceIsbn = $this->input->get('bookauthor');
		$referenceCourse = $this->input->get('bookcourse');
		$bookdetails = array('title' => $referenceTitle, 'author' => $referenceIsbn, 'code' => $referenceCourse);

		$userId = $this->session->userdata('id');

		if($referenceId==NULL){
			$referenceId = $this->uri->segment(3);
		}
		$userType = $this->session->userdata('userType');
		$input = $this->session->userdata('keyword');
		$email = $this->session->userdata('email_address');	
		$firstName = $this->session->userdata('firstName');	

		if(isset($_GET['cancel'])){
			//$data['flag'] = 1;
			$sessionData = array('canWaitlist' => FALSE, 'canReserve' => FALSE, 'flag' => FALSE);
			$this->session->set_userdata($sessionData);
			
			redirect('cart/remove_after_reserved/'.$referenceId);
			return;
		}

		//if "Reserve" button was clicked
		if(isset($_GET['reserve'])){
			$reserveStatus = $this->user_model->reserve_reference_materials($referenceId, $userId, $userType);
		
			if($reserveStatus == FALSE){	//if conditions in reserving were not satisfied
				$sessionData = array('failedReserve' => TRUE, 'flag' => FALSE);
				$this->session->set_userdata($sessionData);

				$data['rows'] = $this->user_model->search_reference_materialss($input);
				//$data['flag'] = 1;
				if($data['rows'] != NULL)
					$data['flags']=FALSE;
				else $data['flags']=TRUE;
				$this->load->view('search_result_view.php', $data);

			}
			else if($reserveStatus == 1){	//successful reserve
				//echo "Reference material was successfully reserved.";
				$sessionData = array('canWaitlist' => FALSE, 'referenceId' => $referenceId, 'canReserve' => FALSE, 'successfulReserve' => TRUE, 'flag' => FALSE);
				$this->session->set_userdata($sessionData);
				$data['rows'] = $this->user_model->search_reference_materialss($input);
				//$data['flag'] = 1;
				//call to mail
				
				if($data['rows'] != NULL)
					$data['flags']=FALSE;
				else $data['flags']=TRUE;
				
				$this->send_email($email,$firstName,$bookdetails,$referenceId);
			}
			else{	//if the reference material is out of stock
				$sessionData = array('canWaitlist' => true, 'referenceId' => $referenceId, 'canReserve' => FALSE, 'flag' => TRUE);
				$this->session->set_userdata($sessionData);
				$data['rows'] = $this->user_model->search_reference_materialss($input);//material
				//$data['flag'] = 0;
				if($data['rows'] != NULL)
					$data['flags']=FALSE;
				else $data['flags']=TRUE;
				$this->load->view('search_result_view.php', $data);
			}
		 //if "Waitlist" button was clicked
		}else if(isset($_GET['waitlist'])){
			$waitlistStatus = $this->user_model->waitlist_reference_materials($referenceId, $userId, $userType);
	
			if($waitlistStatus == FALSE){	//if conditions in waitlisting were not satisfied
				$sessionData = array('failedWaitlist' => TRUE, 'flag' => FALSE);
				$this->session->set_userdata($sessionData);
				$data['rows'] = $this->user_model->search_reference_materialss($input);//binalik muna, walang s yung isa
				//$data['flag'] = 1;
				if($data['rows'] != NULL)
					$data['flags']=FALSE;
				else $data['flags']=TRUE;
				$this->load->view('search_result_view.php', $data);
			}
			else if($waitlistStatus == 1){	//successful wait list
				$sessionData = array('canWaitlist' => FALSE, 'referenceId' => $referenceId, 'canReserve' => FALSE, 'successfulWaitlist' => TRUE, 'flag' => FALSE);
				$this->session->set_userdata($sessionData);
				$data['rows'] = $this->user_model->search_reference_materialss($input);
				//$data['flag'] = 1;
				if($data['rows'] != NULL)
					$data['flags']=FALSE;
				else $data['flags']=TRUE;
				$this->load->view('search_result_view.php', $data);
			}
			else{	//if the reference material is still available
				$sessionData = array('canReserve' => true, 'referenceId' => $referenceId, 'canWaitlist' => FALSE, 'flag' => TRUE);
				$this->session->set_userdata($sessionData);
				$data['rows'] = $this->user_model->search_reference_materialss($input);
				//$data['flag'] = 0;
			if($data['rows'] != NULL)
					$data['flags']=FALSE;
				else $data['flags']=TRUE;
				$this->load->view('search_result_view.php', $data);
			}
		 //if neither of the two buttons (Reserve, Waitlist) were clicked
		}else{
				//$data['bookInfo'] = $this->user_model->search_reference_materials($input);
				$sessionData = array('flag' => FALSE);
				$this->session->set_userdata($sessionData);
				//$data['flag'] = 1;
				$data['rows'] = NULL;

				$this->load->view('search_result_view.php', $data);
		}
	}

	/**
	 * Function for advanced search based on checkboxes
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function advanced_search_reference(){
		$data["title"] = "Advanced Search - ICS Library System";

		$tempArray = array();//for keywords
		$tempArrayValues = array();//for the values
		//replace special characters with nothing
		$order  = array('\\','\/','@','!','#','&','$','%','^','*','(',')','+','=',',','.','<','>','?','[',']',':','\'','\"');


		$order2  = array('\\','\/','@','!','#','&','$','%','^','*','(',')','+','=','\"',',','.','<','>','?','[',']',':','\'','a','b','c',
			'd','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G',
			'H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$query = "";//for query

		/*
		the following codes will check if the checkbox is marked
		*/
		if(in_array("title", $_GET['projection'])){
			$keywordTitle = $this->input->get('title');
			//trim whitespaces and special characters
			$keywordTitle = htmlspecialchars($keywordTitle,ENT_QUOTES);
			$keywordTitle = ltrim($keywordTitle);
			$keywordTitle = rtrim($keywordTitle);
			//$keywordTitle = str_replace($order, '', $keywordTitle);
			//we will build up the search query using string concatenation
			if($keywordTitle==null){	//didn't type anything
				$sessionData=array('emptykeyword'=>TRUE);
				$this->session->set_userdata($sessionData);
				redirect('search');
			}
			$query .= "title like '%$keywordTitle%'";
			array_push($tempArray,'title');	//push it to the array
			array_push($tempArrayValues,$keywordTitle);
		}
		//if author is checked
		if(in_array("author", $_GET['projection'])){
			$keywordAuthor = $this->input->get('author');

			//trim whitespaces and special characters
			$keywordAuthor = htmlspecialchars($keywordAuthor,ENT_QUOTES);
			$keywordAuthor = ltrim($keywordAuthor);
			$keywordAuthor = rtrim($keywordAuthor);
			//$keywordAuthor = str_replace($order, '', $keywordAuthor);
			if($keywordAuthor==null){
				$sessionData=array('emptykeyword'=>TRUE);
				$this->session->set_userdata($sessionData);
				redirect('search');
			}

			if ( in_array('title',$tempArray) ) {
				//^ we check if previous checkboxes were marked
				$query .= " or author like '%$keywordAuthor%'";
			}
			else{
				//no other checkboxes were marked
				$query .= " author like '%$keywordAuthor%'";
			}
			array_push($tempArray,'author');
			array_push($tempArrayValues,$keywordAuthor);
		}

		//if year_published is checked
		if(in_array("year_published", $_GET['projection'])){
			$keywordYearPublished = $this->input->get('year_published');

			$keywordYearPublished = htmlspecialchars($keywordYearPublished,ENT_QUOTES);
			$keywordYearPublished = ltrim($keywordYearPublished);
			$keywordYearPublished = rtrim($keywordYearPublished);
			//$keywordYearPublished = str_replace($order, '', $keywordYearPublished);

			if($keywordYearPublished ==null){
				$sessionData=array('emptykeyword'=>TRUE);
				$this->session->set_userdata($sessionData);
				redirect('search');
			}
			if ( in_array('title',$tempArray) || in_array('author',$tempArray)) {
				//^ we check if previous checkboxes were marked
				$query .= " or publication_year like '%$keywordYearPublished%'";
			}
			else{
				//no other checkboxes were marked
				$query .= " publication_year like '%$keywordYearPublished%'";
			}
			array_push($tempArray,'year_published');
			array_push($tempArrayValues,$keywordYearPublished);
		}
		
		//if publisher is checked
		if(in_array("publisher", $_GET['projection'])){
			$keywordPublisher = $this->input->get('publisher');
			
			$keywordPublisher = htmlspecialchars($keywordPublisher,ENT_QUOTES);
			$keywordPublisher = ltrim($keywordPublisher);
			$keywordPublisher = rtrim($keywordPublisher);
			//$keywordPublisher = str_replace($order, '', $keywordPublisher);
			if($keywordPublisher==null){
				$sessionData=array('emptykeyword'=>TRUE);
				$this->session->set_userdata($sessionData);
				redirect('search');
			}

			if ( in_array('title',$tempArray) || in_array('author',$tempArray) || in_array('year_published', $tempArray)) {
				//^ we check if previous checkboxes were marked
				$query .= " or publisher like '%$keywordPublisher%'";
			}
			else{
				//no other checkboxes were marked
				$query .= " publisher like '%$keywordPublisher%'";
			}
			array_push($tempArray,'publisher');
			array_push($tempArrayValues,$keywordPublisher);
		}

		//if course_code is checked
		if(in_array('course_code',$_GET['projection'])){
	    	$keywordCourseCode = $this->input->get('course_code');
	    	
	    	$keywordCourseCode = htmlspecialchars($keywordCourseCode,ENT_QUOTES);
			$keywordCourseCode = ltrim($keywordCourseCode);
			$keywordCourseCode = rtrim($keywordCourseCode);
			//$keywordCourseCode = str_replace($order, '', $keywordCourseCode);
			if($keywordCourseCode==null){
	    		$sessionData=array('emptykeyword'=>TRUE);
				$this->session->set_userdata($sessionData);
				redirect('search');
			}
			if ( in_array('title',$tempArray) || in_array('author',$tempArray) || in_array('year_published', $tempArray) || in_array('publisher', $tempArray)) {
				//^ we check if previous checkboxes were marked
				$keywordCourseCode = strtoupper($keywordCourseCode);
				$query .= " or course_code like '%$keywordCourseCode%'";
			}
			else{
				//no other checkboxes were marked
				$keywordCourseCode = strtoupper($keywordCourseCode);
				$query .= " course_code like '%$keywordCourseCode%'";
			}
			array_push($tempArray,'course_code');
			array_push($tempArrayValues,$keywordCourseCode);
		}
		if($tempArray == null){//check if no checkbox is checked
			$sessionData=array('emptykeyword'=>TRUE);
			$this->session->set_userdata($sessionData);
			redirect('search');
		}

		//the default sort is by title ascending
		$sort="order by title asc";

		//we check what radio button is marked then we put the appropriate query
		if(isset($_GET['sort'])){
			if($_GET['sort'] == 'sortalpha'){
				$sort = "order by title asc";
			}
			elseif ($_GET['sort'] == 'sortbeta') {
				$sort = "order by title desc";
			}
			elseif ($_GET['sort'] == 'sortyear') {
				$sort = "order by publication_year desc";
			}
			else{
				$sort = "order by author asc";
			}
		}

		//we need this for the pagination uri
		$q1 = $tempArray[array_search('title', $tempArray)];
		$q2 = $tempArray[array_search('author', $tempArray)];
		$q3 = $tempArray[array_search('year_published', $tempArray)];
		$q4 = $tempArray[array_search('publisher', $tempArray)];
		$q5 = $tempArray[array_search('course_code', $tempArray)];
		if(!isset($_GET['per_page']) || $_GET['per_page'] == null)
			$_GET['per_page'] = 0;

		$temporary = $_GET['per_page'];
		$temporary = str_replace($order2, '', $temporary);

		$data['temparray'] = $tempArray;
		$data['temparrayvalues'] = $tempArrayValues;
		$config['per_page'] = 10;
		$config['base_url'] = base_url("index.php/search/advanced_search_reference?projection%5B%5D={$q1}&title={$_GET['title']}&projection%5B%5D={$q2}&author={$_GET['author']}&projection%5B%5D={$q3}&year_published={$_GET['year_published']}&projection%5B%5D={$q4}&publisher={$_GET['publisher']}&projection%5D%5B={$q5}&course_code={$_GET['course_code']}&refType={$_GET['refType']}&sort={$_GET['sort']}");
		$config['num_links']= 1;
		$config['page_query_string'] = TRUE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['full_tag_open'] = '<div class="pagination_table"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';
		$config['prev_link'] = '&lt; Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next &gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
	//------------modify
		$reftype = $this->input->get('refType');
		$reftype = ltrim($reftype);
		$reftype = rtrim($reftype);
		$reftype = str_replace($order, '', $reftype);

		if(isset($reftype)){
			$result = $this->user_model->advanced_search("Select * from reference_materials where ({$query}) and category = '{$reftype}' {$sort} limit {$temporary},{$config['per_page']}");
			$result2 = $this->user_model->advanced_search("Select * from reference_materials where ({$query}) and category = '{$reftype}' {$sort}");

		}
		else{
			$result = $this->user_model->advanced_search("Select * from reference_materials where {$query}  {$sort} limit {$temporary},{$config['per_page']}");
			$result2 = $this->user_model->advanced_search("Select * from reference_materials where {$query} {$sort}");
		}
		//we run the query
		$data['flags']=NULL;
		
		if($result != NULL) $data['flags']=FALSE;
		else $data['flags']=TRUE;
		
		$data['rows'] = $result->result();

		$config['total_rows'] = $result2->num_rows();//set the total number of rows
		$this->pagination->initialize($config);
		$data['totalrefmat'] = $result2->num_rows();
		$this->load->view('search_result_view', $data);
	}

	/**
	 * Function for viewing reference
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function view_reference(){
		$data['title'] = "View Book - ICS OnLib";

		$bookid = trim(htmlspecialchars($this->uri->segment(3)));
		$result = $this->user_model->view_reference_materials($bookid);
		$data['rows'] = $result->result();
		$this->load->view('view_results_view', $data);
	}

	/**
	 * Function for sending email
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	function send_email($email_add,$name,$book,$referenceId){
		$config = Array(
			'protocol' => "smtp",
			'smtp_host' => "ssl://smtp.googlemail.com",
			'smtp_port' => 465,
			'smtp_user' => "user.librarian@gmail.com",
			'smtp_pass' => "userlibrarian",//password
			'mailtype'  => 'html',
			'charset' => 'utf-8'
		);

		$date = date('Y-m-d H:m:s');
		$newdate = strtotime ( '+3 Days' , strtotime( $date ));
		$newdate = date('y-m-d',$newdate);
		$day= date("l", strtotime($date) );
		
		if($day == "Saturday")
			{
				$duedate = strtotime ( '+2 day' , strtotime( $newdate ));
				$duedate = date('F j, Y',$duedate);
			}
		elseif($day == "Sunday")
			{
				$duedate = strtotime ( '+1 day' , strtotime( $newdate ));
				$duedate = date('F j, Y',$duedate);
			}
		else
		{
			$duedate = date('F j, Y',strtotime($newdate));
		}
		$date = date('F j, Y',strtotime($date));

		$this->load->library("email", $config);//we pass our configuration
		$this->email->set_newline("\r\n");

		$this->email->from("user.librarian@gmail.com", "ICS Librarian");
		//sample only
		$this->email->to($email_add);
		$this->email->subject("Reference Material Reservation");
		$this->email->message("Dear {$name}, <br/>last ".$date." you have reserved a book using ICS OnLib with the following details:<br><br> <h5>".$book['title']." by ".$book['author']." <br> ".$book['code']."</h5> <br/>This will be due on : <h1>".$duedate."</h1>You must claim the book on or before the due date. 
			Thank you for your cooperation.<br/>Sincerely,<br/><h3>ICS Librarian</h3>");
		
		if($this->email->send()){//if sent successfully
		}

		redirect('cart/remove_after_reserved/'.$referenceId);
	}
}

?>