
<!--footer class="sticky-footer font-small mdb-color lighten-2">
  <div class="container my-auto">
    <div class="copyright text-center py-3"><h6 class="font-weight-bold text-white">IRASOL</h6>
    </div>
  </div>
</footer-->
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script src="<?php echo base_url();?>assets/Recursos/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/js/sb-admin.min.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/js/JsBarcode.all.min.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/js/demo/datatables-demo.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/js/sweetalert2.min.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/js/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/js/funcionesVarias.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/js/jquery.mask.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/js/jquery.form.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/js/jquery.print.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/datatables-export/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/datatables-export/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/datatables-export/js/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/datatables-export/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/datatables-export/js/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/datatables-export/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/Recursos/datatables-export/js/buttons.print.min.js"></script>
<script>
  //campos de documentos jquery.mask.js
  $(document).ready(function(){
    $('#dui').mask('00000000-0');
    $('#telefono').mask('0000-0000');
    $('#telefonoContacto').mask('0000-0000');
    $('#nit').mask('0000-000000-000-0');
  });
</script>
<script>
	$(function () {
    $('table.display').DataTable({
      "ordering": false,
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por pagina",
        "zeroRecords": "No se encontraron resultados en su busqueda",
        "searchPlaceholder": "Buscar registros",
        "info": "Mostrando registros del _START_ al _END_ de un total de  _TOTAL_ registros",
        "infoEmpty": "No existen registros",
        "infoFiltered": "",
        "search": "Buscar:",
        "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Siguiente",
          "previous": "Anterior"
        },
      }
    })

  });
</script>
<script>
  $(function () {
    $('#sucVenta').DataTable({
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por pagina",
        "zeroRecords": "No se encontraron resultados en su busqueda",
        "searchPlaceholder": "Buscar registros",
        "info": "Mostrando registros del _START_ al _END_ de un total de  _TOTAL_ registros",
        "infoEmpty": "No existen registros",
        "infoFiltered": "",
        "search": "Buscar:",
        "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Siguiente",
          "previous": "Anterior"
        },
      }
    })

  });
</script>
<script>
  $(function(){
    //$("tr td #eliminar").click(function(ev){
      $(document).on("click","#eliminar", function(ev){
        ev.preventDefault();
        var id = $(this).parents('tr').find('td:first').text();
        var estado = $(this).attr("data-id");
        var url = $(this).attr("value");
        if (estado == 1) {
          Swal.fire({
            title: 'Quieres deshabilitar el registro?',
            text: "El registro sera deshabilitado!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                type: 'POST',
                url: url,
                data: {'id':id, 'estado':estado},
                success: function(){
                  Swal.fire({
                    title:  "Deshabilitado!",
                    text:  "Registro deshabilitado sactifactoriamente",
                    type:  "success",
                    showConfirmButton: false,
                  });              
                }
              });
              setTimeout(function () {
                location.href = "1"
              }, 700);
            }
            else {

              Swal.fire("Cancelado!", "Se cancelo la acción", "error");

            }
          })
        }else{
          Swal.fire({
            title: 'Quieres habilitar el registro?',
            text: "El registro sera habilitado!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                type: 'POST',
                url: url,
                data: {'id':id, 'estado':estado},
                success: function(){                
                  Swal.fire({
                    title:  "Habilitado!",
                    text:  "Registro habilitado sactifactoriamente",
                    type:  "success",
                    showConfirmButton: false,
                  });              
                }
              });
              setTimeout(function () {
                location.href = "0"
              }, 700);
            }
            else {

              Swal.fire("Cancelado!", "Se cancelo la acción", "error");

            }
          })
        }
      })
    });
  </script>

  <!--cargo inventario producto-->
  <script>
    $(document).ready(function () {
      var base_url = "<?php echo base_url();?>";
      $("#bprod").autocomplete({
        autoFocus: true,
        //indica la informacion que se mostrara al introducir un caracter
        source:function(request, response){
          $.ajax({
            url: base_url + "/Inventario/Compras/buscarPro",
            type: "POST",
            dataType:"json",
            data:{valor: request.term},
            success:function(data){
              response(data);
            }
          });
        },
        //establecemos con cuantos caracteres se activara el plugin
        minLength:2,
        //se ejecuta cuando seleccionamos una sugerencia
        select:function(event, ui){
          data=ui.item.idProducto + "*" + ui.item.label;
          $("#btn-producto-carga").val(data);
          $('#btn-producto-carga').focus();
        },
      });
    })
  </script>
  <script>
    $(document).ready(function(){
      $('#btn-producto-carga').keypress(function(e){
        if(e.keyCode==13)
          $('#btn-producto-carga').click();
      });
    });
  </script>
  <script>
    $(document).on("click", "#btn-producto-carga",function(){
      data = $(this).val();
      if (data !='') {
       infoproducto = data.split("*");
       html = "<tr>";
       html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[0]+"</td>";
       html += "<td>"+infoproducto[1]+"</td>";
       html += "<td><input type='text' size='5'  name='cantidades[]' value='' class='cantidades' required=''></td>";
       html += "<td><button type='button' class='btn btn-danger btn-sm btn-remove-productos'><span class='fa fa-times-circle'></span></button></td>";
       html += "</tr>";
       $("#tbcargo tbody").append(html);
       $("#btn-producto-carga").val(null);
       $("#bprod").val(null);
       $("#bprod").focus();
     }else{
      Swal.fire("Error!", "Seleccione un producto....", "error");
    }
  })
