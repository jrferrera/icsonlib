<?php

/**
 * Cart controller
 *
 * @author	Jose Carlo Husmillo & Alyssa Bianca Cos
 * @version 1.0
 *
 */

class Cart extends CI_Controller{
	public function Cart(){
		parent::__construct();
	}

	/**
	 * Function to add items in the cart
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */	
	public function add_to_cart(){
		$data['title'] = "Cart - ICS OnLib";

		$bookid = $this->uri->segment(3);
		$order2  = array('\\','\/','@','!','#','&','$','%','^','*','(',')','+','=',',','.','<','>','?','[',']',':','\'','a','b','c',
			'd','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G',
			'H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			
		$bookid = str_replace($order2, '', $bookid);

		//Call a function to view a book
		$result = $this->user_model->view_reference_materials($bookid);

		if($result->result() != NULL){		
			foreach ($result->result() as $row){
			    $bookyear = $row->publication_year;
			    $booktitle = $row->title;
			    $bookauthor = $row->author;
			    $bookcode = strtoupper($row->course_code);
			    $totalAvailable = $row->total_available;
			    $totalStock = $row->total_stock; 
			}

			//Details for the cart items. Some details will not be displayed
			$qart = array(
               'id'      => $bookid,
               'qty'     => 1,
               'price'   => 1.00,
               'name'    => 'Book',
               'options' => array('Title' => $booktitle,'Year' => $bookyear, 'Author' => $bookauthor, 'Bookcode' => $bookcode, 'TotalAvailable' => $totalAvailable, 'TotalStock' => $totalStock)
            );

			$this->cart->insert($qart);

			redirect('cart');
		}else{
			redirect('search');
		}
	}

	/**
	 * Function to the cart page
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function index(){
		$data['title'] = "Cart - ICS OnLib";
		$this->load->view('cart_view',$data);
	}

	/**
	 * Function to view cart items
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function view_cart(){
		$data['title'] = "Cart - ICS OnLib";
		$this->load->view('cart_view',$data);
	}

	/**
	 * Function to empty the cart contents
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function empty_cart(){
		$this->cart->destroy();
		redirect('cart');
	}

	/**
	 * Function to remove certain cart items
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function remove_selected(){
		
		
		$total = $this->cart->total();
 
		for ($i=1; $i < $total+1 ; $i++) { 
			$strname = "cart".$i;
			$bookid = $this->input->post($strname);

			//If $bookid is set/checked, delete the item
			if($bookid != null){
				$data = array(  
		              'rowid' => $bookid, 
		              'qty'   => 0 //Setting qty to zero would delete it from cart
		           );  
				
				$this->cart->update($data); 
			}
		}
		$data['title'] = "Cart - ICS OnLib";
		$this->load->view('cart_view',$data);
	}

	/**
	 * Function to remove cart item after reservation
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	public function remove_after_reserved(){
		$bookid = $this->uri->segment(3);
		$order2  = array('\\','\/','@','!','#','&','$','%','^','*','(',')','+','=',',','.','<','>','?','[',']',':','\'','a','b','c',
			'd','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G',
			'H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			
		$bookid = str_replace($order2, '', $bookid);
		$qwe = $this->cart->contents();
		$flag = false;
		$i = 1;
		$rowid = '';

		foreach ($qwe as $key) {
			foreach ($key as $value) {
				if($i == 1){
					$rowid=$value;
				}
				
				if($i == 2 && $value == $bookid){
					$flag = true;
					break;
				}

				$i++;//for rowid
			}
			$i = 1;
			if($flag) break;
		}

		$data = array(  
		              'rowid' => $rowid, 
		              'qty'   => 0 //Setting qty to zero would delete it from cart
		           );  
				
		$this->cart->update($data); 
		redirect('search');
	}
}

?>