<?php $this->load->view("includes/header")?>
<?=$this->load->view("includes/createaccount")?>

	<br/>
	<div class="faq-container">
		<hgroup>
			<h1>Frequently Asked Questions: </h1>
			<div id="faq-border">
			</div>

		</hgroup>

		
		<br/>
		<section>
			<header class="quest">1. What does this system plan to achieve?</header>
			<p class="ans">The ICS OnLib aims to virtualize the ICS Library by incorporating it to the internet, allowing some services, such as searching and reserving a reference, remotely available through internet access..
            It also aims to ease the inventory system of all the references within the library, allowing the librarian to focus on other tasks rather than keeping an inventory of all the reference manually when requested.</p>

            <header class="quest">2. Why is it that the system says something that I cannot reserve a reference? I am a student of the university and already created an account.</header>
			<p class="ans">The system won’t allow you to reserve because of the following reasons:
			You are not allow to reserve that particular reference. Some references can only be reserved by a faculty, and as a student, that reference is off limits. It was implemented that way because some references are being used by the faculty for their research or as basis of their lecture which is utmost priority.
			All the copies of that reference has already been reserved. In this case, the system prompts you if you would like to waitlist for that reference.
			The reference will be removed soon. There are cases that a reference will be pulled out of the library. As such, that reference is put under to be removed status and until all borrowers had returned their copy of the reference, it will still be displayed in the system but cannot be reserved or waitlisted. As soon as the last copy has been returned, the reference will not be shown in the system.
			You have already reserved the reference. Kindly check your profile for the list of references that you have already reserved or waitlisted.
			You have reached the limit of reserving a reference. The limit is 3 for each account.</p>

			<header class="quest">3. I forgot my username and/or my password. What should I do?</header>
			<p class="ans">In regards to accounts, you can directly approach the administrator of the system and request to let him/her show you your username/password. Please provide some sort of validation, the recent form 5 or a validated ID would be enough.</p>

			<header class="quest">4. Where can I find the search button?</header>
			<p class="ans">The search button is located at the upper right of your screen.</p>

			<header class="quest">5. Why is it that the create account button do not work?</header>
			<p class="ans">The developers had tested the system thoroughly and was certain that it worked without fail. Some functions only work when JavaScript is enabled. Kindly check if JavaScript is enabled in your browser. If problems exists, we would appreciate if you would create a feedback regarding the matter.</p>

			<header class="quest">6. Why is it that after three days of reservation, the reference/s that I reserved was gone?</header>
			<p class="ans">There is a time limit in reserving a reference. Currently, reference/s is/are reserved to a user for three(3) days. After the third day, the reservation would be dropped from the user.</p>

			<header class="quest">7. I want to borrow a reference material. I searched for it and nothing displayed. What happened?</header>
			<p class="ans">Check if you have entered the right search detail (title, author, etc).
			If you are sure that you have entered the right detail/s, it means that the reference material is not available on the library. Check for announcements. The book may be available soon.
			It can also mean that the reference material was removed from the system. Again check for announcements.</p>

			<header class="quest">8. There are some errors on my personal information. What should I do?</header>
			<p class="ans">Upon viewing your profile, click the ‘Edit Profile’ button. An edit profile page will display where you can change them.</p>

			<header class="quest">9. What is a CSV File?</header>
			<p class="ans">It is described as Comma-separated values(CSV) file. It allows saving textual data which is delimited by a single character(the comma). It consists of records (typically one record per line). In this library system, CSV file(s) is/are used to add multiple references in the database simultaneously.</p>

			<header class="quest">10. How to create CSV files?</header>
			<p class="ans">CSV files can be created by converting a Microsoft Excel or OpenOffice Spreadsheet File into .csv when saving.
			This link would help http://www.computerhope.com/issues/ch001356.htm :)</p>

			<header class="quest">11. I would like to change my username and password. Is it possible?</header>
			<p class="ans">Yes. Just go to your profile and edit your account. Be sure to remember your new username and password.</p>

			<header class="quest">12. I cannot access the site, what should I do?</header>
			<p class="ans">Check your internet connection. Your internet connection may be down or may be unstable.
			If you are connected, refresh the page. If you still cannot access the site, contact the librarian.</p>

			<header class="quest">13. Can I access the site outside ICS Library?</header>
			<p class="ans">Yes, you can as access the site from anywhere as long as you are connected to the internet and the site is not blocked from your location.</p>

			<header class="quest">14.  How many references can I borrow/reserve from the ICS library system?</header>
			<p class="ans">You can borrow/reserve at most 3 references from the ICS library system.</p>

			<header class="quest">15. What kinds of reference can I borrow from the library? (Thesis, Books, Magazines, SP?)</header>
			<p class="ans">You can borrow any kind of reference as long it is available but not all of them are allowed to be taken home. Special Problems and Theses are for room use only.</p>

			<header class="quest">16. How long can I have the reference material/s that I borrowed?</header>
			<p class="ans">You should return the references that you have borrowed for at most 3 days after you had them.</p>

			<header class="quest">17. What is the penalty of failing to return the book/s on due?</header>
			<p class="ans">As of now, the library do not impose monetary penalties to users. You just be warned that the reference that you borrowed is already overdue.</p>

			<header class="quest">18. Why is it that I cannot log-in using my account?</header>
			<p class="ans">Kindly check if your username and password is correct. If it is indeed correct, It is possible that your account is deactivated. The ICS OnLib uses records from the SystemOne, which came from the Office of the University Registrar (OUR). There must be some reason for your account to be deactivated, like while in Leave of Abscence (LOA). Kindly check your records with the OUR and accomplish pending cases. After that, contact the administrator for the reactivation of your account.</p>

			<header class="quest">19. What is the format of data in uploading a CSV file?</header>
			<p class="ans">Row 1 of the CSV File must be:
			 TITLE,AUTHOR,ISBN,CATEGORY,DESCRIPTION,PUBLISHER,PUBLICATION_YEAR,ACCESS_TYPE,COURSE_CODE, TOTAL_AVAILABLE,TOTAL_STOCK,TIMES_BORROWED,FOR_DELETION in that exact manner. The following rows can be any value 					corresponding to the text in row 1.</p>
		</section>
		<a href="#" class="go-top">Back to Top</a>
		
	</div> <!-- end container -->


<?php $this->load->view("includes/footer")?>