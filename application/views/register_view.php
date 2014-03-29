<?php $this->load->view("includes/header")?>
<?=$this->load->view("includes/createaccount")?>

<div id="content">
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>

	<?php if($this->session->userdata('registered') == false && $this->session->userdata('stud') == true){?>
		<center>
			<div id="warning_top">
				<h4>Account already exists!</h4>
				<span>Please make sure that your username / student number is unique.</span>
				<h4><?php echo anchor('home', '<< Back to Home');  ?></h4>
			</div>
		</center>
	<?php } elseif($this->session->userdata('registered') == false && $this->session->userdata('staff') == true){?>
		<center>
			<div id="warning_top">
				<h4>Account already exists!</h4>
				<span>Please make sure that your username / employee number is unique.</span>
				<h4><?=anchor('home', '<< Back to Home')?></h4>
			</div>
		</center>
	<?php }elseif($this->session->userdata('registered') == true){?>
		<center>
			<div id="warning_top">
				<h4>You are now registered!</h4>
				<span>You can now log in.</span>
				<h4><?=anchor('home', '<< Back to Home')?></h4>
			</div>
		</center>
	<?php }?>
</div>
<?php $this->load->view("includes/footer")?>