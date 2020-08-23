 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Editar Comprobante</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Administracion/AdminMenu"><span class="font-weight-bold">Administración</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Administracion/Comprobantes/index/1"><span class="font-weight-bold">Comprobantes</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Edición Comprobante</span></li>
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
  <form action="<?php echo base_url();?>Administracion/Comprobantes/actualizar" method="POST" >
    <input type="hidden" value="<?php echo $comprobante->idTipoDoc;?>" name="codigo">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group <?php echo !empty(form_error("comprobante"))?'has-danger':''?>">   
          <label for="comprobante">Comprobante:</label>
          <input type="text" class="form-control" id="comprobante" name="comprobante" value="<?php echo $comprobante->tipoDocumento;?>">
          <?php echo form_error("comprobante", "<span class='text-danger'>", "</span>");?>
        </div>
      </div>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success btn-flat">Guardar</button>
      <a href="<?php echo base_url();?>Administracion/Comprobantes/index/1" class="btn btn-danger btn-flat">Cancelar</a>
    </div>
  </form>
</div>