 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Editar Usuarios</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Administracion/AdminMenu"><span class="font-weight-bold">Administración</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Administracion/Usuarios/index/1"><span class="font-weight-bold">Usuarios</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Edición Categoría</span></li>
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
  <form action="<?php echo base_url();?>Administracion/Usuarios/actualizar" method="POST" >
    <input type="hidden" value="<?php echo $empleado->idEmpleado;?>" name="codigo">
    <fieldset class="border p-2">
      <legend class="w-auto">Datos de la Cuenta</legend>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group <?php echo !empty(form_error("usuario"))?'has-danger':''?>">   
            <label for="usuario">Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario->usuario;?>">
            <?php echo form_error("usuario", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="form-group <?php echo !empty(form_error("rol"))?'has-danger':''?>">   
            <label for="rol">Rol:</label>
            <select id="rol" name="rol" class="form-control">
              <?php foreach ($roles as $rol): ?>
                <?php if ($usuario->idRol == $rol->idRol): ?>
                <option selected="" value="<?php echo $rol->idRol?>"><?php echo $rol->rol?></option>
              <?php else: ?>
                <option value="<?php echo $rol->idRol?>"><?php echo $rol->rol?></option>
                <?php endif ?>
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
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $empleado->nombresEmpleado;?>">
            <?php echo form_error("nombre", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group <?php echo !empty(form_error("apellido"))?'has-danger':''?>">   
            <label for="apellido">Apellidos:</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $empleado->apellidosEmpleado;?>">
            <?php echo form_error("apellido", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>      
        <div class="col-md-3">
          <div class="form-group <?php echo !empty(form_error("dui"))?'has-danger':''?>">   
            <label for="dui">DUI</label>
            <input type="text" class="form-control" id="dui" name="dui" value="<?php echo $empleado->dui;?>">
            <?php echo form_error("dui", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="form-group <?php echo !empty(form_error("nit"))?'has-danger':''?>">   
            <label for="nit">NIT:</label>
            <input type="text" class="form-control" id="nit" name="nit" value="<?php echo $empleado->nit;?>">
            <?php echo form_error("nit", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group <?php echo !empty(form_error("telefono"))?'has-danger':''?>">   
            <label for="telefono">Telefono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $empleado->telefono;?>">
            <?php echo form_error("telefono", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>      
        <div class="col-md-3">
          <div class="form-group <?php echo !empty(form_error("correo"))?'has-danger':''?>">   
            <label for="correo">Correo</label>
            <input type="text" class="form-control" id="correo" name="correo" value="<?php echo $empleado->correo;?>">
            <?php echo form_error("correo", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group <?php echo !empty(form_error("direccion"))?'has-danger':''?>">   
            <label for="direccion">Direccion:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $empleado->direccion;?>">
            <?php echo form_error("direccion", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group <?php echo !empty(form_error("cargo"))?'has-danger':''?>">   
            <label for="cargo">Cargo:</label>
            <select id="cargo" name="cargo" class="form-control">
              <?php foreach ($cargos as $cargo): ?>
                <?php if ($empleado->idCargo == $cargo->idCargo): ?>
                <option selected="" value="<?php echo $cargo->idCargo?>"><?php echo $cargo->cargo?></option>
              <?php else: ?>
                <option value="<?php echo $cargo->idCargo?>"><?php echo $cargo->cargo?></option>
              <?php endif ?>
              <?php endforeach ?>
            </select>
            <?php echo form_error("cargo", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group <?php echo !empty(form_error("sucursal"))?'has-danger':''?>">   
            <label for="sucursal">Sucursal:</label>
            <select id="sucursal" name="sucursal" class="form-control">
              <?php foreach ($sucursales as $sucursal): ?>
                <?php if ($empleado->idSucursal == $sucursal->idSucursal): ?>
                <option selected="" value="<?php echo $sucursal->idSucursal?>"><?php echo $sucursal->sucursal?></option>
              <?php else: ?>
                <option  value="<?php echo $sucursal->idSucursal?>"><?php echo $sucursal->sucursal?></option>
              <?php endif ?>
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