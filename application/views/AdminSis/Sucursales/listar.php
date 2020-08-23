 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Listado de Sucursales</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Administracion/AdminMenu"><span class="font-weight-bold">Administración</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Sucursales</span></li>
    </ol>

    <div class="row">
      <a href="<?php echo base_url();?>Administracion/Sucursales/agregar" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Nueva Sucursal</span></a>&nbsp;&nbsp;
      <?php if ($estado==1): ?>
        <div class="row">
          <div class="col-md-12">
            <a href="<?php echo base_url();?>Administracion/Sucursales/index/0" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Deshabilitados</span></a>
          </div>
        </div>
      <?php else: ?>
        <div class="row">
          <div class="col-md-12">
            <a href="<?php echo base_url();?>Administracion/Sucursales/index/1" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Habilitados</span></a>
          </div>
        </div>
      <?php endif ?>
    </div> <br>
  </div>


  <div class="container">
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
    <div class="col-md-2"></div>
    <div class="col-md-7" style="overflow: auto">
      <table id="cv" class="table display table-striped table-hover table-bordered table-sm font-weight-bold text-center" cellspacing="0" width="100%">
        <thead class="blue-gradient text-white">
          <tr>

            <th class="th-sm font-weight-bold">Id</th>
            <th class="th-sm font-weight-bold">Sucursal</th>
            <th class="th-sm font-weight-bold">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($sucursales)): ?>
            <?php foreach ($sucursales as $sucursal): ?>
              <tr>
                <td><?php echo $sucursal->idSucursal;?></td>
                <td><?php echo $sucursal->sucursal;?></td>
                <td><button class=" btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false"></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo base_url();?>Administracion/Sucursales/editar/<?php echo $sucursal->idSucursal;?>"><i class="fas fa-fw fa-edit"></i> Editar</a>
                    <?php if ($estado==1): ?>                        

                      <button id="eliminar" value="<?php echo base_url();?>Administracion/Sucursales/deshabilitar/" data-id="<?php echo $sucursal->estadoSucursal;?>" class="dropdown-item"><i class="fas fa-fw fa-eye-slash"></i> Deshabilitar</button>
                    </div>
                  </td>
                <?php else: ?>
                  <button id="eliminar" value="<?php echo base_url();?>Administracion/Sucursales/deshabilitar/" data-id="<?php echo $sucursal->estadoSucursal;?>" class="dropdown-item"><i class="fas fa-fw fa-eye"></i> Habilitar</button>
                </div>
              </td>
            <?php endif ?>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </tbody>
  </table>
</div>
</div><br>
</div>