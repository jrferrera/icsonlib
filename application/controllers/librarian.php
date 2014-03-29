<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller for librarian-specific modules
 *
 * @package 	icsls
 * @category 	Controller
 * @author 		Mark Carlo Dela Torre, Angela Roscel Almoro, Jason Faustino, Jay-ar Hernaez
 * @version 	1.0
*/

class Librarian extends CI_Controller{
	/**
	 * Librarian constructor
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function Librarian(){
		parent::__construct();

		//Redirect if user is not logged in or not a librarian
		if(! $this->session->userdata('loggedIn') || $this->session->userdata('userType') != 'L'){
			show_404();
		}

		//Load CI helpers, library, and programmer-defined model
		$this->load->helper(array('html', 'form'));
		$this->load->model("librarian_model");
		$this->load->library('form_validation');
		$this->load->library('table', 'input');
	}//End of Librarian constructor

	/* **************************************** SEARCH REFERENCE MODULE **************************************** */

	/**
	 * Inititalize pagination class in searching a reference
	 *
	 * @access 	private
	 * @param 	String 	$linkURL			Used for base_url in switching pages using pagination
	 * @param 	int 	$perPage 			Specifies the number of results per page
	 * @param 	int 	$totalAffected 		Specifies the total number of affected rows without limit constraint
	*/
	private function initialize_pagination($linkURL, $perPage, $totalAffected){

		$this->load->library('pagination');
		$config['base_url'] = $linkURL;
		$config['total_rows'] = $totalAffected;
		$config['per_page'] = $perPage; 
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
		$config['num_links']=1;
		$this->pagination->initialize($config);

	}//End of function initialize_pagination

