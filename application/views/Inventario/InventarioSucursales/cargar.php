 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Cargar Inventario</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>/Inventario/Inventario"><span class="font-weight-bold">Invetario</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Cargar Inventario</span></li>
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
  <form action="<?php echo base_url();?>Inventario/Inventario/cargar2" id="formcompras" method="POST">

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label for="">Producto:</label>
      <div class="input-group">
        <input type="hidden" class="form-control" id="sucursal" name="sucursal" value="<?php echo $sucursal;?>" style="margin:0px auto; display:block;">
        <input type="text" class="form-control" id="bprod"  style="margin:0px auto; display:block;">
        <span class="btn-group">
          <button class="btn btn-primary btn-sm" type="button" id="btn-producto-carga" ><span class="fa fa-check" style="font-size: 14pt;"></span> </button>
          <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#modal-adPro" ><span class="fa fa-plus" style="font-size: 14pt;"></span></button>
        </span>
      </div>
    </div>
  </div>
</div> 
<div class="form-group" style="overflow-x:scroll">
  <div class="col-lg-12">
    <table id="tbcargo" class="table table-bordered table-striped table-hover w-auto" >
      <thead>
        <tr>
          <th class="text-center">Codigo Producto</th>
          <th>Nombre</th>
          <th>Cantidad</th>
          <th>Quitar</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>
<style type="text/css">
input[data-readonly] {
  pointer-events: none;
}
</style>

<div class="form-group">
  <button type="submit" class="btn btn-success btn-flat">Guardar</button>
  <a href="<?php echo base_url();?>Inventario/Inventario/sucursal/<?php echo $sucursal ?>" class="btn btn-danger btn-flat">Cancelar</a>
</div>
</form>
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