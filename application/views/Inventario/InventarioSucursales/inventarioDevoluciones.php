 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Inventario</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Inventario"><span class="font-weight-bold">Menu Inventario</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Inventario</span></li>
    </ol>

    <!--div class="row">
      <a href="<?php echo base_url();?>Inventario/Inventario/cargar/<?php echo $sucursal->idSucursal; ?>" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Cargar Inventario</span></a>
    </div> <br-->
  </div>


  <div class="container">
    <div class="row">
      <div class="col-md-12" style="overflow: auto">
        <table id="ive" class="table table-striped table-hover table-bordered table-sm w-auto" cellspacing="0" width="100%">
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
              <th class="th-sm font-weight-bold">Editar Precio</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($inventarios)): ?>
              <?php foreach ($inventarios as $inventario): ?>
                <tr>
                  <td style="display:none;"><?php echo $inventario->idInventarioDev;?></td>
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
                  <td>$ <?php echo round($inventario->precio,2);?></td>
                  <td>$ <?php echo $inventario->precio *$inventario->Existencias;?></td>
                  <?php if ($inventario->fechaVencimiento == NULL): ?>
                    <td><span class="bg-dark"><span class="text-danger"><?php echo $inventario->fechaVencimiento;?></span></span></td>
                  <?php else: ?>
                    <td><span class="text-danger"><?php echo date("d/m/Y", strtotime($inventario->fechaVencimiento));?></span></td>
                  <?php endif ?>
                  <td>
                    <button id="editarPrecio" data-toggle="modal" data-target="#modal-editPrecio" data-id="<?php echo $inventario->precio;?>" class="dropdown-item"><i class="fas fa-fw fa-edit"></i> Editar</button>
                  </td>
                </tr>
              <?php endforeach ?>
            <?php endif ?>
          </tbody>
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
<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inventario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-editPrecio">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Precio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="overflow: auto">
        <form action="" method="POST" id="formularioPrecio" >
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">   
                <label for="precio">Precio:</label>
                <input type="hidden" class="form-control required" id="id" name="id" value="">
                <input type="text" class="form-control required" id="precio" name="precio" value="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" id="btn-editPrecio" class="btn btn-success btn-flat">Guardar</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
