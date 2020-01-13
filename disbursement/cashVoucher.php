<?php

if(isset($_POST['generateVoucher'])){
$chequeID = $_POST['chequeID'];
$description = $_POST['description'];
$amount = $_POST['amount'];
$preparedBy = $_POST['preparedBy'];
$date = date("Y/m/d");
$payee = $_POST['payee'];

require('mc_table.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219 (10*2) = 189mm

$pdf = new FPDF('P','mm','A4');

$pdf=new PDF_MC_Table();
$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B','14');

//Cell( width, height, text, border, end line, [align] )
$pdf->Cell(130  ,5, 'CASH VOUCHER', 0,0);
$pdf->Cell(59   ,5, $date, 0,1);//endline

//empty cell
$pdf->Cell(189  ,10,'',0,1);

$pdf->SetFont('Arial','','12');
$pdf->Cell(130  ,6, 'Description', 1,0,'C');
$pdf->Cell(59   ,6, 'Amount', 1,1,'C');//endline

$pdf->SetWidths(array(130,59));
$pdf->Row(array($description,'Php '.number_format($amount,2)));

$pdf->Cell(130  ,6, 'Total:', 1,0,'R');
$pdf->SetFont('Arial','B','12');
$pdf->Cell(59   ,6, 'PHP '.number_format($amount,2), 1,1);//endline
$pdf->SetFont('Arial','','12');

$pdf->Cell(189  ,8,'',0,1);

$pdf->Cell(100  ,5, 'Account Charged: __________________', 0,0);
$pdf->Cell(100   ,5, 'Cheque No: '.$chequeID, 0,1);//endline

$pdf->Cell(189  ,5,'',0,1);

$pdf->Cell(100  ,5, 'To Whom Paid: '.ucfirst($payee), 0,0);
$pdf->Cell(100   ,5, 'Authorised By: __________________', 0,1);//endline

$pdf->Cell(189  ,5,'',0,1);

$pdf->Cell(100  ,5, 'Prepared By: '.ucfirst($preparedBy), 0,0);
$pdf->Cell(100   ,5, 'Received: __________________', 0,1);//endline


$pdf->Output();

}
?>