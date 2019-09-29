<?php 
// require('database/DataManager.php');
// require('environment.php');
require('fpdf.php');
$db = new PDO('mysql:host=localhost;dbname=pdffile','root','');



	class PDF extends FPDF{

		// Page header
		function Header(){
    		// Logo
			$this->SetFont('Arial','B',14);
			$this->Image('logo.png' ,0 ,-7, 100);
			$this->Cell(276, 20, 'EMPLOYEE DOCUMENTS', 0, 1, 'R');
			$this->Ln(20);

			$this->SetFont('Arial', 'B', 15);
			$this->Cell(100, 10, 'INVOICE ONE:', 0, 0, "L");
			$this->Cell(100, 10, 'INVOICE TOW:', 0, 1, "L");
			$this->Ln(0);

			$this->SetFont('Times', '', 15);
			$this->Cell(100, 10, 'Naeem', 0, 0, "L");
			$this->Cell(100, 10, 'Hasib', 0, 1, "L");
			$this->Ln(0);

			$this->SetFont('Times', '', 15);
			$this->Cell(100, 10, '796 Silver Harbour, TX 79273, US', 0, 0, "L");
			$this->Cell(100, 10, '796 Silver Harbour, TX 79273, US', 0, 1, "L");
			$this->Ln(0);

			$this->SetFont('Times', '', 15);
			$this->Cell(100, 10, 'naeem@example.com', 0, 0, "L");
			$this->Cell(100, 10, 'hasib@example.com', 0, 1, "L");
			$this->Ln(10);
		}

		// Page footer
		function Footer(){
    		// Position at 1.5 cm from bottom
			$this->SetY(-15);
    		// Arial italic 8
			$this->SetFont('Arial','',8);
    		// Page number
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}

		function headerTable(){
			$this->SetFont('Times','B',12);
			$this->Cell(20,10,'ID',1,0,'C');
			$this->Cell(40,10,'Name',1,0,'C');
			$this->Cell(40,10,'Position',1,0,'C');
			$this->Cell(60,10,'Office',1,0,'C');
			$this->Cell(36,10,'Age',1,0,'C');
			$this->Cell(50,10,'Department',1,0,'C');
			$this->Cell(30,10,'Salary',1,0,'C');
			$this->Ln();
		}

		function viewTable($db){
			$this->SetFont('Times','',12);
			$stmt = $db->query("SELECT * FROM employee");
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(20,10,$data->ID,1,0,'C');
				$this->Cell(40,10,$data->Name,1,0,'L');
				$this->Cell(40,10,$data->Position,1,0,'L');
				$this->Cell(60,10,$data->Office,1,0,'L');
				$this->Cell(36,10,$data->Age,1,0,'L');
				$this->Cell(50,10,$data->Department,1,0,'L');
				$this->Cell(30,10,$data->Salary,1,0,'L');
				$this->Ln();
			}
		}
	}


	// Instanciation of inherited class
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A4',0);
	$pdf->headerTable();
	$pdf->viewTable($db);
	$pdf->Output();










