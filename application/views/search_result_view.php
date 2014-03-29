<?=$this->load->view("includes/header")?>
<?=$this->load->view("includes/createaccount")?>
<!-- Create Account Modal -->
	
<div id="content">

	
<?php 
	//prompts the User that he/she can still reserve a book (if the Waitlist button was clicked)
	if($this->session->userdata('canReserve') == true && $this->session->userdata('flag') == TRUE){
		?>
		<div id="warning_top">
		<?php
		echo "This book is still available. Do you want to reserve it?";?>
		<?php echo '<form method="get" accept-charset="utf-8" action="'?><?php echo base_url('index.php/search/transaction'); ?><?php echo '">';?>
		
		<?php echo '<input type="submit" name="reserve" id="reserve" value="Reserve"/>';
		echo '<input type="submit" name="cancel" value="Cancel"/>';
		echo '<input type="hidden" name = "id" value="' . $this->session->userdata('referenceId') . '"/>';
		echo '</form>';
		$this->session->unset_userdata('canReserve');
		$this->session->unset_userdata('flag');
	} 
?>
</div>
<?php
	//prompts the User that he/she can still waitlist a book (if the Reserve button was clicked)
	if($this->session->userdata('canWaitlist') == true && $this->session->userdata('flag') == TRUE){ ?>
		<div id="warning_top">
		<?php echo "This book is not available for now. Do you want to wait list?";?>
		<?php echo '<form method="get" accept-charset="utf-8" action="'?><?php echo base_url('index.php/search/transaction'); ?><?php echo '">';?>
		<?php echo '<input type="submit" name="waitlist" id="waitlist" value="Waitlist"/>';
		echo '<input type="submit" name="cancel" value="Cancel"/>';
		echo '<input type="hidden" name = "id" value="' . $this->session->userdata('referenceId') . '"/>';
		echo '</form>';
		$this->session->unset_userdata('canWaitlist');
		$this->session->unset_userdata('flag');
	}

	if($this->session->userdata('failedReserve') == TRUE){
	    echo '<script> bootbox.alert("Reserve Action Denied: <br/>&nbsp;&nbsp;&nbsp; 3 possible reasons <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1. You are not allowed to access this book. <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. You have reached the limit of borrowing books. <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3. You have reserved this book already. <br/>"); </script>';
	    $this->session->unset_userdata('failedReserve');
	}
	if($this->session->userdata('failedWaitlist') == TRUE){
	    echo '<script> bootbox.alert("Waitlist Action Denied: <br/>&nbsp;&nbsp;&nbsp; 3 possible reasons <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1. You are not allowed to access this book. <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. You have reached the limit of waitlisting books. <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3. You have waitlisted this book already. <br/>"); </script>';
	    $this->session->unset_userdata('failedWaitlist');
	}
	if($this->session->userdata('successfulReserve') == TRUE){
		echo '<script> bootbox.alert("Reference material was successfully reserved!"); </script>';
		$this->session->unset_userdata('successfulReserve');
	}
	if($this->session->userdata('successfulWaitlist') == TRUE){
		echo '<script> bootbox.alert("Reference material was successfully waitlisted!"); </script>';
		$this->session->unset_userdata('successfulWaitlist');
	}
	
	?>
</div>
		<br/>
		<br/>
			<div class="col-sm-offset-1" id="search_top">
				<form action="<?php echo base_url('index.php/search/search_rm'); ?>" method="get" accept-charset="utf-8">
				
					<input type="text" class="header_class2" name="keyword" size = "30" value="<?php if(isset($_GET['keyword'])) echo htmlspecialchars($this->input->get('keyword'),ENT_QUOTES); ?>"/>
					<input type="submit" class="btn btn-default" name="search1" value="Search" required/>
					<a href="#advanceSearch" data-toggle="modal"> <input name="aSearch" class="btn btn-primary"  value="Advanced Search"/></a>

					<a class="btn btn-success"href="<?=base_url().'index.php/cart/view_cart'?>">View Cart</a>
				</form>
				
			</div>
			<!-- Advance Search Form -->
			<div id="advanceSearch" class="modal fade in" role="dialog">  
