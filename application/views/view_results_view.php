<?=$this->load->view("includes/header")?>
<?php $this->load->view('includes/createaccount'); ?>
	<?php if($rows != null) : ?>
 		<center><b><h4>View Reference Material</h4></center></b>
 		<?php foreach ($rows as $r): ?>
		<div id="content">
		<div id="view_results">

		<div class="input-group input-group-md" align="right">
	  		<span class="input-group-addon">Title:</span>
	  		<input type="text"  class="form-control1" id="title" name="title" value=" <?php echo $r->title; ?>" DISABLED> 
		</div>
		<div class="input-group input-group-md" align="right">
	  		<span class="input-group-addon">Category:</span>
	  		<input type="text"  class="form-control1" id="category" name="category" value="<?php if($r->category == 'B') echo 'Book';
																								 if($r->category == 'M') echo 'Magazine';
																								 if($r->category == 'T') echo 'Thesis';
																								 if($r->category == 'S') echo 'Special Problem';
																								 if($r->category == 'C') echo 'CD/DVD';
																								 if($r->category == 'J') echo 'Journal';
																								 elseif($r->category == NULL)	echo '';?>" DISABLED>
		</div>
		<div class="input-group input-group-md" align="right">
	  		<span class="input-group-addon">Access Type:</span>
	  		<input type="text"  class="form-control1" id="access_type" name="access_type" value="<?php if($r->access_type == 'S') echo 'Student';
																								 if($r->access_type == 'F') echo 'Faculty';
																								 elseif($r->access_type == NULL)	echo '';?>" DISABLED>
		</div>
		<div class="input-group input-group-md" align="right">
	  		<span class="input-group-addon">Author:</span>
	  		<input type="text"  class="form-control1" id="author" name="author" value="<?php echo $r->author; ?>" DISABLED>
		</div>
		<div class="input-group input-group-md" align="right">
	  		<span class="input-group-addon">ISBN:</span>
	  		<input type="text"  class="form-control1" id="isbn" name="isbn" value="<?php echo $r->isbn; ?>" DISABLED>
		</div>
		<div class="input-group input-group-md" align="right">
	  		<span class="input-group-addon">Year of Publication:</span>
	  		<input type="text" class="form-control1" id="publication_year" name="publication_year" value="<?php echo $r->publication_year; ?>" DISABLED>
		</div>
		<div class="input-group input-group-md" align="right">
	  		<span class="input-group-addon">Description:</span>
	  		<input type="text" class="form-control1" id="publication_year" name="publication_year" value="<?php echo $r->description; ?>" DISABLED>
		</div>
		<div class="input-group input-group-md" align="right">
	  		<span class="input-group-addon">Publisher:</span>
	  		<input type="text" class="form-control1" id="publisher" name="publisher" value="<?php echo $r->publisher; ?>" DISABLED>
		</div>
		<div class="input-group input-group-md" align="right">
	  		<span class="input-group-addon">Course Code:</span>
	  		<input type="text" class="form-control1" id="course_code" name="course_code" value="<?php echo strtoupper($r->course_code); ?>" DISABLED>
		</div>
		<div class="input-group input-group-md" align="right">
	  		<span class="input-group-addon">Total Available:</span>
	  		<input type="text" class="form-control1" id="total_available" name="total_available" value="<?php echo $r->total_available; ?>" DISABLED>
		</div>
		<div class="input-group input-group-md" align="right">
	  		<span class="input-group-addon">Total Stock:</span>
	  		<input type="text" class="form-control1" id="total_stock" name="total_stock" value="<?php echo $r->total_stock; ?>" DISABLED>
		</div>	
			
			<div id="view_book">
			<form action="<?php echo base_url('index.php/search/search_rm'); ?>" method="get" accept-charset="utf-8">
			<input type="submit"  class="btn btn-danger" name="search1" id="back" value="<< Back"/>
			<input type="hidden"  name="keyword" value="<?=$this->session->userdata('keyword')?>"/>
			<input type="hidden"  name="offset" value="<?php if(isset($_GET['per_page'])) echo $_GET['per_page']; else echo '0';?>"/>
		</form>
		<div id="toTop"><a href="<?= base_url('index.php/cart/add_to_cart/' . $r->id) ?>" class = "btn btn-success" id = "linked">Add to Cart</a></div>
						<form action="<?php echo base_url('index.php/search/transaction'); ?>" method="get" accept-charset="utf-8">
							<input type="hidden" class="form-control1" name="access_type" value="<?php echo $r->access_type; ?>">
							<input type="hidden" name="id" value=<?=$r->id?> />
							<input type="hidden" name="booktitle" value="<?=$r->title?>" />
					        <input type="hidden" name="bookauthor" value="<?=$r->author?>" />
					        <input type="hidden" name="bookcourse" value="<?=$r->course_code?>" />
					        
						<?php if($this->session->userdata('loggedIn')){ ?>
						<div id="res">
							<?php if($r->total_available > 0) { ?>
							<input type="submit"  class="btn btn-default"name="reserve" id="reserve" value="Reserve"/>
							<?php }else{ ?>
							<input type="submit" class="btn btn-default" name="waitlist" id="waitlist" value="Waitlist"/>
					 	 </div>
					 	<?php }} else {?>
					 	<div id="res">
					 		<input type="submit"  class="btn btn-default"name="reserve" id="reserve" value="Reserve" disabled/>
						</div>
					 	<?php } ?>
					
					</form>
			
			</div>
  
 			
 		<?php endforeach; ?>
 	<?php else:?>
 		<p>No reference material found for that keyword.</p>
 	<?php endif; ?>
</div>

</div>
<?=$this->load->view("includes/footer")?>