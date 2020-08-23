 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Portal Vendedor</title>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white blue o-hidden h-100">
          <a class="card-body text-white " href="<?php echo base_url();?>Inventario/Ventas/agregar/<?php echo $this->session->userdata("idSucursal")?>">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-plus-circle"></i>
              </div>
            </div>
            <div class="mr-5">Venta</div>
          </a>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white red o-hidden h-100">
          <a class="card-body text-white " href="<?php echo base_url();?>Inventario/Devoluciones/agregar">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-minus-circle"></i>
              </div>
            </div>
            <div class="mr-5">Devolución</div>
          </a>
        </div>
      </div>
    </div>
  </div>