<div class="modal-dialog">  
          <div class="modal-content">
            <div class="modal-header">  
              <a class="close" data-dismiss="modal">&times;</a>
           <center><h4><b> Advanced Search</b></h4></center>
            </div><!--modal header-->
            <div class="modal-body">
            	<div id="advancedSearchBody">
                <form action="<?php echo base_url('index.php/search/advanced_search_reference'); ?>" method="get" accept-charset="utf-8">
    
   
	          	<div class="input-group input-group-md" align="right">
	  			        <span class="input-group-addon"><input value="title" type="checkbox" name="projection[]" checked="true">Title:</span>
	  		         	<input type="text" class="form-control" name="title" size = "30" value="<?php if(isset($temparray) && in_array('title',$temparray)) echo $temparrayvalues[array_search('title', $temparray)]?>">
				
				      </div>
			       </br>
        
    
          
          	<div class="input-group input-group-md" align="right">
	  			      <span class="input-group-addon"><input value="author" type="checkbox" name="projection[]">Author:</span>
	  			      <input type="text" name="author" size = "30" class="form-control"value="<?php if(isset($temparray) && in_array('author',$temparray)) echo $temparrayvalues[array_search('author', $temparray)]?>">
			     </div>
			     <br/>

			     <div class="input-group input-group-md" align="right">
	  		      	<span class="input-group-addon"><input value="year_published" type="checkbox" name="projection[]">Year Published:</span>
	  		       	<input type="text" name="year_published" class="form-control"size = "30" value="<?php if(isset($temparray) && in_array('year_published',$temparray)) echo $temparrayvalues[array_search('year_published', $temparray)]?>">
          </div>
            <br/>

			   <div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon"><input value="publisher" type="checkbox" name="projection[]">Publisher:</span>
  			   	<input type="text" name="publisher" class="form-control"size = "30" value="<?php if(isset($temparray) && in_array('publisher',$temparray)) echo $temparrayvalues[array_search('publisher', $temparray)]?>">
 			  </div>
            <br/>

          <div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon"><input value="course_code" type="checkbox" name="projection[]" >Subject:</span>
  				  <input type="text" name="course_code"class="form-control" size = "30" value="<?php if(isset($temparray) && in_array('course_code',$temparray)) echo $temparrayvalues[array_search('course_code', $temparray)]?>">
  		  	</div>
            <br/>
           <div class="input-group input-group-md" align="right">
	  			  <span class="input-group-addon">Category:</span>
  				  <select name="refType"  class="form-control8" >
                <option value="B">Book</option>
                <option value="J">Journal</option>
                <option value="T">Thesis</option>
                <option value="D">CD</option>
                <option value="C">Catalog</option>
              </select>
            </div>
            <br/>
          	
             </div><!--advancedSearchbody-->
            &nbsp &nbsp &nbsp &nbsp
            <input type="radio" name="sort" value="sortalpha"checked="true" />Sort from A to Z
            <input type="radio" name="sort" value="sortbeta" />Sort from Z to A
       		<input type="radio" name="sort" value="sortyear" />Sort by year
            <input type="radio" name="sort" value="sortauthor" />Sort by author(A-Z)
      
   
     
       

              <div class="modal-footer">
                <input  class="btn btn-primary"type="submit" value="Advanced Search" />
                 </form> 
              </div> <!-- modal footer -->

            </div> <!--modalbody-->
          </div>
        </div>
    </div> 
	
		<!-- displays the search results -->

		<div>
		<br/>			
			<div id="pagination_view"><?php 
				echo $this->pagination->create_links();
				if(!empty($rows)){
				?> </div>
				<table id = 'booktable1' class="table table-hover table-bordered">
					<thead>
						<tr>
							<th><center>Title</center></th>
							<th>Category</th>
							<th>Author/s</th>
							<th>Publisher</th>
							<th>Publication Year</th>
							<th>Course Code</th>
							<th>Total Available</th>
							<th>Access Type</th>
							<th>Actions</th>
							
						</tr>
					</thead>
					<tbody style = "text-align: center" >
				<?php	
				foreach($rows as $row): ?>
					<form action="<?php echo base_url('index.php/search/transaction'); ?>" method="get" accept-charset="utf-8">
						<input type="hidden" name="booktitle" value="<?=$row->title?>" />
						<input type="hidden" name="bookauthor" value="<?=$row->author?>" />
						<input type="hidden" name="bookcourse" value="<?=$row->course_code?>" />

					<tr>
						
					<td class="fixed"><?=$row->title?></td>
					<?php if($row->category == 'B') echo '<td>Book</td>';
							if($row->category == 'M') echo '<td>Magazine</td>';
							if($row->category == 'T') echo '<td>Thesis</td>';
							if($row->category == 'S') echo '<td>Special Problem</td>';
							if($row->category == 'C') echo '<td>CD/DVD</td>';
							if($row->category == 'J') echo '<td>Journal</td>';
							elseif($row->category == NULL)    echo '<td></td>';
						?>
						<td><?=$row->author?></td>
						<?php if($row->publisher != NULL && $row->publication_year != NULL){?>
							<td class="fixed"><?=$row->publisher?></td>
							<td><?=$row->publication_year?></td>
						<?php }elseif($row->publisher == NULL && $row->publication_year == NULL){?>
							<td></td>
							<td></td>
						<?php }elseif($row->publisher != NULL && $row->publication_year == NULL){?>
							<td class="fixed"><?=$row->publisher?></td>
							<td></td>
						<?php }elseif($row->publisher == NULL && $row->publication_year != NULL){?>
							<td><?=$row->publication_year?></td>
							<td></td>
						<?php }?>
						<td><?=$row->course_code?></td>
						<td><?=$row->total_available?>/<?=$row->total_stock?></td>
							
						<?php if($row->access_type == 'S') {
								echo '<td>Student</td>';
				     		}else{
								echo '<td>Faculty</td>';
							}
						?>
					<td class="buttonsFixed">
					<input type="hidden" name="id" value="<?=$row->id?>" />
					<a href="<?= base_url('index.php/search/view_reference/' . $row->id)?>" class='btn btn-primary'>View Reference</a>
					<a href="<?= base_url('index.php/cart/add_to_cart/' . $row->id)?>" class='btn btn-success'>Add to Cart</a>
					<?php if($this->session->userdata('loggedIn') && ($this->session->userdata('userType') == 'S' || $this->session->userdata('userType') == 'F')){ ?>
						<input type="submit"  class="btn btn-info"name="reserve" id="reserve" value="Reserve"/>
						<input type="submit" class="btn btn-danger" name="waitlist" id="waitlist" value="Waitlist"/>
				 	<?php }?>
				</td>	
				</tr>
				</form>

			<?php endforeach; ?>
		</table>
		<div id="pagination_view">
				<?php echo $this->pagination->create_links(); ?>
		</div>
			<?php }

			else{
				echo 'No Materials found.';
			}
			?>
			
		</div>
	
	
<?=$this->load->view("includes/footer")?>