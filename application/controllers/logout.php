<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller for Logout
 *
 * @package 	icsls
 * @category 	Controller
 * @author 		Jefferson R. Ferrera
 * @version 	1.0
*/

class Logout extends CI_Controller{
	public function Logout(){
		parent::__construct();

		if(!$this->session->userdata('loggedIn')) redirect('home');
	}

	public function index(){
		$this->user_model->insert_log($this->session->userdata('username')." logged out.");
		$this->session->sess_destroy();

		$data["title"] = "Logout - ICS OnLib";
		redirect('home');
	}
}

?>