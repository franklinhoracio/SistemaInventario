 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Agregar Factura/Compra</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>/Inventario/Inventario"><span class="font-weight-bold">Invetario</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Compras"><span class="font-weight-bold">Compras/Facturas</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Nueva Factura/Compra</span></li>
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
  <form action="<?php echo base_url();?>Inventario/Compras/store" id="formcompras" method="POST">
    <div class="row">
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
        <input type="text" class="form-control" name="numero" required="">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="">Proveedor:</label>
        <div class="input-group">
          <input type="hidden" name="idproveedor" id="idproveedor" required>
          <input type="text" class="form-control" id="proveedor" required>
          <span class="btn-group">
            <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-plus" style="font-size: 14pt;"></span> </button>
          </span>
        </div>
      </div>
    </div>
    <style type="text/css">
    input[data-readonly] {
      pointer-events: none;
    }
  </style>
  <div class="col-md-3">
    <div class="form-group">
      <label for="">Fecha de Compra:</label>
      <input type="date" class="form-control" name="fecha" id="fecha" required>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label for="">Producto:</label>
      <div class="input-group">
        <input type="text" class="form-control" id="bpro" style="margin:0px auto; display:block;">
        <span class="btn-group">
          <button class="btn btn-primary btn-sm" type="button" id="btn-producto" ><span class="fa fa-check" style="font-size: 14pt;"></span> </button>
          <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#modal-adPro" ><span class="fa fa-plus" style="font-size: 14pt;"></span></button>
        </span>
      </div>
    </div>
  </div>
</div> 
<div class="form-group" style="overflow-x:scroll">
  <div class="col-lg-12">
    <table id="tbcompra" class="table table-bordered table-striped table-hover w-auto" >
      <thead>
        <tr>
          <th class="text-center">Codigo Producto</th>
          <th style='display:none;'>Codigo Lote</th>
          <th>Nombre</th>
          <th style='display:none;'>Presentacion</th>
          <th>Costo Unitario</th>
          <th>Cantidad</th>
          <th>IVA</th>
          <th>Sub total</th>
          <th>Importe</th>
          <th>Fecha Vencimiento</th>
          <th>Quitar</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <div class="input-group">
        <span class="input-group-text">Subtotal:</span>
        <input type="text" class="form-control" placeholder="" name="subtotal" readonly="readonly">
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="input-group">
      <span class="input-group-text">IVA:</span>
      <input type="text" id="igc2" class="form-control" placeholder="" name="igc2" value="" readonly>
    </div>
  </div>
  <div class="col-md-3">
    <div class="input-group">
      <span class="input-group-text">Total:</span>
      <input type="text" class="form-control" name="total" required data-readonly onfocus="this.blur();">
    </div>
  </div>
</div>
<style type="text/css">
input[data-readonly] {
  pointer-events: none;
}
</style>

<div class="form-group">
  <button type="submit" class="btn btn-success btn-flat">Guardar</button>
  <a href="<?php echo base_url();?>Inventario/Compras" class="btn btn-danger btn-flat">Cancelar</a>
</div>
</form>
</div>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="overflow: auto">
       <form action="" method="POST" id="formulario2">
        <div class="row">
          <div class="col-md-7">
            <div class="form-group">   
              <label for="proveedor">Proveedor:</label>
              <input type="text" class="form-control required" id="proveedores" name="proveedor" value="">
            </div>
            </div>     
            <div class="col-md-4">
              <div class="form-group">   
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control required" id="telefono" name="telefono" value="">
              </div>
            </div>
          </div>
            <div class="form-group">
              <button type="submit" id="btn-prove" class="btn btn-success btn-flat">Guardar</button>
            </div>
      </form>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-adPro">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="overflow: auto">
        <form action="" method="POST" id="formulario" >
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">   
                <label for="producto">Producto:</label>
                <input type="text" class="form-control required" id="producto" name="producto" value="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">   
                <label for="precio">Precio de Venta:</label>
                <input type="text" class="form-control required" id="precio" name="precio" value="">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">   
                <label for="presentacion">Presentacion:</label>
                <select id="presentacion" name="presentacion" class="form-control required">
                  <option selected="" value="">Seleccione..</option>
                  <?php foreach ($presentaciones as $presentacion): ?>
                    <option value="<?php echo $presentacion->idPresentacion?>"><?php echo $presentacion->presentacion?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">   
                <label for="categoria">Categoria:</label>
                <select id="categoria" name="categoria" class="form-control required">
                  <option selected="" value="">Seleccione..</option>
                  <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo $categoria->idCategoria?>"><?php echo $categoria->categoriaProd?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" id="btn-add" class="btn btn-success btn-flat">Guardar</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>