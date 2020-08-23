 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Realizar Venta</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Inventario"><span class="font-weight-bold">Invetario</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Ventas"><span class="font-weight-bold">Venta</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Nueva Venta</span></li>
    </ol>
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
  <form id="formcompras" action="<?php echo base_url();?>Inventario/Ventas/store" method="POST">
    <!--div class="row">
     <div class="col-md-3">
      <div class="form-group">
        <label for="">Comprobante:</label>
        <select name="comprobantes" id="comprobantes" class="form-control" required>
          <option value="">Seleccione...</option>
          <?php foreach($comprobante as $comprobantes):?>
            <option value="<?php echo $comprobantes->idTipoDoc?>"><?php echo $comprobantes->tipoDocumento?></option>
          <?php endforeach;?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Numero:</label>
        <input type="text" class="form-control" name="numero" id="numero" required="">
      </div>
    </div>
  </div-->

  <div class="row">
    <style type="text/css">
    input[data-readonly] {
      pointer-events: none;
    }
  </style>
  <div class="col-md-5">
    <div class="form-group">
      <label for="">Producto:</label>
      <div class="input-group">
        <input type="text" class="form-control" id="bproVenta" style="margin:0px auto; display:block;">
        <span class="btn-group">
          <button class="btn btn-primary btn-sm" type="button" id="btn-pro" ><span class="fa fa-check" style="font-size: 14pt;"></span> </button>
          <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#modal-adPro" ><span class="fa fa-plus" style="font-size: 14pt;"></span></button>
        </span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="">Fecha de Venta:</label>
      <input type="date" class="form-control" name="fecha" id="fecha" readonly="">
    </div>
  </div>
</div> 

  <div class="col-md-8">
    <table id="tbventas" class="table table-bordered table-striped table-hover" >
      <thead>
        <tr>
          <th style="display:none;">Codigo Producto</th>
          <th style="display:none;">Codigo Lote</th>
          <th style="font-family: Arial; font-size: 12pt;">Nombre</th>
          <th style="display:none;">Presentacion</th>
          <th style="font-family: Arial; font-size: 12pt;">Existencias</th>
          <th style="display:none;">Precio Unitario</th>
          <th style="font-family: Arial; font-size: 12pt;">Cantidad</th>
          <th style="display:none;">IVA</th>
          <th style="display:none;">SubTotal</th>
          <th style="font-family: Arial; font-size: 12pt;">SubTotal</th>
          <th style="font-family: Arial; font-size: 12pt;">Quitar</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div><br>
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <div class="input-group">
        <span class="input-group-text">Total:</span>
        <input style="font-family: Arial; font-size: 14pt;" type="text" id="total" class="form-control" required data-readonly onfocus="this.blur();" name="Total" value="">
      </div>
    </div>
  </div>
  <div class="col-md-3" id="change">
    <div class="input-group">
      <span class="input-group-text">Recibe:</span>
      <input style="font-family: Arial; font-size: 14pt;" type="text" id="recibe" class="form-control" placeholder="" name="recibe" value="0" >
    </div>
  </div>
  <div class="col-md-3">
    <div class="input-group">
      <span class="input-group-text">Cambio:</span>
      <input style="font-family: Arial; font-size: 14pt;" type="text" id="cambio" class="form-control" placeholder="" name="cambio" value="" readonly>
    </div>
  </div>
  <div class="col-md-3">
    <div class="input-group">
      <input style="font-family: Arial; font-size: 25pt;" type="hidden" id="igc2" class="form-control" placeholder="" name="igc2" value="" readonly>
    </div>
  </div>
  <div class="col-md-3">
    <div class="input-group">
      <input style="font-family: Arial; font-size: 25pt;" type="hidden" class="form-control" placeholder="" name="subtotal" readonly="readonly">
    </div>
  </div>
</div>

<div class="form-group">
  <button type="submit" class="btn btn-success btn-flat" style="font-family: Arial; font-size: 14pt;">OK</button>
  <a href="<?php echo base_url();?>Inventario/Compras" class="btn btn-danger btn-flat" style="font-family: Arial; font-size: 14;">Cancelar</a>
</div>
</form>
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
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
