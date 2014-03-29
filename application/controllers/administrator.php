<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller for Administrator module
 *
 * @package 	icsls
 * @category 	Controller
 * @author 		Team 1
 * @version 	1.0
*/

class Administrator extends CI_Controller{
	public function Administrator(){
		parent::__construct();

		//Check if the user is logged-in and is an administrator
		if(! $this->session->userdata('loggedIn') || $this->session->userdata('userType') != 'A'){
			show_404();
		}

		$this->load->model("administrator_model");
		$this->load->library('form_validation');
	}

	public function index(){
		$data['title'] = 'Administrator Home - ICS OnLib';
		$this->view_accounts();
	}

	/**
	 * Function to get all accounts
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */	
	public function view_accounts(){
		$data['title'] = 'View Accounts - ICS OnLib';
		$this->load->library('pagination');
		
		//Gets the value of the hidden input tags if not NULL
		$searchText = trim(htmlspecialchars($this->input->post('hidden_search_text'), ENT_QUOTES));
		$searchCategory = trim(htmlspecialchars(str_replace(' ', '_', $this->input->post('hidden_category')), ENT_QUOTES));
		
		//Checks if the user selected a particular sort order
		if($this->input->post('sort_category')){
			$sortCategory =  $this->input->post('sort_category');
			$this->session->set_userdata(array('sortCategory' => $sortCategory));
			$data['sortCategory'] = $sortCategory;
		}else if($this->session->userdata('sortCategory')){
			$sortCategory = $this->session->userdata('sortCategory');
			$data['sortCategory'] = $sortCategory;
		}else{
			$sortCategory = 'last_name';
			$data['sortCategory'] = $sortCategory;
		}
		
		//Sets the item per page
		$itemsPerPage = 10;
		
		//Gets the offset
		$offset = $this->uri->segment(3) < 1 ? 0 : (($this->uri->segment(3)-1)*$itemsPerPage);

		//Checks if the user specified specific search text and category
		//Gets data depending on the user input
		if($searchText && $searchCategory){
			$accounts = $this->administrator_model->get_limited_search_accounts($searchCategory, $searchText, $sortCategory, $itemsPerPage, $offset);
			$accountCount = $this->administrator_model->get_search_accounts_count($searchCategory, $searchText);
		}else{
			$accounts = $this->administrator_model->get_all_limited_accounts($sortCategory, $itemsPerPage, $offset);
			$accountCount = $this->administrator_model->get_total_accounts();
		}

		if($accountCount > 0) $data['accounts'] = $accounts->result();

		//Configures pagination if the output count is greater than the items per page
		if($accountCount > $itemsPerPage){
			$config['base_url'] = base_url().'index.php/administrator/view_accounts';
			$config['per_page'] = $itemsPerPage;
			$config['full_tag_open'] = '<p>';
			$config['full_tag_close'] = '</p>';
			$config['prev_link'] = '&lt; &lt; Previous';
			$config['next_link'] = 'Next &gt; &gt;';
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
			$config['total_rows'] = $accountCount;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = 1;

			$this->pagination->initialize($config);
		}

		$data['accountCount'] = $accountCount;
		$data['offset'] = $offset;
		$data['searchText'] = $searchText;
		$data['searchCategory'] = str_replace('_', ' ', $searchCategory);
	
		if($this->session->userdata('searchText') && $this->session->userdata('searchText')){
			$this->session->unset_userdata('searchText');
			$this->session->unset_userdata('searchCategory');
		}
		
		$this->load->view('view_accounts_view', $data);		
	}
	
