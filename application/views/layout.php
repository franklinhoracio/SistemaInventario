<header class="header indigo darken-4">
        <div class="toggle-nav">
          <div class="icon-reorder tooltips" data-placement="bottom"><i class="icon_menu"></i></div>
        </div>

        <!--logo start-->
        <a href="<?php echo base_url();?>auth/index" class="logo"><span class="font-weight-bold">Sis<span class="lite">Inventario</span></span></a>
        <!--logo end-->

        <div class="top-nav nav-collapse">
          <ul class="nav pull-right top-menu">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="profile-ava">
                </span>
                <span class="username"><!--?php echo $this->session->userdata("usuario")?--></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-12 text-center">
                      <a href="<?php echo base_url();?>auth/logout"><span class="font-weight-bold" >Cerrar Sesión</span></a>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </header>

      <link href="<?php echo base_url();?>assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />


              <!-- =============================================== -->

        <!--sidebar start-->
        <aside class="main-sidebar">
          <div id="sidebar" class="nav-collapse indigo darken-4">

            <!-- sidebar menu start-->
            <ul class="sidebar-menu">
              <li class="active">
                <a class="" href="<?php echo base_url();?>Dashboard">
                  <i class="fas fa-home"></i>
                  <span class="font-weight-bold">Inicio</span>
                </a>
              </li>
              <li class="sub-menu">
                <a href="<?php echo base_url();?>Administracion/AdminMenu">
                  <i class="fas fa-user-cog"></i> <span class="font-weight-bold">Administración</span>
                  <span class="pull-right-container">
                    <i class=""></i>
                  </span>
                </a>
                <a href="<?php echo base_url();?>">
                  <i class="fas fa-dolly-flatbed"></i> <span class="font-weight-bold">Inventario</span>
                  <span class="pull-right-container">
                    <i class=""></i>
                  </span>
                </a>
                <a href="<?php echo base_url();?>">
                  <i class="fas fa-file-alt"></i> <span class="font-weight-bold">Reportería</span>
                  <span class="pull-right-container">
                    <i class=""></i>
                  </span>
                </a>
                </li>
              </ul>
          </div>
        </aside>


