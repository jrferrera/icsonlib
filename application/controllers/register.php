<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller for register
 *
 * @package 	icsls
 * @category 	Controller
 * @author 		Team 4
 * @version 	1.0
*/

class Register extends CI_Controller{
	public function Register(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('calendar');

		if($this->session->userdata('loggedIn'))	show_404();
	}

	/**
	 * Function for registration
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function index(){
		$data["title"] = "Register - ICS Library System";
		$this->load->view('register_view', $data);
	}

	/**
	 * Function for creating user accounts
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function create_account(){
		$data['title'] = 'Home - ICS OnLib';
		$prefs = array (
               'show_next_prev'  => TRUE,
               'day_listing'	=>'short',
               'next_prev_url'   => base_url('index.php/register/create_account/'),
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
	

		$data['calendar'] = $this->calendar->generate(abs(intval($this->uri->segment(3))), abs(intval($this->uri->segment(4))));

		//Removes validation rules if not a faculty
		if($this->input->post('user_type') == 'F'){
			//10 - index of student number, 11 - index of college minus 1, 12 - index of college minus 2
			$this->form_validation->unset_config('registration', 10);
			$this->form_validation->unset_config('registration', 11);
			$this->form_validation->unset_config('registration', 12);
		}

		if ($this->form_validation->run('registration') == FALSE)
		{
			$this->session->set_userdata(array('registrationError' => TRUE));
			$this->load->view('home_view', $data);
		}
		else
		{
			//if User is a student
			if($this->input->post('user_type') == 'S'){
				$studnum = $this->input->post('student_number');
				$uname = $this->input->post('username');

				$studentQuery = $this->user_model->student_exists($studnum);
				$usernameQuery = $this->user_model->username_exists($uname);

				if($studentQuery == true || $usernameQuery == true){
					$sessionData = array('registered' => false, 'stud' => true);
					$this->session->set_userdata($sessionData);
					redirect('register');
				}else {	
					$this->load->model('user_model');
					$this->user_model->insert_account('users', $_POST);
					
					$sessionData = array('registered' => true);
					$this->session->set_userdata($sessionData);
					redirect('register');
				}
			}
			//if User is a faculty
			else if($this->input->post('user_type') == 'F'){
				$enum = $this->input->post('employee_number');
				$uname = $this->input->post('username');

				$facultyQuery = $this->user_model->staff_exists($enum);
				$usernameQuery = $this->user_model->username_exists($uname);

				if($facultyQuery == true || $usernameQuery == true){
					$sessionData = array('registered' => false, 'staff' => true);
					$this->session->set_userdata($sessionData);
					redirect('register');
				}else {
					$this->load->model('user_model');
					$this->user_model->insert_account('users', $_POST);
					
					$sessionData = array('registered' => true);
					$this->session->set_userdata($sessionData);
					redirect('register');
				}
			}
		}		
	}	
}

?>