 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Kardex</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>inventario/inventario/sucursal/<?php echo $sucursal->idSucursal;?>"><span class="font-weight-bold">Inventario</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Kardex</span></li>
    </ol>
    <div class="container">

      <form action="<?php echo current_url();?>" method="POST" class="form-horizontal">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Desde:</label>
              <input type="date" class="form-control" name="fechainicio" value="<?php echo !empty($fechainicio) ? $fechainicio:'';?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Hasta:</label>
              <input type="date" class="form-control" name="fechafin" value="<?php  echo !empty($fechafin) ? $fechafin:'';?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <input type="submit" name="buscar" value="Buscar" class="btn btn-primary btn-md"> 
          <a href="<?php echo base_url(); ?>inventario/inventario/kardex/<?php echo $producto->idProducto;?>/<?php echo $sucursal->idSucursal;?>" class="btn btn-danger">Restablecer</a>
        </div>
      </form>
      <div class="row">
        <div class="col-md-12" style="overflow: auto">
          <table id="kardex" class="table table-striped table-hover table-bordered table-sm font-weight-bold text-center" cellspacing="0" width="100%">
           <center><font style="text-transform: uppercase; font-size: 18px;">Kardex del Producto <u><mark><?php echo $producto->producto;?><?php echo $producto->sabores;?> </mark></u>&nbsp;de la sucursal <u><mark><?php echo $sucursal->sucursal; ?></mark></u></font></center>
           <thead>
            <tr>
              <th></th>
              <th></th>
              <th colspan="3">Entradas</th>
              <th colspan="3">Salidas</th>
              <th colspan="3">Existencias</th>
            </tr>
            <tr>
              <th>Fecha</th>
              <th>Descripción</th>
              <th>Cantidad</th>
              <th>Costo Unitario</th>
              <th>Total</th>
              <th>Cantidad</th>
              <th>Costo Unitario</th>
              <th>Total</th>
              <th>Cantidad</th>
              <th>Costo Unitario</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php  if(!empty($inventario)):?>
              <?php foreach ($inventario as $inventarios):?>
                <tr>
                  <td><?php echo date("d/m/Y", strtotime($inventarios->fechaMovimiento));?></td>
                  <td><?php echo $inventarios->descripcion;?></td>
                  <td><?php echo $inventarios->cantEntrada;?></td>
                  <td><?php echo $inventarios->cUnitEntrada;?></td>
                  <td><?php echo $inventarios->importeEntrada;?></td>
                  <td><?php echo $inventarios->cantSalida;?></td>
                  <td><?php echo $inventarios->cUnitSalida;?></td>
                  <td><?php echo $inventarios->importeSalida;?></td>
                  <td><?php echo $inventarios->cantExistencias;?></td>
                  <td><?php echo $inventarios->cUnitExistencias;?></td>
                  <td><?php echo $inventarios->importeExistencias;?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div><br>
  </div>
</div>

