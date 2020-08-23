<link href="<?php echo base_url();?>assets/Recursos/mdb/bootstrap.min.css" rel="stylesheet">
<div class="row">
	<div class="col-md-12 text-center">
		<img src="<?php echo base_url();?>assets/Recursos/img/inventario.jpg" width="75" height="75">
	</div>
</div> <br>
<div class="row">
	<div class="col-md-6">	
		<b>Sucursal que envia:</b> <?php echo $traslados->sucursale;?><br>
		<b>Sucursal que recibe:</b> <?php echo $traslados->sucursalr;?> <br>
		<b>Trasportista:</b> <?php echo $traslados->Nombre;?> <br>
	</div>	
	<div class="col-md-6">
		<b>Tipo de Comprobante:&nbsp;</b> <?php echo $traslados->tipoDocumento;?><br>
		<b>Nro. de Comprobante:&nbsp;</b><?php echo $traslados->numDocumento;?><br>
		<b>Estado:&nbsp;</b><?php echo $traslados->estadoTraslado;?><br>
		<b>Fecha:&nbsp;</b> <?php echo date("d/m/Y", strtotime($traslados->fecha));?>
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
						<td>$ <?php echo round($detalle->valorUnitario,2);?></td>
						<td>$ <?php echo round($detalle->importeProducto,2);?></td>
						<?php $a++ ?>
					</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-right"><strong>Total:</strong></td>
					<td>$ <?php echo round($traslados->importeTraslado,2);?></td>
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
		<b>Realizado por:</b> <?php echo $traslados->usuario;?> <br><br>
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
<div class="modal-footer">
	<button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Cerrar</button>
	<a type="button" class="btn btn-sm btn-primary" href="<?php echo base_url();?>Inventario/Traslados/reporte/<?php echo $traslados->idTraslado;?>" target="_blank"><span class="fa fa-print"> Imprimir</span></a>
</div>
