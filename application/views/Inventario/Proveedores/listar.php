 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Listado de Proveedores</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Proveedores/index/1"><span class="font-weight-bold">Inventario</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Proveedores</span></li>
    </ol>

    <div class="row">
      <a href="<?php echo base_url();?>Inventario/Proveedores/agregar" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Nuevo Proveedor</span></a>&nbsp;&nbsp;
      <?php if ($estado==1): ?>
        <div class="row">
          <div class="col-md-12">
            <a href="<?php echo base_url();?>Inventario/Proveedores/index/0" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Deshabilitados</span></a>
          </div>
        </div>
      <?php else: ?>
        <div class="row">
          <div class="col-md-12">
            <a href="<?php echo base_url();?>Inventario/Proveedores/index/1" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Habilitados</span></a>
          </div>
        </div>
      <?php endif ?>
    </div> <br>
  </div>


  <div class="container">
    <div class="row">
      <div class="col-md-12" style="overflow: auto">
        <table id="cv" class="table display table-striped table-hover table-bordered table-sm font-weight-bold text-center" cellspacing="0" width="100%">
          <thead class="blue-gradient text-white">
            <tr>

              <th class="th-sm font-weight-bold">Id</th>
              <th class="th-sm font-weight-bold">Proveedor</th>
              <th class="th-sm font-weight-bold">Registro Fiscal</th>
              <th class="th-sm font-weight-bold">Teléfono</th>
              <th class="th-sm font-weight-bold">Correo</th>
              <th class="th-sm font-weight-bold">Cantacto</th>
              <th class="th-sm font-weight-bold">Teléfono contacto</th>
              <th class="th-sm font-weight-bold">Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($proveedores)): ?>
              <?php foreach ($proveedores as $proveedor): ?>
                <tr>
                  <td><?php echo $proveedor->idProveedor;?></td>
                  <td><?php echo $proveedor->proveedor;?></td>
                  <td><?php echo $proveedor->registroFiscal;?></td>
                  <td><?php echo $proveedor->telefono;?></td>
                  <td><?php echo $proveedor->correo;?></td>
                  <td><?php echo $proveedor->nombreContacto;?></td>
                  <td><?php echo $proveedor->telefonoContacto;?></td>
                  <td><button class=" btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"></button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="<?php echo base_url();?>Inventario/Proveedores/editar/<?php echo $proveedor->idProveedor;?>"><i class="fas fa-fw fa-edit"></i> Editar</a>
                      <?php if ($estado==1): ?>                        

                        <button id="eliminar" value="<?php echo base_url();?>Inventario/Proveedores/deshabilitar/" data-id="<?php echo $proveedor->estadoProveedor;?>" class="dropdown-item"><i class="fas fa-fw fa-eye-slash"></i> Deshabilitar</button>
                      </div>
                    </td>
                  <?php else: ?>
                    <button id="eliminar" value="<?php echo base_url();?>Inventario/Proveedores/deshabilitar/" data-id="<?php echo $proveedor->estadoProveedor;?>" class="dropdown-item"><i class="fas fa-fw fa-eye"></i> Habilitar</button>
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