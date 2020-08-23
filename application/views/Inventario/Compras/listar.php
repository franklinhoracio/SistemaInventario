 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Listado de Compras</title>
</head>
<body>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard"><span class="font-weight-bold">Inicio</span></a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url();?>Inventario/Inventario"><span class="font-weight-bold">Inventario</span></a></li>
      <li class="breadcrumb-item"><span class="font-weight-bold">Compras</span></li>
    </ol>

    <div class="row">
      <a href="<?php echo base_url();?>Inventario/Compras/agregar" class="btn-grey btn-sm"><span class="font-weight-bold text-white">Agregar Compra/Factura</span></a>
    </div> <br>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-12" style="overflow: auto">
        <table id="cv" class="table display table-striped table-hover table-bordered table-sm font-weight-bold text-center w-auto" cellspacing="0" width="100%">
          <thead class="blue-gradient text-white">
            <tr>
              <th class="font-weight-bold">Proveedor</th>
              <th class="font-weight-bold">Usuario</th>
              <th class="font-weight-bold">Fecha</th>
              <th class="font-weight-bold">Comprobante</th>
              <th class="font-weight-bold">Numero Comprobante</th>
              <th class="font-weight-bold">SubTotal</th>
              <th class="font-weight-bold">Iva</th>
              <th class="font-weight-bold">Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
           <?php if (!empty($compras)): ?>
            <?php foreach($compras as $compra):?>
              <tr>
                <td><?php echo $compra->proveedor;?></td>
                <td><?php echo $compra->usuario;?></td>
                <td><?php echo date("d/m/Y", strtotime($compra->fecha));?></td>
                <td><?php echo $compra->tipoDocumento;?></td>
                <td><?php echo $compra->numDocumento;?></td>
                <td>$ <?php echo round($compra->costo,2);?></td>
                <td>$ <?php echo round($compra->iva,2);?></td>
                <td>$ <?php echo round($compra->importeCompra,2);?></td>
                <td>
                  <button type="button" id="compra" class="btn btn-info btn-sm" value="<?php echo $compra->idCompra;?>" data-toggle="modal" data-target="#modal-default"><span class="fa fa-search"></span></button>
                </td>
              </tr>
            <?php endforeach;?>
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

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Orden de Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-sm btn-primary btn-printc"><span class="fa fa-print"> </span></button>
            </div>
        </div>
    </div>
</div>