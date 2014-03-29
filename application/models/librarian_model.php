<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Librarian Model
 *
 * @package	icsls
 * @category Model	
 * @author	Mark Carlo Dela Torre, Angela Roscel Almoro, Jason Faustino, Jay-ar Hernaez
 */

class Librarian_model extends CI_Model{
	
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	none
	 * @return	integer
	 */
	function __construct(){
		parent::__construct();
	}

	/**
	 * Retrieve all references
	*/
	public function get_all_references(){
		return $this->db->get('reference_materials');
	}

	/**
	 * Retrieves ALL references starting within offset ending with per_page
	 *
	 * @access 	public
	 * @return 	
	*/
	public function get_all_references_part($offset, $sortBy, $orderFrom, $per_page){
		$this->db->order_by($sortBy, $orderFrom);
		return $this->db->get('reference_materials', $per_page, $offset);
	}//end of function get_all_references

	/**
	 * Basic search
	*/
	public function basic_get_reference($queryArray){
		$this->db->select('id')
				 ->from('reference_materials')
				 ->like($queryArray['category'], $queryArray['searchText']);
		return $this->db->get();
	}//end of basic_get_reference

	/**
	 * Basic search
	*/
	public function basic_get_reference_fragment($queryArray, $offset){
		$this->db->select('id, title, author, isbn, category, publisher, publication_year, access_type, course_code, total_available, total_stock, times_borrowed, for_deletion')
				 ->from('reference_materials')
				 ->like($queryArray['category'], $queryArray['searchText'])
				 ->order_by($queryArray['sortBy'], $queryArray['orderFrom'])
				 ->limit($queryArray['perPage'], $offset);

		return $this->db->get();
	}//end of basic_get_reference

	public function advanced_search($projectionArray, $queryArray){
		if(in_array('title', $projectionArray))
			$this->db->like('title', $queryArray['title']);
		if(in_array('author', $projectionArray))
			$this->db->like('author', $queryArray['author']);
		if(in_array('year_published', $projectionArray)){
			if($queryArray['publication_year'] == '')
				$this->db->where('publication_year IS NULL');
			else
				$this->db->like('publication_year', $queryArray['publication_year']);
		}
		if(in_array('publisher', $projectionArray)){
			if($queryArray['publisher'] == '')
				$this->db->where('publisher IS NULL');
			else
				$this->db->like('publisher', $queryArray['publisher']);
		}
		if(in_array('category', $projectionArray))
			$this->db->where('category', $queryArray['category']);
			

		$this->db->select('id')
				 ->from('reference_materials');

		return $this->db->get();
	}

	public function advanced_search_fragment($projectionArray, $queryArray, $offset){
		if(in_array('title', $projectionArray))
			$this->db->like('title', $queryArray['title']);
		if(in_array('author', $projectionArray))
			$this->db->like('author', $queryArray['author']);
		if(in_array('year_published', $projectionArray)){
			if($queryArray['publication_year'] == '')
				$this->db->where('publication_year IS NULL');
			else
				$this->db->like('publication_year', $queryArray['publication_year']);
		}
		if(in_array('publisher', $projectionArray)){
			if($queryArray['publisher'] == '')
				$this->db->where('publisher IS NULL');
			else
				$this->db->like('publisher', $queryArray['publisher']);
		}
		if(in_array('category', $projectionArray))
			$this->db->where('category', $queryArray['category']);
			

		$this->db->select('id, title, author, isbn, category, publisher, publication_year, access_type, course_code, total_available, total_stock, times_borrowed, for_deletion')
				 ->from('reference_materials')
				 ->order_by($queryArray['sortBy'], $queryArray['orderFrom'])
				 ->limit($queryArray['perPage'], $offset);

		return $this->db->get();
	}

	/**
	 * Removes a reference, specified by its row ID, in the database
	 *
	 * @access 	public
	 * @param 	int 	$book_id
	 * @return 	int
	*/
    public function delete_references($book_id){
		
		$this->db->where('id', $book_id);
		$query = $this->db->get('reference_materials');
		foreach($query->result() as $row):
			//Check books if complete
			if($row->total_available === $row->total_stock){
				$this->load->database();
				$this->db->delete('reference_materials', array('id' => $book_id)); 
				return -1;
			}
			else{
				return $book_id;
			}
			$this->user_model->insert_log($this->session->userdata('username'). " deleted book id $book_id.");
		endforeach;
    }//end of function delete_reference
	
