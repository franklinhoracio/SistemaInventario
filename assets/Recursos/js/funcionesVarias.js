/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
   //<!--Ventas-->
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

    $(document).on("click", "#btn-pro",function(){
      data = $(this).val();
      infoproducto = data.split("*");
      html = "<tr>";
      html += "<td style='display:none;'><input type='hidden' name='idproductos[]' value='"+infoproducto[1]+"'>"+infoproducto[1]+"</td>";
      html += "<td style='display:none;' width='100'><input type='hidden' size='10' name='idLote[]' value='"+infoproducto[3]+"'>"+infoproducto[3]+"</td>";
      html += "<td style='font-family: Arial; font-size: 12pt;'>"+infoproducto[2]+"</td>";
      html += "<td style='display:none;'><input type='hidden' name='idpresentacionProducto[]' value='"+infoproducto[8]+"'>"+infoproducto[4]+"</td>";
      html += "<td style='font-family: Arial; font-size: 12pt;'><input type='hidden' name='existencias[]' value='"+infoproducto[5]+"'><input type='hidden' name='idInventario[]' value='"+infoproducto[9]+"'><span class='text-danger'>"+infoproducto[5]+"</span></td>";
      html += "<td><input type='hidden' size='5' required name='precio[]' value='"+infoproducto[6]+"' class='precio'>"+infoproducto[6]+"</td>";
      html += "<td><input type='text' size='5' style='font-family: Arial; font-size: 12pt;' name='cantidades[]' value='' class='cantidades' ></td>";
      html += "<td style='display:none;'><input type='hidden' name='iva[]' value='0.00'><p>"+0+"</p></td>";
      html += "<td style='display:none;'><input type='hidden' name='subt[]' value='0.00'><p>"+0+"</p></td>";
      html += "<td style='font-family: Arial; font-size: 12pt;'><input type='hidden' name='importe[]' value='0.00'><p>"+0+"</p></td>";
      html += "<td><button type='button' class='btn btn-danger btn-sm btn-remove-producto'><span class='fa fa-times-circle'></span></button></td>";
      html += "</tr>";
      $("#tbdespacho tbody").append(html);
      despachosum();
    })

    $(document).on("click",".btn-remove-producto", function(){
      $(this).closest("tr").remove();
      despachosum();
    });

    $(document).on("click", ".btn-sucDesp",function(){
      sucursal = $(this).val();
      infosucursal = sucursal.split("*");
      $("#idsucursal").val(infosucursal[0]);
      $("#sucursal").val(infosucursal[1]);
      $("#modal-sucDes").modal("hide");
    })

    $(document).on("keyup","#tbdespacho input", function(){
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
        despachosum();
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
        despachosum();
      }
    });

    function despachosum(){//venta
      subtotal = 0;
      subtotal0 = 0;

      $("#tbdespacho tbody tr").each(function(){
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

    $(document).on("click", ".btn-check",function(){
      sucursal = $(this).val();
      infosucursal = sucursal.split("*");
      $("#idsucursal").val(infosucursal[0]);
      $("#sucursal").val(infosucursal[1]);
      $("#modal-default").modal("hide");
    })

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

    ;

   /** $(document).on("click","#pro",function(){
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
    })*/
    //<!--Fin Ventas-->


  //campos de documentos jquery.mask.js
  $(document).ready(function(){
    $('#DUI').mask('00000000-0');
    $('#NIT').mask('0000-000000-000-0');
  });
  
  $(document).ready(function(){
    validarFormulario();
  });  

  function validarFormulario(){
   jQuery.validator.messages.required = 'Esta campo es obligatorio.';
   jQuery.validator.messages.number = 'Esta campo debe ser num&eacute;rico.';
   jQuery.validator.messages.email = 'La direcci&oacute;n de correo es incorrecta.';
   $("#formulario").validate();
 }
 
 
