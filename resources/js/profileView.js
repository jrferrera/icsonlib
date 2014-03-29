$(document).ready(function(){

	window.onload = function(){
		profileForm.password.onblur = validatePassword2;
		profileForm.repassword.onblur = validateRePass2;
	}
		
	/*
	* For validation of Password
	*/		
	function validatePassword2(){
		msg = "";
		str = profileForm.password.value;

		$('#helppass').css('color','#FF6600');
					
		if(str == "") msg+="  Please input a valid password ";
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
});