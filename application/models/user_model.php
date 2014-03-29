<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Model
 *
 * @package	icsls
 * @category Model	
 * @author	CMSC 128 AB-5L Team 1 & Team 4
 */

class User_model extends CI_Model{
	/**
	 * Inserts log data
	 *
	 * @access	public
	 * @param	none
	 * @return	integer
	 */

	public function insert_log($message){
		$data = array(
   			'event' => $message,
   			'ipaddress' => $this->input->ip_address()
		);
		$this->db->insert('logs', $data);
	}

	/**
	 * This function returns the attributes of the user
	 * @param	username (string), id (int)
	 * @return	rows from the database
	 */
	public function check_user_password($id, $oldPassword){
		$this->db->select('id, password')
			->from('users')
			->where('id',$id)
			->where('password',$oldPassword);
		$userPassword = $this->db->get()->num_rows();
		return ($userPassword == 1 ? true : false);
	}
	/**
	 * This function returns the attributes of the user
	 * @param	username (string), id (int)
	 * @return	rows from the database
	 */
	public function get_user_profile($id){
		$this->insert_log($this->session->userdata('username'). " viewed his/her profile.");

		$this->db->select('*')
			->from('users')
			->where('id',$id);
		$userProf = $this->db->get();
		return $userProf->row();
	}

	/**
	 * Returns the profile picture of the user
	 * @param	id (int)
	 * @return	row
	 */
	public function get_profile_picture($id){
		$this->insert_log($this->session->userdata('username'). " retrieved his/her profile picture.");

		$this->db->select('profile_picture')
			->from('users')
			->where('id',$id);
		$userProf = $this->db->get();
		return $userProf->row();
	}
	
	/**
	 * Checks if the user is registered using id
	 *
	 * @access	public
	 * @param	int
	 * @return	boolean
	 */
	public function user_exists_by_id($id){
		$userCount = $this->db->query("SELECT * FROM users WHERE id='$id'")->num_rows();

		return ($userCount == 1 ? true : false);
	}

	/**
	 * Checks if the user is registered using username & password
	 *
	 * @access	public
	 * @param	string, string
	 * @return	boolean
	 */
	public function user_exists($username, $password){
		$this->db->select()
				 ->from('users')
				 ->where('username', $username)
				 ->where('password', $password);
		return $this->db->get()->row();

	}

	/**
	 * Gets the maximum wailisted
	 *
	 * @access	public
	 * @param	none
	 * @return	integer
	 */
	public function get_waitlist_max($id){
		$this->db->select_max('waitlist_rank', 'maxRank')
				 ->from('transactions')
				 ->join('reference_materials', 'reference_materials.id=transactions.reference_material_id')
				 ->where('date_borrowed IS NULL')
				 ->where('date_returned IS NULL')
				 ->where('date_waitlisted IS NOT NULL');
		return $this->db->get()->row();
	}

	/**
	 * Gets the user data
	 *
	 * @access	public
	 * @param	string, string
	 * @return	array
	 */
	public function get_user_data($username, $password){
		$this->insert_log($username. " logged in.");

		$this->db->select(array('id', 'user_type', 'username','email_address','first_name')
						 )
				 ->from('users')
				 ->where('username', $username)
				 ->where('password', $password);

		return $this->db->get()->result();
	}
	
