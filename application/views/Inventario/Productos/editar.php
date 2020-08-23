 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Editar Presentación</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Inventario"><span class="font-weight-bold">Inventario</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Productos/index/1"><span class="font-weight-bold">Productos</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Edición Producto</span></li>
    </ol>
  </div>
  <?php if($this->session->flashdata("error")):?>
    <div class="col-md-5">
     <div class="alert alert-danger alert-dimissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error")?></p>
    </div>
  </div>
<?php endif;?>
<div class="container-fluid">
  <form action="<?php echo base_url();?>Inventario/Productos/actualizar" method="POST" >
    <input type="hidden" value="<?php echo $producto->idProducto;?>" name="codigo">
    <div class="row">
        <div class="col-md-4">
          <div class="form-group <?php echo !empty(form_error("producto"))?'has-danger':''?>">   
            <label for="producto">Producto:</label>
            <input type="text" class="form-control" id="producto" name="producto" value="<?php echo $producto->producto;?>">
            <?php echo form_error("producto", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group <?php echo !empty(form_error("precio"))?'has-danger':''?>">   
            <label for="precio">Precio de Venta:</label>
            <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $producto->precioCIVA;?>">
            <?php echo form_error("precio", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group <?php echo !empty(form_error("sabores"))?'has-danger':''?>">   
            <label for="sabores">Sabor:</label>
            <input type="text" class="form-control" id="sabores" name="sabores" value="<?php echo $producto->sabores;?>">
            <?php echo form_error("sabores", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>     
        <div class="col-md-3">
          <div class="form-group <?php echo !empty(form_error("codigoBarra"))?'has-danger':''?>">   
            <label for="codigoBarra">Codigo de Barra:</label>
            <input type="text" class="form-control" id="codigoBarra" name="codigoBarra" value="<?php echo $producto->codigoBarra;?>" autofocus>
            <?php echo form_error("codigoBarra", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
      </div>
        <div class="row">
        <div class="col-md-2">
          <div class="form-group <?php echo !empty(form_error("stockMinimo"))?'has-danger':''?>">   
            <label for="stockMinimo">Stock Mínimo:</label>
            <input type="text" class="form-control" id="stockMinimo" name="stockMinimo" value="<?php echo $producto->stockMinimo;?>">
            <?php echo form_error("stockMinimo", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group <?php echo !empty(form_error("presentacion"))?'has-danger':''?>">   
            <label for="presentacion">Presentacion:</label>
            <select id="presentacion" name="presentacion" class="form-control">
              <?php foreach ($presentaciones as $presentacion): ?>
                <?php if ($producto->idPresentacion == $presentacion->idPresentacion): ?>
              <option selected="" value="<?php echo $presentacion->idPresentacion?>"><?php echo $presentacion->presentacion?></option>
            <?php else: ?>
              <option value="<?php echo $presentacion->idPresentacion?>"><?php echo $presentacion->presentacion?></option>
              <?php endif ?>
              <?php endforeach ?>
            </select>
            <?php echo form_error("presentacion", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group <?php echo !empty(form_error("categoria"))?'has-danger':''?>">   
            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" class="form-control">
              <?php foreach ($categorias as $categoria): ?>
                <?php if ($producto->idCategoria == $categoria->idCategoria): ?>
              <option selected="" value="<?php echo $categoria->idCategoria?>"><?php echo $categoria->categoriaProd?></option>
            <?php else: ?>
              <option value="<?php echo $categoria->idCategoria?>"><?php echo $categoria->categoriaProd?></option>
              <?php endif ?>
              <?php endforeach ?>
            </select>
            <?php echo form_error("categoria", "<span class='text-danger'>", "</span>");?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success btn-flat">Guardar</button>
        <a href="<?php echo base_url();?>Inventario/Productos/index/1" class="btn btn-danger btn-flat">Cancelar</a>
      </div>
  </form>
</div>