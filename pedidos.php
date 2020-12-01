<?php
	/*-------------------------
	Autor: Jorge F prieto L
	Web: www.Jorge F prieto L.com
	Mail: info@Jorge F prieto L.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	$_SESSION['valor']=0;
	$_SESSION['consulta']=null;
	
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Pedidos | Distribuidor";


?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<style>

	.buscarlabel {
		font-family:'Roboto',sans-serif;
		position: absolute;
		top: 0;
		font-size: 14px;
		margin: 10px;
		padding: 10px 10px;
		-webkit-transition: top .2s ease-in-out,  font-size .2s ease-in-out;
		transition: top .2s ease-in-out,  font-size .2s ease-in-out;
		background:transparent!important;
	}
 
	.buscarlabel.active {
		top: -35px;
		font-size: 14px;
		font-weight: 600;
		color: #495560!important;
	}
 
	input[type=text] {
		width: 100%;
		padding: 20px;
		border: 2px solid white;
		font-size: 14px;
		font-weight: 500;
		background-color: #f05855;
		color:#495560;
		max-width:400px;
	}
	
	input[type=text]:focus {
		outline: none;
	}
	
	</style>
  </head>
  <body>

	<?php
	
	include("navbar.php");
	
	//Mostrar mensaje de alerta
	
	?>

	
    <div class="container col-2">
		<div class="panel panel-info">
		
	<?php
		if(isset($_GET['action'])){
		if($_GET['action']==='correctomodificar'){
	?>  
		<script>
			M.toast({html: 'Su pedido ha sido modificado con exito!',classes: 'correcto',displayLength:5000,inDuration:700,outDuration:700});
		</script>
	<?php
	}else{
	?>
		<script>
			M.toast({html: 'Su pedido ha sido almacenado con exito!',classes: 'correcto',displayLength:5000,inDuration:700,outDuration:700});
		</script>
	<?php
	}}?>
	
			<div class="panel-body" style="margin-top:30px;">
				<div class="modal fade" id="dataremove" tabindex="-1" role="dialog" aria-labelledby="dataremove" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="" method="post">
                                <div class="modal-header" style="background:#dc3545; display:flex;color:#fff; border-radius:none;">
                                    <h5 class="modal-title" style="flex:0 1 90%; font-size:18px;" id="exampleModalLabel">PEDIDO A REMOVER</h5>
                                        <button type="button" style="color:#fff;flex:0 1 10%" class="close" data-dismiss="modal" aria-label="Close">
                                            <span style="color:#fff;" aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body" style="display:flex;">
                                        <input type="hidden" class="id" id="id" name="id">
                                       
                                        <i style="color:#fd3c3d; padding:10px; border:1px solid #fd3c3d; border-radius:5%; font-size:20px;margin:auto;  margin-right:10px; " class="glyphicon glyphicon-remove"></i><h4 style="font-size:15px; line-height:22px; text-align:justify; margin:auto; font-weight:500;">El pedido seleccionado sera eliminado. ¿ Estas seguro de realizar esta acción con el pedido:?</h4></li>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                                    <button type="button" onclick="cancelar_pedido()" class="btn btn-danger">Cancelar Pedido</button>
                                </div>
                            <form>
                        </div>
                    </div>
                </div>
			<div style="text-align: center;">
			<?php	
				
				/*---------------------------*/
				//include('ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
					/* Connect To Database*/
				require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
				require_once ("config/conexion.php");
				$query=mysqli_query($con,"SELECT * FROM banner order by id_banner desc limit 4");
				$count=mysqli_num_rows($query);
				if($count>0){
					while($row=mysqli_fetch_array($query)){
						echo '<img src="data:image/jpeg;base64,'.base64_encode($row['imagen']).'" class="figure-img img-fluid rounded hover" style="width: 30%;height:150px" alt="...">';
					}
			?>
			<?php }else{  ?>	
			
				<img src="img/promo.png" class="figure-img img-fluid rounded hover" style="width: 30%;height:150px" alt="...">
				<img src="img/promo2.png" class="figure-img img-fluid rounded hover" style="width: 30%;height:150px" alt="...">
				<img src="img/promo3.png" class="figure-img img-fluid rounded hover" style="width: 30%;height:150px" alt="...">
			<?php }?>

			</div>
			<br>
			
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row buscar" style="padding:0!important;">
							<div class="panel-heading" style="flex:0 1 20%">
								<h4><i class='glyphicon glyphicon-search' style="display:none;"></i> Pedido Histórico</h4>
							</div>
							<div class="buscador" style="display:flex;flex:0 1 80%; width:100%; justify-content:flex-end;padding:10px 15px;">
								<div class="col-md-5 col buscarmodificar " style="flex:0 1 40%;padding:0;">	
									<label for="q" class="buscarlabel"># de Pedido</label>
									<input  name="q" type="text" id="q"  autocomplete="off"  onkeyup='load(1);' required />
								</div>
								<div class="col" style="flex:0 1 20%!important; margin-left:10px;">
									<button type="button" class="btn btn-default"  style="background-color: #f7b917; border:none; width: 30%; color:white;" onclick='load(1);'>
										<span class="glyphicon glyphicon-search" ></span> Buscar</button>
									<span id="loader"></span>
								</div>
							</div>
							
						</div>
			</form>

				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div' id="nuevo"></div><!-- Carga los datos ajax -->
			</div>
		</div>	

	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/pedidos.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	

	
	<script>
		if($('#nuevo').hasClass('activarnav')){
			$('#nuevo').removeClass('activarnav');
			$('#historico').addClass('activarnav');
			$('#facturacion').removeClass('activarnav');
		}	

		
		$('.cerrar').click(function(){
			$('#notificacion').css('display','none');
		})
		
		$('#dataremove').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var recipient = button.data('whatever') 
                    var recipient1 = button.data('cellname') // Extract info from data-* attributes
                    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                    var modal = $(this)
                    modal.find('.modal-title').text('Pedido a cancelar con la ID:  ' + recipient)
                    modal.find('.modal-body #id').val(recipient)
                    modal.find('.modal-body #cellname').val(recipient1)
                    modal.find('.modal-body h4').text('El pedido seleccionado sera cancelado. ¿ Estas seguro de realizar esta acción con el pedido N. '+recipient+'?')
        })
		function cancelar_pedido(){
			var id_factura=$("#dataremove #id").val();
			var q="";
			console.log(id_factura);
			
			$.ajax({
        		type: "GET",
        		url: "./ajax/buscar_pedidos.php?",
        		data: 'id_factura='+id_factura+'&action=ajax&actionar=consulta&q='+q,
		 		beforeSend: function(objeto){
					$('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');

		  		},
        		success: function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					$('#dataremove').modal('hide');
					M.toast({html: 'Pedido N.'+id_factura+' Cancelado con exito!',classes: 'correcto',displayLength:5000,inDuration:700,outDuration:700});
				}
			});
		}
		
		function ver_factura(numero_pedido){
			//alert('Valor:'+numero_pedido);
				var fecha = $("#fecha_envio").text();
				var distribuidor = $("#distribuidor").text();
				var w= 1000;
						var h=800;
						var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
    					var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

   						var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    					var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    					var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    					var top = ((height / 2) - (h / 2)) + dualScreenTop;
				var respuesta=window.open('fpdf/ver_factura.php?id_factura='+numero_pedido+'&distribuidor='+distribuidor+'&fecha_envio='+fecha,'_blank', 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
				//location.href="pedidos.php?action=correcto";
		}
	</script>
	
  </body>
</html>