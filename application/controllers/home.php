<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Home controller
 *
 * @author	Jefferson R. Ferrera & Marian M. Alvarez
 * @version 1.0
 *
 */

class Home extends CI_Controller{
	public function Home(){
		parent::__construct();

		$prefs = array (
               'show_next_prev'  => TRUE,
               'day_listing'	=>'short',
               'next_prev_url'   => site_url('home/index'),
               'template'		 =>	'
	{table_open}<table class="calendar">{/table_open}
	{week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
	
	{cal_cell_content}<span class="day_listing">{day}</span>&nbsp;&bull; {content}&nbsp;{/cal_cell_content}
	{cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span>&bull; {content}</div>{/cal_cell_content_today}
	{cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
	{cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
'

             );
		$this->load->library('calendar', $prefs);
	}

	public function index(){
		$data["title"] = "Home - ICS OnLib";
		
    	 $data1 = array(
			
		);

		$data['calendar'] = $this->calendar->generate(abs(intval($this->uri->segment(3))), abs(intval($this->uri->segment(4))), $data1);
  
		$this->load->view("home_view", $data);		
	}

}

?>