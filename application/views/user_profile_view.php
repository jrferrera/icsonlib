<?php $this->load->view('includes/header'); ?>
<?php
	if($this->session->userdata('uploadSuccessful')){
		echo '<script> bootbox.alert("<center>Profile picture successfully uploaded!</center>"); </script>';
		$this->session->unset_userdata('uploadSuccessful');
	}

	if($this->session->userdata('uploadFailed')){
		echo '<script> bootbox.alert("<center>Upload image failed.<br/>Profile picture should be in *.jpg format, must be at most 200x200 pixels and should not exceed 200KB.</center>"); </script>';
		$this->session->unset_userdata('uploadFailed');
	}

	if($this->session->userdata('profileSuccessfullySaved')){
		echo '<script> bootbox.alert("<center>Profile successfully updated!"); </script>';
		$this->session->unset_userdata('profileSuccessfullySaved');
	}

	if($this->session->userdata('usernameExists')){
		echo '<script> bootbox.alert("<center>Failed to update profile. Username already exists."); </script>';
		$this->session->unset_userdata('usernameExists');
	}

	if($this->session->userdata('profileUpdateFailed')){
		echo '<script> bootbox.alert("<center>Profile update failed!"); </script>';
		$this->session->unset_userdata('profileUpdateFailed');
	}

	if($this->session->userdata('cancelReserve')){
		echo '<script> bootbox.alert("<center>One reserved reference matarial has been cancelled."); </script>';
		$this->session->unset_userdata('cancelReserve');
	}

	if($this->session->userdata('cancelWaitlist')){
		echo '<script> bootbox.alert("<center>One waitlisted reference matarial has been cancelled."); </script>';
		$this->session->unset_userdata('cancelWaitlist');
	}

	if($this->session->userdata('passwordChangeFailedMatch')){
		echo '<script> bootbox.alert("'.$this->session->userdata('passwordChangeMessageMatch').'"); </script>';
		$this->session->unset_userdata('passwordChangeFailedMatch');
	}

	if($this->session->userdata('passwordChangeFailedAutheticate')){
		echo '<script> bootbox.alert("'.$this->session->userdata('passwordChangeMessageAutheticate').'"); </script>';
		$this->session->unset_userdata('passwordChangeFailedAutheticate');
	}
?>

<div id="content">
	<div id="left">
