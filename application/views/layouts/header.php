<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo base_url();?>assets/Recursos/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/Recursos/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/Recursos/css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/Recursos/css/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/Recursos/mdb/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/Recursos/mdb/mdb.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/Recursos/mdb/style.css" rel="stylesheet">
    <link href='<?php echo base_url();?>assets/Recursos/css/fullcalendar.min.css' rel='stylesheet' />
    <link href='<?php echo base_url();?>assets/Recursos/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <!--link href="<?php echo base_url();?>assets/Recursos/css/bootstrap-datetimepicker.min.css" rel="stylesheet"-->
    <link href="<?php echo base_url();?>assets/Recursos/css/sweetalert2.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/Recursos/datatables-export/css/buttons.dataTables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>


</head>
<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark mdb-color lighten-2 static-top">

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>


        <img src="" class="img-fluid" width="60" alt=""><span class="font-weight-bold text-white">Irasol<span class="lite"> S.A. de C.V.</span></span></a>

        <!-- accesos directos -->
        <?php if ($this->session->userdata("cargo")!="Vendedor"): ?>    
        <ul class="navbar-nav ml-auto nav-flex-icon">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-sort-down fa-fw"></i><span class="font-weight-bold text-white">Accesos Directos</span>
                </a>
                <div class="dropdown-menu dropdown" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo base_url();?>Inventario/Compras/agregar/<?php echo $this->session->userdata("idSucursal")?>" >Realizar Compra</a>
                    <a class="dropdown-item" href="<?php echo base_url();?>Inventario/Traslados/agregar/<?php echo $this->session->userdata("idSucursal")?>" >Realizar Traslado</a>
                    <a class="dropdown-item" href="<?php echo base_url();?>Inventario/Ventas/agregar/<?php echo $this->session->userdata("idSucursal")?>" >Realizar Venta</a>
                </div>
            </li>
        </ul>
        <?php endif ?>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto nav-flex-icon">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i><span class="font-weight-bold text-white"><?php echo $this->session->userdata("usuario")?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo base_url();?>auth/logout" >Cerrar sesión</a>
                    <a class="dropdown-item" href="<?php echo base_url();?>Administracion/Usuarios/editarClave/<?php echo $this->session->userdata("idUsuario");?>" >Cambiar Contraseña</a>
                </div>
            </li>
        </ul>

    </nav>

    <div id="wrapper">

        <!-- Sidebar -->
        <?php if ($this->session->userdata("cargo")!="Vendedor"): ?>  
        <ul class="sidebar navbar-nav mdb-color lighten-2 toggled">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url();?>Dashboard">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>Administracion/AdminMenu">
                    <i class="fas fa-user-cog"></i>
                    <span class="font-weight-bold text-white">Administración</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>Inventario/Inventario">
                        <i class="fas fa-dolly-flatbed"></i>
                        <span class="font-weight-bold text-white">Inventario</span></a>
                    </li>
                    <?php if ($this->session->userdata("rol") != "Administrador" and $this->session->userdata("rol") != "Gerente"): ?>
                        <ul class="navbar-nav ml-auto nav-flex-icon">
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-shipping-fast fa-fw"></i><span class="font-weight-bold text-white">Traslados</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="<?php echo base_url();?>Inventario/Traslados/index2/<?php echo $this->session->userdata("idSucursal")?>/Recibido" >En camino</a>
                                    <a class="dropdown-item" href="<?php echo base_url();?>Inventario/Traslados/index/<?php echo $this->session->userdata("idSucursal")?>/Enviado" >Entregados/Pendientes</a>
                                </div>
                            </li>
                        </ul>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>Inventario/Traslados/traslados">
                                <i class="fas fa-shipping-fast"></i>
                                <span class="font-weight-bold text-white">Traslados</span></a>
                            </li>
                        <?php endif ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>Reportes/ReportesMenu">
                                <i class="fas fa-file-alt"></i>
                                <span class="font-weight-bold text-white">Reportería</span></a>
                            </li>
                        </ul>
                        <?php endif ?>
                        <div id="content-wrapper">
                            <div class="container-fluid">
