<?=$this->load->view('includes/header')?>
<?php		
	if(!$row){
		$this->session->set_userdata('edit_error', TRUE);
		redirect('administrator/view_accounts');
	}		

	if($this->session->userdata('edit_success')){
		echo '<script> bootbox.alert("You have successfully edited the account!"); </script>';
		$this->session->unset_userdata('edit_success');
	}
?>
	<h3>&nbsp; &nbsp; Edit Account</h3>
		
		<div id="edit_account" class="edit_acc">
			<form action="<?=base_url().'index.php/administrator/save_account_changes'?>" id="edit_form" name = 'edit_form' method='post' onsubmit="return true">
				
								<?php
									echo form_hidden('row_id', $row->id);
									echo form_hidden('user_type', $row->user_type);
								?>
								<?php if ($row->user_type != 'S'){?>
									<div class="input-group input-group-md" align="right">
	  		   							<span class="input-group-addon">Employee Number:  </span>
  				  						<input type='text' id = "employee_number" class = "form-control1" name='employee_no' pattern='[0-9]{9}' value="<?php echo $row->employee_number; ?>" disabled />
									</div>
								<?php }?>
								<?php if ($row->user_type == 'S'){?>
									<div class="input-group input-group-md" align="right">
	  		   							<span class="input-group-addon">Student Number:  </span>
  				  						<input type='text' id = "student_number" class = "form-control1" name='stud_no' pattern='[\-0-9]{10}' value='<?php echo $row->student_number; ?>' disabled />
									</div>
								<?php }?>

								<div class="input-group input-group-md" align="right">
	  		   							<span class="input-group-addon">Last Name:  </span>
  				  						<input type="text" class="form-control1" id="last_name" name="last_name" pattern = "^([A-Za-z\s])+[-]{0,1}+([A-Za-z\s])+$" value='<?php echo $row->last_name; ?>' title="Must be 2-32 characters." maxlength="32" required/>
								</div>
								<div class='error_message'><?=form_error('last_name')?></div>

								<div class="input-group input-group-md" align="right">
	  		   							<span class="input-group-addon">First Name:  </span>
  				  						<input type="text" class="form-control1"  name="first_name" id="first_name" name="first_name" pattern = "^([A-Za-z0-9]+[ ]{0,1}[A-Za-z0-9]+)+$" value='<?php echo $row->first_name; ?>' title="Must be 2-32 characters." maxlength="32" required/>
								</div>
								<div class='error_message'><?=form_error('first_name')?></div>
								<div class="input-group input-group-md" align="right">
	  		   							<span class="input-group-addon">Middle Name:  </span>
  				  						<input type="text" class="form-control1" name="middle_name" id="middle_name" name="middle_name" pattern="^[A-Za-z ]+$" value='<?php echo $row->middle_name; ?>' maxlength="32" title="Must be at most 32 characters."/>
								</div>
								<div class='error_message'><?=form_error('middle_name')?></div>

								<div class="input-group input-group-md" align="right">
	  		   							<span class="input-group-addon">Username:  </span>
  				  						<input type="text" class="form-control1" name="username" id="uname" name="username" pattern = "^[A-Za-z]+[A-Za-z0-9]+[_|\.]{0,1}[A-Za-z0-9]+$" maxlength="30" value= '<?php echo $row->username; ?>' title="Must be 6-30 characters. Use letters, numbers, underscore and period only." onblur="checkUsername()" required/>
								</div>
								<div class='error_message'><?=form_error('username')?></div>

								<div class="input-group input-group-md" align="right">
	  		   							<span class="input-group-addon">New Password:  </span>
  				  						<input type="text" class="form-control1" id="new_password" name="new_password" maxlength="32" pattern="^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$" title="Must be 6-32 characters and must not contain space." onchange="edit_form.confirm_password.pattern = this.value;"/>
                        	   </div>

                        

                        	   <div class='error_message'><?=form_error('new_password')?></div>

                        	    <div class="input-group input-group-md" align="right">
	  		   							<span class="input-group-addon">Confirm Password:  </span>
  				  						<input type="text" class="form-control1" id="confirm_password" name="confirm_password" pattern="^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$" title="Must be 6-32 characters, must not contain space and must be the same as New Password." />
                        	   </div>

                        	   <div class='error_message'><?=form_error('confirm_password')?></div>

                        	   <div class="input-group input-group-md" align="right">
	  		   							<span class="input-group-addon">College Address:  </span>
  				  						<input type="text" class="form-control1" id="college_address" name="college_address" title="Must be 19-200 characters." maxlength="200" pattern="^([A-Za-z0-9\.\\,\/'#-]+[ ]{0,1})+$" value='<?php echo $row->college_address; ?>' required>
							  </div>

                        	   <div class='error_message'><?=form_error('college_address')?></div>
								

								<div class="input-group input-group-md" align="right">
	  		   							<span class="input-group-addon">Email Address:  </span>
  				  						<input type="email" class="form-control1" id="email_address" name="email_address" pattern = "^([a-zA-Z\+]+)([\.\_\-]{0,1}[a-zA-Z0-9\+]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$" maxlength="60" value='<?php echo $row->email_address; ?>' title="Must follow the standard email format (username, @, domain name, top-level domain name)" required />
						  		</div>

                        	   <div class='error_message'><?=form_error('email_address')?></div>

                        	   <div class="input-group input-group-md" align="right">
	  		   							<span class="input-group-addon">Contact Number:  </span>
  				  						<input type="text" class="form-control1" id="contact_number" name="contact" pattern = "[+]{0,1}[(]{0,1}[0-9]+[)]{0,1} {0,1}[-]{0,1}[0-9]+[-]{0,1}[0-9]+" value='<?php echo $row->contact_number; ?>' maxlength="15" title='Must be 7-15 characters. Must be a mobile or landline number.' required>
								</div>

                        	   <div class='error_message'><?=form_error('contact_number')?></div>

                        	   <?php if ($row->user_type == 'S'){
						echo form_hidden('user_type', $row->user_type);?>
					
							<div class="input-group input-group-md" align="right">
	  		   							<span class="input-group-addon">College:  </span>
  				  						
								<select value='<?php echo $row->college; ?>' name="college" id="college" class="form-control19 collegeDropdown">
									<option value="">Select College</option>
									<option value="CA" <?php if($row->college == 'CA') echo 'selected'; ?>> CA </option>
									<option value="CAS" <?php if($row->college == 'CAS') echo 'selected'; ?>> CAS </option>
									<option value="CA-CAS" <?php if($row->college == 'CA-CAS') echo 'selected'; ?>> CA - CAS</option>
									<option value="CDC" <?php if($row->college == 'CDC') echo 'selected'; ?>> CDC </option>
									<option value="CEM" <?php if($row->college == 'CEM') echo 'selected'; ?>> CEM </option>
									<option value="CEAT" <?php if($row->college == 'CEAT') echo 'selected'; ?>> CEAT </option>
									<option value="CFNR" <?php if($row->college == 'CFNR') echo 'selected'; ?>> CFNR </option>
									<option value="CHE" <?php if($row->college == 'CHE') echo 'selected'; ?>> CHE </option>
									<option value="CVM" <?php if($row->college == 'CVM') echo 'selected'; ?>> CVM </option>
									<option value="GS" <?php if($row->college == 'GS') echo 'selected'; ?>> GS </option>
								</select>
							</div>
							
						

								<div class="input-group input-group-md" align="right">
	  		   							<span class="input-group-addon">Degree:  </span>
  				  						
								<select name="degree" id="degree" class="form-control20 degreeDropdown">
									<option value="">Select Degree</option>
								</select>
							</div>
							<div class='error_message'><?=form_error('degree')?></div>
						</tr>
						<script type="text/javascript">
			<!--
				$(document).ready(function() {
					var col=$(".collegeDropdown").val();
											 
					function fillDegreeDropdown(colDegOption) {
						$.each(colDegOption, function(val, text) {
							
							if(<?='"'.$row->degree.'"'?> == val){
								$('.degreeDropdown').append($('<option selected></option>').val(val).html(text));
							}
							else{
								$('.degreeDropdown').append($('<option></option>').val(val).html(text));
							}
						});
					}
														
					function clearDegreeDropdown() {
						$('.degreeDropdown option:gt(0)').remove();
					}

					if(col == 'CA') {
						clearDegreeDropdown();
															
						var CaOption={
							BSA:'BS Agriculture',
							BSABT: 'BS Agricultural Biotechnology',
							BSFT: 'BS Food Technology'
						};
					fillDegreeDropdown(CaOption);
					} else if(col == 'CAS'){
						clearDegreeDropdown();
															
						var CasOption={
							BACA:'BA Communication Arts',
							BAS: 'BA Sociology',
							BAP: 'BA Philosophy',
							BSAM: 'BS Applied Mathematics',
							BSAP: 'BS Applied Physics',
							BSB: 'BS Biology',
							BSC: 'BS Chemistry',
							BSCS: 'BS Computer Science',
							BSM: 'BS Mathematics',
							BSMST: 'BS Mathematics and Science Teaching',
							BSS: 'BS Statistics'
						};
					fillDegreeDropdown(CasOption);
					} else if(col == 'CA-CAS'){
						clearDegreeDropdown();
															
						var CaCasOption={
							BSAC: 'BS Agricultural Chemistry'
						};
					fillDegreeDropdown(CaCasOption);
					} else if(col == 'CDC'){
						clearDegreeDropdown();
															
						var CdcOption={
							BSDC: 'BS Development Communication'
						};
					fillDegreeDropdown(CdcOption);
					} else if(col == 'CEAT'){
						clearDegreeDropdown();
															
						var CeatOption={
							BSAeng: 'BS Agricultural and Biosystems Engineering',
							BSChE: 'BS Chemical Engineering',
							BSCE: 'BS Civil Engineering',
							BSEE: 'BS Electrical Engineering',
							BSIE: 'BS Industrial Engineering'
						};
					fillDegreeDropdown(CeatOption);
					} else if(col == 'CEM'){
						clearDegreeDropdown();
															
						var CemOption={
							BSAE: 'BS Agricultural Economics',
							BSABM: 'BS Agribusiness Management',
							BSE: 'BS Economics'
						};
					fillDegreeDropdown(CemOption);
					} else if(col == 'CFNR'){
						clearDegreeDropdown();
															
						var CfnrOption={
							BSF: 'BS Forestry'
						};
					fillDegreeDropdown(CfnrOption);
					} else if(col == 'CHE'){
						clearDegreeDropdown();
															
						var CheOption={
							BSHE: 'BS Human Ecology',
							BSN: 'BS Nutrition'
						};
					fillDegreeDropdown(CheOption);
					} else if(col == 'CVM'){
						clearDegreeDropdown();
															
						var CvmOption={
							DVM: 'Doctor of Veterenary Medicine'
						};
					fillDegreeDropdown(CvmOption);
					} else if(col == 'GS'){
						clearDegreeDropdown();
															
						var GsOption={
							MSAC: 'MS Agricultural Chemistry',
							MSAE: 'MS Agricultural Economics',
							MSAEd: 'MS Agricultural Education',
							MSAg: 'MS Agrometeorology',
							MSAgr: 'MS Agronomy',
							MSAS: 'MS Animal Science',
							MSAN: 'MS Applied Nutrition',
							MSBC: 'MS Biochemistry',
							MSB: 'MS Botany',
							MSCE: 'MS Chemical Engineering',
							MSC: 'MS Chemistry',
							MSCS: 'MS Computer Science',
							MSCo: 'MS Community',
							MSD: 'MS Development',
							MSDC: 'MS Development Communication',
							MSDMG: 'MS Development Management and Governance',
							MSE: 'MS Economics',
							MSEn: 'MS Entomology',
							MSES: 'MS Environmental Science',
							MSExE: 'MS Extension Education',
							MSFRM: 'MS Family Resource Management',
							MSFS: 'MS Food Science',
							MSFBS: 'MS Forestry: Forest Biological Sciences',
							MSFRM: 'MS Forestry: Forest Resources Management',
							MSFSFI: 'MS Forestry: Silviculture and Forest Influences',
							MSFSF: 'MS Forestry: Social Forestry',
							MSGH: 'MS Genetics Horticulture',
							MSM: 'MS Mathematics',
							MSMB: 'MS Microbiology',
							MSMBB: 'MS Molecular Biology and Biotechnology',
							MSNRC: 'MS Natural Resources Conservation',
							MSPB: 'MS Plant Breeding',
							MSPGRC: 'MS Plant Genetics Resources Conservation and Management',
							MSPP: 'MS Plant Pathology',
							MSRS: 'MS Rural Sociology',
							MSSS: 'MS Social Science',
							MSS: 'MS Statistics',
							MSVM: 'MS Veterenary Medicine',
							MSWS: 'MS Wildlife Studies',
							MSZ: 'MS Zoology',
							MF: 'Master of Forestry',
							MIT: 'Master of Information Technology',
							MACA: 'MA Communication Arts',
							MAS: 'MA Sociology',
							MAg: 'Master of Agriculture',
							MMAbm: 'Master of Management - Agribusiness Management and Entrepreneurship',
							MMBM: 'Master of Management - Business Management',
							MMCM: 'Master of Management - Cooperative Management',
							PAC: 'PhD Agricultural Chemistry',
							PAE: 'PhD Agricultural Economics',
							PAEd: 'PhD Agricultural Education',
							PAEng: 'PhD Agricultural Engineering',
							PAgr: 'PhD Agronomy',
							PAS: 'PhD Animal Science',
							PBC: 'PhD Biochemistry',
							PSB: 'PhD Botany',
							PCS: 'PhD Computer Science',
							PCD: 'PhD Community Development',
							PDC: 'PhD Development Communication',
							PDS: 'PhD Development Studies',
							PEn: 'PhD Entomology',
							PES: 'PhD Environmental Science',
							PExE: 'PhD Extension Education',
							PFS: 'PhD Food Science',
							PFBS: 'PhD Forestry: Forest Biological Sciences',
							PFRM: 'PhD Forestry: Forest Resources Management',
							PFSFI: 'PhD Forestry: Silviculture and Forest Influences',
							PSFWT: 'PhD Forestry: Wood Science and Technology',
							PGH: 'PhD Genetics Horticulture',
							PHN: 'PhD Human Nutrition',
							PMB: 'PhD Microbiology',
							PMBB: 'PhD Molecular Biology and Biotechnology',
							PPB: 'PhD Plant Breeding',
							PPP: 'PhD Plant Pathology',
							PSS: 'PhD Social Science',
							PSS: 'PhD Statistics',
						};
					fillDegreeDropdown(GsOption);
					}
				});
			-->


			$(".collegeDropdown").change(function() {
					var col=$(this).val();
											 
					function fillDegreeDropdown(colDegOption) {
						$.each(colDegOption, function(val, text) {
							
								$('.degreeDropdown').append($('<option></option>').val(val).html(text));
							
						});
					}
														
					function clearDegreeDropdown() {
						$('.degreeDropdown option:gt(0)').remove();
					}

					if(col == 'CA') {
						clearDegreeDropdown();
															
						var CaOption={
							BSA:'BS Agriculture',
							BSABT: 'BS Agricultural Biotechnology',
							BSFT: 'BS Food Technology'
						};
					fillDegreeDropdown(CaOption);
					} else if(col == 'CAS'){
						clearDegreeDropdown();
															
						var CasOption={
							BACA:'BA Communication Arts',
							BAS: 'BA Sociology',
							BAP: 'BA Philosophy',
							BSAM: 'BS Applied Mathematics',
							BSAP: 'BS Applied Physics',
							BSB: 'BS Biology',
							BSC: 'BS Chemistry',
							BSCS: 'BS Computer Science',
							BSM: 'BS Mathematics',
							BSMST: 'BS Mathematics and Science Teaching',
							BSS: 'BS Statistics'
						};
					fillDegreeDropdown(CasOption);
					} else if(col == 'CA-CAS'){
						clearDegreeDropdown();
															
						var CaCasOption={
							BSAC: 'BS Agricultural Chemistry'
						};
					fillDegreeDropdown(CaCasOption);
					} else if(col == 'CDC'){
						clearDegreeDropdown();
															
						var CdcOption={
							BSDC: 'BS Development Communication'
						};
					fillDegreeDropdown(CdcOption);
					} else if(col == 'CEAT'){
						clearDegreeDropdown();
															
						var CeatOption={
							BSAeng: 'BS Agricultural and Biosystems Engineering',
							BSChE: 'BS Chemical Engineering',
							BSCE: 'BS Civil Engineering',
							BSEE: 'BS Electrical Engineering',
							BSIE: 'BS Industrial Engineering'
						};
					fillDegreeDropdown(CeatOption);
					} else if(col == 'CEM'){
						clearDegreeDropdown();
															
						var CemOption={
							BSAE: 'BS Agricultural Economics',
							BSABM: 'BS Agribusiness Management',
							BSE: 'BS Economics'
						};
					fillDegreeDropdown(CemOption);
					} else if(col == 'CFNR'){
						clearDegreeDropdown();
															
						var CfnrOption={
							BSF: 'BS Forestry'
						};
					fillDegreeDropdown(CfnrOption);
					} else if(col == 'CHE'){
						clearDegreeDropdown();
															
						var CheOption={
							BSHE: 'BS Human Ecology',
							BSN: 'BS Nutrition'
						};
					fillDegreeDropdown(CheOption);
					} else if(col == 'CVM'){
						clearDegreeDropdown();
															
						var CvmOption={
							DVM: 'Doctor of Veterenary Medicine'
						};
					fillDegreeDropdown(CvmOption);
					} else if(col == 'GS'){
						clearDegreeDropdown();
															
						var GsOption={
							MSAC: 'MS Agricultural Chemistry',
							MSAE: 'MS Agricultural Economics',
							MSAEd: 'MS Agricultural Education',
							MSAg: 'MS Agrometeorology',
							MSAgr: 'MS Agronomy',
							MSAS: 'MS Animal Science',
							MSAN: 'MS Applied Nutrition',
							MSBC: 'MS Biochemistry',
							MSB: 'MS Botany',
							MSCE: 'MS Chemical Engineering',
							MSC: 'MS Chemistry',
							MSCS: 'MS Computer Science',
							MSCo: 'MS Community',
							MSD: 'MS Development',
							MSDC: 'MS Development Communication',
							MSDMG: 'MS Development Management and Governance',
							MSE: 'MS Economics',
							MSEn: 'MS Entomology',
							MSES: 'MS Environmental Science',
							MSExE: 'MS Extension Education',
							MSFRM: 'MS Family Resource Management',
							MSFS: 'MS Food Science',
							MSFBS: 'MS Forestry: Forest Biological Sciences',
							MSFRM: 'MS Forestry: Forest Resources Management',
							MSFSFI: 'MS Forestry: Silviculture and Forest Influences',
							MSFSF: 'MS Forestry: Social Forestry',
							MSGH: 'MS Genetics Horticulture',
							MSM: 'MS Mathematics',
							MSMB: 'MS Microbiology',
							MSMBB: 'MS Molecular Biology and Biotechnology',
							MSNRC: 'MS Natural Resources Conservation',
							MSPB: 'MS Plant Breeding',
							MSPGRC: 'MS Plant Genetics Resources Conservation and Management',
							MSPP: 'MS Plant Pathology',
							MSRS: 'MS Rural Sociology',
							MSSS: 'MS Social Science',
							MSS: 'MS Statistics',
							MSVM: 'MS Veterenary Medicine',
							MSWS: 'MS Wildlife Studies',
							MSZ: 'MS Zoology',
							MF: 'Master of Forestry',
							MIT: 'Master of Information Technology',
							MACA: 'MA Communication Arts',
							MAS: 'MA Sociology',
							MAg: 'Master of Agriculture',
							MMAbm: 'Master of Management - Agribusiness Management and Entrepreneurship',
							MMBM: 'Master of Management - Business Management',
							MMCM: 'Master of Management - Cooperative Management',
							PAC: 'PhD Agricultural Chemistry',
							PAE: 'PhD Agricultural Economics',
							PAEd: 'PhD Agricultural Education',
							PAEng: 'PhD Agricultural Engineering',
							PAgr: 'PhD Agronomy',
							PAS: 'PhD Animal Science',
							PBC: 'PhD Biochemistry',
							PSB: 'PhD Botany',
							PCS: 'PhD Computer Science',
							PCD: 'PhD Community Development',
							PDC: 'PhD Development Communication',
							PDS: 'PhD Development Studies',
							PEn: 'PhD Entomology',
							PES: 'PhD Environmental Science',
							PExE: 'PhD Extension Education',
							PFS: 'PhD Food Science',
							PFBS: 'PhD Forestry: Forest Biological Sciences',
							PFRM: 'PhD Forestry: Forest Resources Management',
							PFSFI: 'PhD Forestry: Silviculture and Forest Influences',
							PSFWT: 'PhD Forestry: Wood Science and Technology',
							PGH: 'PhD Genetics Horticulture',
							PHN: 'PhD Human Nutrition',
							PMB: 'PhD Microbiology',
							PMBB: 'PhD Molecular Biology and Biotechnology',
							PPB: 'PhD Plant Breeding',
							PPP: 'PhD Plant Pathology',
							PSS: 'PhD Social Science',
							PSS: 'PhD Statistics',
						};
					fillDegreeDropdown(GsOption);
					}
				});






			</script>
					<?php } ?>
							
			<button type="submit"  id="submitref" value= "submit" class="btn btn-success" >Save Changes</button>
			</form>
			<a href="<?=base_url('index.php/administrator')?>"><button class="btn btn-danger" id="back_button2">Back</button></a>
		</div>
		<?=$this->load->view('includes/footer')?>