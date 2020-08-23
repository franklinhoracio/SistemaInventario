 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Agregar Presentaciones</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Administracion/AdminMenu"><span class="font-weight-bold">Administración</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Administracion/Presentaciones/index/1"><span class="font-weight-bold">Presentaciones</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Nueva Presentación</span></li>
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
    <form action="<?php echo base_url();?>Administracion/Presentaciones/store" method="POST" >
      <div class="row">
        <div class="col-md-3">
          <div class="form-group <?php echo !empty(form_error("presentacion"))?'has-danger':''?>">   
            <label for="presentacion">Presentacion:</label>
            <input type="text" class="form-control" id="presentacion" name="presentacion" value="<?php echo set_value("presentacion");?>">
            <?php echo form_error("presentacion", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success btn-flat">Guardar</button>
        <a href="<?php echo base_url();?>Administracion/Presentaciones/index/1" class="btn btn-danger btn-flat">Cancelar</a>
      </div>
    </form>
  </div>