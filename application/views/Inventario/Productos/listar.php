 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Listado de Productos</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Inventario"><span class="font-weight-bold">Inventario</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Productos</span></li>
    </ol>

    <div class="row">
      <a href="<?php echo base_url();?>Inventario/Productos/agregar" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Nuevo Producto</span></a>&nbsp;&nbsp;
      <?php if ($estado==1): ?>
        <div class="row">
          <div class="col-md-12">
            <a href="<?php echo base_url();?>Inventario/Productos/index/0" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Deshabilitados</span></a>
          </div>
        </div>
      <?php else: ?>
        <div class="row">
          <div class="col-md-12">
            <a href="<?php echo base_url();?>Inventario/Productos/index/1" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Habilitados</span></a>
          </div>
        </div>
      <?php endif ?>
    </div> <br>
  </div>

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


<div class="container">
  <div class="row">
    <div class="col-md-12" style="overflow: auto">
      <table id="cv" class="table display table-striped table-hover table-bordered table-sm font-weight-bold text-center w-auto" cellspacing="0" width="100%">
        <thead class="blue-gradient text-white">
          <tr>

            <th class="th-sm font-weight-bold">Id</th>
            <th class="th-sm font-weight-bold">Producto</th>
            <th class="th-sm font-weight-bold">Precio de Venta</th>
              <!--th class="th-sm font-weight-bold">Codigo de Barra</th>
                <th class="th-sm font-weight-bold">Stock Mínimo</th-->
                  <th class="th-sm font-weight-bold">Categoría</th>
                  <th class="th-sm font-weight-bold">Sabor</th>
                  <th class="th-sm font-weight-bold">Opciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($productos)): ?>
                  <?php foreach ($productos as $producto): ?>
                    <?php $arrayCodigos[]=(string)$producto->codigoBarra;?>
                    <tr>
                      <td><?php echo $producto->idProducto;?></td>
                      <td><?php echo $producto->producto;?></td>
                      <td><?php echo round($producto->precioCIVA,2);?></td>
                  <!--td><svg id='<?php echo "barcode".$producto->codigoBarra; ?>'></svg></td>
                    <td><?php echo $producto->stockMinimo;?></td-->
                      <td><?php echo $producto->categoriaProd;?></td>
                      <td><?php echo $producto->sabores;?></td>
                      <td><button class=" btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"></button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="<?php echo base_url();?>Inventario/Productos/editar/<?php echo $producto->idProducto;?>"><i class="fas fa-fw fa-edit"></i> Editar</a>
                          <?php if ($estado==1): ?>                        

                            <button id="eliminar" value="<?php echo base_url();?>Inventario/Productos/deshabilitar/" data-id="<?php echo $producto->estadoProducto;?>" class="dropdown-item"><i class="fas fa-fw fa-eye-slash"></i> Deshabilitar</button>
                          </div>
                        </td>
                      <?php else: ?>
                        <button id="eliminar" value="<?php echo base_url();?>Inventario/Productos/deshabilitar/" data-id="<?php echo $producto->estadoProducto;?>" class="dropdown-item"><i class="fas fa-fw fa-eye"></i> Habilitar</button>
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
  <script src="<?php echo base_url();?>assets/Recursos/js/JsBarcode.all.min.js"></script>
  <script type="text/javascript">

    function arrayjsonbarcode(j){
      json=JSON.parse(j);
      arr=[];
      for (var x in json) {
        arr.push(json[x]);
      }
      return arr;
    }

    jsonvalor='<?php echo json_encode($arrayCodigos) ?>';
    valores=arrayjsonbarcode(jsonvalor);

    for (var i = 0; i < valores.length; i++) {

      JsBarcode("#barcode" + valores[i], valores[i].toString(), {
        format: "codabar",
        lineColor: "#000",
        width: 2,
        height: 20,
        displayValue: true
      });
    }
    
  </script>