	/**
	 * Function to get selected user/s to be deleted
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */	
	public function delete_accounts(){
		//Gets the post value of the 'users' checkbox
		//$users contains the array of users that has been checked to be deleted
		$users = $this->input->post('users');

		//Checks if $users has a value. If true, accesses from the administrator_model the delete_accounts function, with $users as parameter
		if($users){	
			foreach($users as $value)
	        {
	        	//check if account to be deleted is not own/logged in account
				if($value != $this->session->userdata('id')){
						
					$transaction = $this->administrator_model->check_transaction($value);

					if($transaction==NULL){						
							$this->administrator_model->delete_accounts($value);					
					}
					else{
						if($transaction->date_returned == NULL && $transaction->date_borrowed !=NULL){
							$this->administrator_model->delete_accounts($value);						
						}
						else{
							$this->session->set_userdata('delete_trans', TRUE);
							redirect('administrator/view_accounts');	
						}
					}											
				}
				else{
					$this->session->set_userdata('delete_own', TRUE);
					redirect('administrator/view_accounts');	
				}
	        }				
		}
		$this->session->set_userdata('delete_success',TRUE);

		//After deleting account/s, it redirects to view_accounts() method.
		redirect('administrator/view_accounts');		
	}

	/**
	 * Function to searching user/s
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */	
	public function search_accounts(){
		if($this->input->post('submit') && !$this->input->post('search_text')) redirect('administrator/view_accounts');
		
		$data['title'] = 'Search Account Results - ICS OnLib';
		$this->load->library('pagination');
		
		//Gets the user input from the form
		$searchText = trim(htmlspecialchars($this->input->post('search_text'), ENT_QUOTES));
		$searchCategory = trim(htmlspecialchars($this->input->post('category'), ENT_QUOTES));
		
		if($this->input->post('submit')){
			$this->session->set_userdata(array('searchText' => $searchText));
			$this->session->set_userdata(array('searchCategory' => $searchCategory));
		}
		
		$searchText = $this->session->userdata('searchText');
		$searchCategory = $this->session->userdata('searchCategory');

		//Sets default sort order
		$orderBasis = $this->session->userdata('sortCategory') ? $this->session->userdata('sortCategory') : 'last_name';

		//Sets the item per page
		$itemsPerPage = 10;

		//Gets the offset
		$offset = $this->uri->segment(3) < 1 ? 0 : (($this->uri->segment(3)-1)*$itemsPerPage);

		$accountCount = $this->administrator_model->get_search_accounts_count($searchCategory, $searchText);
		
		if($accountCount > 0) $data['accounts'] = $this->administrator_model->get_limited_search_accounts($searchCategory, $searchText, $orderBasis, $itemsPerPage, $offset)->result();

		//Configures pagination if the output count is greater than the items per page
		if($accountCount > $itemsPerPage){
			$config['base_url'] = base_url().'index.php/administrator/search_accounts';
			$config['per_page'] = $itemsPerPage;
			$config['full_tag_open'] = '<p>';
			$config['full_tag_close'] = '</p>';
			$config['prev_link'] = '&lt; &lt; Previous';
			$config['next_link'] = 'Next &gt; &gt;';
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
			$config['total_rows'] = $accountCount;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = 1;

			$this->pagination->initialize($config);
		}

		$data['accountCount'] = $accountCount;
		$data['offset'] = $offset;
		$data['searchText'] = $searchText;
		$data['searchCategory'] = str_replace('_', ' ', $searchCategory);
		$data['sortCategory'] = $orderBasis;
		
		$this->load->view('view_accounts_view', $data);
	}
	
	/**
	 * Function to creating an account
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */	
	public function create_account(){
		$data['title'] = "Create Account - ICS OnLib";

		if ($this->form_validation->run('create_account') == FALSE)
		{
			$this->load->view('create_account_view', $data);
		}
		else
		{
			$employee_no = trim(htmlspecialchars($this->input->post('employee_no')));			
			$last_name = trim(htmlspecialchars($this->input->post('last_name')));
			$first_name = trim(htmlspecialchars($this->input->post('first_name')));
			$middle_name = trim(htmlspecialchars($this->input->post('middle_name')));
			$user_type = trim(htmlspecialchars($this->input->post('user_type')));
			$username = trim(htmlspecialchars($this->input->post('username')));
			$password = trim(htmlspecialchars(md5($this->input->post('password'))));
			$college_address = trim(htmlspecialchars($this->input->post('college_address')));
			$email_address = trim(htmlspecialchars($this->input->post('email_address')));
			$contact = trim(htmlspecialchars($this->input->post('contact')));
			$confirm_password = trim(htmlspecialchars(md5($this->input->post('confirm_password'))));
				
			//Insert the data in the database
			$accounts = $this->administrator_model->insert_account( $employee_no , $last_name, $first_name , $middle_name, $user_type , $username, $password, $college_address, $email_address ,$contact );
						
			$this->session->set_userdata(array('create_success' => TRUE));
			redirect('administrator');
		}
	}
	