</script>
<script>
  $(document).on("click",".btn-remove-productos", function(){
    $(this).closest("tr").remove();
  });

</script>

<!--buscar producto-->
<script>
  $(document).ready(function () {
    var base_url = "<?php echo base_url();?>";
    $("#bpro").autocomplete({
      autoFocus: true,
        //indica la informacion que se mostrara al introducir un caracter
        source:function(request, response){
          $.ajax({
            url: base_url + "/Inventario/Compras/buscarPro",
            type: "POST",
            dataType:"json",
            data:{valor: request.term},
            success:function(data){
              response(data);
            }
          });
        },
        //establecemos con cuantos caracteres se activara el plugin
        minLength:2,
        //se ejecuta cuando seleccionamos una sugerencia
        select:function(event, ui){
          data=ui.item.idProducto + "*" + ui.item.label + "*" + ui.item.idPresentacion + "*" + ui.item.presentacion;
          $("#btn-producto").val(data);
          $('#btn-producto').focus();
        },
      });
  })
</script>
<script>
  $(document).ready(function(){
    $('#btn-producto').keypress(function(e){
      if(e.keyCode==13)
        $('#btn-producto').click();
    });
  });
</script>
<script>
  $(document).on("click", "#btn-producto",function(){
    data = $(this).val();
    if (data !='') {
     infoproducto = data.split("*");
     html = "<tr>";
     html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[0]+"</td>";
     html += "<td  style='display:none;'><input type='text' size='10' name='idLote[]' value='0'></td>";
     html += "<td>"+infoproducto[1]+"</td>";
     html += "<td style='display:none;'><input type='hidden' name='idpresentacionProducto[]' value='"+infoproducto[2]+"'>"+infoproducto[3]+"</td>";
     html += "<td><input type='text' size='5' required name='precio[]' value='' class='precio'></td>";
     html += "<td><input type='text' size='5'  name='cantidades[]' value='' class='cantidades' ></td>";
     html += "<td><input type='hidden' name='iva[]' value='0.00'><p>"+0+"</p></td>";
     html += "<td><input type='hidden' name='subt[]' value='0.00'><p>"+0+"</p></td>";
     html += "<td><input type='hidden' name='importe[]' value='0.00'><p>"+0+"</p></td>";
     html += "<td><input type='date'  name='fechaV[]'  class='fechaV' required></td>";
     html += "<td><button type='button' class='btn btn-danger btn-sm btn-remove-productos'><span class='fa fa-times-circle'></span></button></td>";
     html += "</tr>";
     $("#tbcompra tbody").append(html);
     sumar();
     $("#btn-producto").val(null);
     $("#bpro").val(null);
     $("#bpro").focus();
   }else{
    Swal.fire("Error!", "Seleccione un producto....", "error");
  }
})
</script>
<script>
  $(document).on("click",".btn-remove-productos", function(){
    $(this).closest("tr").remove();
    sumar();
  });

</script>

