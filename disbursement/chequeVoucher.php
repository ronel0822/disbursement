<?php

if(isset($_POST['generateVoucher'])){
$chequeID = $_POST['chequeID'];
$description = $_POST['description'];
$amount = floatval($_POST['amount']);
$preparedBy = $_POST['preparedBy'];
$date = date("Y/m/d");
$payee = $_POST['payee'];

require('mc_table.php');


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219 (10*2) = 189mm

$pdf = new FPDF('P','mm','A4');
$pdf->SetAutoPageBreak(false);
$pdf=new PDF_MC_Table();
$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B','18');

//Cell( width, height, text, border, end line, [align] )
$pdf->Cell(0  ,7, 'CHEQUE VOUCHER',0,True,'C');
$pdf->Cell(59   ,0, '', 0,1);//endline

//empty cell
$pdf->Cell(189  ,5,'',0,1);

$pdf->SetFont('Arial','','12');
$pdf->Cell(10,0,'',0,0);
$pdf->Cell(22,6, 'Cheque # : ',0,'L');
$pdf->SetFont('Courier','','');
$pdf->Cell(130,6,$chequeID,0,'L');
$pdf->Cell(0,6,'',0,True,'L');
$pdf->cell(50 , 7,'',0,1);

$pdf->SetFont('Arial','','12');
$pdf->Cell(10,0,'',0,0);
$pdf->Cell(16,6, 'Pay To: ',0,'L');
$pdf->SetFont('Courier','','');
$pdf->Cell(115,6,$payee,0,'L');
$pdf->SetFont('arial','','');
$pdf->Cell(12,6,'Date: ',0,'L');
$pdf->SetFont('Courier','','');
$pdf->Cell(0,6,$date,0,'L');
$pdf->cell(50 ,8,'',0,1);


$pdf->Cell(2 ,0 ,'',1,True,'C');
$pdf->SetFont('Arial','','');
$pdf->Cell(120 ,6 ,'DESCRIPTION',1,0,'C');

$pdf->Cell(70,6 , 'AMOUNT', 1,True,'C');
$pdf->SetFont('Courier','','');
$pdf->SetWidths(array(120,70));
$pdf->Row(array($description,'Php '.number_format($amount,2)));



$pdf->Cell(120  ,6, 'Cheque:', 1,0,'R');
$pdf->SetFont('Courier','B','12');
$pdf->Cell(70   ,6, 'Php '.number_format($amount,2), 1,1);//endline
$pdf->SetFont('Arial','','12');
$pdf->Cell(0  ,8,'',0,1);


$pdf->Cell(50,0,'TOTAL SUM OF PESOS:   ',0,0,'L');
$pdf->SetFont('Courier','B','16');
$pdf->Cell(0,0,number_format($amount,2),0,'L');
$pdf->Cell(0,0,'',0,1);

$pdf->SetFont('Arial','B','12');
$pdf->Cell(2 ,8,'',0,True,'C');
$pdf->Cell(120 ,6 ,'Payment Approved By:',0,'C');
$pdf->Cell(70,6 , 'Recieved By:', 0,True,'C');
$pdf->SetFont('Courier','','');
$pdf->Cell(120,10,'______________________','C');
$pdf->Cell(70,10,'______________________',0,True,'C');
$pdf->SetFont('Courier','','12');
$pdf->Cell(120,15,'Prepared By: '.ucfirst($preparedBy),'C');



$pdf->Cell(189  ,5,'',0,1);


$pdf->Output();

}
?>