 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Inventario</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Reportes/ReportesMenu"><span class="font-weight-bold">Reportería</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Inventario</span></li>
    </ol>
    <div class="row">
      <a href="<?php echo base_url();?>Reportes/ReportesMenu/inventarios" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Inventario General</span></a>&nbsp;&nbsp;
      <?php foreach ($sucursales as $sucursal):?>
        <a href="<?php echo base_url();?>Reportes/ReportesMenu/inventarios2/<?php echo $sucursal->idSucursal;?>" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Inventario Sucursal <?php echo $sucursal->sucursal; ?></span></a>&nbsp;&nbsp;
      <?php endforeach; ?>
    </div> <br>
    <div class="container">
      <div class="row">
        <div class="col-md-12" style="overflow: auto">
          <table id="inve" class="table table-striped table-hover table-bordered table-sm font-weight-bold text-center" cellspacing="0" width="100%">
            <thead class="blue-gradient text-white">
              <tr>
                <th class="th-sm font-weight-bold">Producto</th>
                <th class="th-sm font-weight-bold">Sabor</th>
                <!--th class="th-sm font-weight-bold">Lote</th-->
                <th class="th-sm font-weight-bold">Existencias</th>
                <!--th class="th-sm font-weight-bold">Costo Unitario</th-->
                <!--th class="th-sm font-weight-bold">Stock Minimo</th-->
                <!--th class="th-sm font-weight-bold">Costo Total</th-->
                <!--th class="th-sm font-weight-bold">Presentación</th-->
                <th class="th-sm font-weight-bold">Precio Unitario</th>
                <th class="th-sm font-weight-bold">Precio Total</th>
                <th class="th-sm font-weight-bold">Fecha de Vto.</th>
                <th class="th-sm font-weight-bold">Sucursal</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($inventarios)): ?>
                <?php foreach ($inventarios as $inventario): ?>
                  <tr>
                    <td><?php echo $inventario->producto;?></td>
                    <td><?php echo $inventario->sabores;?></td>
                    <!--td><?php echo $inventario->idLote;?></td-->
                    <?php if ($inventario->Existencias > 0): ?>
                      <td><?php echo $inventario->Existencias;?></td>
                    <?php else: ?>
                      <td><span class="bg-dark"><span class="text-danger">Producto agotado</span></span></td>
                    <?php endif ?>
                    <!--td><?php echo round($inventario->costoUnitario,2);?></td-->
                    <!--td><?php echo $inventario->stockMinimo;?></td-->
                    <!--td><?php echo round($inventario->costoExistencias,2);?></td-->
                    <!--td><?php echo $inventario->presentacion;?></td-->
                    <td>$ <?php echo round($inventario->precioCIVA,2);?></td>
                    <td>$ <?php echo $inventario->precioCIVA *$inventario->Existencias;?></td>
                    <?php if ($inventario->fechaVencimiento == NULL): ?>
                      <td><span class="bg-dark"><span class="text-danger"><?php echo $inventario->fechaVencimiento;?></span></span></td>
                    <?php else: ?>
                      <td><span class="bg-dark"><span class="text-danger"><?php echo date("d/m/Y", strtotime($inventario->fechaVencimiento));?></span></span></td>
                    <?php endif ?>
                    <td><?php echo $inventario->sucursal;?></td>
                  </tr>
                <?php endforeach ?>
              <?php endif ?>
            </tbody>
            <tfoot>
              <tr>
                <td ></td>
                <td ></td>
                <td ></td>
                <td class="text-right"><strong>Total:</strong></td>
                <td >$ <?php echo $total; ?></td>
                <td ></td>
                <td ></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div><br>
      <?php if($this->session->flashdata("success")):?>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-5">
           <div class="alert alert-success alert-dimissible text-center">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p><i class=""></i><?php echo $this->session->flashdata("success")?></p>
          </div>
        </div>
      </div>
    <?php endif;?>
  </div>
</div>

