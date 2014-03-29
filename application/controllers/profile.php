<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller for profile
 *
 * @package 	icsls
 * @category 	Controller
 * @author 		Jefferson R. Ferrera
 * @version 	1.0
*/

class Profile extends CI_Controller{
	public function Profile(){
		parent::__construct();

		// if(! $this->session->userdata('loggedIn'))	show_error('User Profile Unavailable. Please log-in to view your profile.', 203);
		
		if(!$this->session->userdata('loggedIn')){
			$this->session->set_userdata(array('profileViewFailed' => TRUE));
			redirect('home');
		}
		$this->load->library('form_validation');
	}

	/**
	 * Function to get and display user information
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */	
	public function index(){
		$data["title"] = "Profile - ICS OnLib";
		$id = $this->session->userdata('id');

		//Checks if user exists
		if($this->user_model->user_exists_by_id($id)){
			$username = $this->session->userdata('username'); //Get username from session data
			$id = $this->session->userdata('id'); //Get user id from session data
			
			$data['query_user'] = $this->user_model->get_user_profile($id); //query for user table
			$data['reserved_materials'] = $this->user_model->get_reserved_materials($id);
			$data['waitlisted_materials'] = $this->user_model->get_waitlisted_materials($id);
			$data['waitlist_max'] = $this->user_model->get_waitlist_max($id);
			$data['borrowed_materials'] = $this->user_model->get_borrowed_materials($id);

			$data['image'] = $this->user_model->get_profile_picture($id);
			
			$this->load->view("user_profile_view", $data);
		}
	}

	/**
	 * Function to save user profile
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function save(){
		$data["title"] = "Profile - ICS Library System";

		$username = $this->session->userdata('username');
		$id = $this->session->userdata('id');
		$user_type = $this->session->userdata('user_type');

		//Get user information
		$data['query_user'] = $this->user_model->get_user_profile($id); 
		$data['query_book'] = $this->user_model->user_book($id);
		$data['image'] = $this->user_model->get_profile_picture($id);

		//Removes validation rules if username is the same
		if($this->input->post('username') == $this->session->userdata('username'))
			//0 - index of username
			$this->form_validation->unset_config('edit_profile', 0);

		if ($this->form_validation->run('edit_profile') == FALSE)
		{
			$this->session->set_userdata(array('profileUpdateFailed' => TRUE));
			$this->load->view('user_profile_view', $data);
		}else{
			if($this->input->post('oldpassword') != ""){
				$oldPassword = md5(trim(htmlspecialchars($this->input->post('oldpassword'))));
				$passwordQuery = $this->user_model->check_user_password($id, $oldPassword);

				$message = '';

				if($passwordQuery){
					$newPassword = trim(htmlspecialchars($this->input->post('password')));
					$confirmPassword = trim(htmlspecialchars($this->input->post('repassword')));

					//If the fields are not null
					if($newPassword != "" && $confirmPassword != ""){
						$password = md5(trim(htmlspecialchars($newPassword)));
					}else if($newPassword == "" || $confirmPassword == ""){
						$message .= 'Profile update failed. New password and confirm password did not match.';
						$this->session->set_userdata(array('passwordChangeFailedMatch' => TRUE));
						$this->session->set_userdata(array('passwordChangeMessageMatch' => $message));
						redirect('profile');
					}
				}else{
					$message .= 'Profile update failed. Enter correct old password.';
					$this->session->set_userdata(array('passwordChangeFailedAutheticate' => TRUE));
					$this->session->set_userdata(array('passwordChangeMessageAutheticate' => $message));
					redirect('profile');
				}
			}
			else { //if password is the same as before
				$query = $this->user_model->get_user_profile($id);
				$password = $query->password;
			}
			
			$username = trim(htmlspecialchars($this->input->post("username")));

			$college_address = trim(htmlspecialchars($this->input->post("college_address")));
			$contact_number = trim(htmlspecialchars($this->input->post("contact_number")));
		
			//update user profile
			$this->user_model->user_update_profile($id, $username, $password, $college_address, $contact_number);
			
			$this->session->set_userdata(array('profileSuccessfullySaved' => TRUE));
			//reset user data on session
			$sessionData = array('username' => $username); 
			$this->session->set_userdata($sessionData);

			redirect('profile', 'refresh');
		}
	}

	/**
	 * Function to change profile picture
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function change_profile_picture(){
		$this->load->library('upload');
		$id = $this->session->userdata('id');
		$uploadSuccessful = $this->user_model->upload_picture($id);

		if($uploadSuccessful){
			$this->session->set_userdata(array('uploadSuccessful' => TRUE));
		}else{
			$this->session->set_userdata(array('uploadFailed' => TRUE));
		}
		
		redirect('profile', 'refresh');
	}

	/**
	 * Function for cancelling reserved and waitlisted books
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function cancel_transaction(){
		$referenceId = $this->input->post('ref_id');
		$id = $this->session->userdata('id');

		//If "Cancel Reservation" was clicked
		if($this->input->post('cancel_reserve')){
			$cancelStatus = $this->user_model->cancel_reserve_reference_materials($referenceId, $id);
			$data["title"] = "Profile - ICS Library System";

			$username = $this->session->userdata('username'); // get username from session
			$id = $this->session->userdata('id'); //get user id from session
			
			$data['query_user'] = $this->user_model->get_user_profile($id); //query for user table
			$data['query_book'] = $this->user_model->user_book($id); //query for transactions table
			
			$sessionData = array('cancelReserve' => TRUE);
			$this->session->set_userdata($sessionData);

			$data['save_message'] = "";
			redirect("profile");
		}

		//If "Cancel Waitlist" was clicked
		if($this->input->post('cancel_waitlist')){
			$cancelStatus = $this->user_model->cancel_waitlist_reference_materials($referenceId, $id);
			$data["title"] = "Profile - ICS Library System";

			$username = $this->session->userdata('username'); // get username from session
			$id = $this->session->userdata('id'); //get user id from session
			
			$data['query_user'] = $this->user_model->get_user_profile($id); //query for user table
			$data['query_book'] = $this->user_model->user_book($id); //query for transactions table
			
			$sessionData = array('cancelWaitlist' => TRUE);
			$this->session->set_userdata($sessionData);

			$data['save_message'] = "";
			redirect('profile');
		}
	}
}

?>