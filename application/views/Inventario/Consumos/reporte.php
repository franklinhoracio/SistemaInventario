<?php  
$fecha = date("d/m/Y", strtotime($despachos->fecha));
require_once(APPPATH.'libraries/fpdf/fpdf.php');
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->Ln(0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(88,3,utf8_decode('Orden de Despacho #'.$despachos->idDespacho.' '. $fecha),0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(122,3,utf8_decode('Orden de Despacho #'.$despachos->idDespacho.' '. $fecha),0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,3,utf8_decode('Orden de Despacho #'.$despachos->idDespacho.' '. $fecha),0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(88,3,utf8_decode('Sucursal: '.$despachos->sucursal),0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(122,3,utf8_decode('Sucursal: '.$despachos->sucursal),0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,3,utf8_decode('Sucursal: '.$despachos->sucursal),0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(88,3,utf8_decode('Motivo: '.$despachos->razonDespacho),0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(122,3,utf8_decode('Motivo: '.$despachos->razonDespacho),0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,3,utf8_decode('Motivo: '.$despachos->razonDespacho),0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(88,5,utf8_decode('Realizado Por: '.$despachos->usuario),0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(122,5,utf8_decode('Realizado Por: '.$despachos->usuario),0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,5,utf8_decode('Realizado Por: '.$despachos->usuario),0,1,'C');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,3,utf8_decode('Cant: '),0,0,'L');
$pdf->Cell(50,3,utf8_decode('Producto: '),0,0,'L');
$pdf->Cell(13,3,utf8_decode('Precio: '),0,0,'L');
$pdf->Cell(20,3,utf8_decode('Total: '),0,1,'L');

//columna 1
$cantProd =0;
foreach($detalles as $detalle) {
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(8,3,utf8_decode($detalle->cantidad),0,0,'C');
	$pdf->SetFont('Arial','',5);
	$pdf->Cell(54,3,utf8_decode($detalle->producto),0,0,'L');
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(10,3,utf8_decode(round($detalle->valorUnitario,2)),0,0,'C');
	$pdf->Cell(10,3,utf8_decode(round($detalle->importeProducto,2)),0,1,'C');
	$cantProd += $detalle->cantidad;
}
$pdf->Ln(3);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(72,3,utf8_decode('Total:'),0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(25,3,utf8_decode('$'.round($despachos->importeDespacho,2)),0,0,'L');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(71,3,utf8_decode('Total:'),0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(27,3,utf8_decode('$'.round($despachos->importeDespacho,2)),0,0,'L');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(73,3,utf8_decode('Total:'),0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,3,utf8_decode('$'.round($despachos->importeDespacho,2)),0,1,'L');

$pdf->Ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(97,3,utf8_decode('Total de Productos: '.$cantProd),0,0,'L');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(98,3,utf8_decode('Total de Productos: '.$cantProd),0,0,'L');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(73,3,utf8_decode('Total de Productos: '.$cantProd),0,0,'L');


//columna 2
$pdf->SetXY(105, 24);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,3,utf8_decode('Cant: '),0,0,'L');
$pdf->Cell(50,3,utf8_decode('Producto: '),0,0,'L');
$pdf->Cell(13,3,utf8_decode('Precio: '),0,0,'L');
$pdf->Cell(20,3,utf8_decode('Total: '),0,1,'L');

$a=0;
foreach($detalles as $detalle) {
	$pdf->SetXY(105, 27+$a);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(8,3,utf8_decode($detalle->cantidad),0,0,'C');
	$pdf->SetFont('Arial','',5);
	$pdf->Cell(54,3,utf8_decode($detalle->producto),0,0,'L');
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(10,3,utf8_decode(round($detalle->valorUnitario,2)),0,0,'C');
	$pdf->Cell(10,3,utf8_decode(round($detalle->importeProducto,2)),0,1,'C');
	$a+=3;
}

//columna 3
$pdf->SetXY(205, 24);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,3,utf8_decode('Cant: '),0,0,'L');
$pdf->Cell(50,3,utf8_decode('Producto: '),0,0,'L');
$pdf->Cell(13,3,utf8_decode('Precio: '),0,0,'L');
$pdf->Cell(20,3,utf8_decode('Total: '),0,1,'L');

$a=0;
foreach($detalles as $detalle) {
	$pdf->SetXY(205, 27+$a);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(8,3,utf8_decode($detalle->cantidad),0,0,'C');
	$pdf->SetFont('Arial','',5);
	$pdf->Cell(54,3,utf8_decode($detalle->producto),0,0,'L');
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(10,3,utf8_decode(round($detalle->valorUnitario,2)),0,0,'C');
	$pdf->Cell(10,3,utf8_decode(round($detalle->importeProducto,2)),0,1,'C');
	$a+=3;
}


$pdf->Ln(10);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(97,5,utf8_decode('Observaciones:____________________________________'),0,0,'L');
$pdf->Cell(98,5,utf8_decode('Observaciones:____________________________________'),0,0,'L');
$pdf->Cell(73,5,utf8_decode('Observaciones:____________________________________'),0,1,'L');

$pdf->Cell(97,4,utf8_decode('__________________________________________________'),0,0,'L');
$pdf->Cell(98,4,utf8_decode('__________________________________________________'),0,0,'L');
$pdf->Cell(10,4,utf8_decode('__________________________________________________'),0,1,'L');

$pdf->Cell(97,4,utf8_decode('__________________________________________________'),0,0,'L');
$pdf->Cell(98,4,utf8_decode('__________________________________________________'),0,0,'L');
$pdf->Cell(10,4,utf8_decode('__________________________________________________'),0,1,'L');

$pdf->Ln(2);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(40,5,utf8_decode('F:__________________'),0,0,'L');
$pdf->Cell(58,5,utf8_decode('F:__________________'),0,0,'L');

$pdf->Cell(40,5,utf8_decode('F:__________________'),0,0,'L');
$pdf->Cell(58,5,utf8_decode('F:__________________'),0,0,'L');

$pdf->Cell(40,5,utf8_decode('F:__________________'),0,0,'L');
$pdf->Cell(40,5,utf8_decode('F:__________________'),0,1,'L');

$pdf->Cell(38,1,utf8_decode('Encargado Bodega:'),0,0,'C');
$pdf->Cell(58,1,utf8_decode('          Recibido Por:'),0,0,'J');

$pdf->Cell(38,1,utf8_decode('  Encargado Bodega:'),0,0,'C');
$pdf->Cell(58,1,utf8_decode('		               Recibido Por:'),0,0,'J');

$pdf->Cell(38,1,utf8_decode('       Encargado Bodega:'),0,0,'C');
$pdf->Cell(40,1,utf8_decode('                  Recibido Por:'),0,1,'J');

$pdf->Output(); 
?> 