	/**
	 * This function checks if the User can reserve, cannot reserve, cannot reserve but can waitlist OR has reserved the reference material already
	 * @param	referenceId (int), userId (int), userType (char)
	 * @return	true || false || constant number (7)
	 */
	public function reserve_reference_materials($referenceId, $userId, $userType){
		date_default_timezone_set("Asia/Manila");	//timezone here in the Philippines

		if($userId == FALSE) return FALSE;
		
		$this->db->select('borrow_limit')
			->from('users')
			->where('id',$userId);
		$userQuery = $this->db->get();
		foreach ($userQuery->result() as $row) { $userBorrowLimit = $row->borrow_limit; }

		$this->db->select('reference_material_id, borrower_id, date_reserved')
			->from('transactions')
			->where('reference_material_id',$referenceId)
			->where('borrower_id',$userId)
			->where('date_returned IS NULL')
			->where('date_reserved IS NOT NULL');
		$transactionQuery = $this->db->get();

		$this->db->select('access_type, total_available, times_borrowed')
			->from('reference_materials')
			->where('id',$referenceId);
		$referenceQuery = $this->db->get();

		foreach ($referenceQuery->result() as $row) { 
		 	$accessType = $row->access_type;
		 	$totalAvailable = $row->total_available;
		 	$timesBorrowed = $row->times_borrowed;
		 }

		 if(($transactionQuery->num_rows() > 0) || ($userBorrowLimit <= 0) || ($accessType == 'F' && $userType  == 'S')) return false;
		 else if($totalAvailable == 0) return 7;
		 else{
		 		$newLimit = $userBorrowLimit - 1;
		 		$newTotal = $totalAvailable - 1;
		 		
				
				$borrowArray = array('borrow_limit' => $newLimit);
				$this->db->where('id', $userId);
				$this->db->update('users', $borrowArray);

				$refArray = array('total_available' => $newTotal);
				$this->db->where('id', $referenceId);
				$this->db->update('reference_materials', $refArray);

				$this->db->set('date_reserved', 'CURDATE()', FALSE);
				$this->db->set('reservation_due_date', 'DATE_ADD(CURDATE(), INTERVAL 3 DAY)', FALSE);
				$data = array('reference_material_id' => $referenceId, 'borrower_id' => $userId, 'user_type' => $userType, 'waitlist_rank' => NULL, 'date_waitlisted' => NULL, 'date_borrowed' => NULL, 'borrow_due_date' => NULL, 'date_returned' => NULL);
				$this->db->insert('transactions', $data);

				$this->insert_log($this->session->userdata('username'). " reserved book id $referenceId.");
				return true;
		 }
	}

	/**
	 * This function checks if the User can waitlist, cannot waitlist, can still reserve OR has waitlisted in the reference material already
	 * @param	referenceId (int), userId (int), userType (char)
	 * @return	true || false || constant number (7)
	 */
	public function waitlist_reference_materials($referenceId, $userId, $userType){
		date_default_timezone_set("Asia/Manila");	//timezone in the Philippines

		$this->db->select('total_available, access_type')
			->from('reference_materials')
			->where('id',$referenceId);
		$bookStatus = $this->db->get();
		foreach ($bookStatus->result() as $row) {
			$book = $row->total_available;
			$accessType = $row->access_type;
		}

		$this->db->select('waitlist_limit')
			->from('users')
			->where('id',$userId);
		$waitlistStatus = $this->db->get();
		foreach ($waitlistStatus->result() as $row2) { $limit = $row2->waitlist_limit; }

		$this->db->select('reference_material_id, borrower_id, date_waitlisted')
			->from('transactions')
			->where('reference_material_id',$referenceId)
			->where('borrower_id',$userId)
			->where('date_waitlisted IS NOT NULL');
		$transactionQuery = $this->db->get();

		if(($transactionQuery->num_rows() > 0) || ($limit <= 0) || ($accessType == 'F' && $userType  == 'S')) return false;
		else if($book > 0) return 7;
		else{
			$this->db->select_max('waitlist_rank', 'maxRank')
				->from('transactions')
				->where('reference_material_id',$referenceId);
			$waitlistRank = $this->db->get();
			if($waitlistRank->num_rows() == 0){
				$newLimit = $limit - 1;
				$dateWaitlisted = date('Y-m-d');
				$rank = 1;

				$waitlistArray = array('waitlist_limit' => $newLimit);
				$this->db->where('id', $userId);
				$this->db->update('users', $waitlistArray);

				$data = array('reference_material_id' => $referenceId, 'borrower_id' => $userId, 'user_type' => $userType, 'waitlist_rank' => $rank, 'date_waitlisted' => $dateWaitlisted, 'date_reserved' => NULL, 'reservation_due_date' => NULL, 'date_borrowed' => NULL, 'borrow_due_date' => NULL, 'date_returned' => NULL);
				$this->db->insert('transactions', $data);
				$this->insert_log($this->session->userdata('username'). " waitlisted for book id $referenceId.");
				return true;
			}
			else{
				foreach ($waitlistRank->result() as $row3) { $maxRank = $row3->maxRank; }
				$newMaxRank = $maxRank + 1;
				$newLimit = $limit - 1;
				//$dateWaitlisted = date('Y-m-d');

				$waitlistArray = array('waitlist_limit' => $newLimit);
				$this->db->where('id', $userId);
				$this->db->update('users', $waitlistArray);
				$this->db->set('date_waitlisted', 'CURDATE()', FALSE);
				$data = array('reference_material_id' => $referenceId, 'borrower_id' => $userId, 'user_type' => $userType, 'waitlist_rank' => $newMaxRank, 'date_reserved' => NULL, 'reservation_due_date' => NULL, 'date_borrowed' => NULL, 'borrow_due_date' => NULL, 'date_returned' => NULL);
				$this->db->insert('transactions', $data);
				$this->insert_log($this->session->userdata('username'). " waitlisted for book id $referenceId.");
				return true;
				}
			}
	}
	
