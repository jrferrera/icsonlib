<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/createaccount'); ?>
<?php
	if($this->session->userdata('directBorrowSuccess')){
		echo '<script> bootbox.alert("Direct reference borrowing successful!"); </script>';
		$this->session->unset_userdata('directBorrowSuccess');
	}

	if($this->session->userdata('directBorrowFailed')){
		$message = $this->session->userdata('directBorrowFailedMessage');
		echo '<script> bootbox.alert("'.$message.'"); </script>';
		$this->session->unset_userdata('directBorrowFailed');
		$this->session->unset_userdata('directBorrowFailedMessage');
	}

	if($this->session->userdata('userAuthenticationFailed')){
		echo '<script> bootbox.alert("User Authentication Failed!"); </script>';
		$this->session->unset_userdata('userAuthenticationFailed');
	}
?>

	<h3>View Reference</h3>

	<?php if($number_of_reference != 1) { ?>
		<center><div id="alertmessage2" class="alert alert-danger">No Reference Found.</div></center>
	<?php }
		else{?>
		<div id="ref_mat">
			<?php foreach ($reference_material as $row) { ?>
				</br>
				<div class="input-group input-group-md" align="right">
	  			<span class="input-group-addon">Title:</span>
	  			<input type="text"  class="form-control1" id="title" name="title" value=" <?php echo $row->title; ?>" disabled/> 
				</div>

				<div class="input-group input-group-md" align="right">
	  			<span class="input-group-addon">Author:</span>
	  			<input type="text"  class="form-control1" id="author" name="title" value=" <?php echo $row->author; ?>" disabled/> 
				</div>
				<div class="input-group input-group-md" align="right">
	  			<span class="input-group-addon">ISBN:</span>
	  			<input type="text"  class="form-control1" id="isbn" name="title" value=" <?php echo $row->isbn; ?>" disabled/> 
				</div>
				<div class="input-group input-group-md" align="right">
	  			<span class="input-group-addon">Category:</span>
	  			<input type="text"  class="form-control1" id="author" name="title" value=" <?php
				if($row->category == 'B'){
					echo "Book";	
				}else if($row->category == 'M'){
					echo "Magazine";
				}else if($row->category == 'T'){
					echo "Thesis";
				}else if($row->category == 'S'){
					echo "Special Problem";
				}else if($row->category == 'J'){
					echo "Journal";
				}else{
					echo "CD/DVD";
				}
				?>" disabled/> 
				</div>
				<div class="input-group input-group-md" align="right">
	  			<span class="input-group-addon">Description:</span>
	  			<input type="text"  class="form-control1" id="description" name="title" value=" <?php echo $row->description; ?>" disabled/> 
				</div>

				<div class="input-group input-group-md" align="right">
	  			<span class="input-group-addon">Publisher:</span>
	  			<input type="text"  class="form-control1" id="author" name="title" value=" <?php echo $row->publisher; ?>" disabled/> 
				</div>
				<div class="input-group input-group-md" align="right">
	  			<span class="input-group-addon">Publication Year:</span>
	  			<input type="text"  class="form-control1" id="author" name="title" value=" <?php echo $row->publication_year; ?>" disabled/> 
				</div>
				<div class="input-group input-group-md" align="right">
	  			<span class="input-group-addon">Access Type:</span>
	  			<input type="text"  class="form-control1" id="author" name="title" value=" <?php
					if($row->access_type=="S"){
						echo "Student";	
					}else{
						echo "Faculty";
					}
				?>" disabled/> 
				</div>
				
				<div class="input-group input-group-md" align="right">
	  			<span class="input-group-addon">Course Code:</span>
	  			<input type="text"  class="form-control1" id="author" name="title" value=" <?php echo $row->course_code; ?>" disabled/> 
				</div>
				
				<div class="input-group input-group-md" align="right">
	  			<span class="input-group-addon">Total Available:</span>
	  			<input type="text"  class="form-control1" id="author" name="title" value=" <?php echo $row->total_available; ?>" disabled/> 
				</div>
				<div class="input-group input-group-md" align="right">
	  			<span class="input-group-addon">Total Stock:</span>
	  			<input type="text"  class="form-control1" id="author" name="title" value=" <?php echo $row->total_stock; ?>" disabled/> 
				</div>
				
				<div class="input-group input-group-md" align="right">
	  			<span class="input-group-addon">Times Borrowed:</span>
	  			<input type="text"  class="form-control1" id="author" name="title" value=" <?php echo $row->times_borrowed; ?>" disabled/> 
				</div>
				
				
			
				
				<div class="input-group input-group-md" align="right">
	  			<span class="input-group-addon">For Deletion:</span>
	  			<input type="text"  class="form-control1" id="author" name="title" value=" <?php echo $row->for_deletion; ?>" disabled/> 
				</div>
			
			<div id="butview">
				<a href = "<?= base_url('index.php/librarian/edit_reference_index/' . $row->id) ?>" id = "linked" class = "btn btn-success">Edit</a>
				<a href = "#borrow" class = "btn btn-danger" data-toggle = "modal" value  = "borrow">Borrow</a>
			</div><!-- but view-->
	<?php } ?>
<br/>
<br/>
<br/>
</div>
	
	<!-- Borrower Information Modal -->
			<div id = "borrow" class = "modal fade in" role = "dialog" width = "100px">
				<div class = "modal-dialog">
					<div class = "modal-content">
						<div class = "modal-header">
							<a class = "close" data-dismiss = "modal">&times;</a>
							<h4>Borrower Information Form</h4>
						</div><!--modal header-->
						<form action = "<?= base_url('index.php/librarian/direct_borrow/' . $row->id); ?>" method = "POST" accept-charset = "UTF-8">
							<div class = "modal-body">
								<div class="input-group input-group-md" align="right">
	  								<span class="input-group-addon">Username:</span>
	  								<input type = "text" class = "form-control" name = "username" value = "<?= $this->input->post('username') ?>" pattern = "^[A-Za-z]+[A-Za-z0-9]+[_|\.]{0,1}[A-Za-z0-9]+$" maxlength="30" size = "30" />
								</div>
								<div class="input-group input-group-md" align="right">
	  								<span class="input-group-addon">Password:</span>
	  								<input type = "password" class = "form-control" name = "password" value  = "<?= $this->input->post('password') ?>" pattern="^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$" maxlength="32" size = "30" />
										</div>
								
							</div>
							<div class = "modal-footer">
								<input type = "submit" class = "btn btn-primary" name = 'submit' value = "Borrow" />
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- End of Borrower Information Modal -->
	

	<?php if($numberOfTransactions > 0) { ?>
	<br />
	<br />
	<table id="transactionLibrarian" class="table table-hover table-bordered" cellpadding = "10" cellspacing = "2">
		<thead>
			<tr>
				<th>Name</th>
				<th>User Type</th>
				<th>Waitlisted Rank</th>
				<th>Date Waitlisted</th>
				<th>Date Reserved</th>
				<th>Date Reserved Due</th>
				<th>Date Borrowed</th>
				<th>Date Borrowed Due</th>
				<th>Date Returned</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($transactions as $t): ?>

				<tr>
					<td><?= $t->first_name . ' ' . $t->middle_name . ' ' . $t->last_name ?></td>
					<td>
						<?php if($t->user_type == 'S'){
							echo 'Student';
						}
						elseif ($t->user_type == 'F'){
						 	echo 'Faculty';
						 } 
						else{
						 	echo 'N/A';
						 }
						 ?>
					</td>
					<td><?= $t->waitlist_rank = ($t->waitlist_rank) ? $t->waitlist_rank : '---' ?></td>
					<td><?= $t->date_waitlisted = ($t->date_waitlisted) ? $t->date_waitlisted : '---' ?></td>
					<td><?= $t->date_reserved = ($t->date_reserved) ? $t->date_reserved : '---' ?></td>
					<td><?= $t->reservation_due_date = ($t->reservation_due_date) ? $t->reservation_due_date : '---' ?></td>
					<td><?= $t->date_borrowed = ($t->date_borrowed) ? $t->date_borrowed : '---' ?></td>
					<td><?= $t->borrow_due_date = ($t->borrow_due_date) ? $t->borrow_due_date : '---' ?></td>
					<td><?= $t->date_returned = ($t->date_returned) ? $t->date_returned : '---' ?></td>
					<td><button id="linked" class="btn btn-primary">
						<?php
							if($t->waitlist_rank > 0){ ?>
								<label>Waitlisted</label>
							<?php }
							elseif($t->date_borrowed == '---') {
								echo anchor(base_url('index.php/librarian/claim_return/' . $t->reference_material_id . '/' . $t->id . '/C'), 'Borrow');
							}
							elseif ($t->date_returned == '---') {
							 	echo anchor(base_url('index.php/librarian/claim_return/' . $t->reference_material_id . '/' . $t->id . '/R'), 'Return');
							}
							else{ ?>
								<label>Finished</label>
							<?php } ?><!-- transaction_library -->
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	</div> 
</div>
</div>
	<?php }} ?>
<?php $this->load->view('includes/footer'); ?>