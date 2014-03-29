<?php $this->load->view("includes/header")?>
<?=$this->load->view("includes/createaccount")?>

<div id="content">
<div id="cart_body">
	<h1><center><b>  Your Cart:</b></center> </h1>
<center><a class="btn btn-success" href="<?=base_url('index.php/search')?>" id='empty'>Back to Search</a></center>
<?php if($this->cart->total() > 0 ): ?>
	

<table id="cart_table" class="table table-hover table-bordered"  cellpadding = "5" cellspacing = "2">
		<div id="emp">
	<?php
 echo '<a class="btn btn-danger"href="'.base_url('index.php/cart/empty_cart')."\" id='empty'>Empty Cart </a>";
?>	</div>
<?php echo form_open('cart/remove_selected'); ?>
<tr>
  <th>&nbsp; &nbsp; &nbsp; <input type="submit" class="btn btn-default"value="Remove Items" onclick="javascript:return confirm('Are you sure?');"></th>
  <th><center>Title</center></th>
  <th><center>Year</center></th>
  <th><center>Author</center></th>
  <th><center>Course Code</center></th>
  <th><center>Total Available</center></th>
  <th><center>Total Stock</center></th>
   <th><center>Action</center></th>
</tr>

<?php $i = 1; ?>

<?php foreach ($this->cart->contents() as $items): ?>

	<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

	<tr>
		<!-- checkbox -->
		
		<td>
			<center><?php 
				$total = $this->cart->total();
				$checkboxname = "cart".$i;
				echo "<input type='checkbox' name='{$checkboxname}' value='{$items['rowid']}' />" ; 

			?></center>
		</td>
			<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
			<p><?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
					<td align="center">
						<?php echo $option_value; ?><br />
						<?php
						if($option_name == 'Title'){
						?>
							<input type="hidden" name="booktitle" value="<?=$option_value?>" />
							
						<?php
						} elseif ($option_name == 'Author') {
						?>
						<input type="hidden" name="bookauthor" value="<?=$option_value?>" />
						<?php
						} elseif ($option_name == 'Bookcode') {
						?>
						<input type="hidden" name="bookcourse" value="<?=$option_value?>" />
						<?php } ?>
					</td>
				<?php endforeach; ?>
				<td>
				<a	href="<?=base_url('index.php/search/view_reference/'.$items['id'])?>" class="btn btn-primary" id="linked">View Book</a>
				<?php if($this->session->userdata('loggedIn') && ($this->session->userdata('userType') == 'S' || $this->session->userdata('userType') == 'F')){ ?>
					<button class=" btn btn-primary"type="submit" formmethod="get" formaction="<?php echo base_url('index.php/search/transaction/'.$items['id']); ?>" name="reserve">Reserve</button>
				<?php } ?>
			</td>
			</p>
			<?php endif; ?>

			</label>
	</tr>

<?php $i++; ?>

<?php endforeach; ?>
</form>
</table>
</div>
<?php else: ?>
		<center><div id="alertmessage2"class="alert alert-danger">Cart is empty!</div></center>
	
<?php endif; ?>

<?php $this->load->view("includes/footer")?>