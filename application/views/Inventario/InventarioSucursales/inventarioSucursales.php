<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Inventario</title>
</head>
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header font-weight-bold"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Inventario</h3>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Inventarios</span></li>
  </ol>
</div>
</div>
    <?php if($this->session->flashdata("success")):?>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5">
         <div class="alert alert-success alert-dimissible text-center">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <p><i class=""></i><?php echo $this->session->flashdata("success")?></p>
        </div>
      </div>
    </div>
  <?php endif;?>
<div class="row">
    <?php  if(!empty($sucursales)):?>
        <?php foreach ($sucursales as $sucursal):?>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white teal lighten-2 o-hidden h-100">
              <a class="card-body text-white " href="<?php echo base_url();?>Inventario/Inventario/sucursal/<?php echo $sucursal->idSucursal; ?>">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-boxes"></i>
                    </div>

                </div>
                    <div class="mr-5">Inventario Sucursal <?php echo $sucursal->sucursal; ?> </div>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>
<div class="row">

  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white teal lighten-2 o-hidden h-100">
        <a class="card-body text-white " href="<?php echo base_url(); ?>Inventario/Devoluciones/inventarioDevoluciones">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-boxes"></i>
                </div>

            </div>
            
            <div class="mr-5">Inventario Devoluciones</div>
        </a>
    </div>
</div>
</div>
