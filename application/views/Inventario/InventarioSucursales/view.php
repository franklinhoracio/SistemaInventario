<link href="<?php echo base_url();?>assets/Recursos/mdb/bootstrap.min.css" rel="stylesheet">
<div class="row">
	<div class="col-md-12" style="overflow: auto">
		<table id="invent" class="table table-striped table-hover table-bordered table-sm w-auto" cellspacing="0" width="100%">
			<thead class="blue-gradient text-white">
				<tr>
					<th class="th-sm font-weight-bold">Producto</th>
					<th class="th-sm font-weight-bold">Sabor</th>
					<!--th class="th-sm font-weight-bold">Lote</th-->
					<th class="th-sm font-weight-bold">Existencias</th>
					<!--th class="th-sm font-weight-bold">Costo Unitario</th-->
					<!--th class="th-sm font-weight-bold">Stock Minimo</th-->
					<!--th class="th-sm font-weight-bold">Costo Total</th-->
					<th class="th-sm font-weight-bold">Precio Unitario</th>
					<th class="th-sm font-weight-bold">Precio Total</th>
					<th class="th-sm font-weight-bold">Fecha de Vto.</th>
					<th class="th-sm font-weight-bold"></th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($inventarios)): ?>
					<?php foreach ($inventarios as $inventario): ?>
						<tr>
							<td><?php echo $inventario->producto;?></td>
							<td><?php echo $inventario->sabores;?></td>
							<!--td><?php echo $inventario->idLote;?></td-->
							<?php if ($inventario->existencias > 0): ?>
								<td><?php echo $inventario->existencias;?></td>
							<?php else: ?>
								<td><u><i>Producto agotado</i></u></td>
							<?php endif ?>
							<!--td><?php echo round($inventario->costoUnitario,2);?></td-->
							<!--td><?php echo $inventario->stockMinimo;?></td-->
							<!--td><?php echo round($inventario->costoExistencias,2);?></td-->
							<td>$ <?php echo round($inventario->precioCIVA,2);?></td>
							<td>$ <?php echo $inventario->precioCIVA *$inventario->existencias;?></td>
							<?php if ($inventario->fechaVencimiento == NULL): ?>
								<td><span class="text-danger"><u><i><?php echo $inventario->fechaVencimiento;?></i></u></span></td>
							<?php else: ?>
								<td><span class="text-danger"><u><i><?php echo date("d/m/Y", strtotime($inventario->fechaVencimiento));?></i></u></span></td>
							<?php endif ?>
							<td><a href="<?php echo base_url();?>Inventario/Inventario/editar/<?php echo $inventario->idInventario;?>">Editar Existencias</a></td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>
<script src="<?php echo base_url();?>assets/Recursos/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/vendor/datatables/dataTables.bootstrap4.js"></script>
<script>
	$(function () {
		$('#invent').DataTable({
			"ordering": false,
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