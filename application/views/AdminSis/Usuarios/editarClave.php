 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Cambio Contraseña</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Administracion/AdminMenu"><span class="font-weight-bold">Administración</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Administracion/Usuarios/index/1"><span class="font-weight-bold">Usuarios</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Cambiar Contraseña</span></li>
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
  <form action="<?php echo base_url();?>Administracion/Usuarios/cambiarClave" method="POST" >
    <input type="hidden" value="<?php echo $usuario->idUsuario;?>" name="codigo">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group <?php echo !empty(form_error("usuario"))?'has-danger':''?>">   
          <label for="usuario">Usuario:</label>
          <input type="text" class="form-control" id="usuario" name="usuario" readonly="" value="<?php echo $usuario->usuario;?>">
          <?php echo form_error("usuario", "<span class='text-danger'>", "</span>");?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group <?php echo !empty(form_error("clave"))?'has-danger':''?>">   
          <label for="clave">Contraseña:</label>
          <input type="text" class="form-control" id="clave" name="clave" value="<?php echo set_value("clave");?>">
          <?php echo form_error("clave", "<span class='text-danger'>", "</span>");?>
        </div>
      </div>      
      <div class="col-md-3">
        <div class="form-group <?php echo !empty(form_error("confirmar_clave"))?'has-danger':''?>">   
          <label for="confirmar_clave">Confirmar Contraseña</label>
          <input type="text" class="form-control" id="confirmar_clave" name="confirmar_clave" value="<?php echo set_value("confirmar_clave");?>">
          <?php echo form_error("confirmar_clave", "<span class='text-danger'>", "</span>");?>
        </div>
      </div>
    </div>
  <br>
  <div class="form-group">
    <button type="submit" class="btn btn-success btn-flat">Guardar</button>    <?php if ($this->session->userdata("cargo")!="Vendedor"): ?>  
    <a href="<?php echo base_url();?>Dashboard" class="btn btn-danger btn-flat" style="font-family: Arial; font-size: 14;">Cancelar</a>
    <?php else: ?>
    <a href="<?php echo base_url();?>Dashboard/portalVendedor" class="btn btn-danger btn-flat">Cancelar</a>
    <?php endif ?>
  </div>
</form>
</div>