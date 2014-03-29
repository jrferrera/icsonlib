<?php
class PDF extends FPDF{
	function Header(){
		// Logo
	    $this->Image('resources/img/ics_logo.jpg',15,7,-120);
	    // Arial bold 15
	    $this->SetFont('Arial','B',15);
	    // Move to the right
	    $this->Cell(80);
	    // Title
	    $this->Cell(50,25,'OnLib: Institute of Computer Science Library Log',0,1,'C');
	    // Line break
	    $this->Ln(20);
	}
}
	$pdf = new PDF('L','mm','Legal');
	$pdf->Header();
	//column headers
	$header = array('Title', 'Author', 'Student no.', 'Employee no.', 'Date Borrowed', 'Date Returned');
	$borrowed_header = array('References not Returned','Total inventory');
	$pdf->AddPage();
	$pdf->SetFont('Arial','',16);

	$date = date('F j, Y g:i a');

	//var_dump($day);
	if(strcmp($mode,'daily')==0){
		$pdf->Cell(30,6,"Daily Report");
	}
	else if(strcmp($mode,'weekly')==0){
		$pdf->Cell(30,6,"Weekly Report");
	}
	else if(strcmp($mode,'monthly')==0){
		$pdf->Cell(30,6,"Monthly Report");
	}

	$pdf->Ln();

	$pdf->SetFont('Arial','',12);
	$pdf->Cell(30,6,"Generated on: ".$currentDate->cur_date." ");
	$pdf->Ln();
	
	$i =0;
	$pdf->Cell(30,6,'Library Log');
	$pdf->Ln();
	// insert header to table
	foreach($header as $col){
		if($i==0){
			$pdf->Cell(152,7,$col,1,0,'C');
			$i++;
		}
		else if($i==2){
			$pdf->Cell(30,7,$col,1,0,'C');
			$i++;
		}
		else{
			$pdf->Cell(38,7,$col,1,0,'C');
			$i++;
		}
	}
	$pdf->Ln();
	$i=0;
	// insert data to table
	foreach($book_list->result() as $row){
		foreach($row as $col){
			if($i==0){
				$pdf->Cell(152,7,$col,1,0,'C');
				$i++;
			}
			else if($i==2){
				$pdf->Cell(30,7,$col,1,0,'C');
				$i++;
			}
			else{
				$pdf->Cell(38,7,$col,1,0,'C');
				$i++;
			}
		}
		$i=0;
		$pdf->Ln();
	}

	$pdf->Ln();
	
	foreach($borrowed_header as $col){
		$pdf->Cell(60,7,$col,1,0,'C');
	}
	$pdf->Ln();

	foreach($books_borrowed->result() as $row){
		foreach($row as $col)
			$pdf->Cell(60,6,$col,1,0,'C');
		
	}
	//var_dump($total_inventory);
	foreach($total_inventory as $col)
		foreach($col as $row2)
			$pdf->Cell(60,6,$row2,1,0,'C');
	
	$pdf->Ln();
	$pdf->Ln();

	//most borrowed book/s
	$pdf->Cell(30,6,'Most borrowed: ');
	$pdf->Ln();
	$count=1;
	if($most_borrowed != NULL){
		foreach($most_borrowed as $row){
			$pdf->Cell(60,7,$count.".) ".$row->title.'.  Times borrowed: '.$row->times_borrowed.'. Course code: '.strtoupper($row->course_code),0,1);
		}
	}
	else{
		$pdf->Cell(30,6,'N/A');
	}

	//if(strcmp($mode,'daily')==0)
		$pdf->Output('Library Log.pdf',"D");
	//else 
		//$pdf->Output();
?>