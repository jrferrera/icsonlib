<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Administrator Model
 *
 * @package	icsls
 * @category Model	
 * @author	CMSC 128 AB-5L Team 1
 */

class Administrator_model extends CI_Model{

	/**
	 * Counts the total number of existing accounts
	 *
	 * @access	public
	 * @param	none
	 * @return	integer
	 */
	public function get_total_accounts()
	{
		return $this->db->count_all('users');
	}

	/**
	 * Updates account activity
	 *
	 * @access	public
	 * @param	$id (int), $value (int)
	 * @return	none
	 */
	public function update_account_activity($id, $value){
		$this->db->where('id',$id);
		$this->db->update('users',array('is_activated' => $value));

		$this->user_model->insert_log($this->session->userdata('username')." activated account id $id.");
	}

	/**
	 * Gets limited number of accounts sorted based on a specific criteria, limit and offset
	 *
	 * @access	public
	 * @param	string, integer, integer
	 * @return	array
	 */
	public function get_all_limited_accounts($orderBasis, $limit, $offset)
	{
		if($orderBasis == 'employee_number'){
			$this->db->select(array('id', 'employee_number', 'employee_number IS NULL as isnull', 'student_number', 'username', 'last_name', 
					 		 		'first_name', 'middle_name', 'user_type', 'is_activated')
							 )
					 ->from('users')
					 ->order_by("ISNULL(employee_number) asc, employee_number asc");
		}else if($orderBasis == 'student_number'){
			$this->db->select(array('id', 'employee_number', 'student_number', 'student_number IS NULL as isnull', 'username', 'last_name', 
					 		 		'first_name', 'middle_name', 'user_type', 'is_activated')
							 )
					 ->from('users')
					 ->order_by("ISNULL(student_number) asc, student_number asc");
		}else{
			$this->db->select(array('id', 'employee_number', 'student_number', 'username', 'last_name', 
					 		 		'first_name', 'middle_name', 'user_type', 'is_activated')
							 )
					 ->from('users')
					 ->order_by($orderBasis, 'asc');
		}
		
		$this->db->limit($limit, $offset);
		
		return $this->db->get();
	}

	/**
	 * Counts the number of accounts matching the search criteria
	 *
	 * @access	public
	 * @param	string, string
	 * @return	array
	 */
	public function get_search_accounts_count($searchCategory, $searchText)
	{
		$this->db->select('username')
				 ->from('users')
				 ->like($searchCategory, $searchText);

		return $this->db->get()->num_rows();
	}

	/**
	 * Gets limited number of accounts matching the search criteria based on search criteria and offset
	 *
	 * @access	public
	 * @param	string, string, string, integer, integer
	 * @return	array
	 */
	public function get_limited_search_accounts($searchCategory, $searchText, $orderBasis, $limit, $offset)
	{
		if($orderBasis == 'employee_number'){
			$this->db->select(array('id', 'employee_number', 'employee_number IS NULL as isnull', 'student_number', 'username', 'last_name', 
					 		 		'first_name', 'middle_name', 'user_type', 'is_activated')
							 )
					 ->from('users')
					 ->like($searchCategory, $searchText)
					 ->order_by("ISNULL(employee_number) asc, employee_number asc");
		}else if($orderBasis == 'student_number'){
			$this->db->select(array('id', 'employee_number', 'student_number', 'student_number IS NULL as isnull', 'username', 'last_name', 
					 		 		'first_name', 'middle_name', 'user_type', 'is_activated')
							 )
					 ->from('users')
					 ->like($searchCategory, $searchText)
					 ->order_by("ISNULL(student_number) asc, student_number asc");
		}else{
			$this->db->select(array('id', 'employee_number', 'student_number', 'username', 'last_name', 
					 		 		'first_name', 'middle_name', 'user_type', 'is_activated')
							 )
					 ->from('users')
					 ->like($searchCategory, $searchText)
					 ->order_by($orderBasis, 'asc');
		}
		
		$this->db->limit($limit, $offset);
		
		return $this->db->get();
	}
	
	/**
	 * Deletes selected account/s
	 *
	 * @access	public
	 * @param	int
	 * @return	none
	 */	
	public function delete_accounts($value){
		$this->db->delete('users', array('id' => $value));
		$this->user_model->insert_log($this->session->userdata('username')." deleted a user with id $value.");
	}	

