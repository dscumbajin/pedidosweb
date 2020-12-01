<?php

	/*-------------------------
	Autor: Jorge F prieto L
	Web: bateriasecuador.com
	Mail: info@bateriasecuador.com
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$numero_pedido=intval($_GET['id']);
		$del1="delete from pedido where numero_factura='".$numero_pedido."'";
		$del2="delete from detalle_pedido where numero_pedido='".$numero_pedido."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
		}
	}
	
	if(isset($_GET['id_factura'])){
		$id_factura=$_GET['id_factura'];
	
		$query=mysqli_query($con,"UPDATE pedido SET estado_pedido='03' WHERE numero_pedido=".$id_factura."");
		
		if (!$query) {
			$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
			$mensaje .= 'Consulta completa: ' . $query;
			echo $mensaje;
		}
		?>
		<?php
		

	}

	if($action == 'ajax' ){
		// escaping, additionally removing everything that could be (html/javascript-) code
         if(isset( $_GET['q'])) $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  $sTable = "pedido, clientes";
		 $sWhere = "";
		 $admin='Administrador';
		 if($_SESSION['user_name']==$admin){
			$sWhere.=" WHERE pedido.ruc_cliente=clientes.codigoCliente";
		 }else{
			$sWhere.=" WHERE pedido.ruc_cliente=clientes.codigoCliente and clientes.codigoCliente=".$_SESSION['user_id']."";
		 }
		 
		if (isset( $_GET['q']) != "" )
		{
		$sWhere.= " and  (clientes.nombreCliente like '%$q%' or pedido.numero_pedido like '%$q%')";
			
		}
		
		$sWhere.=" order by pedido.numero_pedido desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './pedidos.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table table-hover">
				<tr  class="info">
					<th>#</th>
					<th style="text-align:left!important">Distribuidor</th>
					<th>Fecha_creación</th>
					<th>Hora_creación</th>
					<th >Fecha_envío</th>
					<th>Hora_envío</th>
					<th class="text-center">Estado</th>
					<th class='text-center'>Total</th>
					<th class='text-center'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_factura=$row['numero_pedido'];
						$numero_factura=$row['numero_pedido'];
						$fecha=date("d/m/Y", strtotime($row['fecha_pedido']));
						
						if($row['fecha_envio']==null || $row['fecha_envio']=="0000-00-00"){
							$fecha_envio=" ---- ";
						}else{
							$fecha_envio=date("d/m/Y", strtotime($row['fecha_envio']));
						}

						//validar hora
						if($row['hora_envio']==null || $row['hora_envio']=="00:00:00"){
							$hora_envio=" ---- ";
						}else{
							$hora_envio=$row['hora_envio'];
						}
						
						$nombre_cliente=$row['nombreCliente'];
						$telefono_cliente='0983314541';
						$email_cliente=$row['mailCliente'];
						$nombre_vendedor=$row['nombreCliente'];
						$estado_factura=$row['estado_pedido'];

						$estado=mysqli_query($con,'SELECT * FROM estadopedido');
						$count=mysqli_num_rows($estado);
						if($count>0){
							while($row1=mysqli_fetch_array($estado)){
							
								if($estado_factura==$row1['codigoestped']){
									$text_estado=$row1['descripcion'];
									if($row1['color_boton']!=null && $row1['color_letra']!=null)
										$stilo="background:".$row1['color_boton']."; color:".$row1['color_letra']."; padding:7px 7px!important;";
									else
										$stilo="background:#d9534f; color:#fff; padding:5px 5px!important;";
									break;
								}
							}
						}else{
							$text_estado="SIN ESTADO"; $stilo="background:#d9534f; color:#fff; padding:5px 5px!important;";
						}
						$total_venta=$row['subtotal_pedido'];
					?>
					<tr>
					
						<td><?php echo $numero_factura; ?></td>
						<td id="distribuidor" style="text-align:left!important"><?php echo $nombre_cliente; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><?php echo $row['hora_creacion']; ?></td>		
						<td id="fecha_envio"><?php echo $fecha_envio; ?></td>
						<td><?php echo $hora_envio ?></td>

						<td><span style="display:block; border-radius:5px;font-size:14px; text-align:center;<?php echo $stilo;?>" class="label-danger"><?php echo $text_estado; ?></span></td>
						<td class='text-right'><?php echo number_format ($total_venta,2); ?></td>					
						<td class="text-center botones-accion">
						<a href="#" class='acciones' title='Descargar Pedido' onclick="ver_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download-alt"></i></a>

						<?php
						$resultado=preg_match("/CREA[DO,AR,DA,NDO,A]/i",$text_estado);
						
						//$resultado=1;
					
						
						if($resultado==1){
						?>
							<a href="nueva_factura.php?accionar=modificar&id_factura=<?php echo $id_factura;?>&fecha_factura=<?php echo $fecha;?>" class='acciones' title='Modificar Fatura'><i class="glyphicon glyphicon-pencil"></i></a>
							<a data-toggle="modal" class='acciones eliminar' data-target="#dataremove" data-whatever="<?php echo $id_factura;?>" title='Cancelar Pedido' ><i class="glyphicon glyphicon-remove"></i></a>
						<?php
						}else{
							echo '<a></a>';		
							echo '<a></a>';		
						}
						?>
						
						
					</td>
						
					</tr>
					<?php
				}
				?>

			  </table>
			  <div class="paginacion" >
			  		<?php
					 	echo paginate($reload, $page, $total_pages, $adjacents);
					?>
			  </div>
			</div>
			<?php
		}else{
			if($_GET['q'] != ""){
				?>
				<div class="alert alert-danger text-center" role="alert">
					No existen pedidos filtrados con el dato: <?php echo $_GET['q']; ?>
				</div>
				<?php
			}else{
			?>
				<div class="alert alert-danger text-center " role="alert">
					  No existen pedidos para mostrar actualmente para el usuario: <?php echo $_SESSION['user_id']; ?>
				</div>
			<?php
			}
		}
	}
?>