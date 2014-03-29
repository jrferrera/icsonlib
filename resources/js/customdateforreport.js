$(document).ready(function(){
	window.onload = function(){
		if(typeof reportgen !== 'undefined')
		reportgen.onsubmit = validateForm;

		$("#customdate").hide();

	}

	$(".report").change(function(){
		var type = $(this).val();

		if(type == "custom"){
			$("#customdate").show();
		}else{
			$("#customdate").hide();
		}
	});

	function validateForm(){
		var type = $("#day1").val();
		Console.log(type);
		if(type != "custom"){
			alert(type);
		}
	}
});