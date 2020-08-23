 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Agregar Usuario</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Administracion/AdminMenu"><span class="font-weight-bold">Administracion</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Administracion/Usuarios/index/1"><span class="font-weight-bold">Usuarios</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Nuevo Usuario</span></li>
    </ol>
  </div>
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
  <form action="<?php echo base_url();?>Administracion/Usuarios/store" method="POST" >
    <fieldset class="border p-2">
      <legend class="w-auto">Datos de la Cuenta</legend>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group <?php echo !empty(form_error("usuario"))?'has-danger':''?>">   
            <label for="usuario">Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo set_value("usuario");?>">
            <?php echo form_error("usuario", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
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
      <div class="row">
        <div class="col-md-3">
          <div class="form-group <?php echo !empty(form_error("rol"))?'has-danger':''?>">   
            <label for="rol">Rol:</label>
            <select id="rol" name="rol" class="form-control">
              <option selected="" value="">Seleccione..</option>
              <?php foreach ($roles as $rol): ?>
                <option <?= set_value("rol")== $rol->idRol ? 'selected' : '';?> value="<?php echo $rol->idRol?>"><?php echo $rol->rol?></option>
              <?php endforeach ?>
            </select>
            <?php echo form_error("rol", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
      </div>
    </fieldset>
    <br>
    <fieldset class="border p-2">
      <legend class="w-auto">Datos del Usuario</legend>
      <div class="row">
          <div class="col-md-4">
            <div class="form-group <?php echo !empty(form_error("nombre"))?'has-danger':''?>">   
              <label for="nombre">Nombres:</label>
              <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo set_value("nombre");?>">
              <?php echo form_error("nombre", "<span class='text-danger'>", "</span>");?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group <?php echo !empty(form_error("apellido"))?'has-danger':''?>">   
              <label for="apellido">Apellidos:</label>
              <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo set_value("apellido");?>">
              <?php echo form_error("apellido", "<span class='text-danger'>", "</span>");?>
            </div>
          </div>      
          <div class="col-md-3">
            <div class="form-group <?php echo !empty(form_error("dui"))?'has-danger':''?>">   
              <label for="dui">DUI</label>
              <input type="text" class="form-control" id="dui" name="dui" value="<?php echo set_value("dui");?>">
              <?php echo form_error("dui", "<span class='text-danger'>", "</span>");?>
            </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-3">
            <div class="form-group <?php echo !empty(form_error("nit"))?'has-danger':''?>">   
              <label for="nit">NIT:</label>
              <input type="text" class="form-control" id="nit" name="nit" value="<?php echo set_value("nit");?>">
              <?php echo form_error("nit", "<span class='text-danger'>", "</span>");?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group <?php echo !empty(form_error("telefono"))?'has-danger':''?>">   
              <label for="telefono">Telefono:</label>
              <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo set_value("telefono");?>">
              <?php echo form_error("telefono", "<span class='text-danger'>", "</span>");?>
            </div>
          </div>      
          <div class="col-md-3">
            <div class="form-group <?php echo !empty(form_error("correo"))?'has-danger':''?>">   
              <label for="correo">Correo</label>
              <input type="text" class="form-control" id="correo" name="correo" value="<?php echo set_value("correo");?>">
              <?php echo form_error("correo", "<span class='text-danger'>", "</span>");?>
            </div>
          </div>
        </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group <?php echo !empty(form_error("direccion"))?'has-danger':''?>">   
            <label for="direccion">Direccion:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo set_value("direccion");?>">
            <?php echo form_error("direccion", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group <?php echo !empty(form_error("cargo"))?'has-danger':''?>">   
            <label for="cargo">Cargo:</label>
            <select id="cargo" name="cargo" class="form-control">
              <option selected="" value="">Seleccione..</option>
              <?php foreach ($cargos as $cargo): ?>
                <option <?= set_value("cargo")== $cargo->idCargo ? 'selected' : '';?> value="<?php echo $cargo->idCargo?>"><?php echo $cargo->cargo?></option>
              <?php endforeach ?>
            </select>
            <?php echo form_error("cargo", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group <?php echo !empty(form_error("sucursal"))?'has-danger':''?>">   
            <label for="sucursal">Sucursal:</label>
            <select id="sucursal" name="sucursal" class="form-control">
              <option selected="" value="">Seleccione..</option>
              <?php foreach ($sucursales as $sucursal): ?>
                <option <?= set_value("sucursal")== $sucursal->idSucursal ? 'selected' : '';?> value="<?php echo $sucursal->idSucursal?>"><?php echo $sucursal->sucursal?></option>
              <?php endforeach ?>
            </select>
            <?php echo form_error("sucursal", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
      </div>
    </fieldset>
    <div class="form-group">
      <button type="submit" class="btn btn-success btn-flat">Guardar</button>
      <a href="<?php echo base_url();?>Administracion/Usuarios/index/1" class="btn btn-danger btn-flat">Cancelar</a>
    </div>
  </form>
</div>