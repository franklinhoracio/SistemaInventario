<link href="<?php echo base_url();?>assets/Recursos/mdb/bootstrap.min.css" rel="stylesheet">
<div class="row">
	<div class="col-md-12" style="overflow: auto">
		<table class="table display table-bordered table-striped table-hover text-center">
			<thead>
				<tr>
					<th style="font-family: Arial; font-size: 14pt;">Sucursal</th>
					<th style="font-family: Arial; font-size: 14pt;">Producto</th>
					<th style="font-family: Arial; font-size: 14pt;">Existencias</th>
					<th style="font-family: Arial; font-size: 14pt;">Precio</th>
					<th style="font-family: Arial; font-size: 14pt;">Fecha Vto.</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php  if(!empty($inventario)):?>
					<?php foreach ($inventario as $inventarios):?>
						<tr>
							<td style="font-family: Arial; font-size: 14pt;"><?php echo $inventarios->sucursal; ?></td>
							<td style="font-family: Arial; font-size: 14pt;"><?php echo $inventarios->Producto; ?></td>
							<?php if ($inventarios->existencias > 0): ?>
								<td style="font-family: Arial; font-size: 14pt;"><?php echo $inventarios->existencias;?></td>
							<?php else: ?>
								<td style="font-family: Arial; font-size: 14pt;"><span class="bg-dark"><span class="text-danger">Producto agotado</span></span></td>
							<?php endif ?>
							<td style="font-family: Arial; font-size: 14pt;">$ <?php echo round($inventarios->precioCIVA,2);?></td>
							<td style="font-family: Arial; font-size: 14pt;"><span class="bg-dark"><span class="text-danger"><?php echo $inventarios->fechaVencimiento;?></span></span></td>
							<?php $dataproducto = $inventarios->idSucursal."*".$inventarios->idProducto."*".$inventarios->Producto."*".$inventarios->idLote."*".$inventarios->presentacion."*".$inventarios->existencias."*".$inventarios->precioCIVA."*".$inventarios->costoExistencias."*".$inventarios->idPresentacion."*".$inventarios->idInventario; ?>
							<td>
								<?php if ($inventarios->existencias > 0): ?>
								<button type="button" id="btn-pro" class="btn btn-success btn-check3 btn-sm" value="<?php echo $dataproducto?>"><span class="fa fa-check"></span></button>
								<?php endif ?>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script src="<?php echo base_url();?>assets/Recursos/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/vendor/datatables/dataTables.bootstrap4.js"></script>
<script>
	$(function () {
		$('table.display').DataTable({
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por pagina",
				"zeroRecords": "No se encontraron resultados en su busqueda",
				"searchPlaceholder": "Buscar registros",
				"info": "Mostrando registros del _START_ al _END_ de un total de  _TOTAL_ registros",
				"infoEmpty": "No existen registros",
				"infoFiltered": "",
				"search": "Buscar:",
				"paginate": {
					"first": "Primero",
					"last": "Último",
					"next": "Siguiente",
					"previous": "Anterior"
				},
			}
		})

	});
</script>