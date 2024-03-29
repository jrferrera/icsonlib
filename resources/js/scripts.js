		/*
			The following codes are javascript validations
		*/

		/* Title : 
		 *	Required field
		 *	Any characters(symbols & alphanumeric characters)
		 *  Must have at least one Alphanumeric characters	
		 */
		function validate_title(){
				var title = edit_form.title.value;
				var error = "";

				if(title==""){ 
					error = "Title is required";
					alert(error);
					document.getElementById('title').focus(); 
				}else if(!title.match(/^.*[A-Za-z0-9]{1,}.*$/)){ 
					error = "Must have atleast one alphanumeric character.";
					alert(error); 
					document.getElementById('title').focus();
				}

				if(error=="") return true;
		}

		/* Author : 
		 *	Required field
		 *	Alphabets, spaces, periods, and commas only
		 * 	Must start with an alphabet	
		 */


		function validate_author(){
				var author = edit_form.author.value;
				var error = "";

				if(author==""){ 
					error = "Author is required";
					alert(error);
					document.getElementById('author').focus(); 
				}else if(!author.match(/^[a-zA-Z\ ][a-zA-Z\ \.\,]*$/)){ 
					error = "Alphabet, periods and commas only. Must start with an alphabet.";
					alert(error); 
					document.getElementById('author').focus();
				}
				if(error=="") return true;
		}


		/* ISBN : 
		 *	Numbers and hypens only
		 *  Must start and end with a number
		 *  Length must be 13 characters	
		 */

		function validate_isbn(){
				var isbn = edit_form.isbn.value;
				var error = "";

				if(isbn==""){ 
					return true;
				}else if(!isbn.match(/^[0-9][0-9\-]{11}[0-9]$/)){ 
					error = "Numbers and hypens only. Must start and end with a number. Length must be 13 characters.";
					alert(error); 
					document.getElementById('isbn').focus();
				}
				if(error=="") return true;
		}

		/* Publisher : 
		 *	Any characters(symbols & alphanumeric characters)
		 *  Must have at least one Alphanumeric characters	
		 */

		function validate_publisher(){
				var publisher = edit_form.publisher.value;
				var error = "";

				if(publisher==""){ 
					return true;
				}else if(!publisher.match(/^.*[A-Za-z0-9]{1,}.*$/)){ 
					error = "Must have atleast one alphanumeric character.";
					alert(error); 
					document.getElementById('publisher').focus();
				}

				if(error=="") return true;
		}

		/* Publication year : 
		 *	Numbers only
		 *  Year format : xxxx
		 *  Length: 4	
		 */

		function validate_publication_year(){
				var publication_year = edit_form.publication_year.value;
				var error = "";

				if(publication_year==""){
					return true;
				}else if(!publication_year.match(/^[0-9][0-9][0-9][0-9]$/)){ 
					error = "Four numbers only. Year Format: xxxx";
					alert(error); 
					document.getElementById('publication_year').focus();
				}

				if(error=="") return true;
		}

		/* Course code : 
		 *	Required field
		 *	Uppercase letters and numbers only
		 *  Max length: 6
		 */
		function validate_course_code(){
				var course_code = edit_form.course_code.value;
				var error = "";

				if(course_code==""){ 
					error = "Course code is required";
					alert(error);
					document.getElementById('course_code').focus(); 
				}else if(!course_code.match(/^[A-Z][A-Z0-9]{0,4}[0-9]$/)){ 
					error = "Uppercase letters and numbers only. Max length is six characters.";
					alert(error); 
					document.getElementById('course_code').focus();
				}

				if(error=="") return true;
		}

		/* Description : 
		 *	Any characters(symbols & alphanumeric characters)
		 *  Must have at least one Alphanumeric characters	
		 */


		function validate_description(){
				var description = edit_form.description.value;
				var error = "";

				if(description==""){
					return true; 
				}else if(!description.match(/^.*[A-Za-z0-9]{1,}.*$/)){ 
					error = "Must have atleast one alphanumeric character.";
					alert(error); 
					document.getElementById('description').focus();
				}
				if(error=="") return true;
		}

		/* Total stock : 
		 *	Must be greater or equal to total available	
		 */

		function validate_total_stock(){
				var total_stock = document.getElementById('total_stock');
				var error = "";
				var total_available = document.getElementById('total_available');

				if(parseInt(total_stock.value) < parseInt(total_available.value)){
					error = "Total stock can't be less than the total available.";
					alert(error);
					total_stock.value = parseInt(total_stock.value) + 1;
				}else{
					return true;
				}

		}
		
				/*
	Changelog for toggle()
	1/28
	-Parameter for toggle() is the source, which gets which checkbox to base the action from.
	-Gets the array of checkboxes (named users[]) and traverses through all of the checkboxes.
	-Sets the state of the current users[] checkbox to the state of the source checkbox (Select/Deselect All).
*/
function toggle(source){
	checkboxes = document.getElementsByName('users[]');
	for(var i=0, n=checkboxes.length; i<n; i++){
		if(!checkboxes[i].disabled){
			checkboxes[i].checked = source.checked;
		}		
	}
}

