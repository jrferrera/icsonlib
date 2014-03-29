<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Faq controller
 *
 * @author	Team 5
 * @version 1.0
 *
 */

class Faq extends CI_Controller{
	public function Faq(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Frequently Asked Questions - ICS OnLib';

		$this->load->view('faq_view', $data);
	}
}

?>