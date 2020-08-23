 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Editar Inventario</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>/Inventario/Inventario"><span class="font-weight-bold">Invetario</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Editar Producto</span></li>
    </ol>
  </div>
<?php if($this->session->flashdata("error")):?>
  <div class="col-md-5">
   <div class="alert alert-danger alert-dimissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error")?></p>
  </div>
</div>
<?php endif;?>
<div class="container-fluid">
  <form action="<?php echo base_url();?>Inventario/Inventario/editar2" id="formcompras" method="POST">

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label for="">Producto:</label>
      <div class="input-group">
        <input type="hidden" name="idInventario" id="idInventario" value="<?php echo $inventario->idInventario ?>" class="form-control" id="bpro" style="margin:0px auto; display:block;">
        <input type="hidden" name="sucursal" id="sucursal" value="<?php echo $inventario->idSucursal ?>" class="form-control" id="bpro" style="margin:0px auto; display:block;">
        <input type="text" class="form-control" id="bpro" name="bpro" value="<?php echo $inventario->Producto ?>" style="margin:0px auto; display:block;">
        <span class="btn-group">
        </span>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="">Cantidad:</label>
      <div class="input-group">
        <input type="text" class="form-control" id="cantidad" name="cantidad" required="" style="margin:0px auto; display:block;">
        <span class="btn-group">
        </span>
      </div>
    </div>
  </div>
</div> 

<div class="row">
  <div class="col-md-7">
    <div class="form-group">
      <label for="">Motivo/Descripción:</label>
      <div class="input-group">
        <input type="text" class="form-control" id="descripcion" name="descripcion" required=""  placeholder="por la cual modificara la existencia" style="margin:0px auto; display:block;">
        <span class="btn-group">
        </span>
      </div>
    </div>
  </div>
</div> 

<div class="form-group">
  <button type="submit" class="btn btn-success btn-flat">Guardar</button>
  <a href="<?php echo base_url();?>Inventario/Inventario/sucursal/<?php echo $inventario->idSucursal ?>" class="btn btn-danger btn-flat">Cancelar</a>
</div>
</form>
</div>

