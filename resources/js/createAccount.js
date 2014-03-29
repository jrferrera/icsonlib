$(document).ready(function(){

/*
* Hide unnecessary inputs upon onload
*/
window.onload = function(){
	createForm.first_name.onblur = validateFName;
	createForm.middle_name.onblur = validateMName;
	createForm.last_name.onblur = validateLName;
	createForm.username.onblur = validateUName;
	createForm.password.onchange = validatePassword;
	createForm.repass.onchange = validateRePass;
	createForm.contact_number.onblur = validateCNumber;
	createForm.email_address.onblur = validateEmail;
	createForm.college_address.onblur = validateCollegeAddress;
	createForm.student_number.onblur = validateStudentNumber;
	createForm.employee_number.onblur = validateEmployeeNumber;
					
	$("#student_number").hide();
	$(".collegeSet").hide();
	$(".degreeSet").hide();
	$("#enum").hide();
	$("#employee_number").hide();
}

function validateFName(){
	str = createForm.first_name.value;
	hint = ""

	//if (str=="") hint+="This field is required. ";
	if (!str.match(/^([A-Za-z]+[ ]{0,1}[A-Za-z]+)+$/)) hint+="Must be 2-32 characters.";
	if(hint=="Hint:") hint="";
		document.getElementsByName("helpname1")[0].innerHTML=hint;
	if(hint=="")return true;
}

function validateMName(){
	str = createForm.middle_name.value;
	hint = ""

	if (str == "") hint+="";
	if (!str.match(/^([A-Za-z ]){0,32}$/) && str != "") hint+="Special characters not allowed.";
	if(hint=="Hint:") hint="";
		document.getElementsByName("helpname2")[0].innerHTML=hint;
	if(hint=="")return true;
}

function validateLName(){
	str = createForm.last_name.value;
	hint = ""

	//if (str=="") hint+="This field is required. ";
	if (!str.match(/^([A-Za-z\s])+[- ]{0,1}([A-Za-z\s])+$/)) hint+="Must be 2-32 characters.";
	if(hint=="Hint:") hint="";
		document.getElementsByName("helpname3")[0].innerHTML=hint;
	if(hint=="")return true;
}

function validateUName(){
	str = createForm.username.value;
	hint = ""

	//if (str=="") hint+="This field is required. ";
	if (!str.match(/^[A-Za-z]+[A-Za-z0-9]+[_|\.]{0,1}[A-Za-z0-9]+$/)) hint+="Must be 6-30 characters. Use letters, numbers, underscore and period only.";
	if(hint=="Hint:") hint="";
		document.getElementsByName("helpname4")[0].innerHTML=hint;
	if(hint=="")return true;
}

function validateCNumber(){
	str = createForm.contact_number.value;
	hint = ""

	//if (str=="") hint+="This field is required. ";
	if (!str.match(/[+]{0,1}[(]{0,1}[0-9]+[)]{0,1} {0,1}[-]{0,1}[0-9]+[-]{0,1}[0-9]+/)) hint+="Mobile or telephone numbers are allowed";
	if(hint=="Hint:") hint="";
		document.getElementsByName("helpname5")[0].innerHTML=hint;
	if(hint=="")return true;
}	

function validateEmail(){
	str = createForm.email_address.value;
	hint = ""

	//if (str=="") hint+="This field is required. ";
	if (!str.match(/^([a-zA-Z\+]+)([\.\_\-]{0,1}[a-zA-Z0-9\+]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/)) hint+="Must follow the standard email format (username, @, domain name, top-level domain name).";
	if(hint=="Hint:") hint="";
		document.getElementsByName("helpname6")[0].innerHTML=hint;
	if(hint=="")return true;
}

function validateCollegeAddress(){
	str = createForm.college_address.value;
	hint = ""

	//if (str=="") hint+="This field is required. ";
	if (!str.match(/^([A-Za-z0-9\.\\,\/'#-]+[ ]{0,1})+$/)) hint+="Must be 19-200 characters.";
	if(hint=="Hint:") hint="";
		document.getElementsByName("helpname7")[0].innerHTML=hint;
	if(hint=="")return true;
}

function validateStudentNumber(){
	str = createForm.student_number.value;
	hint = ""

	//if (str=="") hint+="This field is required. ";
	if (!str.match(/^[0-9]{4}-[0-9]{5}$/)) hint+="Must follow the correct student number format (YYYY-NNNNN).";
	if(hint=="Hint:") hint="";
		document.getElementsByName("helpname8")[0].innerHTML=hint;
	if(hint=="")return true;
}

function validateEmployeeNumber(){
	str = createForm.employee_number.value;
	hint = ""

	//if (str=="") hint+="This field is required. ";
	if (!str.match(/^[0-9]{9}/)) hint+="Must be 9 integers only. Spaces are not allowed.";
	if(hint=="Hint:") hint="";
		document.getElementsByName("helpname9")[0].innerHTML=hint;
	if(hint=="")return true;
}
/*
* For validation of Password
*/		
function validatePassword(){
	msg = "";
	str = createForm.password.value;

	$('#helppass').css('color','#FF6600');
				
	if(str == "") msg+="  Please input a valid password ";
	if(str.match(/^[a-z]{6,32}$/)) msg="  Strength: Weak";
	else if(str.match(/^[0-9]{6,32}$/)) msg="  Strength: Weak";
	else if(str.match(/^[a-z0-9]{6,32}$/)){
		msg="  Strength: Medium";
		$('#helppass').css('color','#7BB31A');		
	}
	else if(str.match(/^([\&quot;!@#$%^&*()+=\-\[\]\';,.\/{}|:<>?~\\\\A-Za-z0-9_\.])+$/)){
		msg="  Strength: Strong";
		$('#helppass').css('color','green');
	}
				
	if(msg == "") msg="";
		$("#helppass")[0].innerHTML=msg;	
				
}

/*
* For re-validation of Password
*/			
function validateRePass(){
	msg = "";
	str = createForm.repass.value;

	$('#helprepass').css('color','#FF6600');
				
	if(str != ""){
		if(str != createForm.password.value) msg+="  Password does not match. ";
		else{
			msg="  Passwords match";
			$('#helprepass').css('color','green');
		}
	}
				
	if(msg == "") msg="";
		$("#helprepass")[0].innerHTML=msg;
				if(msg == "") return true;	

				
}

function adminConfirm(){
	msg = "";
	str = adminCreate.confirm_password.value;

	if(str != ""){
		if(str != adminCreate.password.value) msg+="  Password does not match. ";
		else{
			msg="  Passwords match";
		}
	}
				
	if(msg == "") msg="";
		if(msg == "") return true;	

				
}		

/*
* Show necessary inputs based from user type
*/
$(".typeDropdown").change(function() {
	var type=$(this).val();
	if(type == 'S'){
		$("#student_number").show();
		$(".degreeSet").show();
		$(".collegeSet").show();
		$("#enum").hide();
		$("#employee_number").hide();
	} else if(type == 'F'){
		$("#student_number").hide();
		$(".degreeSet").hide();
		$(".collegeSet").hide();
		$("#enum").show();
		$("#employee_number").show();
	} else {
		$("#student_number").hide();
		$(".degreeSet").hide();
		$(".collegeSet").hide();
		$("#enum").hide();
		$("#employee_number").show();
	}
});


/*
* Show necessary inputs on degree program based from college
*/
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


});