	/**
	 * This function updates the user information
	 * @param	id (int), username (string), password (string), college_address (string), email (string), contact number (int)
	 * @return	none
	 */
	public function user_update_profile($id, $username, $password, $college_address, $contact_number){
		$updateArray = array('username' => $username, 'password' => $password, 'college_address' => $college_address, 'contact_number' => $contact_number);
				$this->db->where('id', $id);
				$this->db->update('users', $updateArray);

		$this->insert_log($this->session->userdata('username'). " updated his/her profile.");
	}

	/**
	 * This function returns the transactions of the user
	 * @param	id (int)
	 * @return	rows from the database
	 */
	public function user_book($id){
		$this->db->select('*')
			->from('transactions')
			->where('borrower_id',$id);
		$userBook = $this->db->get();
		return $userBook->result();
	}

	/**
	 * This function returns the attributes of the book
	 * @param	reference material id (int)
	 * @return	rows from the database
	 */
	public function user_book_reserve($reference_material_id){
		$this->db->select('*')
			->from('reference_materials')
			->where('id',$reference_material_id);
		$userBookReserve = $this->db->get();
		return $userBookReserve->result();
	}

	/**
	 * This function returns the reserved materials with active transactions
	 * @param	id (int)
	 * @return	rows from the database
	 */
	public function get_reserved_materials($id){
		$this->insert_log($this->session->userdata('username'). " retrieved reserved materials.");
		$this->db->select('reference_material_id, title, author, course_code, reservation_due_date')
				 ->from('reference_materials')
				 ->join('transactions', 'reference_materials.id = transactions.reference_material_id')
				 ->where('borrower_id',$id)
				 ->where('date_reserved IS NOT NULL')
				 ->where('date_returned IS NULL')
				 ->where('date_borrowed IS NULL')
				 ->where('reservation_due_date IS NOT NULL');
		return $this->db->get()->result();
	}

	/**
	 * This function returns the waitlisted materials with active transactions
	 * @param	id (int)
	 * @return	rows from the database
	 */
	public function get_waitlisted_materials($id){
		$this->insert_log($this->session->userdata('username'). " retrieved waitlisted materials.");
		$this->db->select('reference_material_id, title, author, course_code, waitlist_rank')
				 ->from('reference_materials')
				 ->join('transactions', 'reference_materials.id = transactions.reference_material_id')
				 ->join('users', 'transactions.borrower_id = users.id')
				 ->where('borrower_id',$id)
				 ->where('date_borrowed IS NULL')
				 ->where('date_returned IS NULL')
				 ->where('date_waitlisted IS NOT NULL');
		return $this->db->get()->result();
	}

