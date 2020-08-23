 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Listado de Traslados</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Inventario"><span class="font-weight-bold">Inventario</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Traslados</span></li>
    </ol>
  </div>

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
        <a href="<?php echo base_url(); ?>Inventario/Traslados/traslados" class="btn btn-danger btn-md">Restablecer</a>
      </div>
    </form>
    <div class="table-responsive-md text-nowrap">
      <div class="row">
        <div class="col-md-12" style="overflow: auto">
          <table id="cv" class="table display table-bordered table-sm w-auto" cellspacing="0" width="100%">
            <thead class="blue-gradient text-white">
              <tr>
                <th style="display:none;" class="th-sm font-weight-bold">Codigo</th>
                <th  class="font-weight-bold">Usuario</th>
                <th  class="font-weight-bold">Fecha</th>
                <th  class="font-weight-bold">Comprobante</th>
                <th  class="font-weight-bold">Eviado desde</th>
                <th  class="font-weight-bold">Eviado a</th>
                <th  class="font-weight-bold">Total</th>
                <th  class="font-weight-bold">Estado</th>              
                <th>Detalles</th>
                <th>Observaciones</th>
              </tr>
            </thead>
            <tbody>
             <?php if (!empty($salidas)): ?>
              <?php foreach($salidas as $salida):?>
                <tr>
                  <td style="display:none;"><?php echo $salida->idTraslado;?></td>
                  <td ><?php echo $salida->usuario;?></td>
                  <td ><?php echo date("d/m/Y", strtotime( $salida->fecha));?></td>
                  <td ><?php echo $salida->Comprobante;?></td>
                  <td ><?php echo $salida->sucursale;?></td>
                  <td ><?php echo $salida->sucursalr;?></td>
                  <td >$ <?php echo round($salida->importeTraslado,2);?></td>
                  <td ><?php echo $salida->estadoTraslado;?></td>
                  <td >
                    <button type="button" id="salida" class="btn btn-info btn-sm" value="<?php echo $salida->idTraslado;?>" data-toggle="modal" data-target="#modal-default"><span class="fa fa-search"></span></button>
                    <?php if ($salida->estadoTraslado!="Entregado"): ?>
                      <?php if ($salida->estadoTraslado == "Pendiente"): ?>
                        <button class=" btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"></button> 
                        <div class="dropdown-menu">                    
                          <a class="dropdown-item" href="<?php echo base_url();?>Inventario/Traslados/Actualizar/<?php echo $salida->idTraslado;?>/Enviado"><i class=""></i>Enviado</a>
                          <a class="dropdown-item" href="<?php echo base_url();?>Inventario/Traslados/addOb/<?php echo $salida->idTraslado;?>/<?php echo $salida->estadoTraslado;?>" ><i class="fas fa-fw fa-edit"></i>Observaciones</a>
                        </td>
                      </div>
                    <?php endif ?>  
                    <?php if ($salida->estadoTraslado == "Enviado"): ?>                         
                      <button class=" btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false"></button> 
                      <div class="dropdown-menu">                    
                        <?php if ($this->session->userdata("idSucursal") != $salida->idSucursalRecibe and $this->session->userdata("rol") != "Administrador" and $this->session->userdata("rol") != "Gerente"): ?>
                          <a class="dropdown-item" href="<?php echo base_url();?>Inventario/Traslados/addOb/<?php echo $salida->idTraslado;?>/<?php echo $salida->estadoTraslado;?>" ><i class="fas fa-fw fa-edit"></i>Observaciones</a>
                          <?php else: ?>
                            <a class="dropdown-item" href="<?php echo base_url();?>Inventario/Traslados/Actualizar/<?php echo $salida->idTraslado;?>/Entregado"><i class=""></i>Entregado</a>
                            <a class="dropdown-item" href="<?php echo base_url();?>Inventario/Traslados/addOb/<?php echo $salida->idTraslado;?>/<?php echo $salida->estadoTraslado;?>" ><i class="fas fa-fw fa-edit"></i>Observaciones</a>
                        <?php endif ?>
                        
                      </td>
                    </div>
                  <?php endif ?>
                <?php endif ?>
              </td>
              <td ><button type="button" id="observa" class="btn btn-info btn-sm" value="<?php echo $salida->idTraslado;?>" data-toggle="modal" data-target="#modalOb"><span class="fa fa-eye"></span></button></td>
            </tr>
          <?php endforeach;?>
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
        <h5 class="modal-title" id="exampleModalLabel">Orden de Despacho</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
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
        <button type="button" class="btn btn-sm btn-primary btn-print" id="printt"><span class="fa fa-print"> Imprimir</span></button>
      </div>
    </div>
  </div>
</div>