/*
	Changelog for deleteValidate()
	1/28
	-Creates a prompt popup to confirm user of deletion. If TRUE, creates another confirmation. Else if FALSE, cancel action.
	-If TRUE on the second popup, continue to controller, then to model, then delete from database. Else if FALSE, cancel action.
*/
function deleteValidate(){

	var test = false;

	checkboxes = document.getElementsByName('users[]');
	for(var i=0, n=checkboxes.length; i<n; i++){
		if(!checkboxes[i].disabled && checkboxes[i].checked){
			var test = true;
			break;
		}		
	}

	if(test){
		var deletePromptOne = confirm("Are you sure you want to delete? Process cannot be reversed after action has been done.");
		
		if(deletePromptOne){
			var deletePromptTwo = confirm("Are you REALLY sure you want to delete? Say bye to data after this?");

			if(deletePromptTwo){
				return deletePromptTwo;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
}

//Confirm to Delete the selected books
function confirmDelete(){
	var noOfBooksToDelete = $('input[name = "ch[]"]:checked').length;
	alert(noOfBooksToDelete);
	if(noOfBooksToDelete > 0){
		var option = confirm("Are you Sure?");
		if(option == true){		
			alert(noOfBooksToDelete + " Book" + ((noOfBooksToDelete > 1) ? 's' : '') + " Selected.");
		}else{
			return false;
		}
	}else{
		alert("No books selected.");
		return false;
		}
	
}

/*
//Confirm To Delete Ready for Deletion Books
function confirmDeleteReady(){
	var noOfBooksToDelete = $('#readytodeletetable').find("input:checkbox:checked").length;
	if(noOfBooksToDelete > 0){
		var option= confirm("Are you Sure?");
		if(option==true){		
			alert(noOfBooksToDelete+" Book"+((noOfBooksToDelete>1)?'s':'')+" Selected.");
		}else{
			return false;
		}
	}else{
		alert("No books selected.");
		return false;
		}
	}
*/
//Confirm to change the ForDeletion 
function confirmChangeForDeletion(){
	var noOfBooksToDelete = $('#booktable').find("input:checkbox:checked").length;
	if(noOfBooksToDelete > 0){
		var option = confirm("Are you Sure?");
		if(option == true){		 
			alert(noOfBooksToDelete + " Book" + ((noOfBooksToDelete > 1) ? 's' : '') + " Selected.");
		}else{
			return false;
		}
	}else{
		alert("No books selected.");
		}
	}
	
//Mark All checkboxes when choosing
$('#markAll').click(function (){
	var buttonValue = $('#markAll').val();
	if(buttonValue === 'unmarked'){
		$('input[name="ch[]"]').each(function(){
			$(this).prop('checked', true);
		});
		$('#markAll').val('marked');
	}
	else if(buttonValue === 'marked'){
		$('input[name="ch[]"]').each(function(){
			$(this).prop('checked', false);
		});
		$('#markAll').val('unmarked');
	}
});


$('#markAlla').click(function (){
	var buttonText = $('#markAlla').text();
	if(buttonText === 'Mark All'){
		$('#readytodeletetable').find('input[name="chch[]"]').each(function(){
			$(this).prop('checked', true);
		});
		$('#markAlla').text('UnMark All');
	}
	else if(buttonText === 'UnMark All'){
		$('#readytodeletetable').find('input[name="chch[]"]').each(function(){
			$(this).prop('checked', false);
		});
		$('#markAlla').text('Mark All');
	}
});
		



/*function editPassword(){

	var old_password_prompt=prompt("Enter current password");

	if(old_password_prompt!=null){
		var old_password_prompt = CryptoJS.MD5(old_password_prompt).toString();
		var old_password=document.getElementById("old_password").value;

		if (old_password==old_password_prompt){
			var new_password_prompt=prompt("Enter new password");

			if(new_password_prompt!=null){
				for(var i=0;i<3;i++){
					var confirm_password_prompt=prompt("Confirm new password");

					if(confirm_password_prompt!=null){
						if(new_password_prompt==confirm_password_prompt){
							alert("Password change successful!");
							document.getElementById("password").value=new_password_prompt;
							return true;
							break;
						}
						else if(i==2){
							alert("Password did not match 3 times. Try again later.");
							return false;
						}
					}
					else{
						return false;
					}
				}
			}
			else{
				return false;
			}

		}
		else{
			alert("Current password and entered password do not match.");
			return false;
		}
	}
	else{
		return false;
	}
}*/