	/**
	 * This function returns the borrowed materials with active transactions
	 * @param	id (int)
	 * @return	rows from the database
	 */
	public function get_borrowed_materials($id){
		$this->insert_log($this->session->userdata('username'). " retrieved borrowed materials.");
		$this->db->select('reference_material_id, title, author, course_code, borrow_due_date')
				 ->from('reference_materials')
				 ->join('transactions', 'reference_materials.id = transactions.reference_material_id')
				 ->where('borrower_id',$id)
				 ->where('date_borrowed IS NOT NULL')
				 ->where('borrow_due_date IS NOT NULL')
				 ->where('date_returned IS NULL');
		return $this->db->get()->result();
	}

	/**
	 * This function inserts the account to the database
	 * @param	table name (string), data (array)
	 * @return	none
	 */
	public function insert_account( $table_name, $data){

		$snum = $this->input->post('student_number');
		$enum = $this->input->post('employee_number');
		$lname = $this->input->post('last_name');
		$fname = $this->input->post('first_name');
		$mname = $this->input->post('middle_name');
		$usertype = $this->input->post('user_type');
		$username = $this->input->post('username');
		$password = md5($_POST['password']);
		$collegeAdd = $this->input->post('college_address');
		$email = $this->input->post('email_address');
		$contactNum = $this->input->post('contact_number');
		$college = $this->input->post('college');
		$degree = $this->input->post('degree');
		
		if($usertype == 'S'){
			$data = array('employee_number' => NULL, 'student_number' => $snum, 'last_name' => $lname, 'first_name' => $fname, 'middle_name' => $mname, 'user_type' => $usertype, 'username' => $username, 'password' => $password, 'college_address' => $collegeAdd, 'email_address' => $email, 'contact_number' => $contactNum, 'borrow_limit' => 3, 'waitlist_limit' => 5, 'college' => $college, 'degree' => $degree);
		}
		else if($usertype == 'F'){
			$data = array('employee_number' => $enum, 'student_number' => NULL, 'last_name' => $lname, 'first_name' => $fname, 'middle_name' => $mname, 'user_type' => $usertype, 'username' => $username, 'password' => $password, 'college_address' => $collegeAdd, 'email_address' => $email, 'contact_number' => $contactNum, 'borrow_limit' => 3, 'waitlist_limit' => 5, 'college' => NULL, 'degree' => NULL);

		}
		
		$this->db->insert($table_name, $data);
		$this->insert_log($username . " successfully registered.");
	}

	/**
	 * This function checks if the student number already exists
	 * @param	student number(varchar)
	 * @return	true || false
	 */
	public function student_exists($studnum){
		$this->db->select('student_number')
			->from('users')
			->where('student_number',$studnum);
		$studentQuery = $this->db->get();
		if($studentQuery->num_rows() > 0) return true;
		else return false;
	}
	
	/**
	 * This function checks if the employee number already exists
	 * @param	employee number(varchar)
	 * @return	true || false
	 */
	public function staff_exists($enum){
		$this->db->select('employee_number')
			->from('users')
			->where('employee_number',$enum);
		$facultyQuery = $this->db->get();
		if($facultyQuery->num_rows() > 0) return true;
		else return false;
	}

	/**
	 * This function checks if the username already exists
	 * @param	username (varchar)
	 * @return	true || false
	 */
	public function username_exists($uname){
		$this->db->select('username')
			->from('users')
			->where('username',$uname);
		$usernameQuery = $this->db->get();
		if($usernameQuery->num_rows() > 0) return true;
		else return false;
	}

