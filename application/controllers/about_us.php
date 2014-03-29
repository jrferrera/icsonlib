<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Cart controller
 *
 * @author	Team 5
 * @version 1.0
 *
 */

class About_us extends CI_Controller{
	public function About_us(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'About Us - ICS OnLib';

		$this->load->view('about_us_view', $data);
	}
}

?>