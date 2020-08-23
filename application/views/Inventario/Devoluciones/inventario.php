<link href="<?php echo base_url();?>assets/Recursos/mdb/bootstrap.min.css" rel="stylesheet">
<div class="row">
	<div class="col-md-12" style="overflow: auto">
		<table id="proInvent" class="table display table-bordered table-striped table-hover text-center">
			<thead>
				<tr>
					<th>Sucursal</th>
					<th>Producto</th>
					<th style="display:none;">Lote</th>
					<!--th>Presentación</th-->
					<th>Cantidad</th>
					<th>Fecha Vto.</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php  if(!empty($inventario)):?>
					<?php foreach ($inventario as $inventarios):?>
						<tr>
							<td><?php echo $inventarios->sucursal; ?></td>
							<td><?php echo $inventarios->producto; ?></td>
							<td style="display:none;"><?php echo $inventarios->idLote;?></td>
							<!--td><?php echo $inventarios->presentacion;?></td-->
							<?php if ($inventarios->existencias > 0): ?>
								<td><?php echo $inventarios->existencias;?></td>
							<?php else: ?>
								<td><span class="bg-dark"><span class="text-danger">Producto agotado</span></span></td>
							<?php endif ?>
							<td><span class="bg-dark"><span class="text-danger"><?php echo $inventarios->fechaVencimiento;?></span></span></td>
							<?php $dataproducto = $inventarios->idSucursal."*".$inventarios->idProducto."*".$inventarios->producto."*".$inventarios->idLote."*".$inventarios->presentacion."*".$inventarios->existencias."*".round($inventarios->precioCIVA,2)."*".$inventarios->costoExistencias."*".$inventarios->idPresentacion."*".$inventarios->idInventario."*".$inventarios->costoUnitario; ?>
							<td>
								<?php if ($inventarios->existencias > 0): ?>
									<button type="button" id="btn-prodev" class="btn btn-success btn-check3 btn-sm" value="<?php echo $dataproducto?>"><span class="fa fa-check"></span></button>
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
		$('#proInvent').DataTable({
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