	/**
	 * This function cancels a reservation and updates the borrow_limit of the user, total_available and times_borrowed of the reference material
	 * @param	reference id (int), user id (int)
	 * @return	true
	 */
	public function cancel_reserve_reference_materials($referenceId, $userId){
		$this->db->select('borrow_limit')
			->from('users')
			->where('id',$userId);
		$userQuery = $this->db->get();
		foreach ($userQuery->result() as $row) { $userBorrowLimit = $row->borrow_limit; }
		
		$this->db->select('total_available, times_borrowed')
			->from('reference_materials')
			->where('id',$referenceId);
		$referenceQuery = $this->db->get();
		foreach ($referenceQuery->result() as $row) { 
		 	$totalAvailable = $row->total_available;
		}

		$newLimit = $userBorrowLimit + 1;
		$newTotal = $totalAvailable + 1;

		$cancelArray = array('borrow_limit' => $newLimit);
				$this->db->where('id', $userId);
				$this->db->update('users', $cancelArray);

		$cancelArray2 = array('total_available' => $newTotal);
				$this->db->where('id', $referenceId);
				$this->db->update('reference_materials', $cancelArray2);
		
		$this->db->where('borrower_id', $userId);
		$this->db->where('reference_material_id', $referenceId);
		$this->db->where('date_borrowed IS NULL');
		$this->db->delete('transactions');

		$this->insert_log($this->session->userdata('username'). " cancelled reservation for book id $referenceId.");
		return true;
	}

	/**
	 * This function cancels a waitlist and updates the waitlist_limit of the user and the waitlist_rank of the other users in the transactions table
	 * @param	reference id (int), user id (int)
	 * @return	true
	 */
	public function cancel_waitlist_reference_materials($referenceId, $userId){
		$this->db->select('waitlist_limit')
			->from('users')
			->where('id',$userId);
		$userQuery = $this->db->get();
		foreach ($userQuery->result() as $row) { $userWaitlistLimit = $row->waitlist_limit; }

		$this->db->select('waitlist_rank')
			->from('transactions')
			->where('reference_material_id',$referenceId)
			->where('borrower_id',$userId);
		$waitlistRank = $this->db->get();
		foreach ($waitlistRank->result() as $row) { $userWaitlistRank = $row->waitlist_rank; }

		$newLimit = $userWaitlistLimit + 1;

		$cancelArray2 = array('waitlist_limit' => $newLimit);
				$this->db->where('id', $userId);
				$this->db->update('users', $cancelArray2);
		
		$this->db->query("SET @rank = '-1'"); 
		$this->db->query("UPDATE transactions SET waitlist_rank = $userWaitlistRank + (SELECT @rank := @rank + 1) WHERE waitlist_rank > '$userWaitlistRank' AND reference_material_id='$referenceId'");			
		
		$this->db->where('borrower_id', $userId);
		$this->db->where('reference_material_id', $referenceId);
		$this->db->delete('transactions');

		$this->insert_log($this->session->userdata('username'). " cancelled waitlist for book id $referenceId.");
		return true;
	}

	/**
	 * Updates the user profile picture
	 * @param	id (int)
	 * @return	none
	 */
	function upload_picture($id){
		$userImageDirectory = 'resources/img/user_images/';
		$defaultImage = '0.jpg';

		$config['upload_path'] = $userImageDirectory;
		$config['allowed_types'] = 'jpg';
		$config['max_size']	= '200 KB';
		$config['max_width'] = '200';
		$config['max_height'] = '200';
		$this->upload->initialize($config);

		$this->db->select('profile_picture')
				 ->from('users')
				 ->where('id',$id);
		$currentImage = $this->db->get()->row()->profile_picture;

		if($this->upload->do_upload('profile_picture')){
			//Deletes the image if it is not the default image
			if($currentImage != $defaultImage)	unlink($userImageDirectory.$currentImage);

			//Gets the information about the file uploaded
			$uploadData = $this->upload->data('profile_picture');
			
			$fullPath = $userImageDirectory . $uploadData['orig_name'];
			$newPicture = "$id.jpg";
			rename($fullPath, $userImageDirectory . $newPicture);

			$this->db->where('id', $id);
			$this->db->update('users',array('profile_picture' => $newPicture));
			
			$this->insert_log($this->session->userdata('username'). " uploaded a profile picture.");

			return TRUE;
		}else{	
			$this->insert_log($this->session->userdata('username'). " failed to upload a profile picture.");
			return FALSE;
		}
	}

