
		$(document).ready(function(){
			var id=$("#id_factura").val();
		
			autocompletar_datos();

			//mostrar tabs
			//$("#myModal #marca").addClass('collapse in')
			$("#myModal #linea1").collapse('show')
			//$("#myModal #clase1").addClass('collapse in')

			//$("#myModalpromo #marca").addClass('collapse in')
			$("#myModalpromo #linea1").collapse('show')
			//$("#myModalpromo #clase1").addClass('collapse in')

			//$("#myModalagregar #marca").addClass('collapse in')
			$("#myModalagregar #linea1").collapse('show')
			//$("#myModalagregar #clase1").addClass('collapse in')

			//$("#myModalpromomodificar #marca").addClass('collapse in')
			$("#myModalpromomodificar #linea1").collapse('show')
			//$("#myModalpromomodificar #clase1").addClass('collapse in')*/



			//cambios promo modificar

			if(!id)load(1);else loadmodificar(1);
			if(!id)inicio();else iniciomodificar();	
		});


		//mostrar atributo de filtros
		$('#myModalpromo #atributo1').click(function(){
			if($('#myModalpromo #linea1').hasClass('in')){
				$('#myModalpromo #linea1').collapse('hide');
			}else{
				$('#myModalpromo #linea1').collapse('show');
			}
		})
		$('#myModalpromo #atributo2').click(function(){
			if($('#myModalpromo #marca').hasClass('in')){
				$('#myModalpromo #marca').collapse('hide');
			}else{
				$('#myModalpromo #marca').collapse('show');
			}
		})

		$('#myModalpromo #atributo3').click(function(){
			if($('#myModalpromo #clase1').hasClass('in')){
				$('#myModalpromo #clase1').collapse('hide');
			}else{
				$('#myModalpromo #clase1').collapse('show');
			}
		})


		$('#myModal #atributo1').click(function(){
			if($('#myModal #linea1').hasClass('in')){
				$('#myModal #linea1').collapse('hide');
			}else{
				$('#myModal #linea1').collapse('show');
			}
		})
		$('#myModal #atributo2').click(function(){
			if($('#myModal #marca').hasClass('in')){
				$('#myModal #marca').collapse('hide');
			}else{
				$('#myModal #marca').collapse('show');
			}
		})

		$('#myModal #atributo3').click(function(){
			if($('#myModal #clase1').hasClass('in')){
				$('#myModal #clase1').collapse('hide');
			}else{
				$('#myModal #clase1').collapse('show');
			}
		})


		$('#myModalpromomodificar #atributo1').click(function(){
			if($('#myModalpromomodificar #linea1').hasClass('in')){
				$('#myModalpromomodificar #linea1').collapse('hide');
			}else{
				$('#myModalpromomodificar #linea1').collapse('show');
			}
		})
		$('#myModalpromomodificar #atributo2').click(function(){
			if($('#myModalpromomodificar #marca').hasClass('in')){
				$('#myModalpromomodificar #marca').collapse('hide');
			}else{
				$('#myModalpromomodificar #marca').collapse('show');
			}
		})

		$('#myModalpromomodificar #atributo3').click(function(){
			if($('#myModalpromomodificar #clase1').hasClass('in')){
				$('#myModalpromomodificar #clase1').collapse('hide');
			}else{
				$('#myModalpromomodificar #clase1').collapse('show');
			}
		})

		$('#myModalagregar #atributo1').click(function(){
			if($('#myModalagregar #linea1').hasClass('in')){
				$('#myModalagregar #linea1').collapse('hide');
			}else{
				$('#myModalagregar #linea1').collapse('show');
			}
		})
		$('#myModalagregar #atributo2').click(function(){
			if($('#myModalagregar #marca').hasClass('in')){
				$('#myModalagregar #marca').collapse('hide');
			}else{
				$('#myModalagregar #marca').collapse('show');
			}
		})

		$('#myModalagregar #atributo3').click(function(){
			if($('#myModalagregar #clase1').hasClass('in')){
				$('#myModalagregar #clase1').collapse('hide');
			}else{
				$('#myModalagregar #clase1').collapse('show');
			}
		})

		
		//filtraje marca
		function autocompletar_datos(){
			
			$.ajax({
        		type: "GET",
        		url: "./ajax/autocompletar.php",
        		data: "",
				
		 		beforeSend: function(datos){
					$("#outer_div").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
						var tables = datos.split(",");
						autocomplete(document.getElementById("q"), tables);
						autocompletepromo(document.getElementById("q3"), tables);
						autocompletemodificar(document.getElementById("q1"), tables);
						autocompletepromomodificar(document.getElementById("q4"), tables);
						
					}else{
						//$("#myModal #marca").append('<option value="Seleccione..">No aplica marca..</option>');
					}
				},error: function(datos){
				

					console.log('Ha sucedido un error en la consulta:'+datos);
				}
			});
		}

		function iniciomodificar()
		{
			var id=$("#id_factura").val();

			$.ajax({
        		type: "GET",
        		url: "./ajax/pedido_modificar.php?",
        		data: "id_factura='"+id+"'",
		 		beforeSend: function(objeto){
					$("#resultadosmodificar").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					$("#resultadosmodificar").html(datos);
		
				}
			});

		}
		function load(page){
			var familia='', marca='', clase='';
			var q= $("#q").val();
			//realizar consultas
			if (localStorage.getItem("Familia")) {
				//Haz algo aquí
				familia=localStorage.getItem("Familia");
			}
			
			if (localStorage.getItem("Marca")) {
				//Haz algo aquí
				marca=localStorage.getItem("Marca");
			}
			if (localStorage.getItem("Clase")) {
				//Haz algo aquí
				clase=localStorage.getItem("Clase");
			}

			if(familia!="" || marca!="" || clase!="" || q!="" ){
				direccion='./ajax/productos_pedido.php?action=ajax&familia='+familia+'&marca='+marca+'&clase='+clase+'&parametro='+q;
			}else{
			
				direccion='./ajax/productos_pedido.php?action=ajax&page='+page+'&q='+q;
			}
			$("#loader").fadeIn('slow');
			$.ajax({
				url:direccion,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){

					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
					
				}
			})
		}

		
		
		function loadpromo(page){
			var familia='', marca='', clase='';
			var q= $("#q3").val();
			//realizar consultas
			if (localStorage.getItem("Familia")) {
				//Haz algo aquí
				familia=localStorage.getItem("Familia");
			}
			
			if (localStorage.getItem("Marca")) {
				//Haz algo aquí
				marca=localStorage.getItem("Marca");
			}
			if (localStorage.getItem("Clase")) {
				//Haz algo aquí
				clase=localStorage.getItem("Clase");
			}

			if(familia!="" || marca!="" || clase!="" || q!="" ){
				direccion='./ajax/productos_pedido_promo.php?action=ajax&familia='+familia+'&marca='+marca+'&clase='+clase+'&parametro='+q;
			}else{
			
				direccion='./ajax/productos_pedido_promo.php?action=ajax&page='+page+'&q='+q;
			}

		
			$("#loaderpromo").fadeIn('slow');
			$.ajax({
				url:direccion,
				 beforeSend: function(objeto){
				 $('#loaderpromo').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_divpromo").html(data).fadeIn('slow');
					$('#loaderpromo').html('');
					
				}
			})
		}

	function agregar(id)
		{
			//alert('paso agregar');
			var precio_venta=document.getElementById('precio_venta_'+id).value;
			var cantidad=$('#myModal #cantidad_'+id).val();
			
			//Inicia validacion
			if (isNaN(cantidad))
			{
			 	M.toast({html: "La cantidad ingresada no es un numero",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				document.getElementById('cantidad_'+id).focus();
			
				return false;
			}
			if (isNaN(precio_venta))
			{
				M.toast({html: "El precio del producto no es un numero",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
			
				document.getElementById('precio_venta_'+id).focus();
				return false;
			}
			
			if(cantidad<1){
				if(cantidad==0){
					M.toast({html: "No se permite el ingreso de cantidades en 0",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				
				}else{
				
					M.toast({html: "No se permite el ingreso de numeros negativos",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				}
			
				document.getElementById('cantidad_'+id).focus();
				return false;
			}

			
			//Fin validacion
			
			$.ajax({
				type: "POST",
				url: "./ajax/agregar_pedido.php",
				data: "id="+id+"&precio_venta="+precio_venta+"&agregarproducto=1&cantidad="+cantidad,
				beforeSend: function(objeto){
					$("#resultados").html("Mensaje: Cargando...");
					$("#myModal .agregar").removeAttr('enabled','enabled');
					$("#myModal .agregar").attr('disabled','disabled');
					$("#myModal .agregar i").removeClass('glyphicon glyphicon-plus');
					$("#myModal .agregar i").addClass('fas fa-spinner');
				
				},
				success: function(datos){
					$("#resultados").html(datos);
					$("#myModal .agregar").removeAttr('disabled','disabled');
					$("#myModal .agregar").attr('enabled','enabled');
					$("#myModal .agregar i").removeClass('fas fa-spinner');
					$("#myModal .agregar i").addClass('glyphicon glyphicon-plus');
				},error: function(datos){
					M.toast({html: "Error en el ingreso del producto",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				}
			});
		}


		//agregar en el modificar
		function agregarmodificar(id)
		{

			var precio_venta=document.getElementById('precio_venta_'+id).value;
			var cantidad=$('#myModalagregar #cantidad_'+id).val();
			var id_factura=$("#id_factura").val();
			if (isNaN(cantidad))
			{
			 M.toast({html: "La cantidad ingresada no es un numero",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
			document.getElementById('cantidad_'+id).focus();
			
			return false;
			}
			if (isNaN(precio_venta))
			{
				M.toast({html: "El precio del producto no es un numero",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
			
			document.getElementById('precio_venta_'+id).focus();
			return false;
			}
			if(cantidad<1){
				if(cantidad==0){
					M.toast({html: "No se permite el ingreso de cantidades en 0",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				
				}else{
				
					M.toast({html: "No se permite el ingreso de numeros negativos",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				}
			
				document.getElementById('cantidad_'+id).focus();
				return false;
			}

			//Fin validacion
			
			$.ajax({
        		type: "GET",
        		url: "./ajax/pedido_modificar.php",
        		data: "id="+id+"&id_factura="+id_factura+"&agregarproducto=1&precio_venta="+precio_venta+"&cantidad="+cantidad,
		 		beforeSend: function(objeto){
					$("#resultadosmodificar").html("Mensaje: Cargando...");
					$("#myModalagregar .agregar").removeAttr('enabled','enabled');
					$("#myModalagregar .agregar").attr('disabled','disabled');
					$("#myModalagregar .agregar i").removeClass('glyphicon glyphicon-plus');
					$("#myModalagregar .agregar i").addClass('fas fa-spinner');
				
				},
				success: function(datos){
					$("#resultadosmodificar").html(datos);
					$("#myModalagregar .agregar").removeAttr('disabled','disabled');
					$("#myModalagregar .agregar").attr('enabled','enabled');
					$("#myModalagregar .agregar i").removeClass('fas fa-spinner');
					$("#myModalagregar .agregar i").addClass('glyphicon glyphicon-plus');
				},error: function(datos){
					M.toast({html: "Error en el ingreso del producto",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				}
			});
		}

		function agregarpromomodificar(id){
			var id_factura=$("#id_factura").val();
			var precio_venta=$('#myModalpromomodificar #precio_venta_'+id).val();
			var cantidad=$('#myModalpromomodificar #cantidad_'+id).val();
		
			
			
			//Inicia validacion
			if (isNaN(cantidad))
			{
			 M.toast({html: "La cantidad ingresada no es un numero",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
			document.getElementById('cantidad_'+id).focus();
			
			return false;
			}
			if (isNaN(precio_venta))
			{
				M.toast({html: "El precio del producto no es un numero",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
			
			document.getElementById('precio_venta_'+id).focus();
			return false;
			}
			if(cantidad<1){
				if(cantidad==0){
					M.toast({html: "No se permite el ingreso de cantidades en 0",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				
				}else{
				
					M.toast({html: "No se permite el ingreso de numeros negativos",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				}
			
				document.getElementById('cantidad_'+id).focus();
				return false;
			}
			//Fin validacion
			
			$.ajax({
				type: "GET",
				url: "./ajax/pedido_modificar.php",
				data: "id_factura="+id_factura+"&agregarproducto=2&id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad,
				beforeSend: function(objeto){
					$("#resultadosmodificar").html("Mensaje: Cargando...");
					$("#myModalpromomodificar .agregar").removeAttr('enabled','enabled');
					$("#myModalpromomodificar .agregar").attr('disabled','disabled');
					$("#myModalpromomodificar .agregar i").removeClass('glyphicon glyphicon-plus');
					$("#myModalpromomodificar .agregar i").addClass('fas fa-spinner');
				},
				success: function(datos){
					loadpromomodificar();
					$("#resultadosmodificar").html(datos);
					$("#myModalpromomodificar .agregar").removeAttr('disabled','disabled');
					$("#myModalpromomodificar .agregar").attr('enabled','enabled');
					$("#myModalpromomodificar .agregar i").removeClass('fas fa-spinner');
					$("#myModalpromomodificar .agregar i").addClass('glyphicon glyphicon-plus');	
				},error:function(datos){
					console.log("Error ha sucedido problemas con la consulta SQL")
				}
			});
		}
		function agregarpromo(id)
		{
			var precio_venta=document.getElementById('precio_venta_'+id).value;
			var cantidad=$('#myModalpromo #cantidad_'+id).val();
			
			var preciofinal= $('#valor').text();
			var descuento= $('#descuento').text();
			
			//Inicia validacion
			if (isNaN(cantidad))
			{
			 M.toast({html: "La cantidad ingresada no es un numero",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
			document.getElementById('cantidad_'+id).focus();
			
			return false;
			}
			if (isNaN(precio_venta))
			{
				M.toast({html: "El precio del producto no es un numero",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
			
			document.getElementById('precio_venta_'+id).focus();
			return false;
			}
			if(cantidad<1){
				if(cantidad==0){
					M.toast({html: "No se permite el ingreso de cantidades en 0",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				
				}else{
				
					M.toast({html: "No se permite el ingreso de numeros negativos",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				}
			
				document.getElementById('cantidad_'+id).focus();
				return false;
			}
			//Fin validacion
			
			$.ajax({
				type: "POST",
				url: "./ajax/agregar_pedido.php",
				data: "id="+id+"&precio_venta="+precio_venta+"&agregarproducto=2&cantidad="+cantidad,
				beforeSend: function(objeto){
					$("#resultados").html("Mensaje: Cargando...");
					$("#myModalpromo .agregar").removeAttr('enabled','enabled');
					$("#myModalpromo .agregar").attr('disabled','disabled');
					$("#myModalpromo .agregar i").removeClass('glyphicon glyphicon-plus');
					$("#myModalpromo .agregar i").addClass('fas fa-spinner');
				},
				success: function(datos){
					loadpromo();
					$("#resultados").html(datos);
					$("#myModalpromo .agregar").removeAttr('disabled','disabled');
					$("#myModalpromo .agregar").attr('enabled','enabled');
					$("#myModalpromo .agregar i").removeClass('fas fa-spinner');
					$("#myModalpromo .agregar i").addClass('glyphicon glyphicon-plus');
					
				},error:function(datos){
					console.log("Error ha sucedido problemas con la consulta SQL")
				}
			});
		}
		
		function eliminar (id)
		{
			
			$.ajax({
				type: "GET",
				url: "./ajax/agregar_pedido.php",
				data: "eliminar=1&id="+id,
				beforeSend: function(objeto){
					$("#resultados").html("Mensaje: Cargando...");
				},
				success: function(datos){
				$("#resultados").html(datos);
				}
			});

		}

		function editar (id)
		{
			var cantidad=$('#cantidad_'+id).val();
			if (isNaN(cantidad))
			{
				M.toast({html: "Error No es un numero ",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				document.getElementById('cantidad_'+id).focus();
				return false;
			}
			if(cantidad<1){
				if(cantidad==0){
					
					M.toast({html: "No se permite el ingreso de cantidades en 0",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				}else{
					M.toast({html: "No se permite el ingreso de cantidades menores a 0",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				}
				document.getElementById('cantidad_'+id).focus();
				return false;
			}
		
			$.ajax({
				type: "GET",
				url: "./ajax/agregar_pedido.php",
				data: "editar=1&id_editar="+id+'&cantidad_editar='+cantidad,
				beforeSend: function(objeto){
					$("#resultados").html("Mensaje: Cargando...");
				},
				success: function(datos){
				$("#resultados").html(datos);
				}
			});

		}
		function editar_modificar(id){
			var cantidad=$('#cantidad_'+id).val();
			var id_factura=$("#id_factura").val();
			if (isNaN(cantidad))
			{
				M.toast({html: "Error No es un numero ",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				document.getElementById('cantidad_'+id).focus();
				return false;
			}
			if(cantidad<1){
				if(cantidad==0){
					
					M.toast({html: "No se permite el ingreso de cantidades en 0",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				}else{
					M.toast({html: "No se permite el ingreso de cantidades menores a 0",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				}
				document.getElementById('cantidad_'+id).focus();
				return false;
			}
		
			$.ajax({
				type: "GET",
				url: "./ajax/pedido_modificar.php",
				data: "editar=1&id_editar="+id+'&id_factura='+id_factura+'&cantidad_editar='+cantidad,
				beforeSend: function(objeto){
					$("#resultadosmodificar").html("Mensaje: Cargando...");
				},
				success: function(datos){
				$("#resultadosmodificar").html(datos);
				}
			});
		}

	
		function inicio ()
		{
			$.ajax({
        type: "GET",
        url: "./ajax/agregar_pedido.php",
        data: "inicio=1",
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		
		}
			});

		}
		
		$("#datos_factura").submit(function(){
			
		  var id_cliente = $("#id_cliente").val();
		  var id_vendedor = $("#id_vendedor").val();
		  var condiciones = $("#condiciones").val();
		  
		  if (id_cliente==""){
			  alert("Debes seleccionar un cliente");
			  $("#nombre_cliente").focus();
			  return false;
		  }
		 VentanaCentrada('./pdf/documentos/pedido_pdf.php?id_cliente='+id_cliente+'&id_vendedor='+id_vendedor+'&condiciones='+condiciones,'Factura','','1024','768','true');
	 	});
		
		$( "#guardar_cliente" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_cliente.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})
		
		$( "#guardar_producto" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax_productos").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax_productos").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})