	/**
	 * Loads the search reference view containing a form and input fields to search references stored in the database
	 *
	 * @access public
	 */
	public function index($offset = 0){
		$data['title'] = "Librarian - ICS OnLib";

		$perPage = ($this->input->get('perPage') != '') ? $this->input->get('perPage') : 10;

		$category = 'title';
		$sortBy = 'title';
		$orderFrom = 'ASC';

		$data['references'] = $this->librarian_model->get_all_references_part($offset, $sortBy, $orderFrom, $perPage)->result();
		$data['totalAffected'] = $this->librarian_model->get_all_references()->num_rows();
		$data['per_page'] = $perPage;

		$this->initialize_pagination(base_url("index.php/librarian/display_all_reference?
			category={$category}
			&sortBy={$sortBy}
			&orderFrom={$orderFrom}
			&perPage={$perPage}
			&all=TRUE"), $perPage, $data['totalAffected']);

		$data['offset'] = $offset;

		$this->load->view('search_reference_view', $data);
	}//End of function search_reference_index

	/**
	 * Function for displaying all references
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function display_all_reference($offset = 0){
		$data['title'] = "Librarian - ICS OnLib";

		$perPage = ($this->input->get('perPage') != '') ? $this->input->get('perPage') : 10;

		$offset = ($this->input->get('per_page') != '') ? $this->input->get('per_page') : 0;

		//default
		$sortBy = in_array($this->input->get('sortBy'), array('title', 'course_code', 'author', 'category', 'times_borrowed')) ? $this->input->get('sortBy') : 'title';
		$orderFrom = in_array($this->input->get('orderFrom'), array('ASC', 'DESC')) ? $this->input->get('orderFrom') : 'ASC';

		$data['references'] = $this->librarian_model->get_all_references_part($offset, $sortBy, $orderFrom, $perPage)->result();
		$data['totalAffected'] = $this->librarian_model->get_all_references()->num_rows();
		$data['per_page'] = $perPage;

		$this->initialize_pagination(base_url("index.php/librarian/display_all_reference?
			all=Display%20All%20References
			&sortBy={$sortBy}
			&orderFrom={$orderFrom}
			&perPage={$perPage}
			"), $perPage, $data['totalAffected']);

		$data['offset'] = $offset;

		$this->load->view('search_reference_view', $data);
	}

	/**
	 * Librarian Basic Search Reference Function
	 *
	 * @access public
	 */
	public function search_reference(){
		$data['title'] = 'Librarian - ICS OnLib';
		
		$offset = ($this->input->get('per_page') != '') ? $this->input->get('per_page') : 0;

		//Display all reference
		if(isset($_GET['all'])){
			$getString = '';
			$getString .= '?all=' . $this->input->get('all')
				. '&sortBy=' . $this->input->get('sortBy') . '&orderFrom=' . $this->input->get('orderFrom')
				. '&perPage=' . $this->input->get('perPage');
			echo $getString;
			redirect('librarian/display_all_reference' . $getString);
		}elseif(isset($_GET['submit'])){
			//Elements from Basic Search
			$queryArray = array(
				'category' => htmlspecialchars($this->input->get('category'), ENT_QUOTES),
				'searchText' =>  htmlspecialchars($this->input->get('searchText'), ENT_QUOTES),
				'sortBy' => htmlspecialchars($this->input->get('sortBy'), ENT_QUOTES),
				'orderFrom' => htmlspecialchars($this->input->get('orderFrom'), ENT_QUOTES),
				'perPage' => htmlspecialchars($this->input->get('perPage'), ENT_QUOTES)
				);
			
			if(! in_array($queryArray['category'], array('title', 'author', 'isbn', 'publisher', 'course_code')))
				redirect('librarian');

			//Get total number of affected reference
			$data['totalAffected'] = $this->librarian_model->basic_get_reference($queryArray)->num_rows();

			//Get affected reference from offset to per page
			$data['references'] = $this->librarian_model->basic_get_reference_fragment($queryArray, $offset)->result();

			$this->initialize_pagination(base_url("index.php/librarian/search_reference?
				category={$this->input->get('category')}
				&searchText={$this->input->get('searchText')}
				&submit={$this->input->get('submit')}
				&sortBy={$this->input->get('sortBy')}
				&orderFrom={$this->input->get('orderFrom')}
				&perPage={$this->input->get('perPage')}"), $queryArray['perPage'], $data['totalAffected']);

			$data['offset'] = $offset;
			$data['per_page'] = $queryArray['perPage'];
		}else{
			redirect('librarian');
		}

		$this->load->view('search_reference_view', $data);
	}

	/**
	 * Librarian Advance Search Function
	 *
	 * @access public
	 */
	public function advanced_search_reference(){
		$data['title'] = 'Librarian - ICS OnLib';

		if(isset($projectionString))
			$projectionArray = explode('+', $projectionString);
		else
			$projectionArray = $this->input->get('projection');

		if(empty($projectionArray)){
			redirect('librarian/search_reference?category=title&searchText=&submit=Search&sortBy=' . $this->input->get('sortBy')
				. '&orderFrom=' . $this->input->get('orderFrom') . '&perPage=' . $this->input->get('perPage'));
		}

		$projectionString = '';

		//Imitation of form get
		foreach($projectionArray as $item):
			$projectionString .= "projection%5B%5D={$item}&{$item}={$this->input->get($item)}&";
		endforeach;

		//Remove excess plus symbol
		$projectionString = substr($projectionString, 0, -1);
		
		$offset = ($this->input->get('per_page') != '') ? $this->input->get('per_page') : 0;

		$queryArray = array(
			'title' => $this->input->get('title'),
			'author' => $this->input->get('author'),
			'publication_year' => $this->input->get('year_published'),
			'publisher' => $this->input->get('publisher'),
			'category' =>$this->input->get('category'),
			'sortBy' => $this->input->get('sortBy'),
			'orderFrom' => $this->input->get('orderFrom'),
			'perPage' => $this->input->get('perPage')
			);

		if(! in_array($queryArray['category'], array('B', 'M', 'S', 'T', 'C', 'J'))){
			redirect('librarian');
		}

		$data['totalAffected'] = $this->librarian_model->advanced_search($projectionArray, $queryArray)->num_rows();

		$data['references'] = $this->librarian_model->advanced_search_fragment($projectionArray, $queryArray, $offset)->result();

		//Initialize Pagination Class
		$this->initialize_pagination(base_url("index.php/librarian/advanced_search_reference?
			{$projectionString}
			&title={$queryArray['title']}
			&author={$queryArray['author']}
			&year_published={$queryArray['publication_year']}
			&publisher={$queryArray['publisher']}
			&category={$queryArray['category']}
			&sortBy={$queryArray['sortBy']}
			&orderFrom={$queryArray['orderFrom']}
			&perPage={$queryArray['perPage']}
			&submit={$this->input->get('submit')}"
			), $queryArray['perPage'], $data['totalAffected']);
		

		$data['offset'] = $offset;
		$data['per_page'] = $queryArray['perPage'];
		$data['projectionArray'] = $projectionArray;

		$this->load->view('search_reference_view', $data);
	}
	/* **************************************** END OF SEARCH REFERENCE MODULE **************************************** */

	/* **************************************** VIEW REFERENCE MODULE **************************************** */
	/**
	 * View a reference specified by its row ID (which is set in the database)
	 *
	 * @access public
	 */
	public function view_reference(){
		$data['title'] = "Librarian - ICS OnLib";

		$id = $this->uri->segment(3);

		if($id === FALSE) redirect('librarian');
	      
	    $result = $this->librarian_model->get_reference($id);
	    $data['reference_material'] = $result->result();
	    $data['number_of_reference'] = $result->num_rows();

	    $data['transactions'] = $this->librarian_model->get_transactions($id)->result();
	    $data['numberOfTransactions'] = $this->librarian_model->get_transactions($id)->num_rows();

	    $this->load->view('view_reference_view', $data);
	}//End of function view_reference

	/* **************************************** END OF REFERENCE MODULE **************************************** */

	/* **************************************** EDIT REFERENCE MODULE **************************************** */

	/**
	 * Loads initial state of the reference to be edited
	 *
	 * @access public
	 */
	public function edit_reference_index(){
		$data['title'] = "Edit Reference - ICS OnLib";

		$referenceId = $this->uri->segment(3);

		if($referenceId === FALSE OR intval($referenceId) < 1)
			redirect('librarian');

		$queryObj = $this->librarian_model->get_reference($referenceId);

		$data['reference_material'] = $queryObj->result();
		$data['number_of_reference'] = $queryObj->num_rows();

		$this->load->view('edit_reference_view', $data);
	}//End of function edit_reference_index

	/**
	 * Edit reference based on the input of the user
	 *
	 * @access public
	 */
	public function edit_reference(){
		$data['title'] = "Edit Reference - ICS OnLib";
		$this->load->helper('text');

		$id = $this->uri->segment(3);

		if($id === 	FALSE) redirect('librarian');

		if ($this->form_validation->run('edit_reference') == FALSE)
		{
			$this->session->set_userdata(array('editReferenceFailed' => TRUE));
			$this->load->view('edit_reference_view', $data);
		}
		else
		{
			//Filter the user's input of HTML special symbols
			$title = htmlspecialchars(mysql_real_escape_string(trim($this->input->post('title'))), ENT_QUOTES);
			$author = htmlspecialchars(mysql_real_escape_string(trim($this->input->post('author'))), ENT_QUOTES);
			$isbn = htmlspecialchars(mysql_real_escape_string(trim($this->input->post('isbn'))), ENT_QUOTES);
			$category = htmlspecialchars(mysql_real_escape_string(trim($this->input->post('category'))), ENT_QUOTES);
			$publisher = htmlspecialchars(mysql_real_escape_string(trim($this->input->post('publisher'))), ENT_QUOTES);
			$publication_year = htmlspecialchars(mysql_real_escape_string(trim($this->input->post('publication_year'))), ENT_QUOTES);
			$access_type = htmlspecialchars(mysql_real_escape_string(trim($this->input->post('access_type'))), ENT_QUOTES);
			$course_code = htmlspecialchars(mysql_real_escape_string($this->input->post('course_code')), ENT_QUOTES);
			$description = htmlspecialchars(mysql_real_escape_string(trim($this->input->post('description'))), ENT_QUOTES);
			$total_stock = htmlspecialchars(mysql_real_escape_string($this->input->post('total_stock')), ENT_QUOTES);

			//DO NOT TRUST the user's input. Server-side input validation
			if($total_stock <= 0)
				redirect('librarian/edit_reference_index/' . $id);			
			if(! in_array(strtoupper($category), array('B', 'S', 'C', 'J', 'M', 'T')))
				redirect('librarian/edit_reference_index/' . $id);
			if(! (intval($publication_year) >= 1000 AND intval($publication_year) <= date('Y')))
				redirect('librarian/edit_reference_index/' . $id);
			if(preg_match("/\A[A-Z]{2,3}\d{2,3}\z/", $course_code) === FALSE)
				redirect('librarian/edit_reference_index/' . $id);

			//Store the input from user to be passed on the model
		    $query_array = array(
		       	'title' => $title,
		       	'author' => $author,
		       	'isbn' => $isbn,
		       	'category' => $category,
		       	'publisher' => $publisher,
		       	'publication_year' => $publication_year,
		       	'access_type' => $access_type,
		       	'course_code' => $course_code,
		       	'description' => $description,
		       	'total_stock' => $total_stock,
		       	'id' => $id
		    );

		    $result = $this->librarian_model->edit_reference($query_array);
		    $this->session->set_userdata(array('editReferenceSuccess' => TRUE));
		    redirect('librarian/edit_reference_index/' . $id);
		}
	}//End of function edit_reference

	/* **************************************** END OF EDIT REFERENCE MODULE **************************************** */

	/* **************************************** DELETE REFERENCE MODULE **************************************** */
	/**
	 * Delete selected references specified by its respective checkbox
	 *
	 * @access public
	 */
    public function delete_reference(){
        $data['title'] = "Librarian - ICS OnLib";

		$cannotBeDeleted = array();
		if(! empty($_POST['ch'])){
			if(count($this->input->post('ch')) > 0):
				$toDelete = $this->input->post('ch');
				
				$toBeRemovedNumber = count($toDelete);

				for($i = 0; $i < $toBeRemovedNumber; $i++){
					$result = $this->librarian_model->delete_references($toDelete[$i]);
					if($result != -1)
						$cannotBeDeleted[] = $result;
				}
				 
			endif;
		}

		if(count($cannotBeDeleted) > 0){
			$data['forDeletion'] = $this->librarian_model->get_selected_books($cannotBeDeleted);
			$this->load->view('for_deletion_view',$data);
		}
		else
			redirect('librarian');
    }//End of function delete_reference
	
	/**
	 * Updates for_deletion attribute of references in case they cannot be deleted immediately
	 *
	 * @access public
	 */
	public function change_forDeletion(){
		 $data['title'] = "Librarian - ICS OnLib";
		 
		 if(! empty($_POST['ch'])):
			$toUpdate = $this->input->post('ch');
			for($i = 0; $i < count($toUpdate); $i++){
				$this->librarian_model->update_for_deletion($toUpdate[$i]);
			}
		 endif;

		$readyResult = $this->librarian_model->get_ready_for_deletion();
		$data['readyDeletion']	= $readyResult;
		$idready = array();

		foreach($readyResult as $row):
			$idready[] = $row->id;
		endforeach;
		
		$data['query'] = $this->librarian_model->get_other_books($idready);	
		redirect('librarian');
	}//End of function change_forDeletion

	/* **************************************** END OF DELETE REFERENCE MODULE **************************************** */

	/* **************************************** ADD REFERENCE MODULE **************************************** */

	/**
	 * Loads the view for adding references
	 *
	 * @access public
	 */
	public function add_reference_index(){
		$data['title'] = "Librarian - ICS OnLib";

		$this->load->view('add_view', $data);
	}//End of function add_reference_index

	/**
	 * Add a reference to the database
	 *
	 * @access public
	 */
	public function add_reference(){
		$data['title'] = "Add Reference Material - ICS OnLib";

		if ($this->form_validation->run('add_book') == FALSE)
		{
			$this->load->view('addReference_view', $data);
		}
		else
		{
			if($this->input->post('submit')) {
				$data = array(
		        	'TITLE' => htmlspecialchars(trim($this->input->post('title')), ENT_QUOTES),
		            'AUTHOR' => htmlspecialchars(trim($this->input->post('author')), ENT_QUOTES),
		            'ISBN' => htmlspecialchars($this->input->post('isbn'), ENT_QUOTES),
		            'CATEGORY' => htmlspecialchars($this->input->post('category'), ENT_QUOTES),
		            'DESCRIPTION' => htmlspecialchars(trim($this->input->post('description')), ENT_QUOTES),
		            'PUBLISHER' => htmlspecialchars(trim($this->input->post('publisher')), ENT_QUOTES),
		            'PUBLICATION_YEAR' => htmlspecialchars($this->input->post('year'), ENT_QUOTES),
		            'ACCESS_TYPE' => htmlspecialchars($this->input->post('access_type'), ENT_QUOTES),
		            'COURSE_CODE' => htmlspecialchars($this->input->post('course_code'), ENT_QUOTES),
		            'TOTAL_AVAILABLE' => htmlspecialchars($this->input->post('total_available'), ENT_QUOTES),
		            'TOTAL_STOCK' => htmlspecialchars($this->input->post('total_stock'), ENT_QUOTES),
					'TIMES_BORROWED' => '0',
		            'FOR_DELETION' => 'F'
	        	);

				//Setting empty fields that can be NULL to NULL
				if($data['ISBN'] == '')
					$data['ISBN'] = NULL;
				if($data['DESCRIPTION'] == '')
					$data['DESCRIPTION'] = NULL;
				if($data['PUBLISHER'] == '')
					$data['PUBLISHER'] = NULL;
				if($data['PUBLICATION_YEAR'] == '')
					$data['PUBLICATION_YEAR'] = NULL;

				//Server-side Input validation
				//Missing not-NULLable data validation
				if($data['TITLE'] == '' OR $data['AUTHOR'] == '' OR $data['CATEGORY'] == '' OR $data['ACCESS_TYPE'] == '' OR $data['COURSE_CODE'] == '' OR $data['TOTAL_AVAILABLE'] == '')
					redirect('librarian/add_reference');
				//Category fixed pre-defined set of values validation
				if(! in_array($data['CATEGORY'], array('B', 'M', 'S', 'J', 'T', 'C')))
					redirect('librarian/add_reference');
				//Access Type fixed pre-defined set of values validation
				if(! in_array($data['ACCESS_TYPE'], array('S', 'F')))
					redirect('librarian/add_reference');
				//Publication Year value validation
				if($data['PUBLICATION_YEAR'] != '' && (intval($data['PUBLICATION_YEAR']) < 1900 OR intval($data['PUBLICATION_YEAR']) > intval(date('Y'))))
					redirect('librarian/add_reference');
				//Total Available value validation
				if(intval($data['TOTAL_AVAILABLE']) < 1 OR ($data['TOTAL_AVAILABLE'] > $data['TOTAL_STOCK']))
					redirect('librarian/add_reference');
				//Total Stock value validation
				if(intval($data['TOTAL_STOCK']) < 1)
					redirect('librarian/add_reference');
				if(preg_match("/\A[A-Z]{2,3}[0-9]{1,3}\z/", $data['COURSE_CODE']) == 0)
					redirect('librarian/add_reference');

				$this->librarian_model->add_data($data);
				$data['title'] = "Librarian - ICS OnLib";

				$this->session->set_userdata(array('addReferenceSuccess' => TRUE));
				redirect('librarian/add_reference');
			}else{
				$this->load->view("addReference_view", $data);
			}
		}
	}//End of function add_reference

	/**
	 * Loads and validates the file uploaded by the user
	 *
	 * @access public
	 */
	public function file_upload(){
		$data['title'] = "Librarian - ICS OnLib";
		$data['message'] = '';

		if($this->input->post()){
			$config_arr = array(
	            'upload_path' => './uploads/',
	            'allowed_types' => 'text/plain|text/csv|csv',
	            'max_size' => '2048'
	        );

	        $this->load->library('upload', $config_arr);

			if(! $this->upload->do_upload('csvfile')){
				$data['error'] = $this->upload->display_errors();
				$this->load->view("fileUpload_view", $data);
			}
			else{
				$uploadData = array('upload_data' => $this->upload->data());
				$filename='./uploads/'.$uploadData['upload_data']['file_name'];
				$this->load->library('CSVReader');
		        $data['csvData'] = $this->csvreader->parse_file($filename);
		        
		        if(empty($data['csvData'])){
		        	$data['message'] = 'CSV file does not contain any data.';
		        	$this->load->view('fileUpload_view', $data);
		        }
		        else
			        if(! array_key_exists('TITLE', $data['csvData'][0]) OR
						! array_key_exists('AUTHOR', $data['csvData'][0]) OR
						! array_key_exists('ISBN', $data['csvData'][0]) OR
						! array_key_exists('CATEGORY', $data['csvData'][0]) OR
						! array_key_exists('DESCRIPTION', $data['csvData'][0]) OR
						! array_key_exists('PUBLISHER', $data['csvData'][0]) OR
						! array_key_exists('PUBLICATION_YEAR', $data['csvData'][0]) OR
						! array_key_exists('ACCESS_TYPE', $data['csvData'][0]) OR
						! array_key_exists('COURSE_CODE', $data['csvData'][0]) OR
						! array_key_exists('TOTAL_AVAILABLE', $data['csvData'][0]) OR
						! array_key_exists('TOTAL_STOCK', $data['csvData'][0]) OR
						! array_key_exists('TIMES_BORROWED', $data['csvData'][0]) OR
						! array_key_exists('FOR DELETION', $data['csvData'][0])
			        	){
			        	$data['message'] = 'File does not follow correct format. Refer to FAQs in the home page.';
			        	$this->load->view('fileUpload_view', $data);
			        }
			        else
						$this->load->view("uploadSuccess_view", $data);
				
			}
		}
		else{
			$this->load->view("fileUpload_view", $data);     
		}
	}//End of function file_upload

	/**
	 * Adds multiple references to the database using the data in the file
	 *
	 * @access public
	 */
	public function add_multipleReferences(){
		$data['title'] = "Librarian - ICS OnLib";
		$data['message'] = '';
		
		if($this->input->post()){
		    $count = $this->input->post('rowCount');

		    for($i = 0; $i < $count; $i++) {
				$data[$i] = array(
					'TITLE' => htmlspecialchars(mysql_real_escape_string($this->input->post('title' . $i)), ENT_QUOTES),
					'AUTHOR' => htmlspecialchars(mysql_real_escape_string($this->input->post('author' . $i)), ENT_QUOTES),
					'ISBN' => htmlspecialchars(mysql_real_escape_string($this->input->post('isbn' . $i)), ENT_QUOTES),
					'CATEGORY' => htmlspecialchars(mysql_real_escape_string($this->input->post('category' . $i)), ENT_QUOTES),
					'DESCRIPTION' => htmlspecialchars(mysql_real_escape_string($this->input->post('description' . $i)), ENT_QUOTES),
					'PUBLISHER' => htmlspecialchars(mysql_real_escape_string($this->input->post('publisher' . $i)), ENT_QUOTES),
					'PUBLICATION_YEAR' => htmlspecialchars(mysql_real_escape_string($this->input->post('year' . $i)), ENT_QUOTES),
					'ACCESS_TYPE' => htmlspecialchars(mysql_real_escape_string($this->input->post('access_type' . $i)), ENT_QUOTES),
					'COURSE_CODE' => htmlspecialchars(mysql_real_escape_string($this->input->post('course_code' . $i)), ENT_QUOTES),
					'TOTAL_AVAILABLE' => htmlspecialchars(mysql_real_escape_string($this->input->post('total_available' . $i)), ENT_QUOTES),
					'TOTAL_STOCK' => htmlspecialchars(mysql_real_escape_string($this->input->post('total_stock' . $i)), ENT_QUOTES),
					'TIMES_BORROWED' => htmlspecialchars(mysql_real_escape_string($this->input->post('times_borrowed' . $i)), ENT_QUOTES),
					'FOR_DELETION' => htmlspecialchars(mysql_real_escape_string($this->input->post('for_deletion' . $i)), ENT_QUOTES)
				);
		    }

	    	$this->librarian_model->add_multipleData($data, $count);
	    	$data['message'] = 'Data has been saved.';
	    	$this->load->view('fileUpload_view', $data);
		}
	}//End of function add_multipleReferences

	/* **************************************** END OF ADD REFERENCE MODULE **************************************** */

	/**
	 * Displays information about the libarian
	 *
	 * @access public
	 */
	public function view_profile(){
		$data['title'] = "Librarian - ICS OnLib";
		$this->load->model('administrator_model');

		$data['results'] = $this->administrator_model->get_profile($this->session->userdata('id'));

		$this->load->view('user_profile_view', $data);
	}

	/* **************************************** GENERATE REPORT MODULE **************************************** */
	/**
	 * Function report generation
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function view_report_index(){
		$data['title'] = "Librarian - ICS OnLib";
		$this->load->view("report_generation_view", $data);
	}

	/**
	 * Function to view report
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function view_report(){
		$data['title'] = "Librarian - ICS OnLib";
		$this->load->library('fpdf/fpdf');//load fpdf class; a free php class for pdf generation
		$this->load->model('user_model');

		$type = $_POST['print_by'];
		$startdate='';
		$enddate='';
		
		if($type == "custom"){
			$startdate=$this->input->post('day1');
			$enddate=$this->input->post('day2');

			if($startdate == NULL || $enddate == NULL)
				redirect('librarian/view_report_index');
			else if($enddate < $startdate)//end date is a date before the startdate
				redirect('librarian/view_report_index');
		}

		$result = $this->librarian_model->get_data($type,$startdate,$enddate);
		if($result != NULL){
			$data = $this->librarian_model->get_data($type,$startdate,$enddate); 
			$this->load->view('pdf_report_view', $data);
		}
		else{
			redirect('librarian/view_report_index');
		}
	}

	/* **************************************** END OF GENERATE REPORT MODULE **************************************** */

	/**
	 * Function for direct borrowal of a reference
	 *
	 * This function updates the transactions table.
	 *
	 * @access private
	 */
	public function direct_borrow(){
		$referenceId = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';

		if(isset($_POST['submit'])){
			$username = trim(htmlspecialchars(($this->input->post('username'))));
			$password = md5($this->input->post('password'));

			//Account exists
			if($this->user_model->user_exists($username, $password)){
				$userInfo = $this->librarian_model->get_user_info($username, $password);
				$referenceInfo = $this->librarian_model->get_reference_info($referenceId);

				//Check borrow limit of user, access priveleges, and availability of reference material
				//If it satisfies all the conditions
				if($userInfo['borrow_limit'] > 0 && ($userInfo['user_type'] == 'F' OR $referenceInfo['access_type'] == $userInfo['user_type'])
					&& $referenceInfo['total_available'] > 0){
					
					$this->librarian_model->direct_borrow($referenceInfo, $userInfo);

					$this->session->set_userdata('directBorrowSuccess', TRUE);
					redirect('librarian/view_reference/'. $referenceId);
				}
				//Didn't satisfied the conditions required
				else{
					$message = 'Direct Borrow Failed<br/><ul>';

					if($userInfo['borrow_limit'] <= 0)
						$message .= "<li>The user reached the maximum allowed number of reference material.</li>";

					if($referenceInfo['access_type'] == 'F' && $userInfo['user_type'] != 'F')
						$message .= "<li>The user is not allowed to borrow the reference material due to access privilege.</li>";

					if($referenceInfo['total_available'] < 0)
						$message .= "<li>The reference material is currently not available.</li>";

					$this->session->set_userdata(array('directBorrowFailed' => TRUE));
					$this->session->set_userdata(array('directBorrowFailedMessage' => $message));

					$message .= '</ul>';
					redirect("librarian/view_reference/$referenceId");
				}
			}else{
				$this->session->set_userdata(array('userAuthenticationFailed' => TRUE));
				redirect("librarian/view_reference/$referenceId");
			}
		}
		else{
			show_404(base_url('index.php/librarian/direct_borrow' . $referenceId));
		}
	}

	/**
	 * Decrements/Increments the total_available of a reference
	 *
	 * @access public
	 */
	public function claim_return(){
		$referenceId = $this->uri->segment(3);
		$userId = $this->uri->segment(4);
		$flag = $this->uri->segment(5);

		if(intval($referenceId) > 0 && intval($userId) > 0)
			$this->librarian_model->claim_return_reference($referenceId, $userId, $flag);

		redirect('librarian/view_reference/' . $referenceId, 'refresh');
	}

	/**
	 * Controller function for diplaying overdue references
	 *
	 * @access public
	 */
	public function get_overdue_transactions(){
		$data['title'] = 'Librarian - ICS OnLib';

		$offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

		$queryArray = array(
			'sort' => $this->input->get('sortBy'),
			'order' => $this->input->get('order'),
			'page' => $this->input->get('page'),
			'offset' => $offset
			);

		//Server-side select validation
		if(! in_array($queryArray['sort'], array('last_name', 'title', 'user_type', 'category', 'daysOverdue')))
			redirect('librarian');
		if(! in_array($queryArray['order'], array('ASC', 'DESC')))
			redirect('librarian');
		if(! in_array($queryArray['page'], array('10', '25', '50', '75', '100', 'all')))
			redirect('librarian');

		$data['numberOfoverDueTransactions'] = $this->librarian_model->get_overdue()->num_rows();

		$this->initialize_pagination(base_url("index.php/librarian/get_overdue_transactions?
				sortBy={$queryArray['sort']}
				&order={$queryArray['order']}
				&page={$queryArray['page']}
				&offset={$offset}"), $queryArray['page'], $data['numberOfoverDueTransactions']);

		$data['overdueTransactions'] = $this->librarian_model->get_overdue_part($queryArray)->result();

		$data['offset'] = $offset;
		$data['per_page'] = $queryArray['page'];

		$this->load->view('search_reference_view', $data);
	}//End of function get_overdue_transactions
}

?>