<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Login</title>
	<link href="<?php echo base_url();?>assets/Recursos/login/estilos.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/Recursos/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><link href="<?php echo base_url();?>assets/Recursos/mdb/mdb.min.css" rel="stylesheet">

</head>
<body class="">
		
	<form  class="login" action="<?php echo base_url();?>Auth/Login" method="POST" >
		<p class="h1 cyan-text text-center"><i class="fas fa-user-lock"></i></p>
		<p class="h5 text-center cyan-text">Introduzca sus credenciales</p><br>
		<?php if($this->session->flashdata("error")):?>
		<div class="col-md-12">
         <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <p class="text-center"><?php echo $this->session->flashdata("error")?></p>
        </div>
      </div>
      <?php endif;?>
		<div class="form-group">
			<label for="usuario" class="cyan-text text-center">Usuario</label>
			<input type="text" class="form-control" name="usuario" id="usuario" placeholder="Escribe tu usuario"  required="" autofocus>
		</div>
		<div class="form-group">
			<label for="pass" class="cyan-text text-center">Contraseña</label>
			<input type="password" class="form-control" name="pass" id="pass" placeholder="Escribe tu contraseña" required="">
		</div>
		<p class="text-center">
			<button type="submit" class="btn btn-success btn-flat">Ingresar</button>
		</p>
	</form>
	<script src="<?php echo base_url();?>assets/Recursos/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/Recursos/login/bootstrap.min.js"></script>
</body>
</html>