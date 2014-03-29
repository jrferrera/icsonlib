<?php
	if($this->session->userdata('registrationError')){
		echo '<script> bootbox.alert("<center>Registration Failed.<br/>Click create account button to view the errors.</center>"); </script>';
		$this->session->unset_userdata('registrationError');
	}
?>
<div class="modal fade bs-modal-lg" tabindex="-1" id="createAccount" tabindex="-1" role="dialog" aria-labelledby="createAccountLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg"> 
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	         <center> <h3 class="modal-title"><b>Create Account</b></h3></center>
	        </div>
	        <div class="modal-body">
	          <form method="post" action="<?=base_url('index.php/register/create_account')?>" role="form" accept-charset="utf-8" name="createForm"> <!-- FORM -->
	          	<!--div class="form-group"-->
	          		
					<table class="form-group table">

						
						<tr>
							<td align="right" class="col-md-4"><label> First Name:</label> </td>
							<td><input type="text" class="form-control" id="first_name" name = "first_name" title="Must be 2-32 characters." maxlength="32" pattern = "^([A-Za-z0-9]+[ ]{0,1}[A-Za-z0-9]+)+$" placeholder="First Name" onblur="" value="<?=set_value('first_name')?>" required/><span name="helpname1"></span></td>
							
						</tr>
						<tr>
							<td align="right"><div class='error_message'><?=form_error('first_name')?></td></div>
						</tr>	
						<tr>
							<td align="right" class="col-md-4"><label> Middle Name:</label> </td>
							<td><input type="text" class="form-control" id="middle_name" name = "middle_name" title="Must be at most 32 characters." maxlength="32" pattern = "^[A-Za-z ]{0,32}$" placeholder="Middle Name" onblur="" value="<?=set_value('middle_name')?>"/><span name="helpname2"></span></td>
								
						</tr>	
							<tr>
							<td align="right"><div class='error_message'><?=form_error('middle_name')?></td></div>
						</tr>
						<tr>
							<td align="right" class="col-md-4"><label> Last Name:</label> </td>
							<td><input type="text" class="form-control" id="last_name" name = "last_name" title="Must be 2-32 characters." maxlength="32" pattern = "^([A-Za-z\s])+[-]{0,1}+([A-Za-z\s])+$" placeholder="Last Name" onblur="" value="<?=set_value('last_name')?>" required/><span name="helpname3"></span> </td>
							
						</tr>	
						<tr>
							<td align="right"><div class='error_message'><?=form_error('last_name')?></td></div>
						</tr>
						<tr>
							<td align="right" class="col-md-4"><label> Username</label> </td>
							<td><input type="text" class="form-control col-md-6" id="username" name = "username" title="Must be 6-30 characters. Use letters, numbers, underscore and period only." maxlength="30" pattern = "^[A-Za-z]+[A-Za-z0-9]+[_|\.]{0,1}[A-Za-z0-9]+$" value="<?=set_value('username')?>" required/><span name="helpname4"></span></td>
							
						</tr>
						<tr>
								<td align="right"><div class='error_message'><?=form_error('username')?></div></td>

						</tr>						
						<tr>
							<td align="right" class="col-md-4"><label> Password</label> </td>
							<td><input type="password" class="form-control" id="password" maxlength="32" title="Must be 6-32 characters and must not contain space." name="password" pattern="^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$" value="<?=set_value('password')?>" required/>
							<span name="helppass" id="helppass"></span></td>
						</tr>
						<tr>

							<td align="right"><div class='error_message'><?=form_error('password')?></div></td>
						</tr>						
						<tr>
							<td align="right" class="col-md-4"><label> Re-type Password</label> </td>
							<td><input type="password" class="form-control" id="repass" min="6" max="32" title="Must be 6-32 characters and must not contain space."  name = "repass" pattern="^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$" value="<?=set_value('repass')?>" required/>
							<span name="helprepass" id="helprepass"></span></br></td>
							
						</tr>

						<tr>
							<td align="right">

								<div class='error_message'><?=form_error('repass')?></div>
							</td>

						</tr>
						<tr>
							<td align="right" class="col-md-4"><label> Contact Number</label> </td>
							<td><input type="text" class="form-control" id="contact" name = "contact_number" title='Must be 7-15 characters. Must be a mobile or landline number.' maxlength="15" pattern = "[+]{0,1}[(]{0,1}[0-9]+[)]{0,1} {0,1}[-]{0,1}[0-9]+[-]{0,1}[0-9]+" placeholder="09XXXXXXXXX" title='Must be 7-15 characters. Must be a mobile or landline number.' value="<?=set_value('contact_number')?>" required/><span name="helpname5"></span></td>
							
						</tr>
						<tr align="right">
							<div class='error_message'><?=form_error('contact_number')?></div>
						</tr>
						<tr>
							<td align="right" class="col-md-4"><label> E-mail Address</label> </td>
							<td><input type="email" class="form-control" id="email_address" name = "email_address" title="Must follow the standard email format (username, @, domain name, top-level domain name)" pattern = "^([a-zA-Z\+]+)([\.\_\-]{0,1}[a-zA-Z0-9\+]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$" maxlength="60" placeholder="username@email.com" value="<?=set_value('email_address')?>" required/><span name="helpname6"></span></td>
							
						</tr>
						<tr align="right">

							<td><div class='error_message'><?=form_error('email_address')?></div></td>
						</tr>
						<tr>
							<td align="right" class="col-md-4"><label> College Address</label> </td>
							<td><textarea class="form-control" id="college_address" name = "college_address" title="Must be 19-200 characters." maxlength="200" pattern="^([A-Za-z0-9\.\\,\/'#-]+[ ]{0,1})+$" required></textarea><span name="helpname7"></span></td>
							
						</tr>

						<tr>
							<td align="right">

								<div class='error_message'><?=form_error('college_address')?></div>
							</td>
						</tr>
						<tr>
							<td align="right" class="col-md-4"></br>
								<select name="user_type" class="form-control typeDropdown">
									<option value="">Select User Type</option>
									<option value="S"> Student </option>
									<option value="F"> Faculty </option>
								</select> 
							</td>
						</tr>
						<tr>
							<td align="right"><div class='error_message'><?=form_error('user_type')?></div></td>
						</tr>
			<script type="text/javascript">
				$(".typeDropdown").change(function() {
					var type=$(this).val();
					if(type == 'S'){
						$("#stdno").show();
						$("#student_number").show();
						$("#degree").show();
						$("#college").show();
						$("#degreeDropdown").show();
						$("#collegeDropdown").show();
						
						$("#enum").hide();
						$("#employee_number").hide();
						
						$("#student_number").removeAttr("disabled");
					} else if(type == 'F'){
						$("#employee_number").attr("disabled", "disabled");
						$("#student_number").attr("disabled", "disabled");
						
						$("#stdno").hide();
						$("#degree").hide();
						$("#college").hide();
						$("#student_number").hide();
						$("#degreeDropdown").hide();
						$("#collegeDropdown").hide();
						
						$("#enum").show();
						$("#employee_number").show();
						
						$("#employee_number").removeAttr("disabled");
					} else {
						$("#employee_number").attr("disabled", "disabled");
						$("#student_number").attr("disabled", "disabled");
						
						$("#enum").show();
						$("#employee_number").show();
						$("#employee_number").removeAttr("disabled");
					}
				});
			</script>

						<tr id="student_number">
							<td align="right" class="col-md-4"><label> Student No.</label> </td>
							<td><input type="text" class="form-control"  id="student_number" title="Must follow the correct student number format (YYYY-NNNNN)." maxlength="10" name="student_number" pattern = "^[0-9]{4}-[0-9]{5}$" value="<?=set_value('student_number')?>"/><span name="helpname8"></span></br></td>
							<div class='error_message'><?=form_error('student_number')?></div>
						</tr>
						<tr id="employee_number">
							<td align="right" class="col-md-4"><label> Employee No.</label> </td>
							<td><input type="text" class="form-control" name="employee_number" title="Must be 9 digits." maxlength="9" pattern="^[0-9]+$" value="<?=set_value('employee_number')?>"/><span name="helpname9"></span></td>
							<div class='error_message'><?=form_error('employee_number')?></div>
						</tr>
						<tr class="collegeSet">
							<td align="right" class="col-md-4"><label>College</label> </td>
							<td>
								<select name="college" class="form-control collegeDropdown">
									<option value="">Select College</option>
									<option value="CA"> CA </option>
									<option value="CAS"> CAS </option>
									<option value="CA-CAS"> CA - CAS</option>
									<option value="CDC"> CDC </option>
									<option value="CEM"> CEM </option>
									<option value="CEAT"> CEAT </option>
									<option value="CFNR"> CFNR </option>
									<option value="CHE"> CHE </option>
									<option value="CVM"> CVM </option>
									<option value="GS"> GS </option>
								</select>
							</td>
							<div class='error_message'><?=form_error('college')?></div>
						</tr>
						<tr class="degreeSet">
							<td align="right" class="col-md-4"><label>Degree</label> </td>
							<td>
								<select name="degree" class="form-control degreeDropdown">
									<option value="">Select Degree</option>
								</select>
							</td>
							<div class='error_message'><?=form_error('degree')?></div>
						</tr>

						<script type="text/javascript">
			<!--
				$("#collegeDropdown").change(function() {
					var col=$(this).val();
											 
					function fillDegreeDropdown(colDegOption) {
						$.each(colDegOption, function(val, text) {
							$('#degreeDropdown').append($('<option></option>').val(val).html(text));
						});
					}
														
					function clearDegreeDropdown() {
						$('#degreeDropdown option:gt(0)').remove();
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
			</script>
					</table>
			
				   <!--/div-->				
			   
	        </div>
		        <div class="modal-footer">
		          <input class="btn btn-primary" type="submit" name="submit" value="Register"/>
		        </div>
	        </form> <!-- END OF FORM -->
	      </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	  </div><!-- /.modal -->
		  