<?= $this->load->view('includes/header') ?>
<?= $this->load->view('includes/advanceSearchLib') ?>


	<!-- Form Searching References -->
    
<br>
<br>


<div id="content">
	<div id="buttonsLibrarian" class="row1">
        <a href = '<?= base_url('index.php/librarian/add_reference') ?>' class = 'btn btn-sm btn-default'>Add Reference Via Form &nbsp</a>
		
        <a href = '<?= base_url('index.php/librarian/file_upload') ?>' class = 'btn btn-sm btn-default'>Add Reference Via File Upload</a>
	
        <a href = '<?= base_url('index.php/librarian/view_report_index') ?>' class = 'btn btn-sm btn-default'>Generate Report</a>
		
		 <a href = '#overdue' class = "btn  btn-sm btn-default" data-toggle = "modal">
				Display Overdue Transactions
			</a>
		
			
		</div>
	<div class="col-sm-offset-1" id="search_top">

		<br /> 
		<form action = "<?= base_url('index.php/librarian/search_reference') ?>" method = 'GET'>
			<select  class="btn btn-sm btn-default" name = 'category'>
				<option value = 'title' <?php echo ($this->input->get('category') == 'title') ? "selected" : ""; ?>>Title</option>
				<option value = 'author' <?php echo ($this->input->get('category') == 'author') ? "selected" : ""; ?>>Author</option>
				<option value = 'isbn' <?php echo ($this->input->get('category') == 'isbn') ? "selected" : ""; ?>>ISBN</option>
				<option value = 'course_code' <?php echo ($this->input->get('category') == 'course_code') ? "selected" : ""; ?>>Course Code</option>
				<option value = 'publisher' <?php echo ($this->input->get('category') == 'publisher') ? "selected" : ""; ?>>Publisher</option>
			</select>
	      
			<input type = 'text' class="header_class2" name = 'searchText' pattern = '.{1,}' value = '<?= htmlspecialchars($this->input->get('searchText'), ENT_QUOTES) ?>'/>
	  
			<input type = 'submit' class="btn btn-sm btn-primary" name = 'submit' value = 'Search' />
			<a href="#advanceSearchL" data-toggle="modal">
				<input type="submit" name="aSearch" class="btn btn-sm btn-success"  value="Advanced Search"/>
			</a>
			<br /> <br />
			<input type = 'submit' class="btn btn-sm btn-primary" name = 'all' value = 'Display All References' />
			&nbsp; &nbsp;

			<label>Sort By</label>
			<select class = "btn btn-xs btn-default" name = 'sortBy'>
				<option value = 'title' <?= ($this->input->get('sortBy') == 'title') ? 'selected' : '' ?>>Title</option>
				<option value = 'course_code' <?= ($this->input->get('sortBy') == 'course_code') ? 'selected' : '' ?>>Course Code</option>
				<option value ='author' <?= ($this->input->get('sortBy') == 'author') ? 'selected' : '' ?>>Author</option>
				<option value = 'category' <?= ($this->input->get('sortBy') == 'category') ? 'selected' : '' ?>>Category</option>
				<option value = 'times_borrowed' <?= ($this->input->get('sortBy') == 'times_borrowed') ? 'selected' : '' ?>>Times Borrowed</option>
			</select>
			&nbsp; &nbsp;
			<label>Order</label>
			<select class = "btn  btn-xs btn-default" name = 'orderFrom'>
				<option value = 'ASC' <?= ($this->input->get('orderFrom') == 'ASC') ? 'selected' : '' ?>>in Ascending Order</option>
				<option value = 'DESC' <?= ($this->input->get('orderFrom') == 'DESC') ? 'selected' : '' ?>>in Descending Order</option>
			</select>
			&nbsp; &nbsp;
			<label>Results per page</label>
			<select class = "btn  btn-xs btn-default" name = 'perPage'>
				<option value = '10' <?= ($this->input->get('perPage') == '10') ? 'selected' : '' ?>>10</option>
				<option value = '25' <?= ($this->input->get('perPage') == '25') ? 'selected' : '' ?>>25</option>
				<option value = '50' <?= ($this->input->get('perPage') == '50') ? 'selected' : '' ?>>50</option>
				<option value = '75' <?= ($this->input->get('perPage') == '75') ? 'selected' : '' ?>>75</option>
				<option value = '100' <?= ($this->input->get('perPage') == '100') ? 'selected' : '' ?>>100</option>
			</select>
		</form>
		<br />

	</div>

	<!-- Display Overdue Transactions Modal -->
	<div id="overdue" class="modal fade in" role="dialog">  
		<div class="modal-dialog">  
			<div class="modal-content">
				<div class="modal-header">  
					<a class="close" data-dismiss="modal">&times;</a>
					<h4>Display Overdue Transactions</h4>  
				</div><!--modal header-->
				<form action="<?php echo base_url('index.php/librarian/get_overdue_transactions'); ?>" method = "GET" accept-charset = "UTF-8">
					<div class="modal-body">
						<table>
							<tr>
								<td align = "right"><label>Sort By</label></td>
								<td align = "right">
									<select class = "form-control" name = "sortBy">
										<option value = "last_name" <?= ($this->input->get('sortBy') == 'last_name') ? 'selected' : '' ?>>Name</option>
										<option value = "title" <?= ($this->input->get('sortBy') == 'title') ? 'selected' : '' ?>>Reference Title</option>
										<option value = "user_type" <?= ($this->input->get('sortBy') == 'user_type') ? 'selected' : '' ?>>User Type</option>
										<option value = "category" <?= ($this->input->get('sortBy') == 'category') ? 'selected' : '' ?>>Category</option>
										<option value = "daysOverdue" <?= ($this->input->get('sortBy') == 'daysOverdue') ? 'selected' : '' ?>>Days Overdue</option>
									</select>
								</td>
							</tr>
							<tr>
								<td align = "right"><label>Order</label></td>
								<td align = "right">
									<select class = "form-control" name = "order">
										<option value = "ASC" <?= ($this->input->get('order') == 'ASC') ? 'selected' : '' ?>>Ascending/Increasing</option>
										<option value = "DESC" <?= ($this->input->get('order') == 'DESC') ? 'selected' : '' ?>>Descending/Decreasing</option>
									</select>
								</td>
							</tr>
							<tr>
								<td align = "right"><label>Show</label></td>
								<td align = "right">
									<select class = "form-control" name = "page">
										<option value = "10" <?= ($this->input->get('page') == '10') ? 'selected' : '' ?>>10 per Page</option>
										<option value = "25" <?= ($this->input->get('page') == '25') ? 'selected' : '' ?>>25 per Page</option>
										<option value = "50" <?= ($this->input->get('page') == '50') ? 'selected' : '' ?>>50 per Page</option>
										<option value = "75" <?= ($this->input->get('page') == '75') ? 'selected' : '' ?>>75 per Page</option>
										<option value = "100" <?= ($this->input->get('page') == '100') ? 'selected' : '' ?>>100 per Page</option>
										<option value = "all" <?= ($this->input->get('page') == 'all') ? 'selected' : '' ?>>All</option>
									</select>
								</td>
							</tr>
						</table>
					</div>
					<div class = "modal-footer">
						<input type = "submit" class = "btn btn-primary" name = "display" value = "Display Overdue Transactions" >
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- End of Display Overdue Transactions Modal-->
  		
    <!-- displays the search results -->
    <?php if(! empty($references)) { ?>
   	<div>
    	<form name = "forms" action = "<?= base_url('index.php/librarian/delete_reference/') ?>" method = "POST">
			<?php $endOfPage = ($offset + $per_page < $totalAffected) ? ($offset + $per_page) : $totalAffected; ?>
			
			<center>
				<span>
					<label>
					<?php if($this->input->get('searchText') != '') { ?>
						Retrieved <?= $totalAffected ?> reference<?php if($totalAffected > 1) echo 's' ?> containing  
							"<?= htmlspecialchars($this->input->get('searchText'), ENT_QUOTES) ?>" in 
							<?= ucwords(str_replace('_', ' ', htmlspecialchars($this->input->get('category'), ENT_QUOTES))) ?>
					<?php } elseif(isset($projectionArray) && ! empty($projectionArray)) { ?>
						Retrieved <?= $totalAffected ?> reference<?php if($totalAffected > 1) echo 's' ?> with

						<?php $this->load->view('includes/advanceSearchDecorText');
						
						}
						elseif(isset($_GET['all']) OR $this->input->get('searchText') == '') { ?>
							Retrieved all references
						<?php } ?>
					</label>
				</span>
			</center>
			<center>
				<span>
					<p>Retrieved <?= $offset + 1 ?> to <?= $endOfPage ?> of <?= $totalAffected ?> references</p>
				</span>
			</center>
			<div id="pagination_view">	
				<?php echo $this->pagination->create_links(); ?>
			</div>
			<table id = 'booktable' class="table table-hover table-bordered" >
				<thead>
					<tr>
						<th class="fixedCheckBox">
							<div id="buttonSearch">
								<button type = "button" class="btn btn-primary"  id = "markAll" value = "unmarked" alt = "Mark All" /><span class="glyphicon glyphicon-check"></span></button>
								<button type = "submit" class="btn btn-primary" value = "Delete Selected" onclick = "return confirmDelete()" alt = "Delete Selected" /><span class="glyphicon glyphicon-trash"></span> </button>
							</div>
						</th>
						<th>Course Code</th>
						<th class="fixedReferenceDetails">Reference Details</th>
						<th>Access Type</th>
						<th>Stock Count</th>
						<th class="fixedTimesBorrowed">Number of Times Borrowed</th>
						<th>Reference Status</th>
					</tr>
				</thead>
				<tbody style = "text-align: center" >
				<?php	
					foreach($references as $row): ?>
						<tr>
							<td  align="center"class="fixedCheckBox"> <input type = 'checkbox' class = 'checkbox' name = 'ch[]' value = '<?= $row->id ?>' /></td>
							<td><?= $row->course_code ?></td>
							<td class="fixedReferenceDetails" align="left"><b>Title: </b><?= anchor(base_url('index.php/librarian/view_reference/' . $row->id), $row->title) ?><br/>
							<b>Author:</b> <?= $row->author ?><br/>
								<b>Category: </b><?php 
									if($row->category == 'B')
										echo 'Book';
									elseif ($row->category == 'J')
										echo 'Journal';
									elseif($row->category == 'M')
										echo 'Magazine';
									elseif($row->category == 'C')
										echo 'CD/DVD';
									elseif($row->category == 'S')
										echo 'Special Problem';
									elseif($row->category == 'T')
										echo 'Thesis';
								?>
							
							<br/><b>ISBN:</b> <?= $row->isbn = ($row->isbn != '') ? $row->isbn : 'N/A' ?><br/>
							<b>Publisher: </b><?= $row->publisher = ($row->publisher != '') ? $row->publisher : 'N/A' ?><br/>
							<b>Publication Year: </b> <?= $row->publication_year = ($row->publication_year != '') ? $row->publication_year : 'N/A' ?><br/>
							<td>
								<?php 
									if($row->access_type == 'S')
										echo 'Student';
									elseif ($row->access_type == 'F')
										echo 'Faculty';
								?>
							</td>
							<td><?= $row->total_available ?> / <?= $row->total_stock ?></td>
							<td class="fixedTimesBorrowed"><?= $row->times_borrowed ?></td>
							<td>
								<?php
									if($row->for_deletion == 'T')
										echo 'To be removed';
									elseif ($row->for_deletion == 'F')
										echo 'Available';
								?>
							</td>
						</tr>

				<?php endforeach; ?>
			</table>
			<div id="pagination_view">	
				<?php echo $this->pagination->create_links(); ?>
			</div>

			<center>
				<span>
					<p>Retrieved <?= $offset + 1 ?> to <?= $endOfPage ?> of <?= $totalAffected ?> references</p>
				</span>
			</center>
			
		</form>
		<a href="#" class="go-top">Back to Top</a>
	<?php }
	elseif(! empty($overdueTransactions)){ ?>
		<?php $endOfPage = ($offset + $per_page < $numberOfoverDueTransactions) ? ($offset + $per_page) : $numberOfoverDueTransactions; ?>
		<center>
			<span>
				<label>
					Retrieved <?= $offset + 1 ?> to <?= $endOfPage ?> of <?= $numberOfoverDueTransactions ?> transactions
				</label>
			</span>
		</center>
		<div id = "pagination_view">
			<?= $this->pagination->create_links(); ?>
		</div>
		<table class = "table table-hover table-bordered">
			<thead>
				<tr>
					<th>ID Number</th>
					<th>Name</th>
					<th>User Type</th>
					<th>Reference Title</th>
					<th>Reference Category</th>
					<th>Date Borrowed</th>
					<th>Due Date</th>
					<th>Number of Days Overdue</th>
				</tr>
			</thead>
			<tbody style = "text-align: center" >
				<?php foreach ($overdueTransactions as $t): ?>
					<tr>
						<th>
							<?php if($t->user_type == 'S'){
								echo $t->student_number;
							}
							elseif($t->user_type == 'F'){
								echo $t->employee_number;
							}
							else{
								echo 'N/A';
							} ?>
						</th>
						<th><?= $t->last_name . ', ' . $t->first_name . ' ' . $t->middle_name ?></th>
						<th>
							<?php if($t->user_type == 'S'){
								echo 'Student';
							}
							elseif($t->user_type == 'F'){
								echo 'Faculty';
							}
							else{
								echo 'N/A';
							}
							?>
						</th>
						<th><?= anchor(base_url('index.php/librarian/view_reference/' . $t->id), $t->title) ?></th>
						<th>
							<?php if($t->category == 'B'){
								echo 'Book';
							}
							elseif($t->category == 'S'){
								echo 'Special Problem';
							}
							elseif($t->category == 'J'){
								echo 'Journal';
							}
							elseif($t->category == 'T'){
								echo 'Thesis';
							}
							elseif($t->category == 'M'){
								echo 'Magazine';
							}
							elseif($t->category == 'C'){
								echo 'CD/DVD';
							}
							else{
								echo 'N/A';
							}
							?>
						</th>
						<th><?= $t->date_borrowed ?></th>
						<th><?= $t->borrow_due_date ?></th>
						<th><?= $t->daysOverdue ?></th>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<center>
			<span>
				<label>
					Retrieved <?= $offset + 1 ?> to <?= $endOfPage ?> of <?= $numberOfoverDueTransactions ?> transactions
				</label>
			</span>
		</center>
		<div id = "pagination_view">
			<?= $this->pagination->create_links(); ?>
		</div>
		<br/>
		<br/>
		<a href="#" class="go-top">Back to Top</a>
	<?php }

	else{ ?>
		<center>
			<label>
				<?php 
				if(isset($references) && empty($references)){
					echo 'No reference material found with ';
					if(! empty($projectionArray)){

						$this->load->view('includes/advanceSearchDecorText');
						
					}
					else
						echo '"' . htmlspecialchars($this->input->get('searchText'), ENT_QUOTES) . '" in ' .
							ucwords(str_replace('_', ' ', $this->input->get('category'))) . '.';	
				}
				elseif(empty($overdueTransactions) && isset($_GET['display'])){
					echo 'No accounts with overdue transcations';
				} ?>
			</label>
		</center>
		
	<?php } ?>
	</div>
 </div>
		
<?= $this->load->view('includes/footer') ?>