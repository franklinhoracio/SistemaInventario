<link href="<?php echo base_url();?>assets/Recursos/mdb/bootstrap.min.css" rel="stylesheet">
<div class="row">
	<div class="col-md-12 text-center">
		<img src="<?php echo base_url();?>assets/Recursos/img/inventario.jpg" width="75" height="75">
	</div>
</div> <br>
<div class="row">	
	<div class="col-md-6">
		<!--b>Tipo de Comprobante:&nbsp;</b> <?php echo $ventas->tipoDocumento;?><br>
		<b>Nro. de Comprobante:&nbsp;</b><?php echo $ventas->numDocumento;?><br-->
		<span class="text-center"><b>Fecha:&nbsp;</b> <?php echo date("d/m/Y", strtotime($despachos->fecha));?></span>
	</div>	
</div>
<br>
<div class="row">
	<div class="col-md-12" style="overflow: auto">
		<table class="table table-striped table-hover table-bordered table-sm font-weight-bold text-center">
			<thead class="black white-text">
				<tr>
					<th style="display:none;">Codigo</th>
					<th>Producto</th>
					<th>Sabor</th>
					<th>Cantidad</th>
					<th>Precio</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalles as $detalle):?>
				<tr>
					<td style="display:none;"><?php echo $detalle->idProducto;?></td>
                    <td><?php echo $detalle->producto;?></td>
                    <td><?php echo $detalle->sabores;?></td>
                    <td><?php echo $detalle->cantidad;?></td>
                    <td>$ <?php echo round($detalle->valorUnitario,2);?></td>
                    <td>$ <?php echo round($detalle->importeProducto,2);?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-right"><strong>Total del Despacho:</strong></td>
					<td><?php echo round($despachos->importeDespacho,2);?></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">
		<b>Razón/Motivo:</b> <?php echo $despachos->razonDespacho;?> <br>
	</div>
	<div class="col-md-12">
		<b>Realizada por:</b> <?php echo $despachos->Nombre;?> <br>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Cerrar</button>
	<a type="button" class="btn btn-sm btn-primary" href="<?php echo base_url();?>Inventario/Consumos/reporte/<?php echo $despachos->idDespacho;?>" target="_blank"><span class="fa fa-print"> Imprimir</span></a>
</div>