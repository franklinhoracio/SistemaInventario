 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Observaciones</title>
</head>
<body>
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
    <form action="<?php echo base_url();?>Inventario/Traslados/storeObservacion" method="POST" >
      <div class="row">
        <div class="col-md-10">
          <div class="form-group <?php echo !empty(form_error("observacion"))?'has-danger':''?>">   
            <label for="observacion">Observación:</label>
            <textarea class="form-control required" required="" name="observacion" id="observacion" rows="5"></textarea>
            <?php echo form_error("observacion", "<span class='text-danger'>", "</span>");?>
          </div>
          <input type="hidden" name="estado" value="<?php echo $estado;?>">
          <input type="hidden" name="idTraslado" value="<?php echo $idTraslado;?>">
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success btn-flat">Guardar</button>
        <a href="<?php echo base_url();?>Inventario/Inventario" class="btn btn-danger btn-flat">Cancelar</a>
      </div>
    </form>
  </div>