<?=$this->load->view("includes/header")?>
<form name="forms" action="<?= base_url().'index.php/librarian/change_forDeletion/' ?>" method="post">
<br/>
<div class="alert alert-info"><h4>The following resource(s) might still be in use, thus not deleted in the database.<br/>
		Would you like to change to 'For Deletion' status? </h4>
</div>

<table id = 'booktable' class="table table-hover table-bordered" cellpadding = "5" cellspacing = "2">
		<thead>
					<tr>
						<th>
							<button type = "button" class="btn btn-primary glyphicon glyphicon-check "  id = "markAll" value = "unmarked" alt = "Mark All" /></button> </td>
							<button type = "submit" class="btn btn-primary glyphicon glyphicon-thumbs-up" id="dele" value = "Delete Selected" onclick = "return confirmChangeForDeletion()" alt = "Delete Selected" /></button></td>
						</th>
						<th>Course Code</th>
						<th>
							<center>Title</center>
						</th>
						<th>Author/s</th>
						<th>Category</th>
						<th>ISBN</th>
						<th>Publisher</th>
						<th>Publication Year</th>
						<th>Access Type</th>
						<th>Stock Count</th>
						<th>Number of Times Borrowed</th>
						<th>Reference Status</th>
					</tr>
				</thead>
		
	<?php
		foreach($forDeletion as $forDelete):
			$totalrows = $forDelete->num_rows();
			if($totalrows > 0):
				foreach ($forDelete->result() as $row):	
	?>
				
				<tbody style = "text-align: center" >
		<tr>
		<tr>
							<td align="center"><input type = 'checkbox' class = 'checkbox' name = 'ch[]' value = '<?= $row->id ?>' /></td>
							<td><?= $row->course_code ?></td>
							<td class="fixedTitle"><?= anchor(base_url('index.php/librarian/view_reference/' . $row->id), $row->title) ?></td>
							<td class="fixedAuthor"><?= $row->author ?></td>
							<td>
								<?php 
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
							</td>
							<td><?= $row->isbn = ($row->isbn != '') ? $row->isbn : 'N/A' ?></td>
							<td class="fixedPublisher"><?= $row->publisher = ($row->publisher != '') ? $row->publisher : 'N/A' ?></td>
							<td><?= $row->publication_year = ($row->publication_year != '') ? $row->publication_year : 'N/A' ?></td>
							<td>
								<?php 
									if($row->access_type == 'S')
										echo 'Student';
									elseif ($row->access_type == 'F')
										echo 'Faculty';
								?>
							</td>
							<td><?= $row->total_available ?> / <?= $row->total_stock ?></td>
							<td><?= $row->times_borrowed ?></td>
							<td>
								<?php
									if($row->for_deletion == 'T')
										echo 'To be removed';
									elseif ($row->for_deletion == 'F')
										echo 'Available';
								?>
							</td>
						</tr>
	<?php
				endforeach;
			endif;
		endforeach;
	?>
<table>
</form>
<?=$this->load->view("includes/footer")?>