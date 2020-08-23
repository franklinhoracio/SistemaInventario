 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Ventas</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Reportes/ReportesMenu"><span class="font-weight-bold">Reportería</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Ventas</span></li>
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
              <a href="<?php echo base_url(); ?>Reportes/ReportesMenu/ventas" class="btn btn-danger btn-md">Restablecer</a>
            </div>
        </form>
      <div class="row">
        <div class="col-md-12" style="overflow: auto">
          <table id="vent" class="table table-striped table-hover table-bordered table-sm font-weight-bold text-center" cellspacing="0" width="100%">
            <thead class="blue-gradient text-white">
              <tr>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Sabor</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>IVA</th>
                <th>Total + IVA</th>
                <th class="th-sm font-weight-bold">Sucursal</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($detalles)): ?>
                <?php foreach ($detalles as $detalle): ?>
                  <tr>
                    <td><?php echo $detalle->usuario;?></td>
                    <td><?php echo date("d/m/Y", strtotime($detalle->fecha));?></td>
                    <td><?php echo $detalle->producto;?></td>
                    <td><?php echo $detalle->sabores;?></td>
                    <td><?php echo $detalle->cantidad;?></td>
                    <td>$ <?php echo round($detalle->precio,2);?></td>
                    <td>$ <?php echo round($detalle->iva,2);?></td>
                    <td>$ <?php echo round($detalle->importeProducto,2);?></td>
                    <td><?php echo $detalle->sucursal;?></td>
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
</div>

