 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Realizar Devolución</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Devoluciones"><span class="font-weight-bold">Invetario</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Nueva Devolución</span></li>
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
  <form action="<?php echo base_url();?>Inventario/Devoluciones/store" method="POST">
    <div class="row">
     <div class="col-md-3">
      <div class="form-group">
        <label for="">Comprobante:</label>
        <select name="comprobantes" id="comprobantes" class="form-control" required>
          <option value="">Seleccione...</option>
          <?php foreach($comprobante as $comprobantes):?>
            <?php if ($comprobantes->tipoDocumento == "Req. Devolucion"): ?>
              <?php $datacomprobante = $comprobantes->idTipoDoc."*".$comprobantes->cantidad?>
              <option value="<?php echo $datacomprobante?>"><?php echo $comprobantes->tipoDocumento?></option>
            <?php endif ?>
          <?php endforeach;?>
        </select>
        <input type="hidden" id="idcomprobante" name="idcomprobante">
        <input type="hidden" id="cantidad" name="cantidad">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Numero:</label>
        <input type="text" class="form-control" name="numero" id="numero" readonly="" required="">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Fecha de devolución:</label>
        <input type="date" class="form-control" name="fecha" id="fecha" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Sucursal que devuelve:</label>
        <div class="input-group">
          <input type="hidden" name="idsucursal" id="idsucursal" required=>
          <input type="text" class="form-control" id="sucursal" required data-readonly onfocus="this.blur();">
          <span class="btn-group">
            <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span> </button>
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Sucursal que recibe:</label>
        <div class="input-group">
          <input type="hidden" name="idsucursalr" id="idsucursalr" required=>
          <input type="text" class="form-control" id="sucursalr" required data-readonly onfocus="this.blur();">
          <span class="btn-group">
            <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal-defaulte" ><span class="fa fa-search"></span> </button>
          </span>
        </div>
      </div>
    </div>
    <style type="text/css">
    input[data-readonly] {
      pointer-events: none;
    }
  </style>
  
</div>
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label for="">Productos:</label>
      <div class="input-group">
        <input type="hidden" name="producto" id="producto">
        <span class="btn-group">
          <button id="proInventarioDev" class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal-productos" ><span class="fa fa-search"></span> </button>
        </span>
      </div>
    </div>
  </div>

  <!--div class="col-md-4">
    <div class="form-group">
      <label for="">Transportista:</label>
      <div class="input-group">
        <input type="hidden" name="trasnportista" id="trasnportista" required=>
        <input type="text" class="form-control" id="trasn" readonly>
        <span class="btn-group">
          <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal-trasnportista" ><span class="fa fa-search"></span> </button>
        </span>
      </div>
    </div>
  </div-->
  <style type="text/css">
  input[data-readonly] {
    pointer-events: none;
  }
</style>
</div>

<div class="form-group" style="overflow-x:scroll">
  <div class="col-md-12">
    <table id="tbdevolucion" class="table table-bordered table-striped table-hover" >
      <thead>
        <tr>
          <th style="display:none;">Codigo Producto</th>
          <th style="display:none;">Codigo Lote</th>
          <th>Nombre</th>
          <th style='display:none;'>Presentacion</th>
          <th>Existencias</th>
          <th>Precio Actual</th>
          <th>Precio Nuevo</th>
          <th>Cantidad</th>
          <th>Importe</th>
          <th>Quitar</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>
<div class="col-md-3">
  <div class="form-group">
    <div class="input-group">
      <span class="input-group-text">Total:</span>
      <input type="text" class="form-control" placeholder="" name="Total" required data-readonly onfocus="this.blur();">
    </div>
  </div>
</div><div class="col-md-9"></div>

<div class="form-group">
  <div class="col-md-12">
    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
    <?php if ($this->session->userdata("cargo")!="Vendedor"): ?>  
    <a href="<?php echo base_url();?>Inventario/Devoluciones" class="btn btn-danger btn-flat">Cancelar</a>
    <?php else: ?>
    <a href="<?php echo base_url();?>Dashboard/portalVendedor" class="btn btn-danger btn-flat">Cancelar</a>
    <?php endif ?>
  </div>

</div>
</form>
</div>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sucursales</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="overflow: auto">
        <table id="" class="table display table-bordered table-striped table-hover display text-center">
          <thead>
            <tr>
              <th>Sucursal</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php  if(!empty($sucursales)):?>
              <?php foreach ($sucursales as $sucursal):?>
               <tr>
                <td><?php echo $sucursal->sucursal;?></td>
                <?php $datasucursal = $sucursal->idSucursal."*".$sucursal->sucursal; ?>
                <td>
                  <button type="button" class="btn btn-success btn-check btn-sm" value="<?php echo $datasucursal?>"><span class="fa fa-check"></span></button>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-left btn-sm" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modal-defaulte">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sucursales</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="overflow: auto">
        <table id="" class="table display table-bordered table-striped table-hover display text-center">
          <thead>
            <tr>
              <th>Sucursal</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php  if(!empty($sucursales)):?>
              <?php foreach ($sucursales as $sucursal):?>
               <tr>
                <td><?php echo $sucursal->sucursal;?></td>
                <?php $datasucursal = $sucursal->idSucursal."*".$sucursal->sucursal; ?>
                <td>
                  <button type="button" class="btn btn-success btn-check2 btn-sm" value="<?php echo $datasucursal?>"><span class="fa fa-check"></span></button>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-left btn-sm" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modal-productos">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="overflow: auto">
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger pull-left btn-sm" data-dismiss="modal">Cerrar</button>
  </div>
</div>
</div>
</div>

<div class="modal fade" id="modal-trasnportista">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="overflow: auto">
       <table id="" class="table display table-bordered table-striped table-hover text-center">
        <thead>
          <tr>
            <th class="th-sm font-weight-bold">Id</th>
            <th class="th-sm font-weight-bold">Usuario</th>
            <th class="th-sm font-weight-bold">Nombre</th>
            <th class="th-sm font-weight-bold">Correo</th>
            <th class="th-sm font-weight-bold">Rol</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php  if(!empty($trasnportistas)):?>
            <?php foreach ($trasnportistas as $trasnportista):?>
             <tr>
              <td><?php echo $trasnportista->idUsuario;?></td>
              <td><?php echo $trasnportista->usuario;?></td>
              <td><?php echo $trasnportista->Nombre;?></td>
              <td><?php echo $trasnportista->correo;?></td>
              <td><?php echo $trasnportista->rol;?></td>
              <?php $datatrasn = $trasnportista->idUsuario."*".$trasnportista->Nombre; ?>
              <td>
                <button type="button" id="transpor" class="btn btn-success btn-sm" value="<?php echo $datatrasn?>"><span class="fa fa-check"></span></button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger pull-left btn-sm" data-dismiss="modal">Cerrar</button>
  </div>
</div>
</div>
</div>

