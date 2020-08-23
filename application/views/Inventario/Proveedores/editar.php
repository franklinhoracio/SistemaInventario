 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Editar Proveedor</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Inventario"><span class="font-weight-bold">Inventario</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Proveedores/index/1"><span class="font-weight-bold">Proveedores</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Edición Proveedor</span></li>
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
  <form action="<?php echo base_url();?>Inventario/Proveedores/actualizar" method="POST" >
    <input type="hidden" value="<?php echo $proveedor->idProveedor;?>" name="codigo">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group <?php echo !empty(form_error("proveedor"))?'has-danger':''?>">   
          <label for="proveedor">Proveedor:</label>
          <input type="text" class="form-control" id="proveedor" name="proveedor" value="<?php echo $proveedor->proveedor;?>">
          <?php echo form_error("proveedor", "<span class='text-danger'>", "</span>");?>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group <?php echo !empty(form_error("registroFiscal"))?'has-danger':''?>">   
          <label for="registroFiscal">Registro Fiscal:</label>
          <input type="text" class="form-control" id="registroFiscal" name="registroFiscal" value="<?php echo $proveedor->registroFiscal;?>">
          <?php echo form_error("registroFiscal", "<span class='text-danger'>", "</span>");?>
        </div>
      </div>
    </div>
    <div class="row">      
      <div class="col-md-3">
        <div class="form-group <?php echo !empty(form_error("telefono"))?'has-danger':''?>">   
          <label for="telefono">Teléfono:</label>
          <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $proveedor->telefono;?>">
          <?php echo form_error("telefono", "<span class='text-danger'>", "</span>");?>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group <?php echo !empty(form_error("correo"))?'has-danger':''?>">   
          <label for="correo">Correo:</label>
          <input type="text" class="form-control" id="correo" name="correo" value="<?php echo $proveedor->correo;?>">
          <?php echo form_error("correo", "<span class='text-danger'>", "</span>");?>
        </div>
      </div>
    </div>
    <div class="row">      
      <div class="col-md-3">
        <div class="form-group <?php echo !empty(form_error("nombreContacto"))?'has-danger':''?>">   
          <label for="nombreContacto">Contacto:</label>
          <input type="text" class="form-control" id="nombreContacto" name="nombreContacto" value="<?php echo $proveedor->nombreContacto;?>">
          <?php echo form_error("nombreContacto", "<span class='text-danger'>", "</span>");?>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group <?php echo !empty(form_error("telefonoContacto"))?'has-danger':''?>">   
          <label for="telefonoContacto">Teléfono Contacto:</label>
          <input type="text" class="form-control" id="telefonoContacto" name="telefonoContacto" value="<?php echo $proveedor->telefonoContacto;?>">
          <?php echo form_error("telefonoContacto", "<span class='text-danger'>", "</span>");?>
        </div>
      </div>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success btn-flat">Guardar</button>
      <a href="<?php echo base_url();?>Inventario/Proveedores/index/1" class="btn btn-danger btn-flat">Cancelar</a>
    </div>
  </form>
</div>