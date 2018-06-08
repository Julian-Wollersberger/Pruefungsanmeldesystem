<?php
	require('fpdf.php');

class PDF extends FPDF
{
	// Load data
	function LoadData($file)
	{
		// Read file lines
		$lines = file($file);
		$data = array();
		foreach($lines as $line)
		    $data[] = explode(';',trim($line));
		return $data;
	}

	

	// Colored table
	function FancyTable($header, $data)
	{
		// Colors, line width and bold font
		$this->SetFillColor(145,145,145);
		$this->SetTextColor(255);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('Arial','',14);

		// Header
		$w = array(30,30,50,20,25,15,20);
		for($i=0;$i<count($header);$i++)
		    $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		$this->Ln();

		// Color and font restoration
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('Arial','',10);


		// Data
		$fill = false;
		foreach($data as $row)
		{
		    $this->Cell($w[0],6,utf8_decode($row[0]),'LR',0,'L',$fill);
		    $this->Cell($w[1],6,utf8_decode($row[1]),'LR',0,'L',$fill);
		    $this->Cell($w[2],6,utf8_decode($row[2]),'LR',0,'L',$fill);
		    $this->Cell($w[3],6,utf8_decode($row[3]),'LR',0,'C',$fill);
			$this->Cell($w[4],6,utf8_decode($row[4]),'LR',0,'C',$fill);
			$this->Cell($w[5],6,utf8_decode($row[5]),'LR',0,'C',$fill);
			$this->Cell($w[6],6,utf8_decode($row[6]),'LR',0,'C',$fill);
		    $this->Ln();
		    $fill = !$fill;
		}
		// Closing line
		$this->Cell(array_sum($w),0,'','T');
	}

	// Page header
	function Header()
	{
		// Logo
		$this->Image('./form/htl_logo.png',10,6,20);
		// Arial bold 15
		$this->SetFont('Arial','B',23);
		// Move to the right
		$this->Cell(80);
		// Title
		$this->Cell(30,10,utf8_decode('Anmeldungen zur NOST-Prüfung'),0,0,'C');
		// Line break
		$this->Ln(20);
	}

	// Page footer
	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','',8);
		// Page number
		$this->Cell(0,10,'Seite '.$this->PageNo().'/{nb}',0,0,'R');
	}
}

	$pdf = new PDF();


	// Column headings
	$header = array('Vorname', 'Nachname', 'Email', 'Klasse', 'Datum', 'Zeit','Fach');
	// Data loading
	$data = $pdf->LoadData('../anmeldungen/anmeldungen.csv');
	$pdf->SetFont('Arial','',12);
	
	$pdf->AddPage();
	$pdf->FancyTable($header,$data);
	$pdf->Output();


	
?>
