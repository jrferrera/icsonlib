<?=$this->load->view('includes/header')?>
<!-- View to fill forms to create account of administrator and librarian (Admin module) -->
<!-- Erika C. Kimhoko January 27,2014 -->
<!-- Updated: January 29,2014 -->
<!-- Note: d q sure kung tama ung patterns na nilagay ko. Pacheck na lang tnx -->

	<!--alert to inform the user about the error -->
 <h3>Create Account</h3>
	<div id="add_acc">
	<?php if(isset($_POST['submit']) && isset($passCheck) && !$passCheck) {echo "<script>alert(\"Your email has already been used. Please enter a another one.\");</script>";} ?>
	
	<form action="<?=base_url().'index.php/administrator/create_account'?>" method='post' id="adminCreate" name="adminCreate">
		
		<?php 
			if($this->input->post('submit') && isset($passCheck) && $passCheck){
				echo '<script> alert("Passwords do not match."); </script>';
			}
		?>	
			<div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon">Employee Number:</span>
  				  <input type='text' class="form-control" name='employee_no' value="<?=set_value('employee_no')?>" title="Must be 9 digits." maxlength="9" pattern="^[0-9]+$" autofocus required/>
			</div>
			<div class='error_message'><?=form_error('employee_no')?></div>
			

			<div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon">Last Name:</span>
  				 <input type='text'class="form-control" name='last_name' value="<?=set_value('last_name')?>" maxlength="32" title="Must be 2-32 characters." pattern = "^([A-Za-z\s])+[-]{0,1}+([A-Za-z\s])+$" required/>
			</div>
			<div class='error_message'><?=form_error('last_name')?></div>
			<div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon">First Name:</span>
  				 <input type='text' class="form-control"name='first_name' pattern = "^([A-Za-z0-9]+[ ]{0,1}[A-Za-z0-9]+)+$" value="<?=set_value('first_name')?>" maxlength="32" title="Must be 2-32 characters." required/></td>
			</div>
			<div class='error_message'><?=form_error('first_name')?></div>

			<div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon">Middle Name:</span>
  				<input type='text'class="form-control" name='middle_name' pattern = "^[A-Za-z ]+$" value="<?=set_value('middle_name')?>" maxlength="32" title="Must be at most 32 characters."/>
			</div>
			<div class='error_message'><?=form_error('middle_name')?></div>

			<div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon">User Type:</span>
  				<select class="btn btn-default form-control18" name='user_type'>
			 	 <option value="">----</option>
			 	 <option value="A">Admin</option>
			 	 <option value="L">Librarian</option>
				</select>
			</div>
			<div class='error_message'><?=form_error('user_type')?></div>


			
	     <div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon">Username:</span>
  				<input type='text' class="form-control"name='username' pattern="^[A-Za-z]+[A-Za-z0-9]+[_|\.]{0,1}[A-Za-z0-9]+$" value="<?=set_value('username')?>" maxlength="30" title="Must be 6-30 characters. Use letters, numbers, underscore and period only." required/>
			
		</div>
			<div class='error_message'><?=form_error('username')?></div>
		
		
		<div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon">Password:</span>
  				<input type='password' class="form-control" name='password' pattern="^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$" value="<?=set_value('password')?>" maxlength="32" title="Must be 6-32 characters and must not contain space." onchange="adminCreate.confirm_password.pattern = this.value;" required/>
		
		</div>
			<div class='error_message'><?=form_error('password')?></div>
		
		<div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon"> Confirm Password:</span>
  				<input type='password'class="form-control" name='confirm_password' pattern="^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$" value="<?=set_value('confirm_password')?>" maxlength="32" title="Must be 6-32 characters, must not contain space and must be the same as password." required/>
		
		</div>
			<div class='error_message'><?=form_error('confirm_password')?></div>
		
		<div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon"> College Address:</span>
  				<textarea class="form-control" id="college_address" name = "college_address" title="Must be 20-65,535 characters." maxlength="65535" pattern="^([A-Za-z0-9\.\\,\/'#-]+[ ]{0,1})+$" value="<?=set_value('college_address')?>" required><?=set_value('college_address')?></textarea>
		</div>
			<div class='error_message'><?=form_error('college_address')?></div>
		
		<div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon"> Email Address:</span>
  				<input type='email' class="form-control" name='email_address' value="<?=set_value('email_address')?>" maxlength="60" pattern = "^([a-zA-Z\+]+)([\.\_\-]{0,1}[a-zA-Z0-9\+]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$" title='Must contain 2-60 characters including "@email.com".' required/>
		</div>
		<div class='error_message'><?=form_error('email_address')?></div>

		<div class="input-group input-group-md" align="right">
	  		   	<span class="input-group-addon">Contact Number:</span>
  				<input type='text' class="form-control" name='contact' pattern="[0-9]{7,11}" value="<?=set_value('contact')?>" maxlength="15" pattern = "[+]{0,1}[(]{0,1}[0-9]+[)]{0,1} {0,1}[-]{0,1}[0-9]+[-]{0,1}[0-9]+" title='Must be 7-15 characters. Must be a mobile or landline number.' required/>
		</div>
		<div class='error_message'><?=form_error('email_address')?></div>

		</div>
		<br/>
		<center id="button_submit"><input type='submit' class="btn btn-default" name='submit' value='Submit'/></center>
	  
	</form>



<?=$this->load->view("includes/footer")?>