<div id="profile_fixed">	
		<div id ="profile_picture_div">
			<img src="<?=base_url('resources/img/user_images/'.$image->profile_picture)?>" width="200" height="200">
			<form action="<?=base_url()."index.php/profile/change_profile_picture"?>" method="post" accept-charset="utf-8" enctype="multipart/form-data"><!--Profile Form-->
				Profile picture: <input type='file' id='profile_picture' name='profile_picture' accept='.jpg' title='Profile picture should be in *.jpg format, must be at most 200x200 pixels and should not exceed 200KB.' required/><br/>
				<input type='submit' name='submit' value='Change Profile Picture'/>
				<div id="profilered">* Profile picture should be in *.jpg format, must be at most 200x200 pixels and should not exceed 200KB.</div>
			</form>
		</div>
		
		
			<div id="profile_div">
			<form action="<?=base_url()."index.php/profile/save"?>" method="post" name="profileForm"><!--Profile Form-->
			
		        <div id="prof_form">
		            
						<h2 id="prof_name"><?=$query_user->last_name?>, <?=$query_user->first_name?> <?=$query_user->middle_name?></h2>
		            	

		     
		     	    
		            	<?php if($query_user->user_type=='S') { //if user is student?>
		            		<div class="input-group input-group-md" align="right">
	  		   					<span class="input-group-addon">Student Number:  </span>
  				  				<input type="text" class="form-control1" DISABLED id="student_number" value="<?=$query_user->student_number?>" name="student_number" pattern="^[0-9][0-9\-]{11}[0-9]$">
							</div>
		            		<?php }else{ //if user is FACULTY or ADMIN?>
		            		<div class="input-group input-group-md" align="right">
	  		   					<span class="input-group-addon">Employee Number:  </span>
  				  				<input type="text" class="form-control1" DISABLED id="student_number" value="<?=$query_user->employee_number?>" name="student_number" pattern="^[0-9][0-9\-]{11}[0-9]$">
							</div>
		            		<?php }?>
		            
		            
		            	<?php if($query_user->user_type=='S') { //if user is student?>

		            		<div class="input-group input-group-md" align="right">
	  		   					<span class="input-group-addon">College:  </span>
  				  				<input type="text" class="form-control1" DISABLED id="college" value="<?=$query_user->college?>" name="college" pattern="^[0-9][0-9\-]{11}[0-9]$">
						</div>

		            	<?php }?>
		            
		            
		            	<?php if($query_user->user_type=='S') { //if user is student?>
		            			<div class="input-group input-group-md" align="right">
	  		   					<span class="input-group-addon">Degree Course:  </span>
  				  				<input type="text" class="form-control1" DISABLED id="degree" value="<?=$query_user->degree?>" name="degree" pattern="^[0-9][0-9\-]{11}[0-9]$">
								</div>
		            	<?php }?>
		            
		            	<div class="input-group input-group-md" align="right">
	  		   					<span class="input-group-addon">Email Address:  </span>
  				  				<input type="text" class="form-control1" DISABLED id="email_address" value="<?=$query_user->email_address?>" name="email_address" pattern = "^([a-z0-9._]{2,}@[a-zA-Z0-9.-]{2,}\.[a-zA-Z]{2,})(\.[a-zA-Z])*$">
		            	</div>
		                <div class="input-group input-group-md" align="right">
	  		   					<span class="input-group-addon">Username:  </span>
  				  				<input type="text" class="form-control1" id="username" name="username" value="<?=$query_user->username?>" title="Must be 6-30 characters. Use letters, numbers, underscore and period only." min="6" max="30" onblur="validateUName()" pattern = "^([A-Za-z0-9]|[A-Za-z0-9]\_|[A-Za-z0-9]\.|[A-Za-z0-9]\_\.){6,30}$">
		          		</div>
		                <div id="alignright" class='error_message'><?=form_error('username')?></div>
		                <div id="alignright"><span name="helpname4"></span></div>
		           		 <div class="input-group input-group-md" align="right">
	  		   					<span class="input-group-addon">Old Password:  </span>
  				  				<input type="password" class="form-control1" id="oldpassword" name="oldpassword" min="6" max="32" title="Must be 6-32 characters."/>
		                </div>
		                <div class='error_message'><?=form_error('oldpassword')?></div>
		                 <div class="input-group input-group-md" align="right">
	  		   					<span class="input-group-addon">New Password:  </span>
  				  				<input type="password" class="form-control1" id="password" name="password" min="6" max="32" title="Must be 6-32 characters." width="3em" onblur="validatePassword2()"/>
		                
		            </div>
		            	<div class='error_message'><?=form_error('password')?></div>
		            <div id="alignright1"><span name="helppass" id="helppass"></span></div>
		              <div class="input-group input-group-md" align="right">
	  		   					<span class="input-group-addon fontsize">Confirm New Password:&nbsp</span>
  				  				<input type="password" class="form-control1" id="repassword" name="repassword" min="6" max="32" title="Must be 6-32 characters." width="3em" onblur="validateRePass2()">
		                
		            </div>
		            <div class='error_message'><?=form_error('repassword')?></div>
		             <div id="alignright1"><span name="helppass" id="helprepass"></span></div>
		            <div class="input-group input-group-md" align="right">
	  		   					<span class="input-group-addon">College Address:  </span>
  				  				<textarea class="form-control1" id="college_address" name="college_address" title="Must be 20-65,535 characters." min="20" max="65535" pattern="^([A-Za-z0-9]\.\,\s|[A-Za-z0-9]\.|[A-Za-z0-9]\,|[A-Za-z0-9]\s|[A-Za-z]|[A-Za-z0-9]){20,65535}$"><?=$query_user->college_address?></textarea>
		            </div>
		        
		        	<div class="input-group input-group-md" align="right">
	  		   					<span class="input-group-addon">Contact Number:  </span>
  				  				 <input type="text" class="form-control1" id="contact_number" name="contact_number" value="<?=$query_user->contact_number?>" min="11" max="11" pattern = "[0-9]{11}" placeholder="09XXXXXXXXX">
		            </div>
		           
		     	</div>
		     			  <div id="prof_btn">
		                <button type="submit" class="btn btn-default btn" name="submit">Edit</button>
		            	</div>

		     	 </form>
			</div>  <!--END OF PROFILE DIV-->
			</div> <!--END OF PROFILE-FIXED-->
			<?php if($this->session->userdata('userType') == 'S'||$this->session->userdata('userType') == 'F') {?>
			<div id="outer_carousel">
			<div id ="profile_books_carousel">
				<div id="this-carousel-id" class="carousel slide">
					<div class="carousel-inner" >
						<div class = "item active">
							<div class = "profile_books_item">
								<h4>Borrowed Materials: </h4> <!--Borrowed books-->
								<?php if(!empty($borrowed_materials)) { ?>
									<?php foreach($borrowed_materials as $material) : ?>
										Title: <?=$material->title?><br/><!--Title-->
										Author: <?=$material->author?><br/><!--Author-->
										Course Code: <?=$material->course_code?><br/> <!--Course Code-->
										Due Date: <?=$material->borrow_due_date?><br/> <!--Borrow Due Date-->
									<br/>
									<?php endforeach; ?>
									<div id="profileblack">*Kindly return the material(s) to the ICS Library before the due date.</div>
								<?php }else { ?>
										<ul>
											<li>No borrowed material.</li><br/>
										</ul>
								<?php } ?>
							</div>
						</div>
						<div class="item">
							<div class = "profile_books_item">
								<h4>Reserved Materials: </h4> <!--Reserved books-->
								<?php if(!empty($reserved_materials)) { ?>
									<?php foreach($reserved_materials as $material) : ?>
										Title: <?=$material->title?><br/><!--Title-->
										Author: <?=$material->author?><br/><!--Author-->
										Course Code: <?=$material->course_code?><br/> <!--Course Code-->
										Due Date: <?=$material->reservation_due_date?><br/> <!--Reservation Due Date-->
									<br/>
									<form method="post" accept-charset="utf-8" action="<?=base_url()."index.php/profile/cancel_transaction"?>" onclick="javascript: return confirm('Are you sure you want to cancel reservation?');">
										<input type="hidden" name="ref_id" value=<?=$material->reference_material_id?> />
										<input type="submit" name="cancel_reserve" id="cancel_reserve" value="Cancel Reservation"/><br/><br/>
									</form>
									<?php endforeach; ?>
									<div id="profileblack">*Kindly claim the materials before the due date, otherwise, your reservation will be cancelled.</div>
								<?php }else { ?>
										<ul>
											<li>No reserved material.</li><br/>
										</ul>
								<?php } ?>
							</div>					
						</div>
						<div class="item">
							<div class = "profile_books_item">
								<h4>Waitlisted Materials: </h4> <!--Reserved books-->
								<?php if(!empty($waitlisted_materials)) { ?>
									<?php foreach($waitlisted_materials as $material) : ?>
										Title: <?=$material->title?><br/><!--Title-->
										Author: <?=$material->author?><br/><!--Author-->
										Course Code: <?=$material->course_code?><br/> <!--Course Code-->
										Rank: <?=$material->waitlist_rank?>/<?=$waitlist_max->maxRank?><br/> <!--Rank-->
									<br/>
									<form method="post" accept-charset="utf-8" action="<?=base_url()."index.php/profile/cancel_transaction"?>" onclick="javascript: return confirm('Are you sure you want to cancel waitlist?');">
										<input type="hidden" name="ref_id" value=<?=$material->reference_material_id?> />
										<input type="submit" name="cancel_waitlist" id="cancel_waitlist" value="Cancel Waitlist"/><br/><br/>
									</form>
									<?php endforeach; ?>
								<?php }else { ?>
										<ul>
											<li>No waitlisted material.</li><br/>
										</ul>
								<?php } ?>
							</div>					
						</div>
					</div><!-- .carousel-inner -->
				<!--  next and previous controls here
				href values must reference the id for this carousel -->
					<a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
					<a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
				</div><!-- .carousel -->
			</div>
	</div> <!--End outer carou-->	
	<?php }//closing for if statement ?>

	</div> <!--End of left div-->	
