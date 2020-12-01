
	

		function modificarfactura(){

			var id=$("#mod_codigo").val();
			var cantidad=$("#mod_cantidad").val();
			var id_factura=$("#id_factura").val();
			
			$.ajax({
        		type: "GET",
				url: "./ajax/pedido_modificar.php",
        		data: "id_factura="+id_factura+"&id_codigo="+id+"&cantidad="+cantidad,
		 		beforeSend: function(objeto){
					$("#resultadosmodificar").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					$("#resultadosmodificar").html(datos);
		
				}
			});
		}
		
		function eliminarmodificar(id){
			var id_factura=$("#id_factura").val();
			$.ajax({
				type: "GET",
				url: "./ajax/pedido_modificar.php",
				data: "eliminar=1&id_eliminar="+id+"&id_factura="+id_factura,
				 beforeSend: function(objeto){
					$("#resultadosmodificar").html("Mensaje: Cargando...");
				  },
				success: function(datos){
				$("#resultadosmodificar").html(datos);
				}
					});
		}
		
		