	public function check_transaction($value){
		$this->db->select(array('borrower_id', 'date_borrowed', 'date_returned'))
							->from('transactions')
							->where('borrower_id',$value);
		return $this->db->get()->row();
	}		
	
	/* Parameters:
		a. $employee_no , $last_name , $first_name , $middle_name , $user_type , $username , $password , $college_address , $email_address , $contact -
			values of the user to be inserted in to the database	
	
		Description: Function which inserts the user details in to the database
		Return value: 1 if successfully inserted the account else 0
		Created by: Erika Kimhoko, January 29, 2014
	*/

	public function insert_account( $employee_no , $last_name, $first_name , $middle_name,
			$user_type , $username, $password, $college_address, $email_address ,$contact ){
		
			//check if there is the same username 
			//to ensure no duplicates in username to avoid problems in log in
			$this->db->select('username')
								->from('users')
								->where('username',$username);
			
			if($this->db->get()->num_rows() == 0){
				//insert
				$data = array(
				   'employee_number' => $employee_no ,
				   'student_number' => NULL ,
				   'last_name' => $last_name,
				   'first_name' => $first_name ,
				   'middle_name' => $middle_name ,
				   'user_type' => $user_type ,
				   'username' => $username ,
				   'password' => $password ,
				   'college_address' => $college_address ,
				   'email_address' => $email_address ,
				   'contact_number' => $contact ,
				   'borrow_limit' => NULL ,
				   'waitlist_limit' => NULL ,
				   'college' => NULL ,
				   'degree' => NULL ,
				   'profile_picture' => '0.jpg' 
				);

				$this->db->insert('users', $data); 

				$this->user_model->insert_log($this->session->userdata('username')." created an account with username $username.");
				return TRUE;
			}
			else{
				return FALSE;
			}
	}
	
	/**
	 * Gets the user profile
	 *
	 * @access	public
	 * @param	none
	 * @return	row on a database
	 */	
	public function get_profile($id){ //returns the profile of the chosen user
		//****MODIFIED CODE: Used ID instead of USERNAME
		$this->user_model->insert_log($this->session->userdata('username')." viewed profile of user $id.");
		$query=$this->db->select()
						->from('users')
						->where('id',$id);
		return $query->get()->result();
	}
	
	/**
	 * Gets the existing account
	 *
	 * @access	public
	 * @param	id - id of username to be edited
	 * @return	array
	 */	
	public function get_existing_account($id){ 
		 $userInfo = $this->db->select()
		 						->from('users')
								->where('id',$id);		 

		return $this->db->get()->row();
	}
	
	/**
	 * returns the data from database of a certain account
	 *
	 * @access	public
	 * @param	input - user input in the username text field
	 * @return	
	 */	
	public function get_username($input){
		$this->db->select('username')
					->from('users')
					->where('username',$input);

		return $this->db->get();
	}
	
	/**
	 * Get the user password
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function get_password($input){
		$this->db->select('password')
					->from('users')
					->where('id',$input);

		return $this->db->get();
	}
	
	/**
	 * Function for saving account changes
	 *
	 * @access	public
	 * @param	string, string, string, string, string, string, string, string, string, string, string, int, string, string
	 * @return	none
	 */	
	public function save_changes($username,$first_name,$last_name,$middle_name,$password,$college_address,$email_address,$contact,$user_type,$row_id,$college,$degree){

		$data = array(
            	'last_name' => $last_name , 
                'first_name' => $first_name, 
				'middle_name' => $middle_name, 
				'username' => $username, 
				'password' => $password, 
				'college_address' => $college_address, 
				'email_address' => $email_address, 
				'contact_number' => $contact, 
				'college' => $college, 
				'degree' => $degree
            );

		$this->db->where('id', $row_id);
		$this->db->update('users', $data);
		$this->user_model->insert_log($this->session->userdata('username')." edited the profile of $username.");
	}
	
	/**
	 * Checks if user exists
	 *
	 * @access	public
	 * @param	string
	 * @return	none
	 */
	public function user_exists($id){
		//****MODIFIED CODE: Used ID instead of USERNAME
		$this->db->select()
					->from('users')
					->where('id',$id);

		$userCount = $this->db->get()->num_rows();
		return ($userCount == 1 ? true : false);
	}
}

?>