<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller for Login
 *
 * @package 	icsls
 * @category 	Controller
 * @author 		Jefferson R. Ferrera
 * @version 	1.0
*/

class Login extends CI_Controller{
	public function Login(){
		parent::__construct();
	}

	/**
	 * Controller to check if the user is registered or not and allows the user to log in
	 * according to user type
	 * @access	public
	 * @param	none
	 * @return	none
	 */	
	public function index(){
		//Empties cart content
		$this->cart->destroy();

		if(!$this->input->post('username') && !$this->input->post('password')){
			$username = "";
			$password = "";
		}
		else{
			$username = htmlspecialchars(mysql_real_escape_string($this->input->post('username')));
			$password = htmlspecialchars(mysql_real_escape_string(md5($this->input->post('password'))));
		}
		
		$checker = $this->user_model->user_exists($username, $password);
		
		//Checks if the user is registered
		if($checker && $checker->is_activated == 'T'){
			$userData = $this->user_model->get_user_data($username, $password);

			$sessionData = array(
				'loggedIn' => true,
				'id' => $userData[0]->id,
				'userType' => $userData[0]->user_type,
				'username' => $userData[0]->username,
				'email_address' => $userData[0]->email_address,
				'firstName' => $userData[0]->first_name
				);

			$this->session->set_userdata($sessionData);
			
			//Loads the correct view corresponding to the appropriate user
			if($userData[0]->user_type == 'A'){
				redirect("administrator", 'refresh');
			}else if($userData[0]->user_type == 'L'){
				redirect("librarian", 'refresh');
			}else if($userData[0]->user_type == 'F' || $userData[0]->user_type == 'S'){
				redirect("home", 'refresh');
			}
		}
		else if($checker && $checker->is_activated == 'F'){
			$data["title"] = "Login Failed - ICS Library System";
			$data["loginMessage"] = "Account deactivated. Please contact ICS OnLib Administrator for more information.";
			sleep(2);
			$this->load->view("login_view", $data);
		}
		else{
			$data["title"] = "Login Failed - ICS Library System";
			$data["loginMessage"] = "Username and/or password didn't match.";
			sleep(2);
			$this->load->view("login_view", $data);
		}
	}
}

?>