<script>
  $(document).on("keyup","#tbcompra input", function(){
    precio = $(this).closest("tr").find("td:eq(4)").children("input").val();
    cantidad = $(this).closest("tr").find("td:eq(5)").children("input").val();
    subtotal1 = precio * cantidad;
    iva = subtotal1 * 0.13;
    $(this).closest("tr").find("td:eq(6)").children("p").text(iva.toFixed(2));
    $(this).closest("tr").find("td:eq(6)").children("input").val(iva.toFixed(2));
    $(this).closest("tr").find("td:eq(7)").children("p").text(subtotal1.toFixed(2));
    $(this).closest("tr").find("td:eq(7)").children("input").val(subtotal1.toFixed(2));
    importe = subtotal1 + iva;
    $(this).closest("tr").find("td:eq(8)").children("p").text(importe.toFixed(2));
    $(this).closest("tr").find("td:eq(8)").children("input").val(importe.toFixed(2));
    sumar();
  });

    function sumar(){//compra
      subtotal = 0;
      subtotal0 = 0;

      $("#tbcompra tbody tr").each(function(){
        subtotal = subtotal + Number($(this).find("td:eq(7)").text());
        subtotal0 = subtotal0 + Number($(this).find("td:eq(8)").text());
      });

      $("input[name=subtotal]").val(subtotal.toFixed(2));
      var iva2 = subtotal * 0.13;
      $("input[name=igc2]").val(iva2.toFixed(2));
      total = (subtotal0);
      $("input[name=total]").val((total).toFixed(2));
    }
  </script>
  <script>
    $(document).on("click", ".btn-check",function(){
      proveedor = $(this).val();
      infoproveedor = proveedor.split("*");
      $("#idproveedor").val(infoproveedor[0]);
      $("#proveedor").val(infoproveedor[1]);
      $("#modal-default").modal("hide");
    })
  </script>

  <script>
    $(document).on("click","#compra",function(){
      valor_id = $(this).val();
      $.ajax({
        url: "<?php echo base_url();?>Inventario/Compras/vista",
        type:"POST",
        dataType:"html",
        data:{idCompra:valor_id},
        success:function(data){
          $("#modal-default .modal-body").html(data);
        }
      })
    })
  </script>
  <!--traslados-->
  <script>
    $(document).on("click", "#transpor",function(){
      proveedor = $(this).val();
      infoproveedor = proveedor.split("*");
      $("#trasnportista").val(infoproveedor[0]);
      $("#trasn").val(infoproveedor[1]);
      $("#modal-trasnportista").modal("hide");
    })
  </script>
  <script>
    $(document).on("click", "#btn-proTras",function(){
      data = $(this).val();
      if (data !='') {
        infoproducto = data.split("*");
        html = "<tr>";
        html += "<td style='display:none;'><input type='hidden' name='idproductos[]' value='"+infoproducto[1]+"'>"+infoproducto[1]+"</td>";
        html += "<td style='display:none;'><input type='hidden' size='10' name='idLote[]' value='"+infoproducto[3]+"'>"+infoproducto[3]+"</td>";
        html += "<td>"+infoproducto[2]+"</td>";
        html += "<td style='display:none;'><input type='hidden' name='idpresentacionProducto[]' value='"+infoproducto[8]+"'>"+infoproducto[4]+"</td>";
        html += "<td><input type='hidden' name='existencias[]' value='"+infoproducto[5]+"'><input type='hidden' name='idInventario[]' value='"+infoproducto[9]+"'><span class='text-danger'>"+infoproducto[5]+"</span></td>";
        html += "<td><input type='hidden' size='5' required name='precio[]' value='"+infoproducto[6]+"' class='precio'>"+infoproducto[6]+"</td>";
        html += "<td><input type='text' size='5'  name='cantidades[]' value='' class='cantidades' required></td>";
        html += "<td><input type='hidden' name='importe[]' value='0.00'><p>"+0+"</p></td>";
        html += "<td><button type='button' class='btn btn-danger btn-sm btn-remove-traslado'><span class='fa fa-times-circle'></span></button></td>";
        html += "</tr>";
        $("#tbtraslado tbody").append(html);
        trasladosum();
      }else{
        Swal.fire("Error!", "Seleccione un producto....", "error");
      }
    })
  </script>
  <script>
    $(document).on("click",".btn-remove-traslado", function(){
      $(this).closest("tr").remove();
      trasladosum();
    });

  </script>

  <script>
    $(document).on("keyup","#tbtraslado input", function(){
      existencia = $(this).closest("tr").find("td:eq(4)").children("input").val();
      cantidad = Number($(this).closest("tr").find("td:eq(6)").children("input").val());
      if (existencia < cantidad) {
        alert("La cantidad a trasladar es mayor a existencias");
        precio = $(this).closest("tr").find("td:eq(5)").children("input").val();
        cantidad = existencia;
        importe = precio * cantidad;
        $(this).closest("tr").find("td:eq(6)").children("p").text(cantidad);
        $(this).closest("tr").find("td:eq(6)").children("input").val(cantidad);
        $(this).closest("tr").find("td:eq(7)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(7)").children("input").val(importe.toFixed(2));
        trasladosum();
      }else{

        precio = $(this).closest("tr").find("td:eq(5)").children("input").val();
        importe = precio * cantidad;
        $(this).closest("tr").find("td:eq(7)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(7)").children("input").val(importe.toFixed(2));
        trasladosum();
      }
    });

    function trasladosum(){//compra
      total = 0;

      $("#tbtraslado tbody tr").each(function(){
        total = total + Number($(this).find("td:eq(7)").text());
      });
      $("input[name=Total]").val((total).toFixed(2));
    }
  </script>
  <script>
    $(document).on("click", ".btn-check",function(){
      sucursal = $(this).val();
      infosucursal = sucursal.split("*");
      $("#idsucursal").val(infosucursal[0]);
      $("#sucursal").val(infosucursal[1]);
      $("#modal-default").modal("hide");
    })
  </script>

  <script>
    $(document).on("click", ".btn-check2",function(){
      sucursal = $(this).val();
      infosucursal = sucursal.split("*");
      $("#idsucursalr").val(infosucursal[0]);
      $("#sucursalr").val(infosucursal[1]);
      $("#modal-defaulte").modal("hide");
    })
  </script>

  <script>
    $(document).on("click","#salida",function(){
      valor_id = $(this).val();
      $.ajax({
        url: "<?php echo base_url();?>Inventario/Traslados/vista",
        type:"POST",
        dataType:"html",
        data:{idSalida:valor_id},
        success:function(data){
          $("#modal-default .modal-body").html(data);
        }
      })
    })
  </script>

  <script>
    $(document).on("click","#observa",function(){
      valor_id = $(this).val();
      $.ajax({
        url: "<?php echo base_url();?>Inventario/Traslados/vistaOb",
        type:"POST",
        dataType:"html",
        data:{idSalida:valor_id},
        success:function(data){
          $("#modalOb .modal-body").html(data);
        }
      })
    })
  </script>

  <script>
    $(document).on("click","#proInventario",function(){
      valor_id = $("#idsucursal").val();
      $.ajax({
        url: "<?php echo base_url();?>Inventario/Traslados/proInventario",
        type:"POST",
        dataType:"html",
        data:{id:valor_id},
        success:function(data){
          $("#modal-productos .modal-body").html(data);
        }
      })
    })
  </script>
  <!--fin traslados-->
  <!--devoluciones-->
  <script>
    $(document).on("click", "#btn-prodev",function(){
      data = $(this).val();
      if (data !='') {
        infoproducto = data.split("*");
        html = "<tr>";
        html += "<td style='display:none;'><input type='hidden' name='idproductos[]' value='"+infoproducto[1]+"'>"+infoproducto[1]+"</td>";
        html += "<td style='display:none;'><input type='hidden' size='10' name='idLote[]' value='"+infoproducto[3]+"'>"+infoproducto[3]+"</td>";
        html += "<td>"+infoproducto[2]+"</td>";
        html += "<td style='display:none;'><input type='hidden' name='idpresentacionProducto[]' value='"+infoproducto[8]+"'>"+infoproducto[4]+"</td>";
        html += "<td><input type='hidden' name='existencias[]' value='"+infoproducto[5]+"'><input type='hidden' name='idInventario[]' value='"+infoproducto[9]+"'><span class='text-danger'>"+infoproducto[5]+"</span></td>";
        html += "<td><input type='hidden' size='5' required name='precioActual[]' value='"+infoproducto[6]+"' class='precio'><input type='hidden' name='costoUnitario[]' value='"+infoproducto[10]+"'>"+infoproducto[6]+"</td>";
        html += "<td><input type='text' size='5' required name='precio[]' value='0.00' class='precio'></td>";
        html += "<td><input type='text' size='5'  name='cantidades[]' value='' class='cantidades' required></td>";
        html += "<td><input type='hidden' name='importe[]' value='0.00'><p>"+0+"</p></td>";
        html += "<td><button type='button' class='btn btn-danger btn-sm btn-remove-tras'><span class='fa fa-times-circle'></span></button></td>";
        html += "</tr>";
        $("#tbdevolucion tbody").append(html);
        devolucionsum();
      }else{
        Swal.fire("Error!", "Seleccione un producto....", "error");
      }
    })
  </script>
  <script>
    $(document).on("click",".btn-remove-tras", function(){
      $(this).closest("tr").remove();
      devolucionsum();
    });

  </script>

  <script>
    $(document).on("keyup","#tbdevolucion input", function(){
      existencia = $(this).closest("tr").find("td:eq(4)").children("input").val();
      cantidad = Number($(this).closest("tr").find("td:eq(7)").children("input").val());
      if (existencia < cantidad) {
        alert("La cantidad a trasladar es mayor a existencias");
        precio = $(this).closest("tr").find("td:eq(5)").children("input").val();
        cantidad = existencia;
        importe = precio * cantidad;
        $(this).closest("tr").find("td:eq(7)").children("p").text(cantidad);
        $(this).closest("tr").find("td:eq(7)").children("input").val(cantidad);
        $(this).closest("tr").find("td:eq(8)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(8)").children("input").val(importe.toFixed(2));
        devolucionsum();
      }else{

        precio = $(this).closest("tr").find("td:eq(5)").children("input").val();
        importe = precio * cantidad;
        $(this).closest("tr").find("td:eq(8)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(8)").children("input").val(importe.toFixed(2));
        devolucionsum();
      }
    });

    function devolucionsum(){//compra
      total = 0;

      $("#tbdevolucion tbody tr").each(function(){
        total = total + Number($(this).find("td:eq(8)").text());
      });
      $("input[name=Total]").val((total).toFixed(2));
    }
  </script>

  <script>
    $(document).on("click","#proInventarioDev",function(){
      valor_id = $("#idsucursal").val();
      $.ajax({
        url: "<?php echo base_url();?>Inventario/Traslados/proInventario2",
        type:"POST",
        dataType:"html",
        data:{id:valor_id},
        success:function(data){
          $("#modal-productos .modal-body").html(data);
        }
      })
    })
  </script>

  <script>
    $(document).on("click","#devolucion",function(){
      valor_id = $(this).val();
      $.ajax({
        url: "<?php echo base_url();?>Inventario/Devoluciones/vista",
        type:"POST",
        dataType:"html",
        data:{idDevolucion:valor_id},
        success:function(data){
          $("#modal-dev .modal-body").html(data);
        }
      })
    })
  </script>

  <script >
    $(document).on("click","#printd",function(){
      $("#modal-default .modal-body").print({
        title:"Orden de Devolución",
        doctype: '<!doctype html>'
      });
    });
  </script>
  <!--fin devoluciones-->

  <!--Ventas-->

  <script>
    $(document).ready(function () {
      var base_url = "<?php echo base_url();?>";
      $("#bproVenta").autocomplete({
        autoFocus: true,
        //indica la informacion que se mostrara al introducir un caracter
        source:function(request, response){
          $.ajax({
            url: base_url + "/Inventario/Ventas/buscarInv",
            type: "POST",
            dataType:"json",
            data:{valor: request.term},
            success:function(data){
              response(data);
            }
          });
        },
        //establecemos con cuantos caracteres se activara el plugin
        minLength:2,
        //se ejecuta cuando seleccionamos una sugerencia
        select:function(event, ui){
          data=ui.item.idSucursal + "*" + ui.item.idProducto + "*" + ui.item.label + "*" + ui.item.idLote + "*" + ui.item.presentacion+ "*" + ui.item.existencias + "*" + ui.item.precioCIVA + "*" + ui.item.costoExistencias + "*" + ui.item.idPresentacion + "*" + ui.item.idInventario;
          $("#btn-pro").val(data);
          $('#btn-pro').focus();
        },
      });
    })
  </script>
  <script>
    $(document).on("click", "#btn-pro",function(){
      data = $(this).val();
      infoproducto = data.split("*");
      html = "<tr>";
      html += "<td style='display:none;'><input type='hidden' name='idproductos[]' value='"+infoproducto[1]+"'>"+infoproducto[1]+"</td>";
      html += "<td style='display:none;' width='100'><input type='hidden' size='10' name='idLote[]' value='"+infoproducto[3]+"'>"+infoproducto[3]+"</td>";
      html += "<td style='font-family: Arial; font-size: 12pt;'>"+infoproducto[2]+"</td>";
      html += "<td style='display:none;'><input type='hidden' name='idpresentacionProducto[]' value='"+infoproducto[8]+"'>"+infoproducto[4]+"</td>";
      html += "<td style='display:none;'><input type='hidden' name='existencias[]' value='"+infoproducto[5]+"'><input type='hidden' name='idInventario[]' value='"+infoproducto[9]+"'><span class='text-danger'>"+infoproducto[5]+"</span></td>";
      html += "<td style='display:none;'><input type='hidden' size='5' required name='precio[]' value='"+infoproducto[6]+"' class='precio'>"+infoproducto[6]+"</td>";
      html += "<td><input type='number' size='5' style='font-family: Arial; font-size: 12pt;' name='cantidades[]' value='' class='cantidades' min='1' pattern='^[0-9]+' placeholder='0'></td>";
      html += "<td style='display:none;'><input type='hidden' name='iva[]' value='0.00'><p>"+0+"</p></td>";
      html += "<td style='display:none;'><input type='hidden' name='subt[]' value='0.00'><p>"+0+"</p></td>";
      html += "<td style='font-family: Arial; font-size: 12pt;'><input type='hidden' name='importe[]' value='0.00'><p>"+0+"</p></td>";
      html += "<td><button type='button' class='btn btn-danger btn-sm btn-remove-producto'><span class='fa fa-times-circle'></span></button></td>";
      html += "</tr>";
      $("#tbventas tbody").append(html);
      ventassum();
      $("#btn-pro").val(null);
      $("#bproVenta").val(null);
      $("#bproVenta").focus();
    })
  </script>
  <script>
    $(document).on("click",".btn-remove-producto", function(){
      $(this).closest("tr").remove();
      ventassum();
    });

  </script>

  <script>
    $(document).on("click", ".btn-sucVende",function(){
      sucursal = $(this).val();
      infosucursal = sucursal.split("*");
      $("#idsucursal").val(infosucursal[0]);
      $("#sucursal").val(infosucursal[1]);
      $("#modal-sucVende").modal("hide");
    })
  </script>

  <script>
    $(document).on("keyup","#tbventas input", function(){
      existencia = $(this).closest("tr").find("td:eq(4)").children("input").val();
      cantidad = Number($(this).closest("tr").find("td:eq(6)").children("input").val());
      if (existencia < cantidad) {
        alert("La cantidad a vender es mayor a existencias");
        precio = $(this).closest("tr").find("td:eq(5)").children("input").val();
        cantidad = existencia;
        subtotal1 = precio * cantidad;
        iva = (subtotal1 / 1.13)*0.13;
        sub = subtotal1 - iva;
        $(this).closest("tr").find("td:eq(6)").children("p").text(cantidad);
        $(this).closest("tr").find("td:eq(6)").children("input").val(cantidad);
        $(this).closest("tr").find("td:eq(7)").children("p").text(iva.toFixed(2));
        $(this).closest("tr").find("td:eq(7)").children("input").val(iva.toFixed(2));
        $(this).closest("tr").find("td:eq(8)").children("p").text(sub.toFixed(2));
        $(this).closest("tr").find("td:eq(8)").children("input").val(sub.toFixed(2));
        importe = subtotal1;
        $(this).closest("tr").find("td:eq(9)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(9)").children("input").val(importe.toFixed(2));
        ventassum();
      }else{
        precio = $(this).closest("tr").find("td:eq(5)").children("input").val();
        subtotal1 = precio * cantidad;
        iva = (subtotal1 / 1.13)*0.13;
        sub = subtotal1 - iva;
        $(this).closest("tr").find("td:eq(7)").children("p").text(iva.toFixed(2));
        $(this).closest("tr").find("td:eq(7)").children("input").val(iva.toFixed(2));
        $(this).closest("tr").find("td:eq(8)").children("p").text(sub.toFixed(2));
        $(this).closest("tr").find("td:eq(8)").children("input").val(sub.toFixed(2));
        importe = subtotal1;
        $(this).closest("tr").find("td:eq(9)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(9)").children("input").val(importe.toFixed(2));
        ventassum();
      }
    });

    function ventassum(){//venta
      subtotal = 0;
      subtotal0 = 0;

      $("#tbventas tbody tr").each(function(){
        subtotal = subtotal + Number($(this).find("td:eq(8)").text());
        subtotal0 = subtotal0 + Number($(this).find("td:eq(9)").text());
      });

      $("input[name=subtotal]").val(subtotal.toFixed(2));
      var iva2 = subtotal * 0.13;
      $("input[name=igc2]").val(iva2.toFixed(2));
      total = (subtotal0);
      $("input[name=Total]").val((total).toFixed(2));
      vuelto();
    }
  </script>
  <script>
    $(document).on("click", ".btn-check",function(){
      sucursal = $(this).val();
      infosucursal = sucursal.split("*");
      $("#idsucursal").val(infosucursal[0]);
      $("#sucursal").val(infosucursal[1]);
      $("#modal-default").modal("hide");
    })
  </script>
  <script>
    $(document).ready(function(){
      $("#change input").keyup(function()
      { 
        vuelto();
      });
    });

    function vuelto() {
      var cambio = 0;
      var total = $("#total").val();
      var recibe = $('#recibe').val();
      recibe=parseFloat(recibe);
      total=parseFloat(total);
      cambio = recibe - total;
      if (recibe <= 0) {
        $("#cambio").val((0.00).toFixed(2));
      }else{
        $("#cambio").val((cambio).toFixed(2));
      }
    }
  </script>


  <script>
    $(document).on("click","#venta",function(){
      valor_id = $(this).val();
      $.ajax({
        url: "<?php echo base_url();?>Inventario/Ventas/vista",
        type:"POST",
        dataType:"html",
        data:{idVenta:valor_id},
        success:function(data){
          $("#modal-default .modal-body").html(data);
        }
      })
    })
  </script>

  <script>
    $(document).on("click","#pro",function(){
      valor_id = $(this).val();
      id_suc = $("#idsucursal").val();
      $.ajax({
        url: "<?php echo base_url();?>Inventario/Ventas/vistaPro",
        type:"POST",
        dataType:"html",
        data:{idCategoria:valor_id, idSucursal:id_suc},
        success:function(data){
          $("#modal-productos .modal-body").html(data);
        }
      })
    })
  </script><!--Fin Ventas-->
  <script>
    $(document).on("click","#despacho",function(){
      valor_id = $(this).val();
      $.ajax({
        url: "<?php echo base_url();?>Inventario/consumos/vista",
        type:"POST",
        dataType:"html",
        data:{idDespcho:valor_id},
        success:function(data){
          $("#modal-despacho .modal-body").html(data);
        }
      })
    })
  </script>
  <!--desactivar submit al presionar enter-->
  <script>
    $(document).ready(function() {
      $("#formcompras").keypress(function(e) {
        if (e.which == 13) {
          return false;
        }
      });
    });
  </script>
  <script>
    $("#comprobantes").on("change",function(){
      option = $(this).val();
      if (option!="") {
        infocomprobante = option.split("*");
        $("#idcomprobante").val(infocomprobante[0]);
        $("#cantidad").val(infocomprobante[1]);
        $("#numero").val(generarnumero(infocomprobante[1]));
      }else{
        $("#idcomprobante").val(null);
        $("#numero").val(null);
      }
    });

    function generarnumero(numero){
      if (numero >=99999 && numero<999999) {
        return Number(numero)+1;
      }
      if (numero >=9999 && numero<99999) {
        return "0" + (Number(numero)+1);
      }
      if (numero >=999 && numero<9999) {
        return "00" + (Number(numero)+1);
      }
      if (numero >=99 && numero<999) {
        return "000" + (Number(numero)+1);
      }
      if (numero >=9 && numero<99) {
        return "0000" + (Number(numero)+1);
      }
      if (numero<9) {
        return "00000" + (Number(numero)+1);
      }
    }
  </script>
  <script type="text/javascript">
    window.onload = function(){
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
  document.getElementById('fecha').value=ano+"-"+mes+"-"+dia;
}
</script>
<!--Reportes-->
<script>
        //imprimir reporte de compra
        $(document).on("click",".btn-printc",function(){
          $("#modal-default .modal-body").print({
            title:"Orden de Compra",
            doctype: '<!doctype html>'
          });
        });

        //imprimir reporte de traslado
        $(document).on("click","#printt",function(){
          $("#modal-default .modal-body").print({
            title:"Orden de Traslados",
            doctype: '<!doctype html>'
          });
        });

        //imprimir reporte de devolucion
        $(document).on("click","#printd",function(){
          $("#modal-dev .modal-body").print({
            title:"Orden de Devoluciones",
            doctype: '<!doctype html>'
          });
        });

        //imprimir reporte de traslado
        $(document).on("click",".btn-printv",function(){
          $("#modal-default .modal-body").print({
            title:"Detalle Venta",
            doctype: '<!doctype html>'
          });
        });

      </script>
      <!--reporte-->
      <script>
        var d = new Date();
        $(function () {
          $('#inve').DataTable( {
            "ordering": false,
            "language": {
              "lengthMenu": "Mostrar _MENU_ registros por pagina",
              "zeroRecords": "No se encontraron resultados en su busqueda",
              "searchPlaceholder": "Buscar registros",
              "info": "Registros del _START_ al _END_  de  _TOTAL_ registros",
              "infoEmpty": "No existen registros",
              "infoFiltered": "(filtrado de un total de _MAX_ registros)",
              "search": "Buscar:",
              "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
              },
            },

            dom: 'Bfrtip',
            buttons: [{
              extend: 'excel', footer: true,
              title: 'Invetario Fecha: '+ d.getDate()+'-'+d.getMonth()+'-'+d.getFullYear()+' Hora: '+d.getHours()+'-'+d.getMinutes(),
              customize: function(xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];

                // Loop over the cells in column `C`
                $('row c[r^="C"]', sheet).each( function () {
                    // Get the value
                    if ( $('is t', this).text() == 'Producto agotado' ) {
                      $(this).attr( 's', '20' );
                    }
                  });
              }
            }]

          });
        });
      </script>
      <script>
        var d = new Date();
        $(function () {
          $('#kardex').DataTable( {
            "ordering": false,
            "language": {
              "lengthMenu": "Mostrar _MENU_ registros por pagina",
              "zeroRecords": "No se encontraron resultados en su busqueda",
              "searchPlaceholder": "Buscar registros",
              "info": "Registros del _START_ al _END_  de  _TOTAL_ registros",
              "infoEmpty": "No existen registros",
              "infoFiltered": "(filtrado de un total de _MAX_ registros)",
              "search": "Buscar:",
              "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
              },
            },

            dom: 'Bfrtip',
            buttons: [{
              extend: 'excel',
              title: 'Kardex Generado el: '+ d.getDate()+'-'+d.getMonth()+'-'+d.getFullYear(),
            }]

          });
        });
      </script>
      <script>
        var d = new Date();
        $(function () {
          $('#vent').DataTable( {
            "ordering": false,
            "language": {
              "lengthMenu": "Mostrar _MENU_ registros por pagina",
              "zeroRecords": "No se encontraron resultados en su busqueda",
              "searchPlaceholder": "Buscar registros",
              "info": "Registros del _START_ al _END_  de  _TOTAL_ registros",
              "infoEmpty": "No existen registros",
              "infoFiltered": "(filtrado de un total de _MAX_ registros)",
              "search": "Buscar:",
              "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
              },
            },

            dom: 'Bfrtip',
            buttons: [{
              extend: 'excel',
              title: 'Ventas Fecha: '+ d.getDate()+'-'+d.getMonth()+'-'+d.getFullYear()+' Hora: '+d.getHours()+'-'+d.getMinutes(),
            }]

          });
        });
      </script>
      <script>
        $(document).on("click","#pro",function(){
          valor_id = $(this).val();
          $.ajax({
            url: "<?php echo base_url();?>Inventario/Ventas/pro",
            type:"POST",
            dataType:"html",
            data:{idVenta:valor_id},
            success:function(data){
              $("#modal-default .modal-body").html(data);
            }
          })
        })
      </script>
