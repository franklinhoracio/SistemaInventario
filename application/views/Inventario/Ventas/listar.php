 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Listado de Ventas</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Inventario"><span class="font-weight-bold">Inventario</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Ventas</span></li>
    </ol>
    <div class="row">
      <div class="col-md-2"></div>
      <a href="<?php echo base_url();?>Inventario/Ventas/agregar/<?php echo $this->session->userdata("idSucursal")?>" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Realizar Venta</span></a>
    </div> <br>
  </div>


  <div class="container">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8" style="overflow: auto">
        <table id="cv" class="table display table-striped table-hover table-bordered table-sm w-auto" cellspacing="0" width="100%">
          <thead class="blue-gradient text-white">
            <tr>
              <th class="th-sm font-weight-bold">Codigo</th>
              <th class="th-sm font-weight-bold">Usuario</th>
              <th class="th-sm font-weight-bold">Fecha</th>
              <?php if ($this->session->userdata("rol")=="Administrador"): ?>
              <th style="display:none;" class="th-sm font-weight-bold">Comprobante</th>
              <th style="display:none;" class="th-sm font-weight-bold">Numero Comprobante</th>
              <?php endif ?>
              <th style="display:none;" class="th-sm font-weight-bold">SubTotal</th>
              <th style="display:none;" class="th-sm font-weight-bold">Iva</th>
              <th class="th-sm font-weight-bold">Total Venta</th>
              <?php if ($this->session->userdata("rol")=="Administrador"): ?>
              <th></th>
              <?php endif ?>
            </tr>
          </thead>
          <tbody>
           <?php if (!empty($ventas)): ?>
            <?php foreach($ventas as $venta):?>
              <tr>
                <td><?php echo $venta->idVenta;?></td>
                <td><?php echo $venta->usuario;?></td>
                <td><?php echo date("d/m/Y", strtotime( $venta->fecha));?></td>
                <?php if ($this->session->userdata("rol")=="Administrador"): ?>
                <td style="display:none;"><?php echo $venta->tipoDocumento;?></td>
                <td style="display:none;"><?php echo $venta->numDocumento;?></td>
                <?php endif ?>
                <td style="display:none;"><?php echo $venta->precio;?></td>
                <td style="display:none;"><?php echo $venta->iva;?></td>
                <td>$ <?php echo round($venta->importeVenta,2);?></td>
                <?php if ($this->session->userdata("rol")=="Administrador"): ?>

                <td>
                  <button type="button" id="venta" class="btn btn-info btn-sm" value="<?php echo $venta->idVenta;?>" data-toggle="modal" data-target="#modal-default"><span class="fa fa-search"></span></button>
                </td>
                <?php endif ?>
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
        <h5 class="modal-title" id="exampleModalLabel">Detalle de Venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <!--button type="button" class="btn btn-sm btn-primary btn-printv"><span class="fa fa-print"> </span></button-->
      </div>
    </div>
  </div>
</div>
