<?php foreach($projectionArray as $key):
	if($key == 'category'){
		$keyCategory = $this->input->get($key);
		if($keyCategory == 'B')
			echo 'Book';
		elseif ($keyCategory == 'M')
			echo 'Magazine';
		elseif($keyCategory == 'J')
			echo 'Journal';
		elseif($keyCategory == 'C')
			echo 'CD/DVD';
		elseif($keyCategory == 'T')
			echo 'Thesis';
		elseif($keyCategory == 'S')
			echo 'Special Problem';
		else
			echo 'Undefined';

		echo ' as reference Category';
	}
	else{
		if($this->input->get($key) == '' && in_array($key, array('publisher', 'year_published')))
			echo 'No ';
		else{
			if($this->input->get($key) == '' && in_array($key, array('title', 'course_code', 'author')))
				echo 'Any ';
			else
				echo '"' . $this->input->get($key) . '" in ';
		}
		if($key == 'year_published')
			echo 'Publication Year';
		else
			echo ucwords(htmlspecialchars($key, ENT_QUOTES));
	}
		?>
		<br />
	<?php endforeach;