<!-- para buscar producto a regresar (ventas)-->
      <script>
    $(document).ready(function () {
      var base_url = "<?php echo base_url();?>";
      $("#codigoBarra").autocomplete({
        autoFocus: true,
        //indica la informacion que se mostrara al introducir un caracter
        source:function(request, response){
          $.ajax({
            url: base_url + "/Inventario/Compras/buscarPro",
            type: "POST",
            dataType:"json",
            data:{valor: request.term},
            success:function(data){
              response(data);
            }
          });
        },
        //establecemos con cuantos caracteres se activara el plugin
        minLength:6,
        appendTo: "#formularioDev",
        //se ejecuta cuando seleccionamos una sugerencia
        select:function(event, ui){
          id=ui.item.idProducto;
          codigoB=ui.item.codigoBarra;
          $("#idProDev").val(id);
          $("#codigoB").val(codigoB);
        },
      });
    })
  </script>
      <!-- para agregar la devolucion del producto (ventas)-->
      <script>
       
       function addDev(){
        var codigoB = $('#codigoB').val();
        var idProDev = $('#idProDev').val();
        var cantidadDev = $('#cantidadDev').val();

      $.ajax({
          url: "<?php echo base_url();?>Inventario/Ventas/addDevo",
          type:"POST",
          data:{
            'idProDev': idProDev,
            'cantidadDev': cantidadDev,
          },
          success:function(data){
            Swal.fire({
              title:  "Exito!",
              text:  "Se regreso producto",
              type:  "success",
            });
            $("#modal-devolucion").modal("hide");
            $('#idProDev').val("");
            $('#cantidadDev').val("");
            $('#codigoB').val("");
          },error:function(jqXHR, textStatus, er,rorThrown){
            console.log('error::' + errorThrown)
          }
        })
      };

      $('#btn-addDev').click(function(e){
        e.preventDefault();
        jQuery.validator.messages.required = 'Este campo es obligatorio.';
        var validado = $("#formularioDev").valid();
        if (validado) {
          addDev();
        }
      });
    </script>
    <!--Fin Ventas-->
  </body>
  </html>
  <script>
   function add(){
    var producto = $('#producto').val();
    var precio = $('#precio').val();
    var categoria = $('#categoria').val();
    var presentacion = $('#presentacion').val();

    $.ajax({
      url: "<?php echo base_url();?>Inventario/Productos/add2",
      type:"POST",
      data:{
        'producto': producto,
        'precio': precio,
        'categoria': categoria,
        'presentacion': presentacion
      },
      success:function(data){
        Swal.fire({
          title:  "Exito!",
          text:  "Producto agregado",
          type:  "success",
        });
        $("#modal-adPro").modal("hide");
        $('#producto').val("");
        $('#precio').val("");
        $('#categoria').val("");
        $('#presentacion').val("");
      },error:function(jqXHR, textStatus, er,rorThrown){
        console.log('error::' + errorThrown)
      }
    })
  };

  $('#btn-add').click(function(e){
    e.preventDefault();
    jQuery.validator.messages.required = 'Este campo es obligatorio.';
    var validado = $("#formulario").valid();
    if (validado) {
      add();
    }
  });
