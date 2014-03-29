<!-- View Accounts Page -->

<?=$this->load->view('includes/header')?>
<?php
	if($this->session->userdata('deactivate_error')){
		echo '<script> bootbox.alert("Cannot deactivate own account!"); </script>';
		$this->session->unset_userdata('deactivate_error');
	}
	if($this->session->userdata('edit_error')){
		echo '<script> bootbox.alert("Account does not exist!"); </script>';
		$this->session->unset_userdata('edit_error');
	}
	if($this->session->userdata('create_success')){
		echo '<script> bootbox.alert("Successfully created account!"); </script>';
		$this->session->unset_userdata('create_success');
	}
	if($this->session->userdata('delete_success')){
		echo '<script> bootbox.alert("Successfully deleted the account/s!"); </script>';
		$this->session->unset_userdata('delete_success');
	}
	else if($this->session->userdata('delete_trans')){
		echo '<script> bootbox.alert("Cannot delete account/s, an account still has a transaction!"); </script>';
		$this->session->unset_userdata('delete_trans');
	}
	else if($this->session->userdata('delete_own')){
		echo '<script> bootbox.alert("Cannot delete own account while logged in!"); </script>';
		$this->session->unset_userdata('delete_own');
	}
?>

	<div class="col-sm-offset-1" id='search_container'>
	
		<form action='<?=base_url('index.php/administrator/search_accounts')?>' method='post'>
			<select class="btn btn-default" id='category' name='category'>
				<option value='username' <?=($searchCategory == 'username' ? "selected='selected'" : '')?>>Username</option>
				<option value='student_number' <?=($searchCategory == 'student number' ? "selected='selected'" : '')?>>Student Number</option>
				<option value='employee_number' <?=($searchCategory == 'employee number' ? "selected='selected'" : '')?>>Employee Number</option>
				<option value='first_name' <?=($searchCategory == 'first name' ? "selected='selected'" : '')?>>First Name</option>
				<option value='last_name' <?=($searchCategory == 'last name' ? "selected='selected'" : '')?>>Last Name</option>
			</select>
			<input type='text' id='search_text' class="header_class2" name='search_text' autofocus="autofocus" value='<?=($searchText != '' ? $searchText : '')?>' required/>

			<input  class="btn btn-success" type='submit' name='submit' value='Search Account'/>
		</form>
	</div>
	
	<div class="col-sm-offset-1" id='category_option_container'>
		<form action='<?=base_url('index.php/administrator/view_accounts')?>' method='post'>
			Sort by:
			<input type='hidden' id='hidden_search_text' name='hidden_search_text' value='<?=$searchText?>'/>
			<input type='hidden' id='hidden_category' name='hidden_category' value='<?=$searchCategory?>'/>
			
			<select id='sort_category' class="btn btn-default"name='sort_category' onchange='this.form.submit()'>
				<option value='last_name' <?=($sortCategory == 'last_name' ? "selected='selected'" : '')?>>Last Name</option>
				<option value='first_name' <?=($sortCategory == 'first_name' ? "selected='selected'" : '')?>>First Name</option>
				<option value='employee_number' <?=($sortCategory == 'employee_number' ? "selected='selected'" : '')?>>Employee Number</option>
				<option value='student_number' <?=($sortCategory == 'student_number' ? "selected='selected'" : '')?>>Student Number</option>
				<option value='user_type' <?=($sortCategory == 'user_type' ? "selected='selected'" : '')?>>User Type</option>
			</select>
		</form>
		<div id="buttonsAdmin">
			<?=anchor('administrator/view_accounts/', '<button class="btn btn-primary">View All Accounts</button>')?>
			<?=anchor('administrator/create_account', '<button class="btn btn-success">Create Account</button>')?>
			
		</div>
	</div>

	<div id='search_result_container'>
		<div id="results">
		<?php if($searchText){ ?>
			<b>Found <?=$accountCount?> with <?=$searchCategory?> '<?=$searchText?>'.</b>
		<?php }else{ ?>
			<b>Found <?=$accountCount?> user accounts.</b>
		<?php } ?>
		</div>
		<?php if($accountCount > 0) { ?>
			    <div id="paginationStyle1"><?= $this->pagination->create_links() ?> </div>

			<table id="admin_results" class="table table-hover table-bordered" cellpadding = "5" cellspacing = "2">
				<thead>
					<!-- Creates a checkbox which when clicked, will toggle all existing checkboxes to the same state as this checkbox (Select/Deselect All) using the Javascript function, toggle(). -->
					<th> Select All <p></p><input type='checkbox' name='selectAll' onClick="toggle(this)"/></th>
					<th>No.</th>
					<th>Employee Number</th>
					<th>Student Number</th>
					<th>Username</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Middle Name</th>
					<th>Account Type</th>
					<th>Action</th>
				</thead>
				<!-- Creates a form for deletion. If successful, it will call the view_accounts() in the administrator controller. -->
				<!-- Changelog: 2/5 Restored delete_accounts() method in administrator controller. Will now redirect to delete_accounts() instead.-->
				<form action="<?=base_url().'index.php/administrator/delete_accounts/'?>" method="post" id="delete_form">
				<?php $i = 1; ?>
				<tbody>
					<?php foreach ($accounts as $account) : ?>
					<a href="<?=base_url('administrator/edit_account/'.$account->id);?>">
						<tr>
							<!-- Creates a checkbox which when checked, will be passed to the controller and model to delete the checked row. Value will vary depending on the account type (Employee/Student). -->
							<!--Changelog: 2/5 -Used username as value instead.-->
							<!--Changelog: 2/10 -Used row id (id) as value instead.-->
							<td>
							<input type='checkbox' class="users" name='users[]' value='<?=$account->id?>' 
							<?php
								if($account->id == $this->session->userdata('id')){
									//echo form_checkbox('users[]', $account->id, FALSE);
									echo " disabled";
								}
							?>
							/>
							</td>
							<td><?=$i++ + $offset?></td>
							<td><?=($account->employee_number != NULL ? $account->employee_number : "--")?>
							</td>
							<td ><?=($account->student_number != NULL ? $account->student_number : "--")?>
							</td>
							<td><?=$account->username?></td>
							<td ><?=$account->last_name?></td>
							<td ><?=$account->first_name?></td>
							<td ><?=$account->middle_name?></td>
							<td><?php
									if($account->user_type == 'A')
										echo "Administrator";
									else if($account->user_type == 'L')
										echo "Librarian";
									else if($account->user_type == 'F')
										echo "Faculty";
									else if($account->user_type == 'S')
										echo "Student";
								?>
							</td>
							<td align="center">

								<!--Changelog: 2/5 -Added a Edit Account button for edit_account() method-->
								<?=anchor('administrator/edit_account/'.$account->id, '<button type="button" class="btn btn-success">Edit Account</button>')?>
								<?php
									if($account->is_activated == 'T'){

										if($account->id != $this->session->userdata('id')){							
											echo anchor('administrator/toggle_account/'.$account->id, '<button type="button" class="btn btn-danger">Deactivate</button>', 'class="deactivate_button"');
										}
										else{
											echo '<button type="button" class="btn btn-default" disabled>Disabled</button>';
										}
									}
									else{
										echo anchor('administrator/toggle_account/'.$account->id, '<button type="button" class="btn btn-primary">Activate</button>', 'class="activate_button"');
									}
								?>
							</td>
						</tr>

					</a>
					<a href="#" class="go-top">Back to Top</a>
					<?php endforeach; ?>

				</tbody>
				<!-- Creates a submit button that when successful and onclick, will call the Javascript function deleteValidate(), which creates a popup informing the user of the deletion. -->
				<div id="adminButtons">
				<input type="submit" class="btn btn-danger"value="Delete Selected"  name="delete" id="delete"/>
				</form>
				</div>
				<br/>
			</table>
			<br/> 
		<?php } ?>
	</div>

<script>

$('#delete_form').submit(function(e){
	var currentForm = this;
	e.preventDefault();
	if($(".users:checked").length>0) {
		bootbox.confirm("Are you sure you want to delete? Process cannot be reversed after action has been done.",
		function(deletePromptOne){
			if(deletePromptOne){
				bootbox.confirm("Are you REALLY sure you want to delete? Say bye to data after this?",
					function(deletePromptTwo){
						if(deletePromptTwo){
							currentForm.submit();
						}
					});
			}
		});
	}
});

$('.deactivate_button').click(function(e){
		var link =$(this).attr('href');
		e.preventDefault();
		bootbox.confirm("Are you sure you want to deactivate this account?",
		function(status){
			if(status){
				window.location = link;
			}
		});
	});

</script>

<?=$this->load->view('includes/footer')?>