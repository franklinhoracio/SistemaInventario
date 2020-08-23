 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Realizar Venta</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Inventario"><span class="font-weight-bold">Invetario</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Ventas"><span class="font-weight-bold">Venta</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Nueva Venta</span></li>
    </ol>
    <?php if($this->session->flashdata("success")):?>
      <div class="col-md-5">
       <div class="alert alert-success alert-dimissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p><i class="icon fa fa-check"></i><?php echo $this->session->flashdata("success")?></p>
      </div>
    </div>
  <?php endif;?>
  <?php if($this->session->flashdata("error")):?>
    <div class="col-md-5">
     <div class="alert alert-danger alert-dimissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error")?></p>
    </div>
  </div>
<?php endif;?>
<div class="container-fluid">
  <form id="formcompras" action="<?php echo base_url();?>Inventario/Ventas/addDevo" method="POST">
    <div class="row">
      <div class="col-md-7">
        <div class="form-group">   
          <label for="codigoBarra">Codigo de Barra:</label>
          <input type="text" class="form-control required" id="codigoBarra" name="codigoBarra" value="">
          <input type="hidden" class="form-control" id="idProDev" name="idProDev" value="">
          <input type="hidden" class="form-control" id="codigoB" name="codigoB" value="">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">   
          <label for="cantidad">Cantidad:</label>
          <input type="text" class="form-control required" id="cantidadDev" name="cantidadDev" placeholder="0" value="">
        </div>
      </div>
    </div>
    <div class="form-group">
       <button type="submit" class="btn btn-success btn-flat" style="font-family: Arial; font-size: 14pt;">OK</button>
    </div>
  </form>
</div>

<!--modal para devolver producto-->
