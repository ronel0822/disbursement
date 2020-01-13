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

$pdf=new PDF_MC_Table();

$pdf->AddPage();


//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B','18');

//Cell( width, height, text, border, end line, [align] )
$pdf->Cell(0  ,7, 'PETTY CASH VOUCHER',0,True,'C');
$pdf->Cell(59   ,0, '', 0,1);//endline

//empty cell
$pdf->Cell(189  ,10,'',0,1);

$pdf->SetFont('Arial','','12');
$pdf->Cell(10,0,'',0,0);
$pdf->Cell(130,6, 'Petty Cash No:	'.$chequeID,0,'L');
$pdf->Cell(0,6,'',0,True,'L');
$pdf->cell(50 , 7,'',0,1);

$pdf->SetFont('Arial','','12');
$pdf->Cell(10,0,'',0,0);
$pdf->Cell(130,6, 'Paid To:  '.$payee,0,'L');
$pdf->Cell(0,6,'Date:   '.$date,0,True,'L');
$pdf->cell(50 ,2,'',0,1);

$pdf->Cell(2 ,0 ,'',1,True,'C');
$pdf->Cell(120 ,6 ,'PARTICULARS',1,0,'C');
$pdf->Cell(70,6 , 'AMOUNT', 1,1,'C');
$pdf->SetFont('Courier','','');
$pdf->SetWidths(array(120,70));
$pdf->Row(array($description,'Php '.number_format($amount,2)));


$pdf->Cell(120  ,6, 'Total:', 1,0,'R');
$pdf->SetFont('Courier','B','12');
$pdf->Cell(70   ,6, 'Php '.number_format($amount,2), 1,1);//endline
$pdf->SetFont('Arial','','12');
$pdf->Cell(0  ,8,'',0,1);

$pdf->SetFont('Arial','','12');
$pdf->Cell(2 ,0 ,'',0,True,'C');
$pdf->Cell(120 ,6 ,'Approved By:',0,'C');
$pdf->Cell(70,6 , 'Recieved Payment By:', 0,True,'C');
$pdf->SetFont('Courier','','14');
$pdf->Cell(120,10,'_________________','C');
$pdf->Cell(70,10,'_________________',0,True,'C');
$pdf->SetFont('Courier','','12');
$pdf->Cell(120,15,'Prepared By: '.ucfirst($preparedBy),'C');



$pdf->Cell(189  ,5,'',0,1);


$pdf->Output();

}
?>