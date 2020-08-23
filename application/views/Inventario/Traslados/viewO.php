<link href="<?php echo base_url();?>assets/Recursos/mdb/bootstrap.min.css" rel="stylesheet">
<div class="row">
	<div class="col-md-12 text-center">
		<img src="<?php echo base_url();?>assets/Recursos/img/inventario.jpg" width="75" height="75">
	</div>
</div> <br>
<div class="row">
	<div class="col-md-6">	
		<b>Sucurasl que envia:</b> <?php echo $traslados->sucursale;?><br>
		<b>Sucursal que recibe:</b> <?php echo $traslados->sucursalr;?> <br>
	</div>	
	<div class="col-md-6">
		<b>Tipo de Comprobante:&nbsp;</b> <?php echo $traslados->tipoDocumento;?><br>
		<b>Nro. de Comprobante:&nbsp;</b><?php echo $traslados->numDocumento;?><br>
		<b>Fecha en que se realizo el traslado:&nbsp;</b> <?php echo date("d/m/Y", strtotime($traslados->fecha));?>
	</div>	
</div>
<br>
<div class="row">
	<div class="col-md-12" style="overflow: auto">
		<table class="table table-striped table-hover table-bordered table-sm font-weight-bold text-center">
			<thead class="black white-text">
				<tr>
					<th>Observación</th>
					<th>Usuario</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($observacion as $observa):?>
					<tr>
						<td><?php echo $observa->observacion;?></td>
						<td><?php echo $observa->usuario;?></td>
						<td><?php echo date("d/m/Y H:i:s", strtotime($observa->fechaHora));?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>