	/**
	 * Get references ready for deletion (references with for_deletion = 'T' and complete stock)
	 *
	 * @access 	public
	 * @return 	object
	*/
	function get_ready_for_deletion(){
		$this->db->select('id, title, author')
				 ->from('reference_materials')
				 ->where('total_available = total_stock')
				 ->where('for_deletion = \'T\'');
		return $this->db->get()->result();
		
	}//end of functionget_ready_for_deletion
	
	//get the remaining books
	function get_other_books($idready){
		if(! empty($idready))
			$this->db->where_not_in('id', $idready);
		
		return $this->db->get('reference_materials');
	}
	
	//Given array of selected books retrieve info
	function get_selected_books($selected){
		$info = array();
		foreach($selected as $id):
			$this->db->where('id', $id);
			$info[] = $this->db->get('reference_materials');
		endforeach;
		
		return $info;
	}
	
	//Update the for_deletion attribute
	function update_for_deletion($book_id){ //Changes 'For Deletion' attribute of the reference to  'T'
		$this->db->where('id', $book_id);
		$this->db->update('reference_materials', array('for_deletion' => 'T'));
		$this->user_model->insert_log($this->session->userdata('username'). " set book id $book_id for deletion.");
	}

	/**
	 * Adds a reference in the database
	 *
	 * @access 	public
	 * @param 	array 	$data
	*/
	function add_data($data){      
        $this->db->insert('reference_materials', $data);
        $this->user_model->insert_log($this->session->userdata('username'). " added a reference material.");
    }//end of function add_data

    /**
     * Adds multiple references from the uploaded file to the database
     *
     * @access 	public
     * @param 	array 	$data
     * 			int 	$count
    */
    public function add_multipleData($data, $count){
        for($i = 0; $i < $count; $i++) {
            $this->db->insert('reference_materials', $data[$i]);
        }
        

        /*find a more efficient way to do this */
        $this->db->set('isbn',NULL);
        $this->db->where('isbn','');
        $this->db->update('reference_materials');

        $this->db->set('description',NULL);
        $this->db->where('description','');
        $this->db->update('reference_materials');

        $this->db->set('publisher',NULL);
        $this->db->where('publisher','');
        $this->db->update('reference_materials');

        $this->db->set('publication_year',NULL);
        $this->db->where('publication_year','');
        $this->db->update('reference_materials');
        $this->user_model->insert_log($this->session->userdata('username'). " added multiple reference material.");
    }//end of function add_multipleData

    /**
     * Updates a reference's data in the database with the user's input
     *
     * @access 	public
     * @param 	array 	$query_array
    */
    public function edit_reference($query_array){
    	$this->db->where('id', $query_array['id']);
    	$this->db->update('reference_materials', array(
    		'title' => $query_array['title'],
    		'author' => $query_array['author'],
    		'isbn' => $query_array['isbn'],
    		'category' => $query_array['category'],
    		'publisher' => $query_array['publisher'],
    		'publication_year' => $query_array['publication_year'],
    		'access_type' => $query_array['access_type'],
    		'course_code' => $query_array['course_code'],
    		'description' => $query_array['description'],
    		'total_stock' => $query_array['total_stock']
    		));
    	$this->user_model->insert_log($this->session->userdata('username'). " edited a reference material.");
    }//end of function edit_reference

    /**
     * Returns a reference specified by its row ID
     *
     * @param 	int 	$referenceId
     * @return 	array
    */
    public function get_reference($referenceId){
        $this->db->where('id', $referenceId);
        return $this->db->get('reference_materials');
    }//end of function get_reference

