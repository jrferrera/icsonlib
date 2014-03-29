<?= $this->load->view('includes/header') ?>
		<h3>Your file contains the following: </h3>
		<?= form_open('librarian/add_multipleReferences/'); ?>
			<table class = 'table table-hover' border="1px" cellpadding="0" cellspacing="0" width="100%">
			    <tr>
		            <td>TITLE</td>
		            <td>AUTHOR</td>
		            <td>ISBN</td>
		            <td>CATEGORY</td>
		            <td>DESCRIPTION</td>
		            <td>PUBLISHER</td>
		            <td>PUBLICATION YEAR</td>
		            <td>ACCESS TYPE</td>
		            <td>COURSE CODE</td>
		            <td>TOTAL AVAILABLE</td>
		            <td>TOTAL STOCK</td>
		            <td>TIMES BORROWED</td>
		            <td>FOR DELETION</td>
			    </tr>
		        <?php $i = 0;
		        	foreach($csvData as $field): ?>		
		            <tr>
		                <td><input type = "text" name = "<?= 'title' . $i?>" value = "<?= htmlspecialchars($field['TITLE'], ENT_QUOTES) ?>" maxlength='500' title="Must be 1-500 characters containing only alphanumeric character/s, spaces, and any of the following characters: . , \ + : ; # ( ) - ' &quot; &amp;" pattern="^[A-Za-z0-9\.\\,\+:&amp;;'#\(\)\-\'\&quot; ]+$" required></td>
		                <td><input type = "text" name = "<?= 'author' . $i?>" value = "<?= htmlspecialchars($field['AUTHOR'], ENT_QUOTES) ?>" maxlength='255' title='Must be 2-255 characters containing only aphanumeric character/s, spaces, and any of the following characters: . , - &amp;' pattern='^[A-Za-z0-9,&amp;-\. ]+$' required></td>
		                <td><input type = "text" name = "<?= 'isbn' . $i?>" value = "<?= htmlspecialchars($field['ISBN'], ENT_QUOTES) ?>" maxlength='13' title='Must be at most 13 characters containing only 9-digits separated by a dash' pattern='^[0-9]+\-[0-9]+\-[0-9]+\-[0-9]+$'></td>
		                <td>
							<select name = "<?= 'category' . $i?>" required>
								<option value = "B" <?php echo (strcasecmp($field['CATEGORY'], "B") == 0 OR strcasecmp($field['CATEGORY'], "Book") == 0) ? 'selected' : ''; ?>>Book</option>
								<option value = "M" <?php echo (strcasecmp($field['CATEGORY'], "M") == 0 OR strcasecmp($field['CATEGORY'], "Magazine") == 0) ? 'selected' : ''; ?>>Magazine</option>
								<option value = "T" <?php echo (strcasecmp($field['CATEGORY'], "T") == 0 OR strcasecmp($field['CATEGORY'], "Thesis") == 0) ? 'selected' : ''; ?>>Thesis</option>
								<option value = "S" <?php echo (strcasecmp($field['CATEGORY'], "S") == 0 OR strcasecmp($field['CATEGORY'], "SP") == 0 OR strcasecmp($field['CATEGORY'], "Special Problem") == 0) ? 'selected' : ''; ?>>Special Problem</option>
								<option value = "C" <?php echo (strcasecmp($field['CATEGORY'], "C") == 0 OR strcasecmp($field['CATEGORY'], "CD") == 0) ? 'selected' : ''; ?>>CD/DVD</option>
								<option value = "J" <?php echo (strcasecmp($field['CATEGORY'], "J") == 0 OR strcasecmp($field['CATEGORY'], "Journal") == 0) ? 'selected' : ''; ?>>Journal</option>
							</select> 
		                </td>
		                <td><input type = "text" name = "<?= 'description' . $i?>" value = "<?= htmlspecialchars($field['DESCRIPTION'], ENT_QUOTES) ?>" maxlength='65535' title="Must be at most 65536 characters containing only alphanumeric character/s, spaces, and any of the following characters: . , \ + : ; # ( ) - ' &quot; &amp;" pattern="^[A-Za-z0-9\.\\,\+:&amp;;'#\(\)\-\'\&quot; ]+$"></td>
		                <td><input type = "text" name = "<?= 'publisher' . $i?>" value = "<?= htmlspecialchars($field['PUBLISHER'], ENT_QUOTES) ?>" maxlength='100' title="Must be at most 100 characters containing only alphanumeric character/s, spaces, and any of the following characters: . , \ + : ; # ( ) - ' &quot; &amp;" pattern="^[A-Za-z0-9\.\\,\+:&amp;;'#\(\)\-\'\&quot; ]+$"></td>
		                <td><input type = "number" name = "<?= 'year' . $i?>" value = "<?= htmlspecialchars($field['PUBLICATION_YEAR'], ENT_QUOTES) ?>" min="1900" max="<?php echo date('Y'); ?>" maxlength='4'></td>
		                <td>
							<select name = "<?= 'access_type' . $i?>" required>
								<option value = "S" <?php echo (strcasecmp($field['ACCESS_TYPE'], "S") == 0 OR strcasecmp($field['ACCESS_TYPE'], "Student") == 0) ? 'selected' : ''; ?>>Student</option>
								<option value = "F" <?php echo (strcasecmp($field['ACCESS_TYPE'], "F") == 0 OR strcasecmp($field['ACCESS_TYPE'], "Faculty") == 0) ? 'selected' : ''; ?>>Faculty</option>
							</select>
		                </td>
		                <td><input type = "text" name = "<?= 'course_code' . $i?>" value = "<?= htmlspecialchars($field['COURSE_CODE'], ENT_QUOTES)?>" maxlength='8' title='Must be 3-8 characters having starting with two to four uppercase characters followed by an optional space, ending with a one to three digit/s.' pattern = "^[A-Z]{2,4}[ ]{0,1}[0-9]{1,3}$" required></td>
		                <td><input type = "number" name = "<?= 'total_available' . $i ?>" value = "<?= htmlspecialchars($field['TOTAL_AVAILABLE'], ENT_QUOTES) ?>" min = "1" required></td>
		                <td><input type = "number" name = "<?= 'total_stock' . $i?>" value = "<?= htmlspecialchars($field['TOTAL_STOCK'], ENT_QUOTES)?>" min = "1" required></td>
		            	<td><input type = "number" name = "<?= 'times_borrowed' . $i?>" value = "<?= htmlspecialchars($field['TIMES_BORROWED'], ENT_QUOTES) ?>" min = '0' required></td>
		            	<td>
		            		<select name = "<?= 'for_deletion' . $i ?>" value = "<?= htmlspecialchars($field['FOR DELETION'], ENT_QUOTES)?>">
		            			<option value = 'F' <?= (strcasecmp($field['FOR DELETION'], 'F') == 0) ? 'selected' : '' ?>>Available</option>
		            			<option value = 'T' <?= (strcasecmp($field['FOR DELETION'], 'T') == 0) ? 'selected' : '' ?>>To be Removed</option>
		            		</select>
		            	</td>
		            </tr>
		            <?php $i++; ?>
		        <?php endforeach; ?> 
		        <input type = "hidden" name = "rowCount" value = "<?= $i; ?>">
			</table>

			<input type="submit" name="submit" value="Add References">    
		<?= form_close(); ?>
		<p><?php echo anchor('librarian/file_upload', 'Back'); ?></p>
<?= $this->load->view('includes/footer') ?>