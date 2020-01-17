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

$pdf=new PDF_MC_Table();
$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B','14');

//Cell( width, height, text, border, end line, [align] )
$pdf->Cell(130  ,5, 'CASH VOUCHER', 0,1);

//endline

//empty cell
$pdf->SetFont('Courier','B','');
$pdf->Cell(190  ,7, $date, 0,1,'R');
$pdf->SetFont('Arial','','12');
$pdf->Cell(130  ,6, 'DESCRIPTION', 1,0,'C');
$pdf->Cell(59   ,6, 'AMOUNT', 1,1,'C');//endline
$pdf->SetFont('Courier','','');
$pdf->SetWidths(array(130,59));
$pdf->Row(array($description,'Php '.number_format($amount,2)));

$pdf->Cell(130  ,6, 'Total:', 1,0,'R');
$pdf->SetFont('Courier','B','12');
$pdf->Cell(59   ,6, 'PHP '.number_format($amount,2), 1,1);//endline
$pdf->SetFont('Arial','','12');

$pdf->Cell(189  ,8,'',0,1);

$pdf->Cell(115  ,5, 'Account Charged: __________________', 0,0);
$pdf->Cell(25   ,5, 'Cheque No: ', 0,0);//endline
$pdf->SetFont('','I','');
$pdf->Cell(100,5,$chequeID,0,1);

$pdf->Cell(189  ,5,'',0,1);
$pdf->SetFont('','','');
$pdf->Cell(30  ,5, 'To Whom Paid: ', 0,0);
$pdf->SetFont('','I','');
$pdf->Cell(85,5,ucfirst($payee),0,0);
$pdf->SetFont('Arial','','');
$pdf->Cell(100,5, 'Authorised By: __________________', 0,1);//endline

$pdf->Cell(189  ,5,'',0,1);

$pdf->Cell(26  ,5, 'Prepared By: ', 0,0);
$pdf->SetFont('','I','');
$pdf->Cell(95,5,ucfirst($preparedBy),0,0);
$pdf->SetFont('Arial','','');
$pdf->Cell(100   ,5, 'Received: __________________', 0,1);//endline


$pdf->Output();

}
?>