</div> <!--End of content div-->
</body>
<script type="text/javascript">

	function validateUName(){
			str = profileForm.username.value;
			hint = ""

			//if (str=="") hint+="This field is required. ";
			if (!str.match(/^([A-Za-z0-9]|[A-Za-z0-9]\_|[A-Za-z0-9]\.|[A-Za-z0-9]\_\.){6,30}$/)) hint+="Must be 6-30 characters. Use letters, numbers, underscore and period only.";
			if(hint=="Hint:") hint="";
				document.getElementsByName("helpname4")[0].innerHTML=hint;
			if(hint=="")return true;
		}
		
	/*
	* For validation of Password
	*/		
	function validatePassword2(){
		msg = "";
		str = profileForm.password.value;

		$('#helppass').css('color','#FF6600');
					
		if(str == "") msg+="";
		if(str.match(/^[a-z]{1,5}$/)) msg="  Strength: Weak";
		else if(str.match(/^[0-9]{1,5}$/)) msg="  Strength: Weak";
		else if(str.match(/^[a-z0-9]+$/)){
			msg="  Strength: Medium";
			$('#helppass').css('color','#7BB31A');		
		}
		else if(str.match(/^[a-zA-Z0-9]+$/)){
			msg="  Strength: Strong";
			$('#helppass').css('color','green');
		}
					
		if(msg == "") msg="";
			$("#helppass")[0].innerHTML=msg;	
					
	}

	/*
	* For re-validation of Password
	*/			
	function validateRePass2(){
		msg = "";
		str = profileForm.repassword.value;

		$('#helprepass').css('color','#FF6600');
					
		if(str != ""){
			if(str != profileForm.password.value) msg+="  Password does not match. ";
			else{
				msg="  Passwords match";
				$('#helprepass').css('color','green');
			}
		}
					
		if(msg == "") msg="";
			$("#helprepass")[0].innerHTML=msg;
					if(msg == "") return true;				
	}
</script>
<?php $this->load->view('includes/footer'); ?>