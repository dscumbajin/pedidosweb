<?php
	/*-------------------------
	Autor: Jorge F prieto L
	Web: bateriasecuador.com
	Mail: info@bateriasecuador.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
	}
	//$_SESSION['maxPrecioPromo']=0;
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Nuevo Pedido | Baterías _ Pedidos";
	//declarar nombre de filtros
	$tituloFiltro="Baterías Ecuador";
	$nombrePrincipal="Clasificación";
	$primerFiltro="PRODUCTOS";
	$segundoFiltro="MARCA";
	$tercerFiltro="TIPO";

	//declarar nombres de las tablas modales filtro-producto
	$campo1tabla="Marca";
	$campo2tabla="Producto";
	$campo3tabla="Nombre";
	$GLOBALS['campo1tabla'];
	$GLOBALS['campo2tabla'];
	$GLOBALS['campo3tabla'];
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

	$sqlPromoNombre=mysqli_query($con, "SELECT p.nombre FROM promociones p WHERE p.codigoPromocion='".$_SESSION['promoactiva']."'");
		$rowPromoNombre=mysqli_fetch_array($sqlPromoNombre);
		
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php 
	
	 	include("head.php");
	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script>
		localStorage.clear();
	</script>
  </head>
  <body>
	<?php		
		include("navbar.php");
	?>  
	

    <div class="container" style="margin-top:40px;">
	<div class="panel panel-info">
		<div class="panel-heading">
			<?php
				if(isset($_GET['id_factura'])){
			?>
					<h4><i class='glyphicon glyphicon-edit'></i> Modificar Pedido</h4>
			<?php
				}else{	
			?>
					<h4><i class='glyphicon glyphicon-edit'></i> Nuevo Pedido</h4>
			<?php
				}
			?>
		</div>
		<div class="panel-body">
		<?php 
			include("modal/buscar_productos.php");
			include("modal/buscar_productos_modificar.php");
			include("modal/buscar_productos_promo.php");
			include("modal/registro_clientes.php");
			include("modal/registro_productos.php");
			include("modal/modificar_factura.php");
			include("modal/moda_promo_modificar.php");
			include("modal/modal_descripcion.php");
			include("modal/modal_descripcion_modificar.php");
			//<!--onclick="imprimirfactura()"-->
		?>
			<form class="form-horizontal" role="form" id="datos_factura">
				<div class="alert alert-warning" role="alert" style="display:flex; margin:auto; display:none; margin-bottom:20px" class="notificacion" id="notificacion" >
			
					  	<div class="preloader"></div>
					  	<span style="margin:auto; flex:0 1 80%;" id="notificacion">Cargando-- Generando Factura  porfavor espere...</span>
					  
				</div>
		

				<progress id="progress" value="0" style="width:100%; display:none;"></progress>
				<div class="row">
					<?php
						if(isset($_GET['id_factura'])){
					?>
						<label for="id_factura" class="col-md-1 control-label">CI_factura</label>
						<div class="col-md-1">
							<input type="text" readonly class="form-control input-sm" id="id_factura" value="<?php $_GET['id_factura']=mysqli_real_escape_string($con,(strip_tags($_GET['id_factura'],ENT_QUOTES)));
							$_GET['id_factura']=str_replace(
								array("\\", "¨", "º", "-", "~",
									"#", "@", "|", "!", "\"",
									"·", "$", "%", "&", "/",
									"(", ")", "?", "'", "¡",
									"¿", "[", "^", "<code>", "]",
									"+", "}", "{", "¨", "´",
									">", "< ", ";", ",", ":",
									".", " "),
								' ',
								$_GET['id_factura']
							); echo $_GET['id_factura'] ?>" readonly>
						</div>
					<?php
						}	
					?>
				</div>
				<br>
			
				
				<div class="form-group row">
				  <label for="nombre_cliente" class="col-md-1 control-label">Distribuidor</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="nombre_cliente" placeholder="Selecciona un cliente" value="<?php echo $_SESSION['user_name']; ?>" readonly>
					  <input id="id_cliente" type='hidden' value="<?php echo $_SESSION['user_id']; ?>">	
				  </div>
				 
				  <label for="email" class="col-md-1 control-label">Pago</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" id="condiciones2" value="Crédito" placeholder="Crédito" readonly>
								<input type="hidden" class="form-control input-sm" id="condiciones" value="4" placeholder="Crédito" readonly>
							</div>
					<label for="mail" class="col-md-1 control-label">Email</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" id="mail" placeholder="Email" value="<?php echo $_SESSION['user_email']; ?>" readonly>
							</div>
				 </div>
						<div class="form-group row">
							
							<label for="empresa" style="display:none;" class="col-md-1 control-label">Codigo</label>
							<div class="col-md-3">
								<input type="hidden" class="form-control input-sm" id="id_vendedor" value="<?php echo $_SESSION['user_id']; ?>" readonly>	
							</div>
							<label for="tel2"  style="display:none;"  class="col-md-1 control-label">Fecha</label>
							<div class="col-md-2">
								<input type="hidden" class="form-control input-sm" id="fecha" value="<?php if(isset($_GET['fecha_factura']))echo $_GET['fecha_factura'];else echo date("d/m/Y");?>" readonly>
							</div>
							
						</div>
						<div class="form-group row activarse" style="display:flex; flex-wrap:wrap; justify-content:center; padding:10px 20px; border-top:1px solid #c8c8c8; border-bottom:1px solid #c8c8c8;">
							
								<?php
									if(!isset($_GET['accionar'])){
								?>
								<div class="row cambiarposicion"  style="display:flex;flex:0 1 50%;justify-content:flex-start;">
									<div class="col" style="margin-left:10px; margin-bottom:10px;">
										<button type="button" class="btn btn-dark" style="padding:10px;" data-toggle="modal" data-target="#myModal">
											<span class="glyphicon glyphicon-plus"  data-tooltip="I am a tooltip"></span> Agregar productos
										</button>
									</div>
								</div>
								<div class="row alterarposicion" style="display:flex;flex:0 1 50%; width:100%;justify-content:flex-end;">
									<div class="col" style="margin-left:10px; margin-bottom:10px;">
										<button type="button" onclick="guardarcambio()" style="padding:10px;"  class="btn btn-dark ">
										<span class="glyphicon glyphicon-floppy-disk "></span> Guardar Pedido
										</button>
									</div>
									
									<div class="col" style="margin-left:10px;">
										<button type="button"   data-toggle="modal" data-target="#comentario" style="padding:10px;" class="btn btn-dark">
											<span class="glyphicon glyphicon-send "></span> Enviar Pedido
										</button>
									</div>
								</div>
								<?php
									}else{
										
								?>
								<div class="row cambiarposicion" style="display:flex;flex:0 1 50%;justify-content:flex-start;">
									<div class="col" style="margin-left:10px; margin-bottom:10px;">
										<button type="button" class="btn btn-dark" style="padding:10px;" data-toggle="modal" data-target="#myModalagregar">
											<span class="glyphicon glyphicon-plus"></span> Agregar productos
										</button>
									</div>
								</div>
								<div class="row alterarposicion" style="display:flex;flex:0 1 50%; width:100%;justify-content:flex-end;">
									<div class="col" style="margin-left:10px; margin-bottom:10px;">
										<button type="button" onclick="descartarcambios()" style="padding:10px;"  class="btn btn-dark">
										<span class="glyphicon glyphicon-remove"></span> Descartar Cambios
										</button>
									</div>
								
									<div class="col" style="margin-left:10px; margin-bottom:10px;">
										<button type="button" onclick="modificarcambio()" style="padding:10px;"  class="btn btn-dark">
										<span class="glyphicon glyphicon-floppy-disk"></span> Guardar Cambios
										</button>
									</div>
									
									<div class="col" style="margin-left:10px;">
										<button type="button" data-toggle="modal" data-target="#comentario2" style="padding:10px;" class="btn btn-dark">
											<span class="glyphicon glyphicon-send"  data-tooltip="I am a tooltip"></span> Enviar Pedido
										</button>
									</div>
								</div>
								<?php 
									}
								?>
								
							</div>
					
				
			</form>	

			<?php
				if(isset($_GET['accionar'])){
				?>
					<div id="resultadosmodificar" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->
				<?php
				
					}else{						
				?>
					<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->	
		<?php 
			}
		
		?>		
		</div>
	
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/nueva_factura.js"></script>
	<script type="text/javascript" src="js/editar_factura.js"></script>
	<script type="text/javascript" src="js/autocomplete.js"></script>
	<script type="text/javascript" src="js/autocompletepromo.js"></script>
	<script type="text/javascript" src="js/autocompletemodificar.js"></script>
	<script type="text/javascript" src="js/autocompletepromocambio.js"></script>
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	

	<script>
	
	if($('#historico').hasClass('activarnav')){
		$('#historico').removeClass('activarnav');
		$('#nuevo').addClass('activarnav');
		$('#facturacion').removeClass('activarnav');
	}



	
	function el1(el) {
		  	console.log(el);
		  	document.getElementById('cantidad_'+el).addEventListener('input',function() {
			var val = this.value;
			if(val>0){
				this.value = val.replace(/\D|\-/,'');
			}else{
				this.value = val.replace(/\D|\-/|0,'');
			}
			
		});  
	}

	//modales control
	function el2(el) {
		  	console.log(el);
		  	document.getElementById('cantidad_'+el).addEventListener('input',function() {
			var val = this.value;
			if(val>0){
				this.value = val.replace(/\D|\-/,'');
			}else{
				this.value = val.replace(/\D|\-/|0,'');
			}
			
		});  
	}
	function el3(el) {
		  	console.log(el);
		  	document.getElementById('cantidad_'+el).addEventListener('input',function() {
			var val = this.value;
			if(val>0){
				this.value = val.replace(/\D|\-/,'');
			}else{
				this.value = val.replace(/\D|\-/|0,'');
			}
			
		});  
	}
	function el4(el) {
		  	console.log(el);
		  	document.getElementById('cantidad_'+el).addEventListener('input',function() {
			var val = this.value;
			if(val>0){
				this.value = val.replace(/\D|\-/,'');
			}else{
				this.value = val.replace(/\D|\-/|0,'');
			}
			
		});  
	}
	function el(el) {
		  	console.log(el);
		  	document.getElementById('cantidad_'+el).addEventListener('input',function() {
			var val = this.value;
			if(val>0){
				this.value = val.replace(/\D|\-/,'');
			}else{
				this.value = val.replace(/\D|\-/|0,'');
			}
			
		});  
	}

	//limitar hasta 100
	function limitar(e, contenido, caracteres)
        {
            // obtenemos la tecla pulsada
            var unicode=e.keyCode? e.keyCode : e.charCode;
			document.descripcion.caracteres.value=document.descripcion.comentario.value.length 
			document.descripcion2.caracteres2.value=document.descripcion2.comentario2.value.length 
			var characterReg = /[`~!@#$%^&*()_°¬|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
            // Permitimos las siguientes teclas:
            // 8 backspace
            // 46 suprimir
            // 13 enter
            // 9 tabulador
            // 37 izquierda
            // 39 derecha
            // 38 subir
			// 40 bajar
			var iChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?¡"; 

		   if(unicode==8 || unicode==46 || unicode==13 || unicode==9 || unicode==37 || 
		   unicode==32 || unicode==39  || unicode==38 || unicode==40
		   )
			return true;
			   
			var inputVal = $('.modal #comentario').val();	
			
			if(characterReg.test(inputVal)) {		
				$('.modal #comentario').val(inputVal.replace(/[`~!@#$%^&*()_|+\-=?;,.<>\{\}\[\]\\\/]/gi,''));
							
			}


            // Si ha superado el limite de caracteres devolvemos false
			if(contenido.length>=caracteres){
				M.toast({html: "No puede ingresar mas de 100 carcteres",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				return false;
			}

		}
		

	//limitar hasta 100
	function limitar2(e, contenido, caracteres)
        {
            // obtenemos la tecla pulsada
            var unicode=e.keyCode? e.keyCode : e.charCode;
			document.descripcion.caracteres.value=document.descripcion.comentario.value.length 
			document.descripcion2.caracteres2.value=document.descripcion2.comentario2.value.length 
			var characterReg = /[`~!@#$%^&*()_°¬|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
            // Permitimos las siguientes teclas:
            // 8 backspace
            // 46 suprimir
            // 13 enter
            // 9 tabulador
            // 37 izquierda
            // 39 derecha
            // 38 subir
			// 40 bajar
			var iChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?¡"; 
		

		   if(unicode==8 || unicode==46 || unicode==13 || unicode==9 || unicode==37 || 
		   unicode==32 || unicode==39  || unicode==38 || unicode==40
		   )
			return true;
			   
			var inputVal = $('.modal #comentario2').val();	
			
			if(characterReg.test(inputVal)) {		
				$('.modal #comentario2').val(inputVal.replace(/[`~!@#$%^&*()_|+\-=?;,.<>\{\}\[\]\\\/]/gi,''));
							
			}


            // Si ha superado el limite de caracteres devolvemos false
			if(contenido.length>=caracteres){
				M.toast({html: "No puede ingresar mas de 100 carcteres",classes: "error",displayLength:3000,inDuration:400,outDuration:400});
				return false;
			}

        }
	
	


	$('#myModalpromo').on('shown.bs.modal', function () {
		limpiar();
		loadpromo(1);
		
		cargarfiltro();
		cargarfiltro_2();
		cargarfiltro_3();
		cargarfiltro_4();  
	})
	$('#myModalpromomodificar').on('shown.bs.modal', function () {
		limpiar();
		loadpromomodificar();
		cargarfiltro();
		cargarfiltro_2();
		cargarfiltro_3();
		cargarfiltro_4();  
	})
	$('#myModal').on('shown.bs.modal', function () {
		limpiar();
		load();
		cargarfiltro();
		cargarfiltro_2();
		cargarfiltro_3();
		cargarfiltro_4();  
	
	})
	$('#myModalagregar').on('shown.bs.modal', function () {
		limpiar();
		loadmodificar();
		cargarfiltro();
		cargarfiltro_2();
		cargarfiltro_3();
		cargarfiltro_4();  
	})

			//Modal
		$('#myModalmodificar').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
  				var recipient = button.data('id') // Extract info from data-* attributes
				var recipient1 = button.data('nombre') // Extract info from data-* attributes
				var recipient2 = button.data('cantidad') // Extract info from data-* attributes
				var recipient3 = button.data('precio') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  				var modal = $(this)
  				
  				modal.find('.modal-body #mod_codigo').val(recipient)
				modal.find('.modal-body #mod_nombre').val(recipient1)
				modal.find('.modal-body #mod_cantidad').val(recipient2)
				modal.find('.modal-body #mod_precio').val(recipient3)
		})

		//gaurdar factura
		function guardarcambio(){
			var preciofinal= $('#sin_iva').text();
			var descuento= $('#descuento').text();
			
			$.ajax({
        		type: "POST",
        		url: "./ajax/agregar_pedido.php",
        		data: "accion=guardar&total="+preciofinal+"&descuento="+descuento,
		 		beforeSend: function(objeto){
					$("#resultados").html("Mensaje: Cargando...");

		  		},
        		success: function(datos){
					$("#resultados").html(datos);
				}
			});
		}
		//modificar factura
		function loadmodificar(page){
			var q= $("#q1").val();
			var familia='', marca='', clase='';
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
				direccion='./ajax/producto_pedido_modificar.php?action=ajax&familia='+familia+'&marca='+marca+'&clase='+clase+'&parametro='+q;
			}else{
			
				direccion='./ajax/producto_pedido_modificar.php?action=ajax&page='+page+'&q='+q;
			}

			$("#loader").fadeIn('slow');
			//console.log(q);
			$.ajax({
				url:direccion,
				 beforeSend: function(objeto){
				 $('#loader1').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div1").html(data).fadeIn('slow');
					$('#loader1').html('');
					
				},
				error:function(){
					alert('Error ha sucedido algo');
				}
			})
		}

	
		function cambiarcolor(){ 
			$('#descripcion #comentario').css('border','1px solid #b3b3b3');
			$('#alerta').css('display','none');
		} 
		function cambiarcolor2(){ 
			$('#descripcion2 #comentario2').css('border','1px solid #b3b3b3');
			$('#alerta2').css('display','none');
		} 
		function transfer_failed(e){$('#notificacion span').html('Error ha sucedido algo con la transferencia del archivo');}
		function transfer_canceled(e){$('#notificacion span').html('Proceso cancelado por parte del usuario');}
		//imprimir factura

		function imprimirfactura(){
			var codigo=$('#id_vendedor').val();
			var pago=$('#condiciones2').val();
			var subtotal=$('#con_iva').text();
			var iva=$('#iva').text();
			var total=$('#valor').text();
			var descuento=$('#descuento').text();
			
			var sin_iva=$('#sin_iva').text();
			var comentario=document.descripcion.comentario.value;
			var comentario_valor= document.descripcion.comentario.value.length;

			if(comentario_valor>100){
				$('#descripcion #comentario').css('border','1px solid #fd3c3d');
				$('#alerta').css('display','block');
				return false;
			}else{
				if(comentario_valor==0){
					comentario="Sin novedad";
				
				}
			}
			if(total==0){
				M.toast({html: "No existen productos seleccionados para crear pedido",classes: "error",displayLength:5000,inDuration:700,outDuration:700});
				$('#comentario').modal('hide');
				return false;
			}else{
				$('#notificacion').css('display','flex');
				//return 0;
				var progressBar = document.getElementById("progress");
				$('#progress').css('display','block');
				var xhr = new XMLHttpRequest();
				url='fpdf/index.php?id_usuario='+codigo+'&pago='+pago+'&subtotal='+subtotal+'&iva='+iva+'&total='+total+'&descuento='+descuento+'&sin_iva='+sin_iva+'&comentario='+comentario,'_blank';
    			xhr.open('GET', url+'&' + Math.floor(Math.random() * 99999),true);
				xhr.responseType = 'blob';

				
				xhr.onprogress = function(e) {
						$(".btn").attr("disabled","disabled");
						var calculo=(e.loaded-17)*0.000010;
						progressBar.value = calculo
						console.log(calculo);
						if(calculo>1){
							M.toast({html: "Su pedido ha sido enviado exitosamente...",classes: "correcto",displayLength:5000,inDuration:700,outDuration:700});
							$(".btn").attr("enabled","enabled");
							$(".btn").removeAttr("disabled","disabled");
						}else{
							M.toast({html: "Procediendo a generar Pedido espere...",classes: "espera",displayLength:5000,inDuration:700,outDuration:700});
							$('#notificacion span ').html('Pedido generado mostrando Pedido, pronto sera dirigido al historico de Baterías Ecuador....');
						}
				};

				
				xhr.addEventListener("error", transfer_failed);
				xhr.addEventListener("abort", transfer_canceled);

				xhr.onloadend = function(e) {
					progressBar.value = e.loaded;
					
				};
				xhr.onloadstart = function(e) {
						$('#comentario').modal('hide');
						$('#notificacion span').html('Cargando Librerias Y generando Factura');
				};
				

    			xhr.onload = function(e) {
      				if (this.status == 200) {
						$('#notificacion').css('display','block');
						$('#progress').css('display','none');
        				var blob = new Blob([this.response], {type: 'application/pdf'});
						var link = document.createElement('a');
						
        				link.download = "Baterias-Ecuador-Pedido.pdf";
						link.click();
						location.href="pedidos.php?action=correcto";
						var fileURL = URL.createObjectURL(blob);    
						// definimos la anchura y altura de la ventana
						var w= 1000;
						var h=800;
						var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
    					var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

   						var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    					var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    					var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    					var top = ((height / 2) - (h / 2)) + dualScreenTop;

						var newWin = window.open(fileURL,'_blank','scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
                    	newWin.focus();
						newWin.reload();
						
      				}else{
							$('#notificacion').css('display','none');
						  alert('Error ha sucedido algo con el envio de datos al correo'+this.responseText);
					}
    			};
				xhr.send(null);
			}
		
		}
		function imprimirfacturamod(){
			var codigo=$('#id_factura').val();
			var pago=$('#nombre_cliente').val();
			var total=$('#valor').text();
			var subtotal=$('#con_iva').text();
			var iva=$('#iva').text();
			var total=$('#valor').text();
			var descuento=$('#descuento').text();
			var sin_iva=$('#con_iva').text();
			var fecha=$('#fecha').val();
			var comentario=document.descripcion2.comentario2.value;
			var comentario_valor= document.descripcion2.comentario2.value.length;

			console.log(comentario_valor);
			if(comentario_valor>100){
				$('#descripcion2 #comentario2').css('border','1px solid #fd3c3d');
				$('#alerta2').css('display','block');
				return false;
			}else{
				if(comentario_valor==0){
					comentario="Sin novedad";
				
				}
			}
			if(total==0){
				 M.toast({html: "No existen productos seleccionados para crear pedido",classes: "error",displayLength:5000,inDuration:700,outDuration:700});
		
				$('#comentario2').modal('hide');
			}else{
				$('#notificacion').css('display','flex');
				var progressBar = document.getElementById("progress");
				$('#progress').css('display','block');
				//return 0;
				var progressBar = document.getElementById("progress");
				var xhr = new XMLHttpRequest();
				url='fpdf/ver_modificar.php?fecha='+fecha+'&id_factura='+codigo+'&distribuidor='+pago+'&subtotal='+subtotal+'&iva='+iva+'&total='+total+'&descuento='+descuento+'&sin_iva='+sin_iva+'&comentario='+comentario,'_blank';
    			xhr.open('GET', url+'&' + Math.floor(Math.random() * 99999), true);
				xhr.responseType = 'blob';
				xhr.onprogress = function(e) {
					$(".btn").attr("disabled","disabled");

    				var calculo=(e.loaded-17)*0.000010;
						progressBar.value = calculo
						
						if(calculo>1){
							M.toast({html: "Su pedido ha sido enviado exitosamente...",classes: "correcto",displayLength:5000,inDuration:700,outDuration:700});
							$(".btn").attr("enabled","enabled");
							$(".btn").removeAttr("disabled","disabled");
						}else{
							M.toast({html: "Procediendo a generar Pedido espere...",classes: "espera",displayLength:5000,inDuration:700,outDuration:700});
							$('#notificacion span ').html('Pedido generado mostrando Pedido, pronto sera dirigido al historico de Baterías Ecuador....');
						}
				};
				
				xhr.addEventListener("error", transfer_failed);
				xhr.addEventListener("abort", transfer_canceled);

				xhr.onloadend = function(e) {
    				progressBar.value = e.loaded;
				};
				xhr.onloadstart = function(e) {
						$('#comentario2').modal('hide');
						$('#notificacion span').html('Cargando Librerias Y generando Factura');
				};
				

    			xhr.onload = function(e) {
      				if (this.status == 200) {
						$('#progress').css('display','none');
						$('#notificacion').css('display','none');
        				var blob = new Blob([this.response], {type: 'application/pdf'});
						var link = document.createElement('a');
						
        				link.download = "Baterias-Ecuador-Pedido.pdf";
						link.click();
						location.href="pedidos.php?action=correcto";
						var fileURL = URL.createObjectURL(blob);    
						// definimos la anchura y altura de la ventana
						var w= 1000;
						var h=800;
						var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
    					var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

   						var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    					var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    					var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    					var top = ((height / 2) - (h / 2)) + dualScreenTop;

						var newWin = window.open(fileURL,'_blank','scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
                    	newWin.focus();
						newWin.reload();
						
      				}else{
							$('#notificacion').css('display','none');
						  alert('Error ha sucedido algo con el envio de datos al correo'+this.responseText);
					}
    			};
				xhr.send(null);
			}
		}

		function loadpromomodificar(page){
			var q= $("#q4").val();
			var familia='', marca='', clase='';
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
				direccion='./ajax/productos_pedido_promo_modificar.php?action=ajax&familia='+familia+'&marca='+marca+'&clase='+clase+'&parametro='+q;
			}else{
			
				direccion='./ajax/productos_pedido_promo_modificar.php?action=ajax&page='+page+'&q='+q;
			}

			$("#loaderpromo").fadeIn('slow');
			$.ajax({
				url:direccion,
				 beforeSend: function(objeto){
				 $('#loaderpromo1').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_divpromo1").html(data).fadeIn('slow');
					$('#loaderpromo1').html('');	
				},
				error:function(data){
					console.log(data);
				}
			})
		}
		

		function modificarcambio(){
			var preciofinal= $('#sin_iva').text();
			var descuento= $('#descuento').text();
			var id_factura=$("#id_factura").val();
			$.ajax({
        		type: "GET",
        		url: "./ajax/pedido_modificar.php?",
        		data: "id_factura="+id_factura+"&guardar=datos&total="+preciofinal+"&descuento="+descuento,
		 		beforeSend: function(objeto){
					$("#resultadosmodificar").html("Mensaje: Cargando...");

		  		},
        		success: function(datos){
					$("#resultadosmodificar").html(datos);
				}
			});
		}

		function descartarcambios(){
			var preciofinal= $('#valor').text();
			var descuento= $('#descuento').text();
			var id_factura=$("#id_factura").val();
			$.ajax({
        		type: "GET",
        		url: "./ajax/pedido_modificar.php?",
        		data: "id_factura="+id_factura+"&descartar=datos&total="+preciofinal+"&descuento="+descuento,
		 		beforeSend: function(objeto){
					$("#resultadosmodificar").html("Mensaje: Cargando...");

		  		},
        		success: function(datos){
					$("#resultadosmodificar").html(datos);
				}
			});
		}


		//limpiar
		function limpiar(){
			localStorage.clear();
			$('#marca_general li').removeClass('selecteds');
			$('#marca_general li').removeClass('selected2');
			$('#marca_general li').removeClass('selected3');

			//limpiar y resetear filto

			$('#marca_general .marca').css('display','none');
			$('#marca_general .clase').css('display','none');

			//limpiar buscadores
			$("#q3").val('');
			$("#q").val('');
			$("#q1").val('');
			$("#q4").val('');

			//ocultar filtros
			$("#myModal #marca").collapse('hide')
			//$("#myModal #linea1").collapse('hide')
			$("#myModal #clase1").collapse('hide')

			$("#myModalpromo #marca").collapse('hide')
			//$("#myModalpromo #linea1").collapse('hide')
			$("#myModalpromo #clase1").collapse('hide')

			$("#myModalagregar #marca").collapse('hide')
			//$("#myModalagregar #linea1").collapse('hide')
			$("#myModalagregar #clase1").collapse('hide')

			$("#myModalpromomodificar #marca").collapse('hide')
			//$("#myModalpromomodificar #linea1").collapse('hide')
			$("#myModalpromomodificar #clase1").collapse('hide')
			
		}
		function cargarfiltro(){
			limpiar();
			filtrar_marca();
			filtrarlinea();
			filtrarfamilia();
			filtrarclase();
			localStorage.removeItem("Familia", valor);
			localStorage.removeItem("Marca", valor);
			localStorage.removeItem("Clase", valor);
			load();
			
		}
		function cargarfiltro_2(){
			limpiar();
			filtrar_marca_promo();
			filtrarlineapromo();
			filtrarfamiliapromo();
			filtrarclasepromo();
			loadpromo();
			
		}
		function cargarfiltro_3(){
			limpiar();
			filtrarmarcamodificar();
			filtrarlineamodificar();
			filtrarclasemodificar();
			filtrarfamiliamodificar();
			loadmodificar();
			
		}
		function cargarfiltro_4(){
			limpiar();
			filtrarmarcamodificarpromo();
			filtrarclasemodificarpromo();
			filtrarfamiliamodificarpromo();
			filtrarlineamodificarpromo();
			loadpromomodificar();
			M.toast({html: 'Área de Filtro cargado exitosamente!',classes: 'correcto',displayLength:5000,inDuration:700,outDuration:700});
		}

		


		
		//filtraje marca
		function filtrar_marca(){
			$("#myModal #marca").empty();
			
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtrar_marca.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_div").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
					
						//$("#marca").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#marca").append('<option value='+registro.codigomarca+'>'+registro.nombremarca+'</option>');
							$("#myModal #marca").append('<li style="display:flex;"><a style="width:100%!important;" href="#" id="'+registro.codigomarca+'" onclick="openfiltro('+"'"+''+registro.codigomarca+''+"'"+')">'+registro.nombremarca+'</a></li>');
						});  
						
					}else{
						$("#myModal #marca").append('<option value="Seleccione..">No aplica marca..</option>');
						
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
					M.toast({html: 'Error en cargar datos para Marca!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
				}
			});
		}

		//filtraje linea
		function filtrarlinea(){
			$("#myModal #linea1").empty();
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtrar_linea.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_div").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
						
						//$("#myModal #linea").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#myModal #linea").append('<option value='+registro.codigolinea+'>'+registro.nombrelinea+'</option>');
							//$("#linea1").append('<li><a href="#" id='+registro.codigolinea+' onclick="openfiltro('+"'"+''+registro.codigolinea+''+"'"+')">'+registro.nombrelinea+'</a></li>');
							
						});  
						
					}else{
					
						$("#myModal #linea1").append('<option value="Seleccione..">No aplica lista_negocio..</option>');
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
					M.toast({html: 'Error en cargar datos para Linea de Negocio!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
				}
			});
		}

			//filtraje linea
			function filtrarclase(){
			$("#myModal #clase1").empty();
			
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtro_clase.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_div").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
						
						//$("#myModal #linea").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#myModal #linea").append('<option value='+registro.codigolinea+'>'+registro.nombrelinea+'</option>');
							$("#myModal #clase1").append('<li style="display:flex;"><a style="width:100%" href="#" id="'+registro.codigoclase+'" onclick="openfiltro3('+"'"+''+registro.codigoclase+''+"'"+')">'+registro.nombreclase+'</a></li>');
						
						});  
						
					}else{
					
						$("#myModal #clase1").append('<option value="Seleccione..">No aplica lista_negocio..</option>');
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
					M.toast({html: 'Error en cargar datos para Linea de Negocio!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
				}
			});
		}

		//filtrar familia
			//filtraje linea
			function filtrarfamilia(){
			$("#myModal #linea1").empty();
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtrar_familia.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_div").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
						//$("#myModal #familia").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#myModal #familia").append('<option value='+registro.codigofamilia+'>'+registro.nombrefamilia+'</option>');
							$("#myModal #linea1").append('<li style="display:flex;"><a style="width:100%" href="#" id="'+registro.codigofamilia+'" onclick="openfiltro2('+"'"+''+registro.codigofamilia+''+"'"+')">'+registro.nombrefamilia+'</a></li>');
						});  
					
					}else{
						$("#myModal #linea1").append('<option value="Seleccione..">No aplica lista_familia..</option>');
						M.toast({html: 'Error en cargar datos para filtro familia SQL!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
				}
			});
		}



	function consulta(familia,marca,clase){
		//consultas de filtros
		//detectar cual es el valor
			var activar=true;
			var q= $("#q").val();
			direccion='./ajax/productos_pedido.php?action=ajax&familia='+familia+'&marca='+marca+'&clase='+clase+'&parametro='+q;
			if(activar===true){
				//cargar data
				$("#loader").fadeIn('slow');
					$.ajax({
						url:direccion,
						beforeSend: function(objeto){
							$('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
						},
						success:function(data){
							$('#myModal #loader').html('');
							$("#myModal #outer_div").html(data).fadeIn('slow');
						},
						error:function(data){
							console.log("Error en acceso a los datos"+data);
						}
					})
				//verificar que seleccciono
			}
	}	


	function openfiltro2(valor){

		//familia filtro
		
		//deseleccionar y seleccionar
		$("#myModal #linea1 li").each(function(){
		
			
			if($(this).text()==valor){
				
				if($(this).hasClass('selecteds')){
					localStorage.removeItem("Familia");
					$(this).removeClass('selecteds')
					$('#myModal #linea1 .remove').remove();
					
				}else{
					$(this).addClass('selecteds')
					localStorage.setItem("Familia", valor);
					$('#myModal #linea1 .remove').remove();
					$(this).append('<i onclick="openfiltro2('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
				}	
			}else{
				
					var expresion=$(this).text().replace(/[\. ,]+/g, " ");
					res = expresion.split(" ");
					if(res[0]==valor){
						
						if($(this).hasClass('selecteds')){
							localStorage.removeItem("Familia");
							$(this).removeClass('selecteds')
							$('#myModal #linea1 .remove').remove();
						}else{
							$(this).addClass('selecteds')
							localStorage.setItem("Familia", valor);
							$('#myModal #linea1 .remove').remove();
							$(this).append('<i onclick="openfiltro2('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}else{
						if($(this).hasClass('selecteds')){
							localStorage.removeItem("Familia");
							$(this).removeClass('selecteds')
							$('#myModal #linea1 .remove').remove();
						}else{
							$(this).addClass('selecteds')
							localStorage.setItem("Familia", valor);
							$('#myModal #linea1 .remove').remove();
							$(this).append('<i onclick="openfiltro2('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
						}	
						
					}
				}
			
		});

		//coger valores del local storage

		var familia='', marca='', clase='';
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

		cargar_filtro();
		//funcion url consulta
		consulta(familia,marca,clase);
        
	}	

	function cargar_filtro(){
		var familia=localStorage.getItem("Familia", valor);
		var marca=localStorage.getItem("Marca", valor);
		var clase=localStorage.getItem("Clase", valor);
		console.log(marca,familia,clase)
		//marca 

		if(familia!=null || marca!=null || clase!=null){

			//armar filtraje
			direccion="./ajax/filtrar_linea_familia.php";
			if(familia!=null && marca==null && clase==null){
				data={'familia':familia};	
			}
			if(familia!=null && clase!=null && marca==null){
				data={'familia':familia,'clase':clase};
			}
			if(familia==null && clase==null && marca!=null){
				data={};
				direccion="./ajax/filtrar_marca.php";
				
			}
			if(familia==null && clase!=null && marca==null){
				data={'clase':clase};
				direccion="./ajax/filtrar_linea_familia.php";
			
			}

			$.ajax({
				url: direccion,
				type:'GET',
				data: data,
				cache:false,
				contentType:false,
				dataType : 'json',
				beforeSend: function(){
					//$('#myModal #marca').append('<option value="Esperando Acceso..">Esperando Acceso...</option>');
				},
				success: function(data){
					
					$("#myModal #marca li").empty();				
					$('#myModal #marca').empty();
					//mostrar filtro 
					$('#myModal #marca').collapse('show');
					if(data!=null){
						

					
						$.each(data,function(index,result){
							
							if(marca!=null){
								if(result.codigomarca==marca){
									$('#myModal #marca').append('<li style="display:flex;" class="selected2"><a  style="width:100%" href="#" id="'+result.codigomarca+'" onclick="openfiltro('+"'"+''+result.codigomarca+''+"'"+')">'+result.nombremarca+'</a><i onclick="openfiltro('+"'"+''+result.codigomarca+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i> </li>');
								}	
							}else{
								if(data.length==1){
									//console.log('aqui');
									//localStorage.setItem("Marca", result.codigomarca);
									$('#myModal #marca').append('<li style="display:flex;" class=""><a  style="width:100%;cursor:default;" href="#" id="'+result.codigomarca+'">'+result.nombremarca+'</a></li>');
								}
								else
									$('#myModal #marca').append('<li style="display:flex;"><a  style="width:100%" href="#" id="'+result.codigomarca+'" onclick="openfiltro('+"'"+''+result.codigomarca+''+"'"+')">'+result.nombremarca+'</a></li>');
							}
							//$('#myModal #marca').append('<li style="display:flex;"><a style="width:100%" href="#" id='+result.codigomarca+' onclick="openfiltro('+"'"+''+result.codigomarca+''+"'"+')">'+result.nombremarca+'</a></li>');

						});
					}else{
						$('#myModal #marca').append('<li><a href="#">No existe productos</a></li>');
					}

					//armar filtraje
				
					direccion="./ajax/filtrar_marca_familia.php";
					if(familia!=null && marca==null && clase==null){
						data={'familia':familia};	
					}

					if(familia!=null && clase!=null && marca==null){
						data={'familia':familia,'clase':clase};
					}

					if(familia!=null && clase==null && marca!=null){
						data={'familia':familia,'marca':marca};
					}

					if(familia==null && marca==null && clase==null){
						console.log('aqui');
						data={};
						direccion="./ajax/filtro_clase.php";
						
					}
					if(familia==null && marca!=null && clase==null){
						data={'marca':marca};
					
					}
			


					$.ajax({
							url:direccion,
							type:'GET',
							data: data,
							cache:false,
							contentType:false,
							dataType : 'json',
							beforeSend: function(){
								//$('#myModal #clase1').append('<option value="Esperando Acceso..">Esperando Acceso...</option>');
							},
							success: function(data){
								//clase

								$("#myModal #clase1 li").empty();			
								$('#myModal #clase1').empty();
								//mostrar filtro 
								$('#myModal #clase1').collapse('show');
								$.each(data,function(index,result){
									//console.log(result.codigomarca)
									if(clase!=null){
										
										if(result.codigoclase==clase){
											$('#myModal #clase1').append('<li style="display:flex;" class="selected3"><a  style="width:100%" href="#" id="'+result.codigoclase+'" onclick="openfiltro3('+"'"+''+result.codigoclase+''+"'"+')">'+result.nombreclase+'</a><i onclick="openfiltro3('+"'"+''+result.codigoclase+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i> </li>');
										}	
									}else{
										if(data.length==1){
											$('#myModal #clase1').append('<li style="display:flex;" class=""><a  style="width:100%;cursor:default;" href="#" id="'+result.codigoclase+'">'+result.codigoclase+'</a></li>');
										}else
											$('#myModal #clase1').append('<li style="display:flex;"><a  style="width:100%" href="#" id="'+result.codigoclase+'" onclick="openfiltro3('+"'"+''+result.codigoclase+''+"'"+')">'+result.nombreclase+'</a></li>');
									}
										
								
									//$('#myModal #clase1').append('<li style="display:flex;"><a  style="width:100%" href="#" id='+result.codigoclase+' onclick="openfiltro3('+"'"+''+result.codigoclase+''+"'"+')">'+result.nombreclase+'</a></li>');

								});
							},
							error: function(data){
								console.log('Ha ocurrido un error: '+data);
							}
					});

					direccion="./ajax/filtrar_familia.php";
					if(familia!=null && marca==null && clase==null){
						data={};	
					}

					if(familia==null && clase!=null && marca!=null){
						data={'marca':marca,'clase':clase};
						direccion="./ajax/filtrar_clase_linea.php";
					}
					if(familia==null && marca!=null && clase==null){
						data={'marca':marca};
						direccion="./ajax/filtrar_clase_linea.php";
					}

					/*if(familia!=null && clase==null && marca!=null){
						data={'familia':familia,'marca':marca};
					}*/

					if(familia==null && marca==null && clase==null){
						//console.log('aqui');
						data={};
						direccion="./ajax/filtro_clase.php";
						
					}
					if(familia==null && marca==null && clase!=null){
						//console.log('aqui');
						data={'clase':clase};
						direccion="./ajax/filtrar_clase_linea.php";
						
					}
					
					$.ajax({
							url: direccion,
							type:'GET',
							data: data,
							cache:false,
							contentType:false,
							dataType : 'json',
							beforeSend: function(){
								//$('#myModal #clase1').append('<option value="Esperando Acceso..">Esperando Acceso...</option>');
							},
							success: function(data){	
								//filtrar familia
								$("#myModal #linea1 li").empty();			
								$('#myModal #linea1').empty();
								$.each(data,function(index,result){
									//console.log(data.length);
									if(familia!=null){
										if(result.codigofamilia==familia){
										
											$('#myModal #linea1').append('<li style="display:flex;" class="selecteds"><a  style="width:100%" href="#" id="'+result.codigofamilia+'" onclick="openfiltro2('+"'"+''+result.codigofamilia+''+"'"+')">'+result.nombrefamilia+'</a><i onclick="openfiltro2('+"'"+''+result.codigofamilia+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i> </li>');
										}	
									}else{
										if(data.length==1){
											//localStorage.setItem("Familia", result.codigofamilia);
											$('#myModal #linea1').append('<li style="display:flex;" class=""><a  style="width:100%;cursor:default;" href="#" id="'+result.codigofamilia+'">'+result.nombrefamilia+'</a></li>');
										}else
											$('#myModal #linea1').append('<li style="display:flex;"><a  style="width:100%" href="#" id="'+result.codigofamilia+'" onclick="openfiltro2('+"'"+''+result.codigofamilia+''+"'"+')">'+result.nombrefamilia+'</a></li>');
									}
									
								});
							},
							error: function(data){
								console.log('Ha ocurrido un error: '+data);
							}
					});
				}
			});
		}else{
		
			filtrar_marca();
			filtrarlinea();
			filtrarfamilia();
			filtrarclase();
		}
	}



	function openfiltro(valor){
		//console.log(valor)
		$("#myModal #marca li").each(function(){
			//familia marca
		
			if($(this).text()==valor){
				if($(this).hasClass('selected2')){
					localStorage.removeItem("Marca");
					$(this).removeClass('selected2')
					$('#myModal #marca .remove').remove();
					localStorage.removeItem("Clase");

				}else{
					$(this).addClass('selected2')
					localStorage.setItem("Marca", valor);
					//crear boton de remover 
					$('#myModal #marca .remove').remove();
					$(this).append('<i onclick="openfiltro('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
				}	
			}else{
				var expresion=$(this).text().replace(/[\. ,]+/g, " ");
				res = expresion.split(" ");

					if(res[0]==valor){
						if($(this).hasClass('selected2')){
							$(this).children('a').children('i').remove();
							localStorage.removeItem("Marca");
							$('#myModal #marca .remove').remove();
						}else{
							$(this).addClass('selected2')
							$('#myModal #marca .remove').remove();
							$(this).children('a').append('<i onclick="openfiltro('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
							localStorage.setItem("Marca", valor);
						}	
					}else{
						if($(this).hasClass('selected2')){
							$(this).children('a').children('i').remove();
							localStorage.removeItem("Marca");
							$('#myModal #marca .remove').remove();
						}else{
							$(this).addClass('selected2')
							$('#myModal #marca .remove').remove();
							$(this).children('a').append('<i onclick="openfiltro('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
							localStorage.setItem("Marca", valor);
						}	
					}
				}
			
		});

		var familia='', marca='', clase='';

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
		//funcion url consulta
		cargar_filtro();
		consulta(familia,marca,clase);
				
	}	

	function openfiltro3(valor){
		$("#myModal #clase1 li").each(function(){
			//familia clase
			if($(this).text()==valor){
				if($(this).hasClass('selected3')){
					$('#myModal #clase1 .remove').remove();
					localStorage.removeItem("Clase");
					$(this).removeClass('selected3');
					//$("#myModal .clase").css('display','none');		
				}else{
					$(this).addClass('selected3');
					localStorage.setItem("Clase", valor);
					$('#myModal #clase1 .remove').remove();
					$(this).append('<i onclick="openfiltro3('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
				}	
			}else{
				var expresion=$(this).text().replace(/[\. ,]+/g, " ");
				res = expresion.split(" ");
					if(res[0]==valor){
						if($(this).hasClass('selected3')){
						
							localStorage.removeItem("Clase");
							$(this).removeClass('selected3');
							$('#myModal #clase1 .remove').remove();
						}else{
							$(this).addClass('selected3');
							localStorage.setItem("Clase", valor);
							$('#myModal #clase1 .remove').remove();
							$(this).append('<i onclick="openfiltro3('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}else{
						if($(this).hasClass('selected3')){
							
							localStorage.removeItem("Clase");
							$(this).removeClass('selected3');
							$('#myModal #clase1 .remove').remove();
						}else{
							$(this).addClass('selected3');
							localStorage.setItem("Clase", valor);
							$('#myModal #clase1 .remove').remove();
							$(this).append('<i onclick="openfiltro3('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}
				}
			
		});
		var familia='', marca='', clase='';

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

		//funcion url consulta
		cargar_filtro();
		consulta(familia,marca,clase);
        
	}




	//filtraje 2 modal promociones

		//filtraje marca
		function filtrar_marca_promo(){
			$("#myModalpromo #marca").empty();
			
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtrar_marca.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_divpromo").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
					
						//$("#marca").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#marca").append('<option value='+registro.codigomarca+'>'+registro.nombremarca+'</option>');
							$("#myModalpromo #marca").append('<li style="display:flex;"><a style="width:100%!important;" href="#" id="'+registro.codigomarca+'" onclick="openfiltro_promo('+"'"+''+registro.codigomarca+''+"'"+')">'+registro.nombremarca+'</a></li>');
						});  
						
					}else{
						$("#myModalpromo #marca").append('<option value="Seleccione..">No aplica marca..</option>');
						
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
					M.toast({html: 'Error en cargar datos para Marca!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
				}
			});
		}

		//filtraje linea
		function filtrarlineapromo(){
			$("#myModalpromo #linea1").empty();
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtrar_linea.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_divpromo").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
						
						//$("#myModal #linea").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#myModal #linea").append('<option value='+registro.codigolinea+'>'+registro.nombrelinea+'</option>');
							//$("#linea1").append('<li><a href="#" id='+registro.codigolinea+' onclick="openfiltro('+"'"+''+registro.codigolinea+''+"'"+')">'+registro.nombrelinea+'</a></li>');
							
						});  
						
					}else{
					
						$("#myModalpromo #linea1").append('<option value="Seleccione..">No aplica lista_negocio..</option>');
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
					M.toast({html: 'Error en cargar datos para Linea de Negocio!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
				}
			});
		}

		//filtraje linea
		function filtrarclasepromo(){
			$("#myModalpromo #clase1").empty();
			
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtro_clase.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_divpromo").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
						
						//$("#myModal #linea").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#myModal #linea").append('<option value='+registro.codigolinea+'>'+registro.nombrelinea+'</option>');
							$("#myModalpromo #clase1").append('<li style="display:flex;"><a style="width:100%" href="#" id="'+registro.codigoclase+'" onclick="openfiltro3_promo('+"'"+''+registro.codigoclase+''+"'"+')">'+registro.nombreclase+'</a></li>');
						
						});  
						
					}else{
					
						$("#myModalpromo #clase1").append('<option value="Seleccione..">No aplica lista_negocio..</option>');
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
					M.toast({html: 'Error en cargar datos para Linea de Negocio!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
				}
			});
		}

		//filtrar familia
		//filtraje linea
		function filtrarfamiliapromo(){
			$("#myModalpromo #linea1").empty();
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtrar_familia.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_divpromo").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
						//$("#myModal #familia").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#myModal #familia").append('<option value='+registro.codigofamilia+'>'+registro.nombrefamilia+'</option>');
							$("#myModalpromo #linea1").append('<li style="display:flex;"><a style="width:100%" href="#" id="'+registro.codigofamilia+'" onclick="openfiltro2_promo('+"'"+''+registro.codigofamilia+''+"'"+')">'+registro.nombrefamilia+'</a></li>');
						});  
					
					}else{
						$("#myModalpromo #linea1").append('<option value="Seleccione..">No aplica lista_familia..</option>');
						M.toast({html: 'Error en cargar datos para filtro familia SQL!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
				}
			});
		}

		function consulta_promo(familia,marca,clase){
		//consultas de filtros
		//detectar cual es el valor
			var activar=true;
			var q= $("#q3").val();
			direccion='./ajax/productos_pedido_promo.php?action=ajax&familia='+familia+'&marca='+marca+'&clase='+clase+'&parametro='+q;
			if(activar===true){
				//cargar data
				$("#loaderpromo").fadeIn('slow');
					$.ajax({
						url:direccion,
						beforeSend: function(objeto){
							$('#loaderpromo').html('<img src="./img/ajax-loader.gif"> Cargando...');
						},
						success:function(data){
							$('#myModalpromo #loaderpromo').html('');
							$("#myModalpromo #outer_divpromo").html(data).fadeIn('slow');
						},
						error:function(data){
							console.log("Error en acceso a los datos"+data);
						}
					})
				//verificar que seleccciono
			}
	}	


	function openfiltro2_promo(valor){

		//familia filtro
		
		//deseleccionar y seleccionar
		$("#myModalpromo #linea1 li").each(function(){
	
			if($(this).text()==valor){
				if($(this).hasClass('selecteds')){
					localStorage.removeItem("Familia");
					$(this).removeClass('selecteds')
					$('#myModalpromo #linea1 .remove').remove();
					
				}else{
					$(this).addClass('selecteds')
					localStorage.setItem("Familia", valor);
					$('#myModalpromo #linea1 .remove').remove();
					$(this).append('<i onclick="openfiltro2_promo('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
				}	
			}else{
				var expresion=$(this).text().replace(/[\. ,]+/g, " ");
				res = expresion.split(" ");
					if(res[0]==valor){
						if($(this).hasClass('selecteds')){
							localStorage.removeItem("Familia");
							$(this).removeClass('selecteds')
							$('#myModalpromo #linea1 .remove').remove();
						}else{
							$(this).addClass('selecteds')
							localStorage.setItem("Familia", valor);
							$('#myModalpromo #linea1 .remove').remove();
							$(this).append('<i onclick="openfiltro2_promo('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}else{
						if($(this).hasClass('selecteds')){
							localStorage.removeItem("Familia");
							$(this).removeClass('selecteds')
							$('#myModalpromo #linea1 .remove').remove();
						}else{
							$(this).addClass('selecteds')
							localStorage.setItem("Familia", valor);
							$('#myModalpromo #linea1 .remove').remove();
							$(this).append('<i onclick="openfiltro2_promo('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}
				}
			
		});

		//coger valores del local storage

		var familia='', marca='', clase='';
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

		cargar_filtro_promo();
		//funcion url consulta
		consulta_promo(familia,marca,clase);
        
	}	

	function cargar_filtro_promo(){
		var familia=localStorage.getItem("Familia", valor);
		var marca=localStorage.getItem("Marca", valor);
		var clase=localStorage.getItem("Clase", valor);
		console.log(marca,familia,clase)
		//marca 

		if(familia!=null || marca!=null || clase!=null){

			//armar filtraje
			direccion="./ajax/filtrar_linea_familia.php";
			if(familia!=null && marca==null && clase==null){
				data={'familia':familia};	
			}
			if(familia!=null && clase!=null && marca==null){
				data={'familia':familia,'clase':clase};
			}
			if(familia==null && clase==null && marca!=null){
				data={};
				direccion="./ajax/filtrar_marca.php";
				
			}
			if(familia==null && clase!=null && marca==null){
				data={'clase':clase};
				direccion="./ajax/filtrar_linea_familia.php";
			
			}

			$.ajax({
				url: direccion,
				type:'GET',
				data: data,
				cache:false,
				contentType:false,
				dataType : 'json',
				beforeSend: function(){
					//$('#myModal #marca').append('<option value="Esperando Acceso..">Esperando Acceso...</option>');
				},
				success: function(data){
					
					$("#myModalpromo #marca li").empty();				
					$('#myModalpromo #marca').empty();
					//mostrar filtro 
					$('#myModalpromo #marca').collapse('show');
					if(data!=null){
						
						$.each(data,function(index,result){
							
							if(marca!=null){
								if(result.codigomarca==marca){
									$('#myModalpromo #marca').append('<li style="display:flex;" class="selected2"><a  style="width:100%" href="#" id="'+result.codigomarca+'" onclick="openfiltro_promo('+"'"+''+result.codigomarca+''+"'"+')">'+result.nombremarca+'</a><i onclick="openfiltro_promo('+"'"+''+result.codigomarca+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i> </li>');
								}	
							}else{
								if(data.length==1){
									$('#myModalpromo #marca').append('<li style="display:flex;" class=""><a  style="width:100%;cursor:default;" href="#" id="'+result.codigomarca+'">'+result.nombremarca+'</a></li>');
								}
								else
									$('#myModalpromo #marca').append('<li style="display:flex;"><a  style="width:100%" href="#" id="'+result.codigomarca+'" onclick="openfiltro_promo('+"'"+''+result.codigomarca+''+"'"+')">'+result.nombremarca+'</a></li>');
							}
							//$('#myModal #marca').append('<li style="display:flex;"><a style="width:100%" href="#" id='+result.codigomarca+' onclick="openfiltro('+"'"+''+result.codigomarca+''+"'"+')">'+result.nombremarca+'</a></li>');

						});
					}else{
						$('#myModalpromo #marca').append('<li><a href="#">No existe productos</a></li>');
					}

					//armar filtraje
				
					direccion="./ajax/filtrar_marca_familia.php";
					if(familia!=null && marca==null && clase==null){
						data={'familia':familia};	
					}

					if(familia!=null && clase!=null && marca==null){
						data={'familia':familia,'clase':clase};
					}

					if(familia!=null && clase==null && marca!=null){
						data={'familia':familia,'marca':marca};
					}

					if(familia==null && marca==null && clase==null){
						console.log('aqui');
						data={};
						direccion="./ajax/filtro_clase.php";
						
					}
					if(familia==null && marca!=null && clase==null){
						data={'marca':marca};
					
					}
			


					$.ajax({
							url:direccion,
							type:'GET',
							data: data,
							cache:false,
							contentType:false,
							dataType : 'json',
							beforeSend: function(){
								//$('#myModal #clase1').append('<option value="Esperando Acceso..">Esperando Acceso...</option>');
							},
							success: function(data){
								//clase

								$("#myModalpromo #clase1 li").empty();			
								$('#myModalpromo #clase1').empty();

								//mostrar filtro 
								$('#myModalpromo #clase1').collapse('show');
								$.each(data,function(index,result){
									//console.log(result.codigomarca)
									if(clase!=null){
										if(result.codigoclase==clase){
											$('#myModalpromo #clase1').append('<li style="display:flex;" class="selected3"><a  style="width:100%" href="#" id="'+result.codigoclase+'" onclick="openfiltro3_promo('+"'"+''+result.codigoclase+''+"'"+')">'+result.nombreclase+'</a><i onclick="openfiltro3_promo('+"'"+''+result.codigoclase+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i> </li>');
										}	
									}else{
										if(data.length==1){
											$('#myModalpromo #clase1').append('<li style="display:flex;" class=""><a  style="width:100%;cursor:default;" href="#" id="'+result.codigoclase+'">'+result.codigoclase+'</a></li>');
										}else
											$('#myModalpromo #clase1').append('<li style="display:flex;"><a  style="width:100%" href="#" id="'+result.codigoclase+'" onclick="openfiltro3_promo('+"'"+''+result.codigoclase+''+"'"+')">'+result.nombreclase+'</a></li>');
									}
	
								});
							},
							error: function(data){
								console.log('Ha ocurrido un error: '+data);
							}
					});

					direccion="./ajax/filtrar_familia.php";
					if(familia!=null && marca==null && clase==null){
						data={};	
					}

					if(familia==null && clase!=null && marca!=null){
						data={'marca':marca,'clase':clase};
						direccion="./ajax/filtrar_clase_linea.php";
					}
					if(familia==null && marca!=null && clase==null){
						data={'marca':marca};
						direccion="./ajax/filtrar_clase_linea.php";
					}

					/*if(familia!=null && clase==null && marca!=null){
						data={'familia':familia,'marca':marca};
					}*/

					if(familia==null && marca==null && clase==null){
						//console.log('aqui');
						data={};
						direccion="./ajax/filtro_clase.php";
						
					}
					if(familia==null && marca==null && clase!=null){
						//console.log('aqui');
						data={'clase':clase};
						direccion="./ajax/filtrar_clase_linea.php";
						
					}
					
					$.ajax({
							url: direccion,
							type:'GET',
							data: data,
							cache:false,
							contentType:false,
							dataType : 'json',
							beforeSend: function(){
								//$('#myModal #clase1').append('<option value="Esperando Acceso..">Esperando Acceso...</option>');
							},
							success: function(data){	
								//filtrar familia
								$("#myModalpromo #linea1 li").empty();			
								$('#myModalpromo #linea1').empty();
								$.each(data,function(index,result){
									//console.log(data.length);
									if(familia!=null){
										if(result.codigofamilia==familia){
										
											$('#myModalpromo #linea1').append('<li style="display:flex;" class="selecteds"><a  style="width:100%" href="#" id="'+result.codigofamilia+'" onclick="openfiltro2_promo('+"'"+''+result.codigofamilia+''+"'"+')">'+result.nombrefamilia+'</a><i onclick="openfiltro2_promo('+"'"+''+result.codigofamilia+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i> </li>');
										}	
									}else{
										if(data.length==1){
											//localStorage.setItem("Familia", result.codigofamilia);
											$('#myModalpromo #linea1').append('<li style="display:flex;" class=""><a  style="width:100%;cursor:default;" href="#" id="'+result.codigofamilia+'">'+result.nombrefamilia+'</a></li>');
										}else
											$('#myModalpromo #linea1').append('<li style="display:flex;"><a  style="width:100%" href="#" id="'+result.codigofamilia+'" onclick="openfiltro2_promo('+"'"+''+result.codigofamilia+''+"'"+')">'+result.nombrefamilia+'</a></li>');
									}
									
								});
							},
							error: function(data){
								console.log('Ha ocurrido un error: '+data);
							}
					});
				}
			});
		}else{
		
			filtrar_marca_promo();
			filtrarlineapromo();
			filtrarfamiliapromo();
			filtrarclasepromo();
		}
	}



	function openfiltro_promo(valor){
		//console.log(valor)
		$("#myModalpromo #marca li").each(function(){
			//familia marca
		
			if($(this).text()==valor){
				if($(this).hasClass('selected2')){
					localStorage.removeItem("Marca");
					$(this).removeClass('selected2')
					$('#myModalpromo #marca .remove').remove();
					localStorage.removeItem("Clase");

				}else{
					$(this).addClass('selected2')
					localStorage.setItem("Marca", valor);
					//crear boton de remover 
					$('#myModalpromo #marca .remove').remove();
					$(this).append('<i onclick="openfiltro_promo('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
				}	
			}else{
				var expresion=$(this).text().replace(/[\. ,]+/g, " ");
				res = expresion.split(" ");

					if(res[0]==valor){
						if($(this).hasClass('selected2')){
							$(this).children('a').children('i').remove();
							localStorage.removeItem("Marca");
							$('#myModalpromo #marca .remove').remove();
						}else{
							$(this).addClass('selected2')
							$('#myModalpromo #marca .remove').remove();
							$(this).children('a').append('<i onclick="openfiltro_promo('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
							localStorage.setItem("Marca", valor);
						}	
					}else{
						if($(this).hasClass('selected2')){
							$(this).children('a').children('i').remove();
							localStorage.removeItem("Marca");
							$('#myModalpromo #marca .remove').remove();
						}else{
							$(this).addClass('selected2')
							$('#myModalpromo #marca .remove').remove();
							$(this).children('a').append('<i onclick="openfiltro_promo('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
							localStorage.setItem("Marca", valor);
						}	
					}
				}
			
		});

		var familia='', marca='', clase='';

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
		//funcion url consulta
		cargar_filtro_promo();
		consulta_promo(familia,marca,clase);
				
	}	

	function openfiltro3_promo(valor){
		$("#myModalpromo #clase1 li").each(function(){
			//familia clase
			if($(this).text()==valor){
				if($(this).hasClass('selected3')){
					$('#myModalpromo #clase1 .remove').remove();
					localStorage.removeItem("Clase");
					$(this).removeClass('selected3');
					//$("#myModal .clase").css('display','none');		
				}else{
					$(this).addClass('selected3');
					localStorage.setItem("Clase", valor);
					$('#myModalpromo #clase1 .remove').remove();
					$(this).append('<i onclick="openfiltro3_promo('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
				}	
			}else{
				var expresion=$(this).text().replace(/[\. ,]+/g, " ");
				res = expresion.split(" ");
					if(res[0]==valor){
						if($(this).hasClass('selected3')){
						
							localStorage.removeItem("Clase");
							$(this).removeClass('selected3');
							$('#myModalpromo #clase1 .remove').remove();
						}else{
							$(this).addClass('selected3');
							localStorage.setItem("Clase", valor);
							$('#myModalpromo #clase1 .remove').remove();
							$(this).append('<i onclick="openfiltro3_promo('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}else{
						if($(this).hasClass('selected3')){
							
							localStorage.removeItem("Clase");
							$(this).removeClass('selected3');
							$('#myModalpromo #clase1 .remove').remove();
						}else{
							$(this).addClass('selected3');
							localStorage.setItem("Clase", valor);
							$('#myModalpromo #clase1 .remove').remove();
							$(this).append('<i onclick="openfiltro3_promo('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}
				}
			
		});
		var familia='', marca='', clase='';

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

		//funcion url consulta
		cargar_filtro_promo();
		consulta_promo(familia,marca,clase);
        
	}


	//tercer filtro agregar productos sin promocion

	//filtraje marca
	function filtrarmarcamodificar(){
			$("#myModalagregar #marca").empty();
			
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtrar_marca.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_div1").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
					
						//$("#marca").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#marca").append('<option value='+registro.codigomarca+'>'+registro.nombremarca+'</option>');
							$("#myModalagregar #marca").append('<li style="display:flex;"><a style="width:100%!important;" href="#" id="'+registro.codigomarca+'" onclick="openfiltro_modificar('+"'"+''+registro.codigomarca+''+"'"+')">'+registro.nombremarca+'</a></li>');
						});  
						
					}else{
						$("#myModalagregar #marca").append('<option value="Seleccione..">No aplica marca..</option>');
						
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
					M.toast({html: 'Error en cargar datos para Marca!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
				}
			});
		}

		//filtraje linea
		function filtrarlineamodificar(){
			$("#myModalagregar #linea1").empty();
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtrar_linea.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_div1").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
						
						//$("#myModal #linea").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#myModal #linea").append('<option value='+registro.codigolinea+'>'+registro.nombrelinea+'</option>');
							//$("#linea1").append('<li><a href="#" id='+registro.codigolinea+' onclick="openfiltro('+"'"+''+registro.codigolinea+''+"'"+')">'+registro.nombrelinea+'</a></li>');
							
						});  
						
					}else{
					
						$("#myModalagregar #linea1").append('<option value="Seleccione..">No aplica lista_negocio..</option>');
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
					M.toast({html: 'Error en cargar datos para Linea de Negocio!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
				}
			});
		}
		//filtraje linea
		function filtrarclasemodificar(){
			$("#myModalagregar #clase1").empty();
			
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtro_clase.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_div1").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
						
						//$("#myModal #linea").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#myModal #linea").append('<option value='+registro.codigolinea+'>'+registro.nombrelinea+'</option>');
							$("#myModalagregar #clase1").append('<li style="display:flex;"><a style="width:100%" href="#" id="'+registro.codigoclase+'" onclick="openfiltro3_modificar('+"'"+''+registro.codigoclase+''+"'"+')">'+registro.nombreclase+'</a></li>');
						
						});  
						
					}else{
					
						$("#myModalagregar #clase1").append('<option value="Seleccione..">No aplica lista_negocio..</option>');
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
					M.toast({html: 'Error en cargar datos para Linea de Negocio!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
				}
			});
		}

		//filtrar familia
		//filtraje linea
		function filtrarfamiliamodificar(){
			$("#myModalagregar #linea1").empty();
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtrar_familia.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_div1").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
						//$("#myModal #familia").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#myModal #familia").append('<option value='+registro.codigofamilia+'>'+registro.nombrefamilia+'</option>');
							$("#myModalagregar #linea1").append('<li style="display:flex;"><a style="width:100%" href="#" id="'+registro.codigofamilia+'" onclick="openfiltro2_modificar('+"'"+''+registro.codigofamilia+''+"'"+')">'+registro.nombrefamilia+'</a></li>');
						});  
					
					}else{
						$("#myModalagregar #linea1").append('<option value="Seleccione..">No aplica lista_familia..</option>');
						M.toast({html: 'Error en cargar datos para filtro familia SQL!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
				}
			});
		}


		function consulta_modificar(familia,marca,clase){
		//consultas de filtros
		//detectar cual es el valor
			var activar=true;
			var q= $("#q1").val();
			direccion='./ajax/producto_pedido_modificar.php?action=ajax&familia='+familia+'&marca='+marca+'&clase='+clase+'&parametro='+q;
			if(activar===true){
				//cargar data
				$("#loader1").fadeIn('slow');
					$.ajax({
						url:direccion,
						beforeSend: function(objeto){
							$('#loader1').html('<img src="./img/ajax-loader.gif"> Cargando...');
						},
						success:function(data){
							$('#myModalagregar #loader1').html('');
							$("#myModalagregar #outer_div1").html(data).fadeIn('slow');
						},
						error:function(data){
							console.log("Error en acceso a los datos"+data);
						}
					})
				//verificar que seleccciono
			}
	}	


	function openfiltro2_modificar(valor){

		//familia filtro
		
		//deseleccionar y seleccionar
		$("#myModalagregar #linea1 li").each(function(){
	
			if($(this).text()==valor){
				if($(this).hasClass('selecteds')){
					localStorage.removeItem("Familia");
					$(this).removeClass('selecteds')
					$('#myModalagregar #linea1 .remove').remove();
					
				}else{
					$(this).addClass('selecteds')
					localStorage.setItem("Familia", valor);
					$('#myModalagregar #linea1 .remove').remove();
					$(this).append('<i onclick="openfiltro2_modificar('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
				}	
			}else{
				var expresion=$(this).text().replace(/[\. ,]+/g, " ");
				res = expresion.split(" ");
					if(res[0]==valor){
						if($(this).hasClass('selecteds')){
							localStorage.removeItem("Familia");
							$(this).removeClass('selecteds')
							$('#myModalagregar #linea1 .remove').remove();
						}else{
							$(this).addClass('selecteds')
							localStorage.setItem("Familia", valor);
							$('#myModalagregar #linea1 .remove').remove();
							$(this).append('<i onclick="openfiltro2_modificar('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}else{
						if($(this).hasClass('selecteds')){
							localStorage.removeItem("Familia");
							$(this).removeClass('selecteds')
							$('#myModalagregar #linea1 .remove').remove();
						}else{
							$(this).addClass('selecteds')
							localStorage.setItem("Familia", valor);
							$('#myModalagregar #linea1 .remove').remove();
							$(this).append('<i onclick="openfiltro2_modificar('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}
				}
			
		});

		//coger valores del local storage

		var familia='', marca='', clase='';
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

		cargar_filtro_modificar();
		//funcion url consulta
		consulta_modificar(familia,marca,clase);
        
	}	

	function cargar_filtro_modificar(){
		var familia=localStorage.getItem("Familia", valor);
		var marca=localStorage.getItem("Marca", valor);
		var clase=localStorage.getItem("Clase", valor);
		console.log(marca,familia,clase)
		//marca 

		if(familia!=null || marca!=null || clase!=null){

			//armar filtraje
			direccion="./ajax/filtrar_linea_familia.php";
			if(familia!=null && marca==null && clase==null){
				data={'familia':familia};	
			}
			if(familia!=null && clase!=null && marca==null){
				data={'familia':familia,'clase':clase};
			}
			if(familia==null && clase==null && marca!=null){
				data={};
				direccion="./ajax/filtrar_marca.php";
				
			}
			if(familia==null && clase!=null && marca==null){
				data={'clase':clase};
				direccion="./ajax/filtrar_linea_familia.php";
			
			}

			$.ajax({
				url: direccion,
				type:'GET',
				data: data,
				cache:false,
				contentType:false,
				dataType : 'json',
				beforeSend: function(){
					//$('#myModal #marca').append('<option value="Esperando Acceso..">Esperando Acceso...</option>');
				},
				success: function(data){
					
					$("#myModalagregar #marca li").empty();				
					$('#myModalagregar #marca').empty();
					//mostrar filtro 
					$('#myModalagregar #marca').collapse('show');
					if(data!=null){
						//$('#myModal .marca').css('display','block');
						$.each(data,function(index,result){
							
							if(marca!=null){
								if(result.codigomarca==marca){
									$('#myModalagregar #marca').append('<li style="display:flex;" class="selected2"><a  style="width:100%" href="#" id="'+result.codigomarca+'" onclick="openfiltro_modificar('+"'"+''+result.codigomarca+''+"'"+')">'+result.nombremarca+'</a><i onclick="openfiltro_modificar('+"'"+''+result.codigomarca+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i> </li>');
								}	
							}else{
								if(data.length==1){
									$('#myModalagregar #marca').append('<li style="display:flex;" class=""><a  style="width:100%;cursor:default;" href="#" id="'+result.codigomarca+'">'+result.nombremarca+'</a></li>');
								}
								else
									$('#myModalagregar #marca').append('<li style="display:flex;"><a  style="width:100%" href="#" id="'+result.codigomarca+'" onclick="openfiltro_modificar('+"'"+''+result.codigomarca+''+"'"+')">'+result.nombremarca+'</a></li>');
							}
							//$('#myModal #marca').append('<li style="display:flex;"><a style="width:100%" href="#" id='+result.codigomarca+' onclick="openfiltro('+"'"+''+result.codigomarca+''+"'"+')">'+result.nombremarca+'</a></li>');

						});
					}else{
						$('#myModalagregar #marca').append('<li><a href="#">No existe productos</a></li>');
					}

					//armar filtraje
				
					direccion="./ajax/filtrar_marca_familia.php";
					if(familia!=null && marca==null && clase==null){
						data={'familia':familia};	
					}

					if(familia!=null && clase!=null && marca==null){
						data={'familia':familia,'clase':clase};
					}

					if(familia!=null && clase==null && marca!=null){
						data={'familia':familia,'marca':marca};
					}

					if(familia==null && marca==null && clase==null){
						console.log('aqui');
						data={};
						direccion="./ajax/filtro_clase.php";
						
					}
					if(familia==null && marca!=null && clase==null){
						data={'marca':marca};
					
					}
			


					$.ajax({
							url:direccion,
							type:'GET',
							data: data,
							cache:false,
							contentType:false,
							dataType : 'json',
							beforeSend: function(){
								//$('#myModal #clase1').append('<option value="Esperando Acceso..">Esperando Acceso...</option>');
							},
							success: function(data){
								//clase

								$("#myModalagregar #clase1 li").empty();			
								$('#myModalagregar #clase1').empty();

								//mostrar filtro 
								$('#myModalagregar #clase1').collapse('show');
								
								$.each(data,function(index,result){
									//console.log(result.codigomarca)
									if(clase!=null){
										if(result.codigoclase==clase){
											$('#myModalagregar #clase1').append('<li style="display:flex;" class="selected3"><a  style="width:100%" href="#" id="'+result.codigoclase+'" onclick="openfiltro3_modificar('+"'"+''+result.codigoclase+''+"'"+')">'+result.nombreclase+'</a><i onclick="openfiltro3_modificar('+"'"+''+result.codigoclase+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i> </li>');
										}	
									}else{
										if(data.length==1){
											$('#myModalagregar #clase1').append('<li style="display:flex;" class=""><a  style="width:100%;cursor:default;" href="#" id="'+result.codigoclase+'">'+result.codigoclase+'</a></li>');
										}else
											$('#myModalagregar #clase1').append('<li style="display:flex;"><a  style="width:100%" href="#" id="'+result.codigoclase+'" onclick="openfiltro3_modificar('+"'"+''+result.codigoclase+''+"'"+')">'+result.nombreclase+'</a></li>');
									}
	
								});
							},
							error: function(data){
								console.log('Ha ocurrido un error: '+data);
							}
					});

					direccion="./ajax/filtrar_familia.php";
					if(familia!=null && marca==null && clase==null){
						data={};	
					}

					if(familia==null && clase!=null && marca!=null){
						data={'marca':marca,'clase':clase};
						direccion="./ajax/filtrar_clase_linea.php";
					}
					if(familia==null && marca!=null && clase==null){
						data={'marca':marca};
						direccion="./ajax/filtrar_clase_linea.php";
					}

					/*if(familia!=null && clase==null && marca!=null){
						data={'familia':familia,'marca':marca};
					}*/

					if(familia==null && marca==null && clase==null){
						//console.log('aqui');
						data={};
						direccion="./ajax/filtro_clase.php";
						
					}
					if(familia==null && marca==null && clase!=null){
						//console.log('aqui');
						data={'clase':clase};
						direccion="./ajax/filtrar_clase_linea.php";
						
					}
					
					$.ajax({
							url: direccion,
							type:'GET',
							data: data,
							cache:false,
							contentType:false,
							dataType : 'json',
							beforeSend: function(){
								//$('#myModal #clase1').append('<option value="Esperando Acceso..">Esperando Acceso...</option>');
							},
							success: function(data){	
								//filtrar familia
								$("#myModalagregar #linea1 li").empty();			
								$('#myModalagregar #linea1').empty();
								$.each(data,function(index,result){
									//console.log(data.length);
									if(familia!=null){
										if(result.codigofamilia==familia){
										
											$('#myModalagregar #linea1').append('<li style="display:flex;" class="selecteds"><a  style="width:100%" href="#" id="'+result.codigofamilia+'" onclick="openfiltro2_modificar('+"'"+''+result.codigofamilia+''+"'"+')">'+result.nombrefamilia+'</a><i onclick="openfiltro2_modificar('+"'"+''+result.codigofamilia+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i> </li>');
										}	
									}else{
										if(data.length==1){
											//localStorage.setItem("Familia", result.codigofamilia);
											$('#myModalagregar #linea1').append('<li style="display:flex;" class=""><a  style="width:100%;cursor:default;" href="#" id="'+result.codigofamilia+'">'+result.nombrefamilia+'</a></li>');
										}else
											$('#myModalagregar #linea1').append('<li style="display:flex;"><a  style="width:100%" href="#" id="'+result.codigofamilia+'" onclick="openfiltro2_modificar('+"'"+''+result.codigofamilia+''+"'"+')">'+result.nombrefamilia+'</a></li>');
									}
									
								});
							},
							error: function(data){
								console.log('Ha ocurrido un error: '+data);
							}
					});
				}
			});
		}else{
		
			filtrarmarcamodificar();
			filtrarlineamodificar();
			filtrarclasemodificar();
			filtrarfamiliamodificar();
		}
	}



	function openfiltro_modificar(valor){
		//console.log(valor)
		$("#myModalagregar #marca li").each(function(){
			//familia marca
		
			if($(this).text()==valor){
				if($(this).hasClass('selected2')){
					localStorage.removeItem("Marca");
					$(this).removeClass('selected2')
					$('#myModalagregar #marca .remove').remove();
					localStorage.removeItem("Clase");

				}else{
					$(this).addClass('selected2')
					localStorage.setItem("Marca", valor);
					//crear boton de remover 
					$('#myModalagregar #marca .remove').remove();
					$(this).append('<i onclick="openfiltro_modificar('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
				}	
			}else{
				var expresion=$(this).text().replace(/[\. ,]+/g, " ");
				res = expresion.split(" ");

					if(res[0]==valor){
						if($(this).hasClass('selected2')){
							$(this).children('a').children('i').remove();
							localStorage.removeItem("Marca");
							$('#myModalagregar #marca .remove').remove();
						}else{
							$(this).addClass('selected2')
							$('#myModalagregar #marca .remove').remove();
							$(this).children('a').append('<i onclick="openfiltro_modificar('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
							localStorage.setItem("Marca", valor);
						}	
					}else{
						if($(this).hasClass('selected2')){
							$(this).children('a').children('i').remove();
							localStorage.removeItem("Marca");
							$('#myModalagregar #marca .remove').remove();
						}else{
							$(this).addClass('selected2')
							$('#myModalagregar #marca .remove').remove();
							$(this).children('a').append('<i onclick="openfiltro_modificar('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
							localStorage.setItem("Marca", valor);
						}	
					}
				}
			
		});

		var familia='', marca='', clase='';

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
		//funcion url consulta
		cargar_filtro_modificar();
		consulta_modificar(familia,marca,clase);
				
	}	

	function openfiltro3_modificar(valor){
		$("#myModalagregar #clase1 li").each(function(){
			//familia clase
			if($(this).text()==valor){
				if($(this).hasClass('selected3')){
					$('#myModalagregar #clase1 .remove').remove();
					localStorage.removeItem("Clase");
					$(this).removeClass('selected3');
					//$("#myModal .clase").css('display','none');		
				}else{
					$(this).addClass('selected3');
					localStorage.setItem("Clase", valor);
					$('#myModalagregar #clase1 .remove').remove();
					$(this).append('<i onclick="openfiltro3_modificar('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
				}	
			}else{
				var expresion=$(this).text().replace(/[\. ,]+/g, " ");
				res = expresion.split(" ");
					if(res[0]==valor){
						if($(this).hasClass('selected3')){
						
							localStorage.removeItem("Clase");
							$(this).removeClass('selected3');
							$('#myModalagregar #clase1 .remove').remove();
						}else{
							$(this).addClass('selected3');
							localStorage.setItem("Clase", valor);
							$('#myModalagregar #clase1 .remove').remove();
							$(this).append('<i onclick="openfiltro3_modificar('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}else{
						if($(this).hasClass('selected3')){
						
							localStorage.removeItem("Clase");
							$(this).removeClass('selected3');
							$('#myModalagregar #clase1 .remove').remove();
						}else{
							$(this).addClass('selected3');
							localStorage.setItem("Clase", valor);
							$('#myModalagregar #clase1 .remove').remove();
							$(this).append('<i onclick="openfiltro3_modificar('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}
				}
			
		});
		var familia='', marca='', clase='';

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

		//funcion url consulta
		cargar_filtro_modificar();
		consulta_modificar(familia,marca,clase);
        
	}





	/* 4 filtro modificar promociones */

	//filtraje marca
	function filtrarmarcamodificarpromo(){
			$("#myModalpromomodificar #marca").empty();
			
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtrar_marca.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_divpromo1").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
					
						//$("#marca").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#marca").append('<option value='+registro.codigomarca+'>'+registro.nombremarca+'</option>');
							$("#myModalpromomodificar #marca").append('<li style="display:flex;"><a style="width:100%!important;" href="#" id="'+registro.codigomarca+'" onclick="openfiltro_modificar_promo('+"'"+''+registro.codigomarca+''+"'"+')">'+registro.nombremarca+'</a></li>');
						});  
						
					}else{
						$("#myModalpromomodificar #marca").append('<option value="Seleccione..">No aplica marca..</option>');
						
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
					M.toast({html: 'Error en cargar datos para Marca!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
				}
			});
		}

		//filtraje linea
		function filtrarlineamodificarpromo(){
			$("#myModalpromomodificar #linea1").empty();
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtrar_linea.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_divpromo1").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
						
						//$("#myModal #linea").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#myModal #linea").append('<option value='+registro.codigolinea+'>'+registro.nombrelinea+'</option>');
							//$("#linea1").append('<li><a href="#" id='+registro.codigolinea+' onclick="openfiltro('+"'"+''+registro.codigolinea+''+"'"+')">'+registro.nombrelinea+'</a></li>');
							
						});  
						
					}else{
					
						$("#myModalpromomodificar #linea1").append('<option value="Seleccione..">No aplica lista_negocio..</option>');
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
					M.toast({html: 'Error en cargar datos para Linea de Negocio!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
				}
			});
		}
			//filtraje linea
			function filtrarclasemodificarpromo(){
			$("#myModalpromomodificar #clase1").empty();
			
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtro_clase.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_divpromo1").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
						
						//$("#myModal #linea").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#myModal #linea").append('<option value='+registro.codigolinea+'>'+registro.nombrelinea+'</option>');
							$("#myModalpromomodificar #clase1").append('<li style="display:flex;"><a style="width:100%" href="#" id="'+registro.codigoclase+'" onclick="openfiltro3_modificar_promo('+"'"+''+registro.codigoclase+''+"'"+')">'+registro.nombreclase+'</a></li>');
						
						});  
						
					}else{
					
						$("#myModalpromomodificar #clase1").append('<option value="Seleccione..">No aplica lista_negocio..</option>');
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
					M.toast({html: 'Error en cargar datos para Linea de Negocio!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
				}
			});
		}

		//filtrar familia
			//filtraje linea
			function filtrarfamiliamodificarpromo(){
			$("#myModalpromomodificar #linea1").empty();
			$.ajax({
        		type: "GET",
        		url: "./ajax/filtrar_familia.php",
        		data: "",
				cache:false,
                contentType:false,
                dataType : 'json',
		 		beforeSend: function(objeto){
					$("#outer_divpromo1").html("Mensaje: Cargando...");
		  		},
        		success: function(datos){
					if(datos!=null){
						//$("#myModal #familia").append('<option value="Seleccione..">Seleccione..</option>');
						$.each(datos,function(key, registro) {
							//$("#myModal #familia").append('<option value='+registro.codigofamilia+'>'+registro.nombrefamilia+'</option>');
							$("#myModalpromomodificar #linea1").append('<li style="display:flex;"><a style="width:100%" href="#" id="'+registro.codigofamilia+'" onclick="openfiltro2_modificar_promo('+"'"+''+registro.codigofamilia+''+"'"+')">'+registro.nombrefamilia+'</a></li>');
						});  
					
					}else{
						$("#myModalpromomodificar #linea1").append('<option value="Seleccione..">No aplica lista_familia..</option>');
						M.toast({html: 'Error en cargar datos para filtro familia SQL!',classes: 'error',displayLength:5000,inDuration:700,outDuration:700});
					}
				},error: function(data){
					console.log('Ha sucedido un error en la consulta:'+data);
				}
			});
		}

		function consulta_modificar_promo(familia,marca,clase){
		//consultas de filtros
		//detectar cual es el valor
			var activar=true;
			var q= $("#q4").val();
			direccion='./ajax/productos_pedido_promo_modificar.php?action=ajax&familia='+familia+'&marca='+marca+'&clase='+clase+'&parametro='+q;
			if(activar===true){
				//cargar data
				$("#loaderpromo1").fadeIn('slow');
					$.ajax({
						url:direccion,
						beforeSend: function(objeto){
							$('#loaderpromo1').html('<img src="./img/ajax-loader.gif"> Cargando...');
						},
						success:function(data){
							$('#myModalpromomodificar #loaderpromo1').html('');
							$("#myModalpromomodificar #outer_divpromo1").html(data).fadeIn('slow');
						},
						error:function(data){
							console.log("Error en acceso a los datos"+data);
						}
					})
				//verificar que seleccciono
			}
	}	


	function openfiltro2_modificar_promo(valor){

		//familia filtro
		
		//deseleccionar y seleccionar
		$("#myModalpromomodificar #linea1 li").each(function(){
	
			if($(this).text()==valor){
				if($(this).hasClass('selecteds')){
					localStorage.removeItem("Familia");
					$(this).removeClass('selecteds')
					$('#myModalpromomodificar #linea1 .remove').remove();
					
				}else{
					$(this).addClass('selecteds')
					localStorage.setItem("Familia", valor);
					$('#myModalpromomodificar #linea1 .remove').remove();
					$(this).append('<i onclick="openfiltro2_modificar_promo('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
				}	
			}else{
				var expresion=$(this).text().replace(/[\. ,]+/g, " ");
				res = expresion.split(" ");
					if(res[0]==valor){
						if($(this).hasClass('selecteds')){
							localStorage.removeItem("Familia");
							$(this).removeClass('selecteds')
							$('#myModalpromomodificar #linea1 .remove').remove();
						}else{
							$(this).addClass('selecteds')
							localStorage.setItem("Familia", valor);
							$('#myModalpromomodificar #linea1 .remove').remove();
							$(this).append('<i onclick="openfiltro2_modificar_promo('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}else{
						if($(this).hasClass('selecteds')){
							localStorage.removeItem("Familia");
							$(this).removeClass('selecteds')
							$('#myModalpromomodificar #linea1 .remove').remove();
						}else{
							$(this).addClass('selecteds')
							localStorage.setItem("Familia", valor);
							$('#myModalpromomodificar #linea1 .remove').remove();
							$(this).append('<i onclick="openfiltro2_modificar_promo('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}
				}
			
		});

		//coger valores del local storage

		var familia='', marca='', clase='';
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

		cargar_filtro_modificar_promo();
		//funcion url consulta
		consulta_modificar_promo(familia,marca,clase);
        
	}	

	function cargar_filtro_modificar_promo(){
		var familia=localStorage.getItem("Familia", valor);
		var marca=localStorage.getItem("Marca", valor);
		var clase=localStorage.getItem("Clase", valor);
		console.log(marca,familia,clase)
		//marca 

		if(familia!=null || marca!=null || clase!=null){

			//armar filtraje
			direccion="./ajax/filtrar_linea_familia.php";
			if(familia!=null && marca==null && clase==null){
				data={'familia':familia};	
			}
			if(familia!=null && clase!=null && marca==null){
				data={'familia':familia,'clase':clase};
			}
			if(familia==null && clase==null && marca!=null){
				data={};
				direccion="./ajax/filtrar_marca.php";
				
			}
			if(familia==null && clase!=null && marca==null){
				data={'clase':clase};
				direccion="./ajax/filtrar_linea_familia.php";
			
			}

			$.ajax({
				url: direccion,
				type:'GET',
				data: data,
				cache:false,
				contentType:false,
				dataType : 'json',
				beforeSend: function(){
					//$('#myModal #marca').append('<option value="Esperando Acceso..">Esperando Acceso...</option>');
				},
				success: function(data){
					
					$("#myModalpromomodificar #marca li").empty();				
					$('#myModalpromomodificar #marca').empty();
					//mostrar filtro 
					$('#myModalpromomodificar #marca').collapse('show');
					if(data!=null){
						//$('#myModal .marca').css('display','block');
						$.each(data,function(index,result){
							
							if(marca!=null){
								if(result.codigomarca==marca){
									$('#myModalpromomodificar #marca').append('<li style="display:flex;" class="selected2"><a  style="width:100%" href="#" id="'+result.codigomarca+'" onclick="openfiltro_modificar_promo('+"'"+''+result.codigomarca+''+"'"+')">'+result.nombremarca+'</a><i onclick="openfiltro_modificar_promo('+"'"+''+result.codigomarca+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i> </li>');
								}	
							}else{
								if(data.length==1){
									$('#myModalpromomodificar #marca').append('<li style="display:flex;" class=""><a  style="width:100%;cursor:default;" href="#" id="'+result.codigomarca+'">'+result.nombremarca+'</a></li>');
								}
								else
									$('#myModalpromomodificar #marca').append('<li style="display:flex;"><a  style="width:100%" href="#" id="'+result.codigomarca+'" onclick="openfiltro_modificar_promo('+"'"+''+result.codigomarca+''+"'"+')">'+result.nombremarca+'</a></li>');
							}
							//$('#myModal #marca').append('<li style="display:flex;"><a style="width:100%" href="#" id='+result.codigomarca+' onclick="openfiltro('+"'"+''+result.codigomarca+''+"'"+')">'+result.nombremarca+'</a></li>');

						});
					}else{
						$('#myModalpromomodificar #marca').append('<li><a href="#">No existe productos</a></li>');
					}

					//armar filtraje
				
					direccion="./ajax/filtrar_marca_familia.php";
					if(familia!=null && marca==null && clase==null){
						data={'familia':familia};	
					}

					if(familia!=null && clase!=null && marca==null){
						data={'familia':familia,'clase':clase};
					}

					if(familia!=null && clase==null && marca!=null){
						data={'familia':familia,'marca':marca};
					}

					if(familia==null && marca==null && clase==null){
				
						data={};
						direccion="./ajax/filtro_clase.php";
						
					}
					if(familia==null && marca!=null && clase==null){
						data={'marca':marca};
					
					}
			


					$.ajax({
							url:direccion,
							type:'GET',
							data: data,
							cache:false,
							contentType:false,
							dataType : 'json',
							beforeSend: function(){
								//$('#myModal #clase1').append('<option value="Esperando Acceso..">Esperando Acceso...</option>');
							},
							success: function(data){
								//clase

								$("#myModalpromomodificar #clase1 li").empty();			
								$('#myModalpromomodificar #clase1').empty();
								//mostrar filtro 
								$('#myModalpromomodificar #clase1').collapse('show');
								$.each(data,function(index,result){
									//console.log(result.codigomarca)
									if(clase!=null){
										if(result.codigoclase==clase){
											$('#myModalpromomodificar #clase1').append('<li style="display:flex;" class="selected3"><a  style="width:100%" href="#" id="'+result.codigoclase+'" onclick="openfiltro3_modificar_promo('+"'"+''+result.codigoclase+''+"'"+')">'+result.nombreclase+'</a><i onclick="openfiltro3_modificar_promo('+"'"+''+result.codigoclase+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i> </li>');
										}	
									}else{
										if(data.length==1){
											$('#myModalpromomodificar #clase1').append('<li style="display:flex;" class=""><a  style="width:100%;cursor:default;" href="#" id="'+result.codigoclase+'">'+result.codigoclase+'</a></li>');
										}else
											$('#myModalpromomodificar #clase1').append('<li style="display:flex;"><a  style="width:100%" href="#" id="'+result.codigoclase+'" onclick="openfiltro3_modificar_promo('+"'"+''+result.codigoclase+''+"'"+')">'+result.nombreclase+'</a></li>');
									}
	
								});
							},
							error: function(data){
								console.log('Ha ocurrido un error: '+data);
							}
					});

					direccion="./ajax/filtrar_familia.php";
					if(familia!=null && marca==null && clase==null){
						data={};	
					}

					if(familia==null && clase!=null && marca!=null){
						data={'marca':marca,'clase':clase};
						direccion="./ajax/filtrar_clase_linea.php";
					}
					if(familia==null && marca!=null && clase==null){
						data={'marca':marca};
						direccion="./ajax/filtrar_clase_linea.php";
					}

					/*if(familia!=null && clase==null && marca!=null){
						data={'familia':familia,'marca':marca};
					}*/

					if(familia==null && marca==null && clase==null){
						//console.log('aqui');
						data={};
						direccion="./ajax/filtro_clase.php";
						
					}
					if(familia==null && marca==null && clase!=null){
						//console.log('aqui');
						data={'clase':clase};
						direccion="./ajax/filtrar_clase_linea.php";
						
					}
					
					$.ajax({
							url: direccion,
							type:'GET',
							data: data,
							cache:false,
							contentType:false,
							dataType : 'json',
							beforeSend: function(){
								//$('#myModal #clase1').append('<option value="Esperando Acceso..">Esperando Acceso...</option>');
							},
							success: function(data){	
								//filtrar familia
								$("#myModalpromomodificar #linea1 li").empty();			
								$('#myModalpromomodificar #linea1').empty();
								$.each(data,function(index,result){
									//console.log(data.length);
									if(familia!=null){
										if(result.codigofamilia==familia){
										
											$('#myModalpromomodificar #linea1').append('<li style="display:flex;" class="selecteds"><a  style="width:100%" href="#" id="'+result.codigofamilia+'" onclick="openfiltro2_modificar_promo('+"'"+''+result.codigofamilia+''+"'"+')">'+result.nombrefamilia+'</a><i onclick="openfiltro2_modificar_promo('+"'"+''+result.codigofamilia+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i> </li>');
										}	
									}else{
										if(data.length==1){
											//localStorage.setItem("Familia", result.codigofamilia);
											$('#myModalpromomodificar #linea1').append('<li style="display:flex;" class=""><a  style="width:100%;cursor:default;" href="#" id="'+result.codigofamilia+'">'+result.nombrefamilia+'</a></li>');
										}else
											$('#myModalpromomodificar #linea1').append('<li style="display:flex;"><a  style="width:100%" href="#" id="'+result.codigofamilia+'" onclick="openfiltro2_modificar_promo('+"'"+''+result.codigofamilia+''+"'"+')">'+result.nombrefamilia+'</a></li>');
									}
									
								});
							},
							error: function(data){
								console.log('Ha ocurrido un error: '+data);
							}
					});
				}
			});
		}else{
		
			filtrarmarcamodificarpromo();
			filtrarclasemodificarpromo();
			filtrarfamiliamodificarpromo();
			filtrarlineamodificarpromo();
		}
	}



	function openfiltro_modificar_promo(valor){
		//console.log(valor)
		$("#myModalpromomodificar #marca li").each(function(){
			//familia marca
		
			if($(this).text()==valor){
				if($(this).hasClass('selected2')){
					localStorage.removeItem("Marca");
					$(this).removeClass('selected2')
					$('#myModalpromomodificar #marca .remove').remove();
					localStorage.removeItem("Clase");

				}else{
					$(this).addClass('selected2')
					localStorage.setItem("Marca", valor);
					//crear boton de remover 
					$('#myModalpromomodificar #marca .remove').remove();
					$(this).append('<i onclick="openfiltro_modificar_promo('+"'"+''+valor+''+"'"+')"  class="fas fa-times remove cerrarseleccionado"></i>');
				}	
			}else{
				var expresion=$(this).text().replace(/[\. ,]+/g, " ");
				res = expresion.split(" ");

					if(res[0]==valor){
						if($(this).hasClass('selected2')){
							$(this).children('a').children('i').remove();
							localStorage.removeItem("Marca");
							$('#myModalpromomodificar #marca .remove').remove();
						}else{
							$(this).addClass('selected2')
							$('#myModalpromomodificar #marca .remove').remove();
							$(this).children('a').append('<i onclick="openfiltro_modificar_promo('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
							localStorage.setItem("Marca", valor);
						}	
					}else{
						if($(this).hasClass('selected2')){
							$(this).children('a').children('i').remove();
							localStorage.removeItem("Marca");
							$('#myModalpromomodificar #marca .remove').remove();
						}else{
							$(this).addClass('selected2')
							$('#myModalpromomodificar #marca .remove').remove();
							$(this).children('a').append('<i onclick="openfiltro_modificar_promo('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
							localStorage.setItem("Marca", valor);
						}	
					}
				}
			
		});

		var familia='', marca='', clase='';

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
		//funcion url consulta
		cargar_filtro_modificar_promo();
		consulta_modificar_promo(familia,marca,clase);
				
	}	

	function openfiltro3_modificar_promo(valor){
		$("#myModalpromomodificar #clase1 li").each(function(){
			//familia clase
			if($(this).text()==valor){
				if($(this).hasClass('selected3')){
					$('#myModalpromomodificar #clase1 .remove').remove();
					localStorage.removeItem("Clase");
					$(this).removeClass('selected3');
					//$("#myModal .clase").css('display','none');		
				}else{
					$(this).addClass('selected3');
					localStorage.setItem("Clase", valor);
					$('#myModalpromomodificar #clase1 .remove').remove();
					$(this).append('<i onclick="openfiltro3_modificar_promo('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
				}	
			}else{
				var expresion=$(this).text().replace(/[\. ,]+/g, " ");
				res = expresion.split(" ");
					if(res[0]==valor){
						if($(this).hasClass('selected3')){
						
							localStorage.removeItem("Clase");
							$(this).removeClass('selected3');
							$('#myModalpromomodificar #clase1 .remove').remove();
						}else{
							$(this).addClass('selected3');
							localStorage.setItem("Clase", valor);
							$('#myModalpromomodificar #clase1 .remove').remove();
							$(this).append('<i onclick="openfiltro3_modificar_promo('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}else{
						if($(this).hasClass('selected3')){
						
							localStorage.removeItem("Clase");
							$(this).removeClass('selected3');
							$('#myModalpromomodificar #clase1 .remove').remove();
						}else{
							$(this).addClass('selected3');
							localStorage.setItem("Clase", valor);
							$('#myModalpromomodificar #clase1 .remove').remove();
							$(this).append('<i onclick="openfiltro3_modificar_promo('+"'"+''+valor+''+"'"+')" class="fas fa-times remove cerrarseleccionado"></i>');
						}	
					}
				}
			
		});
		var familia='', marca='', clase='';

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

		//funcion url consulta
		cargar_filtro_modificar_promo();
		consulta_modificar_promo(familia,marca,clase);
        
	}	



	//abandonar pagina
	/*window.onbeforeunload = confirmExit;
	function confirmExit()
	{
		return "Ha intentado salir de esta pagina. Si ha realizado algun cambio en los campos sin hacer clic en el boton Guardar, los cambios se perderan. Seguro que desea salir de esta pagina? ";
	}*/


		$(function() {
						$("#nombre_cliente").autocomplete({
							source: "./ajax/autocomplete/clientes.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_cliente').val(ui.item.id_cliente);
								$('#nombre_cliente').val(ui.item.nombre_cliente);
								$('#tel1').val(ui.item.telefono_cliente);
								$('#mail').val(ui.item.email_cliente);
																
								
							 }
						});
						 
						
					});
					
	$("#nombre_cliente" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_cliente" ).val("");
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
						}
			});	
	</script>

  </body>
</html>