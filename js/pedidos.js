		$(document).ready(function() {
		    load(1);

		});

		function load(page) {
		    var q = $("#q").val();
		    $("#loader").fadeIn('slow');
		    $.ajax({
		        url: './ajax/buscar_pedidos.php?action=ajax&page=' + page + '&q=' + q,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            $(".outer_div").html(data).fadeIn('slow');
		            $('#loader').html('');
		            $('[data-toggle="tooltip"]').tooltip({ html: true });

		        }
		    })
		}

		$('#nuevo .cerrar2').click(function() {
		    $('#nuevo .notificacion2').css('display', 'none!important');
		})


		function eliminar(id) {
		    var q = $("#q").val();
		    if (confirm("Realmente deseas eliminar este Pedido")) {
		        $.ajax({
		            type: "GET",
		            url: "./ajax/buscar_pedidos.php",
		            data: "id=" + id,
		            "q": q,
		            beforeSend: function(objeto) {
		                $("#resultados").html("Mensaje: Cargando...");
		            },
		            success: function(datos) {
		                $("#resultados").html(datos);
		                load(1);
		            }
		        });
		    }
		}


		function ver_factura(numero_pedido) {
		    //alert('Valor:'+numero_pedido);
		    var fecha = $("#fecha_envio").text();
		    var distribuidor = $("#distribuidor").text();
		    var respuesta = window.open('fpdf/ver_factura.php?id_factura=' + numero_pedido + '&distribuidor=' + distribuidor + '&fecha_envio=' + fecha, '_blank');
		}