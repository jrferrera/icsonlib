<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Devteam controller
 *
 * @author	Team 5
 * @version 1.0
 *
 */

class Devteam extends CI_Controller{
	public function Devteam(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Development Team - ICS OnLib';

		$this->load->view('dev_view', $data);
	}
}

?>