    /**
	*	Function gets the exact transactions based from type of report (Daily, Weekly or Monthly)
	*	@param $type (string)
	*	@return rows from db || null
	*/
	public function get_data($type,$startdate,$enddate){
		
		$currentDate = $this->db->query('select DATE_FORMAT(CURRENT_TIMESTAMP(), "%M %e, %Y %r") as cur_date ')->row();
		$currentDate2 = $this->db->query('select DATE_FORMAT(CURRENT_TIMESTAMP(), "%W") as cur_date ')->row();
		$day = $currentDate->cur_date;
		if($enddate > $currentDate->cur_date){//just in case you entered a future date, it resets to current date
			$enddate = $currentDate->cur_date;
		}
		/*returns rows of data from selected columns of the transaction log based on current date*/
		if (strcmp($type,'daily')==0) {
			$this->db->select('v.title,v.author,u.student_number,u.employee_number,
			 t.date_borrowed, t.date_returned')
			->from('users u, transactions t, reference_materials v')
			->where('t.date_borrowed like CURDATE() and u.id = t.borrower_id and t.reference_material_id = v.id');
			
			$book_list = $this->db->get();

			$books_borrowed = $this->db->query("Select COUNT(reference_material_id) from transactions where date_borrowed like CURDATE()");
		} 
		/*returns rows of data from selected columns of the transasction log based on the whole week
		* can only be accessed on Fridays
		*/
		else if (strcmp($type,'weekly')==0) {
			$this->db->select('v.title,v.author,u.student_number,u.employee_number,
			 t.date_borrowed, t.date_returned')
			->from('users u, transactions t, reference_materials v')
			->where("t.date_borrowed >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) and t.date_borrowed <= CURDATE() and u.id = t.borrower_id and t.reference_material_id = v.id");
			//->where();
			$book_list = $this->db->get();

			$books_borrowed = $this->db->query("Select COUNT(reference_material_id) from transactions where date_borrowed >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) and date_borrowed <= CURDATE()");
		} 
		/*returns rows of data from selected columns of the transaction log based on the whole month*/
		else if (strcmp($type,'monthly')==0) {
			$this->db->select('v.title,v.author,u.student_number,u.employee_number,
			 t.date_borrowed, t.date_returned')
			->from('users u, transactions t, reference_materials v')
			->where('MONTHNAME(t.date_borrowed) like MONTHNAME(CURDATE()) and u.id = t.borrower_id and t.reference_material_id = v.id');
			//->where();
			$book_list = $this->db->get();
			$books_borrowed = $this->db->query("Select COUNT(reference_material_id) from transactions where MONTHNAME(date_borrowed) like MONTHNAME(CURDATE())");
		}
		else if (strcmp($type,'custom')==0) {
			$this->db->select('v.title,v.author,u.student_number,u.employee_number,
			 t.date_borrowed, t.date_returned')
			->from('users u, transactions t, reference_materials v')
			->where("t.date_borrowed >= $startdate and t.date_borrowed <= $enddate and u.id = t.borrower_id and t.reference_material_id = v.id");
			//->where();
			$book_list = $this->db->get();
			$books_borrowed = $this->db->query("Select COUNT(reference_material_id) from transactions where MONTHNAME(date_borrowed) like MONTHNAME(CURDATE())");
		
		}

		$most_borrowed = $this->db->query("select * from reference_materials where times_borrowed = (select max(times_borrowed) from reference_materials) and times_borrowed > 0 limit 10")->result();
		
		$total_inventory = $this->db->query("SELECT SUM(total_stock) from reference_materials")->result();
		if( $book_list!=NULL || $books_borrowed!=NULL || $books_not_borrowed!=NULL || $most_borrowed!=NULL){
		return $data = array('book_list' => $book_list,
							 'books_borrowed' => $books_borrowed,
							 'most_borrowed' => $most_borrowed,
							 'total_inventory' => $total_inventory,
							 'currentDate'=>$currentDate,
							 'mode'=>$type,
							 'day'=>$day);
		}
		else return NULL;
	}

	/**
	*	Function gets the most borrowed reference material
	*	@return rows from db || null
	*/
	public function get_popular(){
		return $this->db->query("SELECT * FROM reference_materials WHERE times_borrowed = (SELECT max(times_borrowed) FROM reference_materials)");
	}

	/**
	 * Returns transactions 
	 *
	 * @access 	public
	 * @param 	int 	$referenceId
	*/
	public function get_transactions($referenceId){
		$this->db->select('u.id, u.first_name, u.middle_name, u.last_name, u.user_type,
			t.reference_material_id, t.waitlist_rank, t.date_waitlisted, t.date_reserved,
			t.reservation_due_date, t.date_borrowed, t.borrow_due_date, t.date_returned')
			->from('users u, transactions t')
			->where('t.reference_material_id', $referenceId)
			->where('u.id = t.borrower_id')
			->where('t.date_returned IS NULL');
		return $this->db->get();
	}//end of function get_transactions

	/**
	 * Retrieve Overdue transactions
	*/
	public function get_overdue(){
		$this->db->select('u.id, u.employee_number, u.student_number, u.first_name, u.middle_name, u.last_name, u.user_type,
					r.id, r.title, r.category, t.date_borrowed, t.borrow_due_date, DATEDIFF(CURDATE(), t.borrow_due_date) daysOverdue', FALSE)
			->from('users u, transactions t, reference_materials r')
			->where('u.id = t.borrower_id')
			->where('r.id = t.reference_material_id')
			->where('t.date_returned IS NULL')
			->where('DATEDIFF(CURDATE(), t.borrow_due_date) > 0');

		return $this->db->get();
		
	}//end of function get_overdue

	public function get_overdue_part($queryArray){
		$this->db->select('u.id, u.employee_number, u.student_number, u.first_name, u.middle_name, u.last_name, u.user_type,
					r.id, r.title, r.category, t.date_borrowed, t.borrow_due_date, DATEDIFF(CURDATE(), t.borrow_due_date) daysOverdue', FALSE)
			->from('users u, transactions t, reference_materials r')
			->where('u.id = t.borrower_id')
			->where('r.id = t.reference_material_id')
			->where('t.date_returned IS NULL')
			->where('DATEDIFF(CURDATE(), t.borrow_due_date) > 0')
			->order_by($queryArray['sort'], $queryArray['order']);

		if($queryArray['page'] != 'all')
			$this->db->limit($queryArray['page'], $queryArray['offset']);

		return $this->db->get();
	}

	/**
	 * Retrieve information about the user to be inserted into the transactions table
	*/
	public function get_user_info($username, $password){
		$this->db->select('id, user_type, borrow_limit, waitlist_limit')
				 ->from('users')
				 ->where('username', $username)
				 ->where('password', $password);
		return $this->db->get()->row_array();
	}

	public function get_reference_info($referenceId){
		$this->db->select('id, access_type, total_available, times_borrowed')
				 ->from('reference_materials')
				 ->where('id', $referenceId);
		return $this->db->get()->row_array();
	}

	/**
	 * Function for direct borrowing of a reference
	 *
	 * This function inserts a new transaction into the transaction table.
	 * This is necessary because there might be cases where the user instantly 
	 * borrows a reference while inside the library. This will ensure that the
	 * transaction made manually will be stored virtually.
	 * @access 	private
	 * @param 	array 	$referenceInfo
	 * @param 	array 	$userInfo
	*/
	public function direct_borrow($referenceInfo, $userInfo){
		//Update total_available and times borrowed of reference material
		$referenceInfo['total_available']--;
		$referenceInfo['times_borrowed']++;
		$this->db->where('id', $referenceInfo['id'])
				 ->update('reference_materials', array('total_available' => $referenceInfo['total_available'],
				 	'times_borrowed' => $referenceInfo['times_borrowed']));

		//Update borrow_limit of user
		$userInfo['borrow_limit']--;
		$this->db->where('id', $userInfo['id'])
				 ->update('users', array('borrow_limit' => $userInfo['borrow_limit']));

		//Insert new transaction row into transactions table
		$this->db->set('date_borrowed', 'CURDATE()', FALSE);
		$this->db->set('borrow_due_date', 'DATE_ADD(CURDATE(), INTERVAL 3 DAY)', FALSE);
		$this->db->insert('transactions', array(
			'reference_material_id' => $referenceInfo['id'],
			'borrower_id' => $userInfo['id'],
			'waitlist_rank' => NULL,
			'date_waitlisted' => NULL,
			'date_reserved' => NULL,
			'reservation_due_date' => NULL,
			'date_returned' => NULL));
		$this->user_model->insert_log("A user borrowed a book directly in the library.");
	}

	/**
	 *
	 *
	 * @access 	public
	 * @param 	int 	$referenceId
	 *			char 	$flag
	*/
	public function claim_return_reference($referenceId, $userId, $flag){
		//Get stock ad stock within library
		$this->db->select('total_available, total_stock')
				 ->from('reference_materials')
				 ->where('id', $referenceId);
		$stockData = $this->db->get()->result();
		
		foreach($stockData as $data){
			$totalAvailable = $data->total_available;
			$totalStock = $data->total_stock;
		}

		//Borrow Reference
		if($flag === 'C'){
			
			//Increment times borrowed of a reference
			$this->db->select('times_borrowed')
					 ->from('reference_materials')
					 ->where('id', $referenceId);
			$timesBorrowedArray = $this->db->get()->result();
			foreach ($timesBorrowedArray as $item) {
				$timesBorrowed = $item->times_borrowed;
				//$totalAvailable = $item->total_available;
			}
			$timesBorrowed++;
			
			
			$this->db->where('id', $referenceId);
			$this->db->update('reference_materials', array('times_borrowed' => $timesBorrowed));

			//Update date_borrowed and borrow_due_date of transactions
			
			$this->db->where('reference_material_id', $referenceId);
			$this->db->where('borrower_id', $userId);
			$this->db->set('date_borrowed', 'CURDATE()', FALSE);
			$this->db->set('borrow_due_date', 'DATE_ADD(CURDATE(), INTERVAL 3 DAY)', FALSE);
			$this->db->update('transactions');
			//$this->db->update('transactions', array('date_borrowed' => $currentDate, 'borrow_due_date' => $dueDate));
		}//end of if - Borrow Reference

		//Return Reference
		elseif ($flag === 'R' && $totalAvailable < $totalStock){
			
			//Update date returned of transactions
			$this->db->where('reference_material_id', $referenceId);
			$this->db->where('borrower_id', $userId);
			$this->db->set('date_returned', 'CURDATE()', FALSE);
			$this->db->update('transactions');
			//$this->db->update('transactions', array('date_returned' => $currentDate));

			//Increment borrow limit
			$this->db->select('borrow_limit')
				  	 ->from('users')
					 ->where('id', $userId);
			$newBorrowLimitArray = $this->db->get()->result();
			foreach ($newBorrowLimitArray as $item) {
				$newBorrowLimit = $item->borrow_limit;
			}
			$newBorrowLimit++;
			$this->db->where('id', $userId);
			$this->db->update('users', array('borrow_limit' => $newBorrowLimit));

			//Increment total available
			$totalAvailable++;
			$this->db->where('id', $referenceId);
			$this->db->update('reference_materials', array('total_available' => $totalAvailable));
			
			//Shift waitlisted users for reserve
			//Retrieve all waitlisted users
			$this->db->select('borrower_id')
					 ->from('transactions')
					 ->where('waitlist_rank > 0')
					 ->where('reference_material_id', $referenceId);
			$waitlistedUsersArray = $this->db->get()->result();
			//Retrieve waitlist rank, date waitlisted, date reserved, and reservation due date of waitlisted users
			foreach ($waitlistedUsersArray as $user) {
				$this->db->select('waitlist_rank, date_waitlisted, date_reserved, reservation_due_date')
						 ->from('transactions')
						 ->where('borrower_id', $user->borrower_id)
						 ->where('reference_material_id', $referenceId);
				$newWaitListRankArray = $this->db->get()->result();
				//Update rank of waitlisted users
				foreach ($newWaitListRankArray as $rank) {
					$newRank = $rank->waitlist_rank - 1;
					//Update new rank and date waitlisted when first in line
					if($newRank <= 0){
						$this->db->where('borrower_id', $user->borrower_id);
						$this->db->set('date_reserved', 'CURDATE()', FALSE);
						$this->db->set('reservation_due_date', 'CURDATE()', FALSE);
						$this->db->update('transactions', array(
							'waitlist_rank' => NULL,
							'date_waitlisted' => NULL
							));

						//Increment waitlist_limit, Decrement borrow_limit
						$this->db->select('waitlist_limit, borrow_limit')
								 ->from('users')
								 ->where('id', $user->borrower_id);
						$newLimitArray = $this->db->get()->result();
						foreach ($newLimitArray as $wLimit) {
							$newWaitlistLimit = $wLimit->waitlist_limit;
							$newBorrowLimit = $wLimit->borrow_limit;

						}
						$newWaitlistLimit++;
						$newBorrowLimit--;
						$this->db->where('id', $user->borrower_id);
						$this->db->update('users', array('waitlist_limit' => $newWaitlistLimit, 'borrow_limit' => $newBorrowLimit));
					
						//Decrement total available
						$this->db->select('total_available')
								 ->from('reference_materials')
								 ->where('id', $referenceId);
						$newTotalAvailable = $this->db->get()->result();
						foreach ($newTotalAvailable as $tAvailable) {
							$totalAvailable = $tAvailable->total_available;
						}
						$totalAvailable--;
						$this->db->where('id', $referenceId);
						$this->db->update('reference_materials', array('total_available' => $totalAvailable));
					}
					//Decrement waitlist rank
					else{
						$this->db->where('borrower_id', $user->borrower_id);
						$this->db->update('transactions', array('waitlist_rank' => $newRank));
					}
				}
			}
		}//end of elseif - Return Reference
		$this->user_model->insert_log("$userId claimed $referenceId from the library.");
	}

}//end of Librarian_model

?>