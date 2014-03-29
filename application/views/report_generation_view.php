
<?=$this->load->view("includes/header")?>
	<div id="content">
		<h3>Generate Report</h3>
		<div id="view_report">
	
	<form action="<?=base_url('index.php/librarian/view_report')?>" method="post" accept-charset="utf-8" name="reportgen">
		
	<div id="buttonsReport">
		<select  class="btn btn-primary report" name="print_by">
			<option value="daily">Daily Report</option>
			<option value="weekly">Weekly Report</option>
			<option value="monthly">Monthly Report</option>
		</select>
		<input class="btn btn-danger submitreport" type="submit"><br/><br/>
		<a href="<?= site_url('librarian/index') ?>"><input class="btn btn-default backbutton1" value="Back"></a>
		<div id="customdate" style="display: none;">
			<p >From:</p>
			<input type="date" name="day1" title="Format is mm/dd/yyyy" min="2000-01-01" id="day1" max="<?php $date = date('Y-m-d'); echo $date;?>">
			<p >To:</p>
			<input type="date" name="day2" title="Format is mm/dd/yyyy" min="2000-01-01" id="day2" max="<?php $date = date('Y-m-d'); echo $date;?>">
		</div>
	</div>
	</form>
</div>
</div>

<?=$this->load->view("includes/footer")?>