	/**
	 * Function for editing/viewing the profile
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */	
	public function edit_account(){
		$data["title"]	= "Edit Account - ICS Library System";

		//Retrieves id of account to be edited through the URI
		$id = trim(htmlspecialchars($this->uri->segment(3)));
		
		$data['row'] = $this->administrator_model->get_existing_account($id);

		$this->load->view("edit_accounts_view", $data);
	}
	
	/**
	 * Function for activating/deactivating user account
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function toggle_account(){
		$id = trim(htmlspecialchars($this->uri->segment(3)));

		if($this->session->userdata('id') == $id){
			$this->session->set_userdata('deactivate_error',TRUE);
			redirect('administrator/view_accounts');
		}
		
		$data['row'] = $this->administrator_model->get_existing_account($id);

		$toggle = $data['row'];

		if($toggle->is_activated == 'T') $value = 'F';
		else $value = 'T';

		$this->administrator_model->update_account_activity($id, $value);

		redirect('administrator/view_accounts');
	}
	
	/**
	 * Function for saving account changes
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */	
	public function save_account_changes(){
		$data["title"]	= "Edit Account - ICS Library System";

		$row_id = trim(htmlspecialchars($this->input->post('row_id')));
		$row = $this->administrator_model->get_existing_account($row_id);
		$data['row'] = $row;
		
		//Removes validation rules if not a faculty
		if($this->input->post('user_type') == 'F' || $this->input->post('user_type') == 'A' || $this->input->post('user_type') == 'L'){
			//9 - index of college, 10 - index of degree
			$this->form_validation->unset_config('edit_account', 9);
			$this->form_validation->unset_config('edit_account', 10);
		}

		//Removes validation rules if username is the same
		if($this->input->post('username') == $row->username)
			//3 - index of username
			$this->form_validation->unset_config('edit_account', 3);

		//Removes validation rules if email address is the same
		if($this->input->post('email_address') == $row->email_address)
			//7 - index of email address
			$this->form_validation->unset_config('edit_account', 7);

		//Perform server-side validation
		if ($this->form_validation->run('edit_account') == FALSE)
		{
			
			$this->load->view('edit_accounts_view', $data);
		}
		else
		{
			$last_name = trim(htmlspecialchars($this->input->post('last_name')));
			$first_name = trim(htmlspecialchars($this->input->post('first_name')));
			$middle_name = trim(htmlspecialchars($this->input->post('middle_name')));
			$username = trim(htmlspecialchars($this->input->post('username')));
			$password = trim(htmlspecialchars($this->input->post('new_password')));
			$college_address = trim(htmlspecialchars($this->input->post('college_address')));
			$email_address = trim(htmlspecialchars($this->input->post('email_address')));
			$contact = trim(htmlspecialchars($this->input->post('contact')));
			$user_type = trim(htmlspecialchars($this->input->post('user_type')));
			
			if($user_type == 'S'){
				$college = $this->input->post('college');
				$degree = $this->input->post('degree');
			}
			else{
				$college = NULL;
				$degree = NULL;
			}
			
			//If the password has been modified
			if($password != ''){
				$password = md5($password);
				
				//Updates account in the database
				$this->administrator_model->save_changes($username,$first_name,$last_name,$middle_name,$password,$college_address,$email_address,$contact,$user_type,$row_id,$college,$degree);
			}else{
				$prev_password = $this->administrator_model->get_password($row_id)->row()->password;

				//Updates account in the database
				$this->administrator_model->save_changes($username,$first_name,$last_name,$middle_name,$prev_password,$college_address,$email_address,$contact,$user_type,$row_id,$college,$degree);
			}

			if($this->session->userdata('id') == $row_id) $this->session->set_userdata('username', $username);
			$this->session->set_userdata('edit_success', TRUE);

			redirect('administrator/edit_account/'.$row_id);
		}
	}
}

?>