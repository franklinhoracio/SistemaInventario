<link href="<?php echo base_url();?>assets/Recursos/mdb/bootstrap.min.css" rel="stylesheet">
<div class="row">
	<div class="col-md-12 text-center">
		<img src="<?php echo base_url();?>assets/Recursos/img/inventario.jpg" width="75" height="75">
	</div>
</div> <br>
<div class="row">
	<div class="col-md-6">	
		<b>Sucursal que devuelve:</b> <?php echo $devoluciones->sucursale;?><br>
		<!--b>Trasportista:</b> <?php echo $devoluciones->Nombre;?> <br-->
	</div>	
	<div class="col-md-6">
		<b>Tipo de Comprobante:&nbsp;</b> <?php echo $devoluciones->tipoDocumento;?><br>
		<b>Nro. de Comprobante:&nbsp;</b><?php echo $devoluciones->numDocumento;?><br>
		<b>Fecha:&nbsp;</b> <?php echo date("d/m/Y", strtotime($devoluciones->fecha));?>
	</div>	
</div>
<br>
<div class="row">
	<div class="col-md-12" style="overflow: auto">
		<table class="table table-striped table-hover table-bordered table-sm font-weight-bold text-center">
			<thead class="black white-text">
				<tr>
					<th>#</th>
					<th>Producto</th>
					<!--th>Lote</th-->
					<th>Cantidad</th>
					<th>Precio</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php $a=1 ?>
				<?php foreach($detalles as $detalle):?>
					<tr>
						<td><?php echo $a;?></td>
						<td><?php echo $detalle->Producto;?></td>
						<!--td><?php echo $detalle->idLote;?></td-->
						<td><?php echo $detalle->cantidad;?></td>
						<td>$ <?php echo round($detalle->precioCIVA,2);?></td>
						<td>$ <?php echo round($detalle->importeProducto,2);?></td>
						<?php $a++ ?>
					</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-right"><strong>Total:</strong></td>
					<td>$ <?php echo round($devoluciones->importeDevTraslado,2);?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<div class="row" style="overflow: auto">
	<div class="col-md-10">
		<b>Observaciones:</b>________________________________________________________________________________________<br>
		_________________________________________________________________________________________________________<br>
		_________________________________________________________________________________________________________<br>
		_________________________________________________________________________________________________________<br>
		_________________________________________________________________________________________________________<br>
	</div>
</div>
<div class="row">
	<div class="col-md-10">
		<b>Realizado por:</b> <?php echo $devoluciones->usuario;?> <br><br>
	</div>
</div>
<div class="row" style="overflow: auto">
	<div class="col-md-6">
		<b>Encargado de Bodega:</b><br>F:____________________<br>
		<b>Transportista:</b><br>F:____________________<br>
	</div>
	<div class="col-md-6">
		<b>Recibido por:</b><br>F:____________________<br>
		<b>Transportista:</b><br>F:____________________<br>
	</div>
</div>
