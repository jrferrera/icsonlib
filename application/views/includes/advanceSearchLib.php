<!-- Advanced Search Modal -->
	<div id="advanceSearchL" class="modal fade in" role="dialog">  
		<div class="modal-dialog">  
			<div class="modal-content">
				<div class="modal-header">  
					<a class="close" data-dismiss="modal">&times;</a>
					<center><b><h4>Advanced Search</h4>  </b></center>
				</div><!--modal header-->
				<form action="<?php echo base_url('index.php/librarian/advanced_search_reference'); ?>" method="get" accept-charset="utf-8">
					<div class="modal-body">	
							<div id="libsearch">
							<div class="input-group input-group-md" align="right">
	  							<span class="input-group-addon"><input value="title" type="checkbox" id = "titleCBox" name="projection[]" <?php if(isset($projectionArray)) echo $checked = (in_array('title', $projectionArray)) ? 'checked' : '' ?> >
	  								<label for = "titleCBox">Title:
	  								</label>
								</span>
	  							<input type="text" class="form-control" name="title" size = "30" value="<?php if(isset($projectionArray) && in_array('title', $projectionArray)) echo $this->input->get('title')?>">
							</div>
								
							<div class="input-group input-group-md" align="right">
	  							<span class="input-group-addon"><input value="author" type="checkbox" id = "authorCBox" name="projection[]" <?php if(isset($projectionArray)) echo $checked = (in_array('author', $projectionArray)) ? 'checked' : '' ?>>
	  								<label for = "authorCBox">Author:</label>
	  							</span>
	  							<input type="text" name="author" size = "30" class="form-control"value="<?php if(isset($projectionArray) && in_array('author', $projectionArray)) echo $this->input->get('author')?>"><br/></td>
							</div>
		
							<div class="input-group input-group-md" align="right">
	  							<span class="input-group-addon"><input value="year_published" type="checkbox" id = "yearCBox" name="projection[]" <?php if(isset($projectionArray)) echo $checked = (in_array('year_published', $projectionArray)) ? 'checked' : '' ?>>
	  								<label for = "yearCBox">Year Published:</label>
	  							</span>
								<input type="text" name="year_published" class="form-control"size = "30" value="<?php if(isset($projectionArray) && in_array('year_published', $projectionArray)) echo $this->input->get('year_published')?>">
							</div>

							<div class="input-group input-group-md" align="right">
	  							<span class="input-group-addon"><input value="publisher" type="checkbox" id = "publisherCBox" name="projection[]" <?php if(isset($projectionArray)) echo $checked = (in_array('publisher', $projectionArray)) ? 'checked' : '' ?>>
	  								<label for = "publisherCBox">Publisher:</label>
	  							</span>
								<input type="text" name="publisher" class="form-control"size = "30" value="<?php if(isset($projectionArray) && in_array('publisher', $projectionArray)) echo $this->input->get('publisher')?>">
							</div>


							<div class="input-group input-group-md" align="right">
	  							<span class="input-group-addon"><input value="category" type="checkbox" id = "categoryCBox" name="projection[]" <?php if(isset($projectionArray)) echo $checked = (in_array('category', $projectionArray)) ? 'checked' : '' ?>>
	  								<label for = "categoryCBox">Category:</label>
	  							</span>
								<select class="form-control6" name = 'category'>
										<option value = "B" <?= ($this->input->get('category') == 'B') ? 'selected' : '' ?>>Book</option>
										<option value = "J" <?= ($this->input->get('category') == 'J') ? 'selected' : '' ?>>Journal</option>
										<option value = "T" <?= ($this->input->get('category') == 'T') ? 'selected' : '' ?>>Thesis</option>
										<option value = "C" <?= ($this->input->get('category') == 'C') ? 'selected' : '' ?>>CD</option>
										<option value = "M" <?= ($this->input->get('category') == 'M') ? 'selected' : '' ?>>Magazine</option>
										<option value = "S" <?= ($this->input->get('category') == 'S') ? 'selected' : '' ?>>Special Problem</option>
									</select>
							</div>

							<div class="input-group input-group-md" align="right">
	  							<span class="input-group-addon"> Sort by:</span>

	  								<select class = "form-control6" name = 'sortBy'>
										<option value = 'title' <?= ($this->input->get('sortBy') == 'title') ? 'selected' : '' ?>>Title</option>
										<option value = 'course_code' <?= ($this->input->get('sortBy') == 'course_code') ? 'selected' : '' ?>>Course Code</option>
										<option value ='author' <?= ($this->input->get('sortBy') == 'author') ? 'selected' : '' ?>>Author</option>
										<option value = 'category' <?= ($this->input->get('sortBy') == 'category') ? 'selected' : '' ?>>Category</option>
										<option value = 'times_borrowed' <?= ($this->input->get('sortBy') == 'times_borrowed') ? 'selected' : '' ?>>Times Borrowed</option>
									</select>
							</div>


							<div class="input-group input-group-md" align="right">
	  							<span class="input-group-addon"> Order:</span>
									<select class = "form-control7" name = 'orderFrom'>
										<option value = 'ASC' <?= ($this->input->get('orderFrom') == 'ASC') ? 'selected' : '' ?>>Ascending</option>
										<option value = 'DESC' <?= ($this->input->get('orderFrom') == 'DESC') ? 'selected' : '' ?>>Descending</option>
									</select>
							</div>

							<div class="input-group input-group-md" align="right">
	  							<span class="input-group-addon"> Results per page:</span>
									<select class = "form-control9" name = 'perPage'>
										<option value = '10' <?= ($this->input->get('perPage') == '10') ? 'selected' : '' ?>>10</option>
										<option value = '25' <?= ($this->input->get('perPage') == '25') ? 'selected' : '' ?>>25</option>
										<option value = '50' <?= ($this->input->get('perPage') == '50') ? 'selected' : '' ?>>50</option>
										<option value = '75' <?= ($this->input->get('perPage') == '75') ? 'selected' : '' ?>>75</option>
										<option value = '100' <?= ($this->input->get('perPage') == '100') ? 'selected' : '' ?>>100</option>
									</select>
							</div>
						</div>
								
							
					</div>
					<div class="modal-footer">
						<input  class="btn btn-primary"type="submit" value="Advanced Search" />
					</div><!-- modal footer --> 
				</form>	
			</div>
		</div>
	</div>