	/**
	*	Function gets the exact reference material based from unique id; for viewing the book
	*
	*	@param $bookid (string)
	*	@return rows from db || null
	*/
	public function view_reference_materials($bookid){
		$this->insert_log($this->session->userdata('username'). " viewed book id $bookid.");
		return $this->db->query("SELECT * from reference_materials where id = $bookid ");
	}


	/**
	*	Function gets the specified reference materials from table with matching keyword; used for pagination
	*
	*	@param $keyword (string)
	*	@return rows from db || null
	*/
	
	public function search_reference_materials($keyword,$limit,$offset){
		if($offset == null) $offset = 0;
		return  $this->db->query("SELECT * from reference_materials where title like '%$keyword%' order by title asc limit $offset,$limit");
	}

	/**
	 * This function gets the reference material info that matched the search input
	 * @param	search input (string)
	 * @return	rows from database
	 */
	public function search_reference_materialss($input){
		$this->db->select('*')
			->from('reference_materials')
			->like('title',$input)
			->or_like('author',$input)
			->or_like('isbn',$input)
			->or_like('publisher',$input)
			->or_like('publication_year',$input)
			->or_like('course_code',$input)
			->limit(10);

		$searchQuery = $this->db->get();
		return $searchQuery->result();
	}

	/**
	*	Function gets the specified reference materials from table with matching keyword; used for pagination's
	*	total page number
	*
	*	@param $keyword (string)
	*	@return rows from db || null
	*/
	public function search_reference_materials2($keyword){
		return  $this->db->query("SELECT * from reference_materials where title like '%$keyword%' order by title asc");
	}


	/**
	*	Function gets the specified reference materials from table with matching keyword; used when first
	*	query returned 0.
	*
	*	@param $keyword (string), $limit (int), $offset(int)
	*	@return rows from db || null
	*/
	public function search_reference_materials_token($keywords,$limit,$offset){
		if($offset == null) $offset = 0;

		$keyword_tokens = preg_split("/[\s,]+/", $keywords);

		$sql = "SELECT * FROM reference_materials WHERE title LIKE'%";
		$sql .= implode("%' OR title LIKE '%", $keyword_tokens) . "'";
		$sql .= "order by title asc limit $offset,$limit";
		return  $this->db->query($sql);
	}

	/**
	*	Function gets the specified reference materials from table with matching keyword; used for pagination
	*
	*	@param $keywords (string)
	*	@return rows from db || null
	*/
	public function search_reference_materials_token2($keywords){
		$keyword_tokens = preg_split("/[\s,!@#$\[\]\*\(\)\^<>\?\+\_\={}]+/", $keywords);

		$sql = "SELECT * FROM reference_materials WHERE title LIKE'%";
		$sql .= implode("%' OR title LIKE '%", $keyword_tokens) . "'";
		$sql .= "order by title asc";
		return  $this->db->query($sql);
	}

	/**
	*	Function gets the reference materials using the advanced search
	*
	*	@param $query (string)
	*	@return rows from db || null
	*/
	public function advanced_search($query){
		return $this->db->query($query);
	}

	/**
	*	Function gets the reference materials using the advanced search; without offset
	*
	*	@param $query (string)
	*	@return rows from db || null
	*/
	public function advanced_search2($query){
		return $this->db->query($query);
	}

