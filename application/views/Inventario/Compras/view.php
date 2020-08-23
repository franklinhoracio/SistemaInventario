<link href="<?php echo base_url();?>assets/Recursos/mdb/bootstrap.min.css" rel="stylesheet">
<div class="row">
	<div class="col-md-12 text-center">
		<img src="<?php echo base_url();?>assets/Recursos/img/inventario.jpg" width="75" height="75">
	</div>
</div> <br>
<div class="row">
	<div class="col-md-6">	
		<b>Proveedor</b><br>
		<b>Nombre:</b> <?php echo $compras->proveedor;?> <br>
	</div>	
	<div class="col-md-6">	
		<b>Comprobante</b> <br>
		<b>Tipo de Comprobante:&nbsp;</b> <?php echo $compras->tipoDocumento;?><br>
		<b>Nro. de Comprobante:&nbsp;</b><?php echo $compras->numDocumento;?><br>
		<b>Fecha:&nbsp;</b> <?php echo $compras->fecha;?>
	</div>	
</div>
<br>
<div class="row">
	<div class="col-md-12" style="overflow: auto">
		<table class="table table-striped table-hover table-bordered table-sm font-weight-bold text-center">
			<thead class="black white-text">
				<tr>
					<th>Codigo</th>
					<th>Producto</th>
					<th>Sabor</th>
					<th>Cantidad</th>
					<th>Costo</th>
					<th>IVA</th>
					<th>Total + IVA</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalles as $detalle):?>
				<tr>
					<td><?php echo $detalle->idProducto;?></td>
                    <td><?php echo $detalle->producto;?></td>
                    <td><?php echo $detalle->sabores;?></td>
                    <td><?php echo $detalle->cantidad;?></td>
                    <td>$ <?php echo round($detalle->valorUnitario,2);?></td>
                    <td>$ <?php echo round($detalle->iva,2);?></td>
                    <td>$ <?php echo round($detalle->importeProducto,2);?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6" class="text-right"><strong>Subtotal de compra:</strong></td>
					<td>$ <?php echo round($compras->costo,2);?></td>
				</tr>
				<tr>
					<td colspan="6" class="text-right"><strong>Iva:</strong></td>
					<td>$ <?php echo round($compras->iva,2);?></td>
				</tr>
				<tr>
					<td colspan="6" class="text-right"><strong>Total:</strong></td>
					<td>$ <?php echo round($compras->importeCompra,2);?></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-6">
		<b>Realizada por:</b> <?php echo $compras->usuario;?> <br>
	</div>
</div>