</script>
<!--buscar y agregar proveedor-->
<script>
  $(document).ready(function () {
    var base_url = "<?php echo base_url();?>";
    $("#proveedor").autocomplete({
        //indica la informacion que se mostrara al introducir un caracter
        source:function(request, response){
          $.ajax({
            url: base_url + "/Inventario/Compras/buscarProve",
            type: "POST",
            dataType:"json",
            data:{valor: request.term},
            success:function(data){
              response(data);
            }
          });
        },
        //establecemos con cuantos caracteres se activara el plugin
        minLength:2,
        //se ejecuta cuando seleccionamos una sugerencia
        select:function(event, ui){
          data=ui.item.idProveedor;
          $("#idproveedor").val(data)
        },
      });
  })
</script>

<script>
 function add2(){
  var proveedores = $('#proveedores').val();
  var telefono = $('#telefono').val();

  $.ajax({
    url: "<?php echo base_url();?>Inventario/Proveedores/add2",
    type:"POST",
    data:{
      'proveedores': proveedores,
      'telefono': telefono
    },
    success:function(data){
      Swal.fire({
        title:  "Exito!",
        text:  "Proveedor agregado",
        type:  "success",
      });
      $("#modal-default").modal("hide");
      $('#proveedores').val("");
      $('#telefono').val("");
    },error:function(jqXHR, textStatus, er,rorThrown){
      console.log('error::' + errorThrown)
    }
  })
};

