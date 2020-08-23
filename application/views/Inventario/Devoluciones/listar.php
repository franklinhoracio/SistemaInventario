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

    <div class="row">
      <a href="<?php echo base_url();?>Inventario/Devoluciones/agregar" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Realizar Devoluciones</span></a>
    </div> <br>
  </div>
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

  <div class="container">
    <form action="<?php echo current_url();?>" method="POST" class="form-horizontal">
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for="">Fecha:</label>
            <input type="date" class="form-control" name="fechainicio" value="<?php echo !empty($fechainicio) ? $fechainicio:'';?>">
          </div>
        </div>
      </div>
      <div class="form-group">
        <input type="submit" name="buscar" value="Buscar" class="btn btn-primary btn-md"> 
        <a href="<?php echo base_url(); ?>Inventario/Devoluciones" class="btn btn-danger btn-md">Restablecer</a>
      </div>
    </form>
    <div class="table-responsive-md text-nowrap">
      <div class="row">
        <div class="col-md-12" style="overflow: auto">
          <table id="cv" class="table display table-bordered table-sm w-auto" cellspacing="0" width="100%">
            <thead class="blue-gradient text-white">
              <tr>
                <th style="display:none;" class="th-sm font-weight-bold">Codigo</th>
                <th class="font-weight-bold">Usuario</th>
                <th class="font-weight-bold">Fecha</th>
                <th class="font-weight-bold">Comprobante</th>
                <th class="font-weight-bold">Sucursal que devuelve</th>
                <th class="font-weight-bold">Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($devoluciones)): ?>
              <?php foreach($devoluciones as $devolucion):?>
                <tr>
                  <td style="display:none;"><?php echo $devolucion->idDevolucionTraslado;?></td>
                  <td ><?php echo $devolucion->usuario;?></td>
                  <td ><?php echo date("d/m/Y", strtotime( $devolucion->fecha));?></td>
                  <td ><?php echo $devolucion->Comprobante;?></td>
                  <td ><?php echo $devolucion->sucursale;?></td>
                  <td >$ <?php echo round($devolucion->importeDevTraslado,2);?></td>
                  <td>
                  <button type="button" id="devolucion" class="btn btn-info btn-sm" value="<?php echo $devolucion->idDevolucionTraslado;?>" data-toggle="modal" data-target="#modal-dev"><span class="fa fa-search"></span></button>
                </td>
                </tr>
                <?php endforeach;?>
        <?php endif ?>
      </tbody>
    </table>
  </div>
</div><br>
</div>

<div class="modal fade" id="modal-dev">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Orden de Devolución</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-sm btn-primary" id="printd"><span class="fa fa-print"> Imprimir</span></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalOb">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Observación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-sm btn-primary btn-print" id="printd"><span class="fa fa-print"> Imprimir</span></button>
      </div>
    </div>
  </div>
</div>
