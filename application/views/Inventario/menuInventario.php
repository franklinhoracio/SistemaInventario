<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Inventario</title>
</head>
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header font-weight-bold"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Inventario</h3>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Inventario</span></li>
  </ol>
</div>
</div>
<div class="row">

  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white teal lighten-2 o-hidden h-100">
        <a class="card-body text-white " href="<?php echo base_url();?>Inventario/Productos/index/1">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-boxes"></i>
                </div>

            </div>
            
            <div class="mr-5">Productos</div>
        </a>
    </div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white teal lighten-2 o-hidden h-100">
        <a class="card-body text-white " href="<?php echo base_url();?>Administracion/Categorias/index/1">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-archive"></i>
                </div>

            </div>
            
            <div class="mr-5">Categorias Productos</div>
        </a>
    </div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white teal lighten-2 o-hidden h-100">
        <a class="card-body text-white " href="<?php echo base_url();?>Administracion/Presentaciones/index/1">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-prescription-bottle"></i>
                </div>

            </div>
            
            <div class="mr-5">Presentaciones</div>
        </a>
    </div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white teal lighten-2 o-hidden h-100">
        <a class="card-body text-white " href="<?php echo base_url();?>Inventario/Proveedores/index/1">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-user-tie"></i>
                </div>

            </div>
            
            <div class="mr-5">Proveedores</div>
        </a>
    </div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white teal lighten-2 o-hidden h-100">
        <a class="card-body text-white " href="<?php echo base_url();?>Inventario/Inventario/sucursales">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-boxes"></i>
                </div>

            </div>
            
            <div class="mr-5">Inventarios</div>
        </a>
    </div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white teal lighten-2 o-hidden h-100">
        <a class="card-body text-white " href="<?php echo base_url();?>Inventario/Compras">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                </div>

            </div>
            
            <div class="mr-5">Compras</div>
        </a>
    </div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white teal lighten-2 o-hidden h-100">
        <a class="card-body text-white " href="<?php echo base_url();?>Inventario/Traslados/Agregar/<?php echo $this->session->userdata("idSucursal")?>">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-shipping-fast"></i>
                </div>

            </div>
            
            <div class="mr-5">Realizar Traslados</div>
        </a>
    </div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white teal lighten-2 o-hidden h-100">
        <a class="card-body text-white " href="<?php echo base_url();?>Inventario/Ventas/index2/<?php echo $this->session->userdata("idSucursal")?>">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-file-invoice-dollar"></i>
                </div>

            </div>
            
            <div class="mr-5">Ventas</div>
        </a>
    </div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white teal lighten-2 o-hidden h-100">
        <a class="card-body text-white " href="<?php echo base_url();?>Inventario/Devoluciones">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-undo"></i>
                </div>

            </div>
            
            <div class="mr-5">Devolución Tienda</div>
        </a>
    </div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white teal lighten-2 o-hidden h-100">
        <a class="card-body text-white " href="<?php echo base_url();?>Inventario/Consumos">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-undo"></i>
                </div>

            </div>
            
            <div class="mr-5">Comsumo Interno</div>
        </a>
    </div>
</div>
</div>