$('#btn-prove').click(function(e){
  e.preventDefault();
  jQuery.validator.messages.required = 'Este campo es obligatorio.';
  var validado = $("#formulario2").valid();
  if (validado) {
    add2();
  }
});
</script>

<script>
  var d = new Date();
  $(function () {
    $('#ive').DataTable( {
      "ordering": false,
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por pagina",
        "zeroRecords": "No se encontraron resultados en su busqueda",
        "searchPlaceholder": "Buscar registros",
        "info": "Registros del _START_ al _END_  de  _TOTAL_ registros",
        "infoEmpty": "No existen registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "search": "Buscar:",
        "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Siguiente",
          "previous": "Anterior"
        },
      },

    });
  });
</script>
<script>
 $(document).on("click","#inventarioV",function(){
  var sucursal = $(this).attr("data-id");
  valor_id = $(this).val();
  $.ajax({
    url: "<?php echo base_url();?>Inventario/Inventario/view",
    type:"POST",
    dataType:"html",
    data:{idInventario:valor_id, idSucursal:sucursal},
    success:function(data){
      $("#modal-default .modal-body").html(data);
    }
  })
})
</script>

<!--editar precio inventario devoluciones-->
<script>
 $(document).on("click","#editarPrecio",function(){
  var id = $(this).parents('tr').find('td:first').text();
  var precio = $(this).attr("data-id");
  $('#id').val(id);
  $('#precio').val(precio);
})
</script>
<script>
 function editPrecio(){
  var id = $('#id').val();
  var precio = $('#precio').val();

  $.ajax({
    url: "<?php echo base_url();?>Inventario/Devoluciones/editar",
    type:"POST",
    data:{
      'id': id,
      'precio': precio
    },
    success:function(data){
      Swal.fire({
        title:  "Exito!",
        text:  "Se actualizo precio!",
        type:  "success",
      });
      $("#modal-editPrecio").modal("hide");
    },error:function(jqXHR, textStatus, er,rorThrown){
      console.log('error::' + errorThrown)
    }
  })
  setTimeout(function () {
    location.href = "inventarioDevoluciones"
  }, 600);
};

$('#btn-editPrecio').click(function(e){
  e.preventDefault();
  jQuery.validator.messages.required = 'Este campo es obligatorio.';
  var validado = $("#formularioPrecio").valid();
  if (validado) {
    editPrecio();
  }
});
</script>