	/**
	*	Function gets the exact transactions based from type of report (Daily, Weekly or Monthly)
	*	@param $type (string)
	*	@return rows from db,associative array || null
	*/
	public function get_data($type){
		$day = date('D');

		/*returns rows of data from selected columns of the transaction log based on current date*/
		if (strcmp($type,'daily')==0) {
			$book_list = $this->db->query("SELECT reference_material_id, borrower_id, date_waitlisted, date_reserved, date_borrowed, date_returned from transactions where date_borrowed like CURDATE()");
			$books_borrowed = $this->db->query("SELECT COUNT(DISTINCT reference_material_id) from transactions where date_borrowed like CURDATE()");
			$books_not_borrowed = $this->db->query("SELECT COUNT(DISTINCT reference_material_id) from transactions where date_borrowed NOT LIKE CURDATE()");
/*			$most_borrowed = $this->db->query("SELECT reference_material_id, MAX(COUNT(date_borrowed)) from transactions where date_borrowed like CURDATE() group by date_borrowed");
			$least_borrowed = $this->db->query("SELECT reference_material_id, MIN(COUNT(date_borrowed)) from transactions where date_borrowed like CURDATE() gro up by date_borrowed");
*/			$this->insert_log($this->session->userdata('username'). " generated a daily report.");
		} 
		/*returns rows of data from selected columns of the transasction log based on the whole week
		* can only be accessed on Fridays
		*/
		else if (strcmp($type,'weekly')==0 && $day=='Fri') {
			$book_list = $this->db->query("SELECT reference_material_id, borrower_id, date_waitlisted, date_reserved, date_borrowed, date_returned from transactions where DATE_SUB(CURDATE(), INTERVAL 4 DAY)<=date_borrowed");	
			$books_borrowed = $this->db->query("SELECT COUNT(DISTINCT reference_material_id) from transactions where DATE_SUB(CURDATE(), INTERVAL 4 DAY)<=date_borrowed");
			$books_not_borrowed = $this->db->query("SELECT COUNT(DISTINCT reference_material_id) from transactions where DATE_SUB(CURDATE(), INTERVAL 4 DAY)<=date_borrowed")->result();
			$this->insert_log($this->session->userdata('username'). " generated a weekly report.");
/*			$most_borrowed = $this->db->query("SELECT reference_material_id, MAX(COUNT(date_borrowed)) from transactions where DATE_SUB(CURDATE(), INTERVAL 4 DAY)<=date_borrowed");
			$least_borrowed = $this->db->query("SELECT reference_material_id, MIN(COUNT(date_borrowed)) from transactions where DATE_SUB(CURDATE(), INTERVAL 4 DAY)<=date_borrowed");
*/		} 
		/*returns rows of data from selected columns of the transaction log based on the whole month*/
		else if (strcmp($type,'monthly')==0) {
			$book_list = $this->db->query("SELECT reference_material_id, borrower_id, date_waitlisted, date_reserved, date_borrowed, date_returned from transactions where MONTHNAME(date_borrowed) like MONTHNAME(CURDATE())");
			$books_borrowed = $this->db->query("SELECT COUNT(DISTINCT reference_material_id) from transactions where MONTHNAME(date_borrowed) like MONTHNAME(CURDATE())");
			
			$books_not_borrowed = $this->db->query("SELECT COUNT(DISTINCT reference_material_id) from transactions where MONTHNAME(date_borrowed) like MONTHNAME(CURDATE())");
			$this->insert_log($this->session->userdata('username'). " generated a monthly report.");
/*			$most_borrowed = $this->db->query("SELECT reference_material_id, MAX(COUNT(date_borrowed)) from transactions where MONTHNAME(date_borrowed) like MONTHNAME(CURDATE())");
			$least_borrowed = $this->db->query("SELECT reference_material_id, MIN(COUNT(date_borrowed)) from transactions where MONTHNAME(date_borrowed) like MONTHNAME(CURDATE())");
*/		}
		$most_borrowed = $this->db->query("select * from reference_materials where times_borrowed = (select max(times_borrowed) from reference_material) ")->result();
		
		if( $book_list!=NULL || $books_borrowed!=NULL || $books_not_borrowed!=NULL || $most_borrowed!=NULL){
		return $data = array('book_list' => $book_list,
							 'books_borrowed' => $books_borrowed,
							 'books_not_borrowed' => $books_not_borrowed,
							 'most_borrowed' => $most_borrowed);//,
							 //'least_borrowed' => $least_borrowed);
		}
		else return NULL;
	}
}

?>