<?php
	/*-------------------------
	Autor: Jorge F prieto L
	Web: bateriasecuador.com
	Mail: info@bateriasecuador.com
	---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();
$sesioncode=$_SESSION['user_id'];
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

if(isset($_POST['accion'],$_POST['descuento'])){
	$sql=mysqli_query($con, "select * from tmp where session_id='".$sesioncode."'");// consulta a la tabla temporal
	$count=mysqli_num_rows($sql);

	if ($count>0){
		
		$id_usuario= $_SESSION['user_id'];
		$sqlcliente=mysqli_query($con, "select * from clientes where codigoCliente='".$id_usuario."'");// consulta a la tabla temporal
		$rowcliente=mysqli_fetch_array($sqlcliente);

		$descuento= str_replace(",","",$_POST['descuento']);
		
		$fecha=date("Y/m/d");
	
		$total=str_replace(",","",$_POST['total']);
		$estado=01;
		//consultar tabla pedido para obtener el ultimo ID
		$sqlpedido=mysqli_query($con,"SELECT MAX(numero_pedido) as id FROM pedido");
		
		if(isset($sqlpedido)){
			$row= mysqli_fetch_array($sqlpedido);
			$valorid=$row['id']+1;
		}else{$valorid=1;}
		//echo $fecha;
		$lista=$rowcliente['codigoLisPre'];
		date_default_timezone_set('America/Guayaquil');
		$horaactua=time();
		$hora_creacion=date('H:i:s',$horaactua);
		$nombre= $_SESSION['user_name'];
		if(!empty($_SESSION['promoactiva']))
			$copromo=$_SESSION['promoactiva'];
		else{

			$copromo=1016371;
		}
		//return '';
		$insert_tmp=mysqli_query($con, "INSERT INTO pedido (numero_pedido, fecha_pedido, ruc_cliente, subtotal_pedido, descuento_pedido, estado_pedido,hora_creacion,nombre_cliente,codigo_lista_precios,codigo_promocion) 
		VALUES ($valorid,'$fecha','$id_usuario',$total,$descuento,$estado,'$hora_creacion','$nombre',$lista,$copromo)");
		
		if (!$insert_tmp) {
			$mensaje  = 'Consulta no válidas: ' .mysqli_error($con) . "\n";
		
			echo '<script> M.toast({html: "Internal Server Error: Error en almacenar los  producto para el pedido: '.$valorid.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
		}else{
			echo '<script> M.toast({html: "Producto almacenado con éxito ",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
				

			while($row=mysqli_fetch_array($sql)){
				$id_producto=$row['id_producto'];
				$cantidad=$row['cantidad_tmp'];
				$precio_tmp=$row['precio_tmp'];
				$promocion=$row['promo'];
				$descuento=$row['descuento_unitario'];
				$iva=$row['descuento_iva'];

				if($promocion==null){
					
					$insert_detail=mysqli_query($con, "INSERT INTO detalle_pedido(numero_pedido,codigo_producto,cantidad,precio_unitario,status,descuento_unitario,porcentaje_iva) VALUES ('$valorid','$id_producto', '$cantidad','$precio_tmp',1,$descuento,$iva)");
					$delete=mysqli_query($con, "DELETE FROM tmp WHERE session_id='".$id_usuario."' and id_producto=".$id_producto."");
					
						
				}else
					$insert_detail=mysqli_query($con, "INSERT INTO detalle_pedido(numero_pedido,codigo_producto,cantidad,precio_unitario,promocion,status,descuento_unitario,porcentaje_iva) VALUES ('$valorid','$id_producto', '$cantidad','$precio_tmp',$promocion,1,$descuento,$iva)");
				
			}
			if (!$insert_detail) {

				$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
				echo '<script> M.toast({html: "Error en almacenar el pedido:  '.$valorid.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
				}else{
					echo '<script> M.toast({html: "Pedido almacenado con éxito ",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
					
					$delete=mysqli_query($con,"DELETE FROM tmp WHERE session_id='".$id_usuario."'");
					echo '<script>location.href="pedidos.php?action=correcto"</script>';
			}
		}

	}else{
		$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
		echo '<script> M.toast({html: "No existe productos seleccionados para crear pedido actualmente",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';	
	}
}


if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}


	/* Connect To Database*/
	//Archivo de funciones PHP
	include("../funciones.php");
if (!empty($id) && !empty($cantidad) && !empty($precio_venta))
{

	$id_producto=mysqli_real_escape_string($con,(strip_tags($_POST['id'], ENT_QUOTES)));
	$cantidad=mysqli_real_escape_string($con,(strip_tags($_POST['cantidad'], ENT_QUOTES)));
	$precio_tmp=mysqli_real_escape_string($con,(strip_tags($_POST['precio_venta'], ENT_QUOTES)));
	$sesion=mysqli_real_escape_string($con,(strip_tags($_SESSION['user_id'], ENT_QUOTES)));
	
	$id=NULL;
	$suma=0;
	
	$seleccionar=mysqli_query($con,"SELECT precioUnitario FROM productos where idProducto=".$id_producto."");
	//verificar valor precio
	if (!$seleccionar) {
		$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
		$mensaje .= 'Consulta completa: ' . $seleccionar;
		echo $mensaje;
	}else{
		$row=mysqli_fetch_array($seleccionar);
		if($row['precioUnitario']!=$precio_tmp){
			echo $row['precioUnitario'];
			echo $precio_tmp;
			echo '<script> M.toast({html: "Se ha alterado el precio del producto por su seguridad obtendremos el precio de nuestra Base de Datos",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
			$precio_tmp=$row['precioUnitario']*$cantidad;
		}else{
			$precio_tmp=$_POST['precio_venta']*$cantidad;
		}
	}

	//echo $precio_tmp;
	if($_POST['agregarproducto']==1){
		$precio_tmp=$_POST['precio_venta'];
		$seleccionar=mysqli_query($con,"SELECT precioUnitario FROM productos where idProducto=".$id_producto."");
		//verificar valor precio
		if (!$seleccionar) {
			$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
			$mensaje .= 'Consulta completa: ' . $seleccionar;
			echo $mensaje;
		}else{
			$row=mysqli_fetch_array($seleccionar);
			if($row['precioUnitario']!=$precio_tmp){
				echo '<script> M.toast({html: "Se ha alterado el precio del producto por su seguridad obtendremos el precio de nuestra Base de Datos",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
				$precio_tmp=$row['precioUnitario'];
			}
		}
		/*consultar antes para modificar*/
		$seleccionar=mysqli_query($con,"SELECT id_tmp,cantidad_tmp,nombreProducto FROM tmp,productos where productos.idProducto=tmp.id_producto and tmp.id_producto=".$id_producto." and promo!=1 and tmp.session_id='".$sesion."' ");
	//verificar valor precio
		if (!$seleccionar) {
			$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
			$mensaje .= 'Consulta completa: ' . $seleccionar;
			echo $mensaje;
			echo '<script> M.toast({html: "Error en almacenar el producto con ID :'.$id_producto.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
		}else{
			$count=mysqli_num_rows($seleccionar);
			if($count<=0){
				$seleccionar=mysqli_query($con,"SELECT promocion,nombreProducto FROM productos where idProducto=".$id_producto."");
						
					if (!$seleccionar) {
							$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
							$mensaje .= 'Consulta completa: ' . $seleccionar;
							echo $mensaje;
							echo '<script> M.toast({html: "Error en almacenar el producto con ID :'.$id_producto.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
					}
					$row=mysqli_fetch_array($seleccionar);
						if($row['promocion']==1){
							$insert_detail=mysqli_query($con, "INSERT INTO tmp(id_producto,cantidad_tmp,session_id,precio_tmp,ver_promo) VALUES ('$id_producto', '$cantidad','$sesion','$precio_tmp',1)");
						}else{	
							$insert_detail=mysqli_query($con, "INSERT INTO tmp(id_producto,cantidad_tmp,session_id,precio_tmp) VALUES ('$id_producto', '$cantidad','$sesion','$precio_tmp')");
						}
						if (!$insert_detail) {
							$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
							$mensaje .= 'Consulta completa: ' . $insert_detail;
							echo $mensaje;
							echo '<script> M.toast({html: "Error en almacenar el producto con ID :'.$id_producto.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
						}else{
							echo '<script> M.toast({html: "Producto '.str_replace('"',"",$row['nombreProducto']).' agregado exitosamente con la cantidad de:'.$cantidad.'",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
						}
				}else{
					$row=mysqli_fetch_array($seleccionar);
					$sumarproducto=$cantidad+$row['cantidad_tmp'];
					$modificarproducto=mysqli_query($con,"UPDATE tmp SET cantidad_tmp=".$sumarproducto." where id_tmp=".$row['id_tmp']."");
						
					if (!$modificarproducto) {
							$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
							
							echo $mensaje;
							echo '<script> M.toast({html: "Error en almacenar el producto con ID :'.$id_producto.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
					}else{
						echo '<script> M.toast({html: "Fue agregado '.$cantidad.' cantidad/es más al producto '.str_replace('"',"",$row['nombreProducto']).'",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
					}
				}
			}
	}else{ 
		//obtener nombre del productoç
		$nombreProducto=mysqli_query($con,"SELECT nombreProducto  FROM productos where idProducto=".$id_producto."");
		//verificar valor precio
		if (!$nombreProducto) {
			$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
			$mensaje .= 'Consulta completa: ' . $nombreProducto;
			echo $mensaje;
			echo '<script> M.toast({html: "Error en obtener el nombre del  producto con ID :'.$id_producto.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
		}
		$nombrerow=mysqli_fetch_array($nombreProducto);
		if($precio_tmp<=str_replace(",","",$_SESSION['maxPrecioPromo']) && $cantidad<=$_SESSION['promoActiva']){

			$precio_tmp=$_POST['precio_venta'];
			$consulta=mysqli_query($con,"SELECT * FROM tmp WHERE session_id='".$sesion."' and cantidad_tmp>".$_SESSION['numeroUnidBase']." and ver_promo=1 and promo!=1 and status!=1 limit 1 ");
			if (!$consulta) {
				$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
				$mensaje .= 'Consulta completa: ' . $consulta;
				echo $mensaje;
				}
			$count=mysqli_num_rows($consulta);
			if($count>0){
				$query=mysqli_fetch_array($consulta);
				$consultavalor=mysqli_query($con,"SELECT * FROM tmp WHERE session_id='".$sesion."' and cantidad_tmp>".$_SESSION['numeroUnidBase']." and disminuir_promo=0 and valor_promo=0 and id_tmp=".$query['id_tmp']." limit 1 ");
				if (!$consultavalor) {
					$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
					$mensaje .= 'Consulta completa: ' . $consultavalor;
					echo $mensaje;
					}
				$count=mysqli_num_rows($consultavalor);
				if($count>0){

					$valor=((int)($query['cantidad_tmp']/$_SESSION['numeroUnidBase']))-1;
					$valor2=$valor+1;
					if($valor===0){
						$consulta=mysqli_query($con,"UPDATE tmp SET disminuir_promo=".$valor.", valor_promo=".$valor2." , status=1 WHERE session_id='".$sesion."' and id_tmp=".$query['id_tmp']." ");
					}else{
						
						$consulta=mysqli_query($con,"UPDATE tmp SET disminuir_promo=".$valor.", valor_promo=".$valor2." WHERE session_id='".$sesion."' and id_tmp=".$query['id_tmp']." ");
					}

					$insert_detail=mysqli_query($con, "INSERT INTO tmp(id_producto,cantidad_tmp,session_id,precio_tmp,promo,verificar,status) VALUES ('$id_producto', '$cantidad','$sesion','$precio_tmp',1,1,1)");
					if (!$insert_detail) {
							$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
							$mensaje .= 'Consulta completa: ' . $insert_detail;
							echo '<script> M.toast({html: "Error en almacenar el producto con ID :'.$id_producto.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
						}else{
							echo '<script> M.toast({html: "Producto '.str_replace('"',"",$nombrerow['nombreProducto']).' agregado exitosamente con la cantidad de:'.$cantidad.'",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
						}
				}else{
					
					$consultacerrar=mysqli_query($con,"SELECT * FROM tmp WHERE session_id='".$sesion."' and cantidad_tmp>".$_SESSION['numeroUnidBase']." and disminuir_promo=0 and valor_promo>0 and id_tmp=".$query['id_tmp']." limit 1 ");
						if (!$consultacerrar) {
							$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
							$mensaje .= 'Consulta completa: ' . $consultacerrar;
							echo $mensaje;
							}
						$count=mysqli_num_rows($consultacerrar);
					if($count>0){
						$query=mysqli_fetch_array($consultacerrar);

						$udpate=mysqli_query($con,"UPDATE tmp SET status=1 WHERE id_tmp=".$query['id_tmp']." and session_id='".$sesion."'");
						if (!$udpate) {
							$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
							$mensaje .= 'Consulta completa: ' . $udpate;
							echo $mensaje;
						}
					}else{
						$cantidadvalor=$query['disminuir_promo']-$cantidad;
						if($cantidadvalor===0){
							$consulta=mysqli_query($con,"UPDATE tmp SET disminuir_promo=".$cantidadvalor.", status=1  WHERE session_id='".$sesion."' and id_tmp=".$query['id_tmp']." ");
						}else{
							$consulta=mysqli_query($con,"UPDATE tmp SET disminuir_promo=".$cantidadvalor."  WHERE session_id='".$sesion."' and id_tmp=".$query['id_tmp']." ");
						}
						
						$insert_detail=mysqli_query($con, "INSERT INTO tmp(id_producto,cantidad_tmp,session_id,precio_tmp,promo,verificar,status) VALUES ('$id_producto', '$cantidad','$sesion','$precio_tmp',1,1,1)");
						if (!$insert_detail) {
								$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
								$mensaje .= 'Consulta completa: ' . $insert_detail;
								echo '<script> M.toast({html: "Error en almacenar el producto con ID :'.$id_producto.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
						}else{
							echo '<script> M.toast({html: "Producto '.str_replace('"',"",$nombrerow['nombreProducto']).' agregado exitosamente con la cantidad de:'.$cantidad.'",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
						}
					}

				}
				
					
		}else{
			
			$consulta=mysqli_query($con,"SELECT * FROM tmp WHERE session_id='".$sesion."' and cantidad_tmp=".$_SESSION['numeroUnidBase']." and ver_promo=1 and promo!=1 and status!=1 limit 1 ");
		
			if (!$consulta) {
			$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
			$mensaje .= 'Consulta completa: ' . $consulta;
			echo $mensaje;
			}
		$count=mysqli_num_rows($consulta);
		if($count>0){
			$query=mysqli_fetch_array($consulta);
			$udpate=mysqli_query($con,"UPDATE tmp SET status=1 WHERE id_tmp=".$query['id_tmp']." and session_id='".$sesion."'");
			if (!$udpate) {
				$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
				$mensaje .= 'Consulta completa: ' . $udpate;
				echo $mensaje;
			}	
			$insert_detail=mysqli_query($con, "INSERT INTO tmp(id_producto,cantidad_tmp,session_id,precio_tmp,promo,verificar,status) VALUES ('$id_producto', '$cantidad','$sesion','$precio_tmp',1,1,1)");
			if (!$insert_detail) {
				$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
				$mensaje .= 'Consulta completa: ' . $insert_detail;
				echo '<script> M.toast({html: "Error en almacenar el producto con ID :'.$id_producto.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
			}else{
				echo '<script> M.toast({html: "Producto '.str_replace('"',"",$nombrerow['nombreProducto']).' agregado exitosamente con la cantidad de:'.$cantidad.'",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
			}
		}else{
		
			$query=mysqli_query($con,"SELECT sum(cantidad_tmp) as cantidad FROM tmp WHERE ver_promo=1 and status=0 and session_id='".$sesion."'");
		
			if (!$query) {
				$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
				$mensaje .= 'Consulta completa: ' . $query;
				echo $mensaje;
			}
			if(($count=mysqli_num_rows($query))>0){
				//echo 'aqui';
				$sql=mysqli_fetch_array($query);
				if($sql['cantidad']>=$_SESSION['numeroUnidBase']){
					//echo 'aqui';

					$query=mysqli_query($con,"SELECT * FROM tmp WHERE ver_promo=1 and status=0 and session_id='".$sesion."'");
					while($row=mysqli_fetch_array($query)){
						$suma=$suma+$row['cantidad_tmp'];
						if($suma<=$_SESSION['numeroUnidBase']){
							$udpate=mysqli_query($con,"UPDATE tmp SET status=1 WHERE id_tmp=".$row['id_tmp']." and session_id='".$sesion."'");
							if (!$udpate) {
								$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
								$mensaje .= 'Consulta completa: ' . $udpate;
								echo $mensaje;
							}
						}else{
							
							if($suma>$_SESSION['numeroUnidBase']){
								$udpate=mysqli_query($con,"UPDATE tmp SET status=1 WHERE id_tmp=".$row['id_tmp']." and session_id='".$sesion."'");
								if (!$udpate) {
									$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
									$mensaje .= 'Consulta completa: ' . $udpate;
									echo $mensaje;
								}
							}
							
							break;
							$suma=0;
						}
					}

					$insert_detail=mysqli_query($con, "INSERT INTO tmp(id_producto,cantidad_tmp,session_id,precio_tmp,promo,verificar,status) VALUES ('$id_producto', '$cantidad','$sesion','$precio_tmp',1,1,1)");
					if (!$insert_detail) {
						$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
						$mensaje .= 'Consulta completa: ' . $insert_detail;
						echo '<script> M.toast({html: "Error en almacenar el producto con ID :'.$id_producto.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
					}else{
						echo '<script> M.toast({html: "Producto '.str_replace('"',"",$nombrerow['nombreProducto']).' agregado exitosamente con la cantidad de:'.$cantidad.'",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
					}
				}else{
					$insert_detail=mysqli_query($con, "INSERT INTO tmp(id_producto,cantidad_tmp,session_id,precio_tmp,promo,verificar,status) VALUES ('$id_producto', '$cantidad','$sesion','$precio_tmp',1,1,1)");
					if (!$insert_detail) {
						$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
						$mensaje .= 'Consulta completa: ' . $insert_detail;
						echo '<script> M.toast({html: "Error en almacenar el producto con ID :'.$id_producto.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
					}else{
						echo '<script> M.toast({html: "Producto  '.str_replace('"',"",$nombrerow['nombreProducto']).' agregado  exitosamente con la cantidad de:'.$cantidad.'",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
					}
				}	

			}else{

				$insert_detail=mysqli_query($con, "INSERT INTO tmp(id_producto,cantidad_tmp,session_id,precio_tmp,promo,verificar,status) VALUES ('$id_producto', '$cantidad','$sesion','$precio_tmp',1,1,1)");
				if (!$insert_detail) {
					$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
					$mensaje .= 'Consulta completa: ' . $insert_detail;
					echo '<script> M.toast({html: "Error en almacenar el producto con ID :'.$id_producto.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
				}else{
					echo '<script> M.toast({html: "Producto '.str_replace('"',"",$nombrerow['nombreProducto']).' agregado exitosamente con la cantidad de:'.$cantidad.'",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
				}
			}
		}
	}
	}else{
		
		$conocer=mysqli_query($con,"SELECT * FROM tmp WHERE status=0 and promo!=1 and cantidad_tmp>=".$_SESSION['numeroUnidBase']." and ver_promo=1 and session_id='".$sesion."'  limit 1");
					
			$count=mysqli_num_rows($conocer);
			if($count>0){
							
				$sqlupdate=mysqli_fetch_array($conocer);
		
				$sql=mysqli_query($con,"UPDATE tmp SET tmp.status=1 WHERE id_tmp=".$sqlupdate['id_tmp']." and session_id='".$sesion."' ");
					if (!$sql) {
								$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
								$mensaje .= 'Consulta completa: ' . $sql;
					echo $mensaje;
				}
			}
		echo '<script> M.toast({html: "El precio o la cantidad del producto no puede ser mayor al máximo de promoción!",classes: "error",displayLength:4000,inDuration:700,outDuration:700}); </script>';
		echo '<script>loadmodificar();</script>';
	}
}
	

}

if(isset($_GET['id_editar'],$_GET['cantidad_editar'])){
	$id=mysqli_real_escape_string($con,(strip_tags($_GET['id_editar'], ENT_QUOTES)));
	$cantidad=mysqli_real_escape_string($con,(strip_tags($_GET['cantidad_editar'], ENT_QUOTES)));
	$sesion=mysqli_real_escape_string($con,(strip_tags($_SESSION['user_id'], ENT_QUOTES)));
	$activar=null;

	//obtener nombre del productoç
	$nombreProducto=mysqli_query($con,"SELECT nombreProducto FROM productos,tmp where tmp.id_producto=productos.idProducto and  id_tmp=".$id."");
	//verificar valor precio
	if (!$nombreProducto) {
		$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
		$mensaje .= 'Consulta completa: ' . $nombreProducto;
		echo $mensaje;
		echo '<script> M.toast({html: "Error en obtener el nombre del  producto con ID :'.$id.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
	}
	$nombrerow=mysqli_fetch_array($nombreProducto);

	if($id>0){
		//verificar si tiene promocion
		if(!empty(@$_SESSION['promoactiva'])){	
			$eliminardata=mysqli_query($con,"SELECT * FROM tmp WHERE id_tmp=".$id." and session_id='".$sesion."' ");
			//verificar si suma o resta el producto
			if (!$eliminardata) {
				$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
				$mensaje .= 'Consulta completa: ' . $eliminardata;
				echo '<script> M.toast({html: "Error en modificar el producto con ID :'.$id.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
			}else{

				$count=mysqli_num_rows($eliminardata);
					if($count>0){		
						$sqlupdate=mysqli_fetch_array($eliminardata);
						//verificar si se resto
						if($sqlupdate['cantidad_tmp']>$cantidad){
							//verificar una sola cantidad
							//sumar productos de promocion
							$sumarpromo=mysqli_query($con,"SELECT sum(cantidad_tmp) as cantidad FROM tmp WHERE promo=1 and session_id='".$sesion."' ");

							$count=mysqli_num_rows($sumarpromo);
							if($count>0){		
								$sqlupdate=mysqli_fetch_array($sumarpromo);
							
									//verificar negativo
									//sumar promociones

									//modificar producto
									$sql=mysqli_query($con,"UPDATE tmp SET cantidad_tmp=".$cantidad." WHERE id_tmp=".$id." and session_id='".$sesion."' ");
									if (!$sql) {
										$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
										$mensaje .= 'Consulta completa: ' . $sql;
										echo '<script> M.toast({html: "Error en modificar el producto con ID :'.$id.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
									}else{
										echo '<script> M.toast({html: "Producto '.utf8_encode(str_replace('"',"",$nombrerow['nombreProducto'])).' modificado exitosamente con la cantidad de:'.$cantidad.'",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
									}
								
									do{
										$total_sumar=0;
										$sumador_total_promo=0;
										$precio_venta=0;
										$sqlValidarPromo=mysqli_query($con, "select * from tmp where promo=1 and session_id='".$_SESSION['user_id']."'");
										if(($count=mysqli_num_rows($sqlValidarPromo))>0){
											while($rowValidarPromo=mysqli_fetch_array($sqlValidarPromo)){
													$cant=$rowValidarPromo['cantidad_tmp'];
													$precio=$rowValidarPromo['precio_tmp'];
													$sumar=$cant*$precio;
													$total_sumar=$total_sumar+$sumar;
											}
										}else{
											$total_sumar=0;
										}
									
									
										//sumar productos nuevamente
										
										$sql=mysqli_query($con, "select tmp.cantidad_tmp as catidadtotal, productos.capacidad,productos.polaridad, tmp.valor_promo, tmp.disminuir_promo, tmp.status, tmp.id_tmp, tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva, productos.promocion, productos.codigoLinea, productos.codigoListaPrecio, tmp.promo from productos, tmp where productos.idProducto=tmp.id_producto and productos.promocion=1 and  promo!=1 and tmp.session_id='".$_SESSION['user_id']."'  order by tmp.promo desc");

										if (!$sql) {
											$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
											echo $mensaje;
											return '';
										}
											$count=mysqli_num_rows($sql);
											if($count>0){
												while ($row=mysqli_fetch_array($sql))
													{
															$precio_venta=$row['precio_tmp']*$row['catidadtotal'];
															$sumador_total_promo=$sumador_total_promo+$precio_venta;
															
													
													}
											}
									
										
								
										$totalvalor=($sumador_total_promo*$_SESSION['porcentaje'])/100;
										$totalvalor=$totalvalor-$total_sumar;

										
										//eliminar una promocion

										if($totalvalor<=0){
											$sumarpromo=mysqli_query($con,"SELECT id_tmp FROM tmp WHERE promo=1 and session_id='".$sesion."' order by cantidad_tmp desc limit 1 ");
											if (!$sumarpromo) {
												$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
												$mensaje .= 'Consulta completa: ' . $eliminardata;
												echo '<script> M.toast({html: "Error en modificar el producto con ID :'.$id.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
											}else{
												$count=mysqli_num_rows($sumarpromo);
												if($count>0){	
													
													$sqlupdate=mysqli_fetch_array($sumarpromo);
													$sumarpromo=mysqli_query($con,"DELETE FROM tmp WHERE promo=1 and id_tmp=".$sqlupdate['id_tmp']."");
												}
											}
											$activar=true;
										}else{
											$sql=mysqli_query($con, "select sum(tmp.cantidad_tmp) as cantidadtotal from tmp,productos where productos.idProducto=tmp.id_producto and promo!=1 and productos.promocion=1 and tmp.session_id='".$_SESSION['user_id']."'");

											if (!$sql) {
												$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
												echo $mensaje;
												
											}else{
												$row=mysqli_fetch_array($sql);
											
												if($row['cantidadtotal']<$_SESSION['numeroUnidBase']){
												
														$sumarpromo=mysqli_query($con,"DELETE FROM tmp WHERE promo=1 and tmp.session_id='".$_SESSION['user_id']."'");
														$activar=true;
													
												}else{
													do{
													$comprobarnumero=0;
													$sql=mysqli_query($con, "select tmp.cantidad_tmp as cantidadtotal, productos.capacidad,nombreLinea,productos.polaridad, tmp.valor_promo, tmp.disminuir_promo, tmp.status, tmp.id_tmp, tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva, productos.promocion, productos.codigoLinea, productos.codigoListaPrecio, tmp.promo from productos, tmp, listalinea where productos.idProducto=tmp.id_producto and productos.codigoLinea=listalinea.codigoLinea and tmp.session_id='".$_SESSION['user_id']."'  order by productos.nombreProducto ASC,tmp.promo DESC");
												/* 	print("select sum(tmp.cantidad_tmp) as catidadtotal, tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva, productos.promocion, productos.codigoLinea from productos, tmp where productos.idProducto=tmp.id_producto and tmp.session_id='".$_SESSION['user_id']."' group by tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva, productos.promocion, productos.codigoLinea");
													die(); */
													if (!$sql) {
														$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
														echo $mensaje;
														return '';
													}
														$count=mysqli_num_rows($sql);
														$cantidadTotal=0;
														if($count>0){
															while ($row=mysqli_fetch_array($sql)){
																$cantidad=$row['cantidadtotal'];
																$promocion=$row['promocion'];
																$promo=$row['promo'];
																if($promocion==1 && $promo!=1){
																	
																	$activar=true;
															
																	$cantidadTotal=$cantidadTotal+$cantidad;
																	
																
																}

															}
															$sqlValidarPromo=mysqli_query($con, "select sum(cantidad_tmp) as cantidad, sum(precio_tmp) as precio from tmp where promo=1 and session_id='".$_SESSION['user_id']."'");
															$rowValidarPromo=mysqli_fetch_array($sqlValidarPromo);
															$comprobarnumero= floor($cantidadTotal/$_SESSION['numeroUnidBase'])-$rowValidarPromo['cantidad'];
														
															if($comprobarnumero<0){
																$sumarpromo=mysqli_query($con,"DELETE  FROM tmp WHERE promo=1 and tmp.session_id='".$_SESSION['user_id']."' limit 1");
																$activar=true;

															}
														}
													}while($comprobarnumero<0);
												}
												
											}
											break;
										}
									}while($totalvalor<=0);



									if($activar===true){
										echo '<script> M.toast({html: "Advertencia alguna de sus promociones han sido eliminadas por motivos de modificación",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
									}
									//fin control venta
								//}
								
							}
							//verificar varias cantidades
						}else{
							//aumento más productos
							$sql=mysqli_query($con,"UPDATE tmp SET cantidad_tmp=".$cantidad." WHERE id_tmp=".$id." and session_id='".$sesion."' ");
							if (!$sql) {
								$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
								$mensaje .= 'Consulta completa: ' . $sql;
								echo '<script> M.toast({html: "Error en modificar el producto con ID :'.$id.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
							}else{
								echo '<script> M.toast({html: "Producto '.utf8_encode(str_replace('"',"",$nombrerow['nombreProducto'])).' modificado exitosamente con la cantidad de:'.$cantidad.'",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
							}
						}
					}
				}
		}else{
			$sql=mysqli_query($con,"UPDATE tmp SET cantidad_tmp=".$cantidad." WHERE id_tmp=".$id." and session_id='".$sesion."' ");
				if (!$sql) {
					$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
					$mensaje .= 'Consulta completa: ' . $sql;
					echo '<script> M.toast({html: "Error en modificar el producto con ID :'.$id.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
				}else{
					echo '<script> M.toast({html: "Producto '.utf8_encode(str_replace('"',"",$nombrerow['nombreProducto'])).' modificado exitosamente con la cantidad de:'.$cantidad.'",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
				}
		}
	}else{
		echo '<script> M.toast({html: "No se permite el ingreso de numeros menores a 0",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
	}
}





if (isset($_GET['id']))//codigo elimina un elemento del array
{

	$sesion=$_SESSION['user_id'];
	$suma=0;
	$verificar=mysqli_query($con,"SELECT * FROM tmp WHERE id_tmp=".$_GET['id']." and session_id='".$sesion."'");
	//obtener nombre del productoç
	$nombreProducto=mysqli_query($con,"SELECT nombreProducto FROM productos,tmp where tmp.id_producto=productos.idProducto and  id_tmp=".$_GET['id']."");
	//verificar valor precio
	if (!$nombreProducto) {
		$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
		$mensaje .= 'Consulta completa: ' . $nombreProducto;
		echo $mensaje;
		echo '<script> M.toast({html: "Error en obtener el nombre del producto con ID :'.$_GET['id'].'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
	}
	$nombrerow=mysqli_fetch_array($nombreProducto);
	
	if (!$verificar) {
		$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
		$mensaje .= 'Consulta completa: ' . $sql;
		echo $mensaje;
	}else{
			//verificar si tiene promocion
			if(!empty(@$_SESSION['promoactiva'])){	
				
								//verificar una sola cantidad
								//sumar productos de promocion
								$sumarpromo=mysqli_query($con,"SELECT sum(cantidad_tmp) as cantidad FROM tmp WHERE promo=1 and session_id='".$sesion."' ");
								

								$count=mysqli_num_rows($sumarpromo);
								if($count>0){		
									$sqlupdate=mysqli_fetch_array($sumarpromo);
									

										//modificar producto
										$sql=mysqli_query($con,"DELETE FROM tmp WHERE id_tmp=".$_GET['id']."");
										if (!$sql) {
											$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
											$mensaje .= 'Consulta completa: ' . $sql;
											echo '<script> M.toast({html: "Error en eliminar el producto con ID :'.$_GET['id'].'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
										}else{
											echo '<script> M.toast({html: "Producto '.utf8_encode(str_replace('"',"",$nombrerow['nombreProducto'])).' eliminado exitosamente",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
										}
										$activar=null;
										do{
											$total_sumar=0;
											$sumador_total_promo=0;
											$precio_venta=0;
											$sqlValidarPromo=mysqli_query($con, "select * from tmp where promo=1 and session_id='".$_SESSION['user_id']."'");
											if(($count=mysqli_num_rows($sqlValidarPromo))>0){
												while($rowValidarPromo=mysqli_fetch_array($sqlValidarPromo)){
														$cant=$rowValidarPromo['cantidad_tmp'];
														$precio=$rowValidarPromo['precio_tmp'];
														$sumar=$cant*$precio;
														$total_sumar=$total_sumar+$sumar;
												}
											}else{
												$total_sumar=0;
											}

											//sumar productos nuevamente
											
											$sql=mysqli_query($con, "select tmp.cantidad_tmp as catidadtotal, productos.capacidad,productos.polaridad, tmp.valor_promo, tmp.disminuir_promo, tmp.status, tmp.id_tmp, tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva, productos.promocion, productos.codigoLinea, productos.codigoListaPrecio, tmp.promo from productos, tmp where productos.idProducto=tmp.id_producto and promo!=1 and productos.promocion=1 and tmp.session_id='".$_SESSION['user_id']."'  order by tmp.promo desc");

											if (!$sql) {
												$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
												echo $mensaje;
												return '';
											}
												$count=mysqli_num_rows($sql);
												if($count>0){
													while ($row=mysqli_fetch_array($sql))
														{
																$precio_venta=$row['precio_tmp']*$row['catidadtotal'];
																$sumador_total_promo=$sumador_total_promo+$precio_venta;
														
														}
												}
											
											
											$totalvalor=($sumador_total_promo*$_SESSION['porcentaje'])/100;
											$totalvalor=$totalvalor-$total_sumar;
											
										
											//eliminar una promocion

											if($totalvalor<0){
												$sumarpromo=mysqli_query($con,"SELECT id_tmp FROM tmp WHERE promo=1 and session_id='".$sesion."' order by cantidad_tmp desc limit 1 ");
												if (!$sumarpromo) {
													$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
													$mensaje .= 'Consulta completa: ' . $eliminardata;
													echo '<script> M.toast({html: "Error en modificar el producto con ID :'.$id.'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
												}else{
													$count=mysqli_num_rows($sumarpromo);
													if($count>0){	
														
														$sqlupdate=mysqli_fetch_array($sumarpromo);
														$sumarpromo=mysqli_query($con,"DELETE  FROM tmp WHERE promo=1 and id_tmp=".$sqlupdate['id_tmp']."");
													}
												}
												$activar=true;
											}else{
													$sql=mysqli_query($con, "select sum(tmp.cantidad_tmp) as cantidadtotal from tmp,productos where productos.idProducto=tmp.id_producto and promo!=1 and productos.promocion=1 and tmp.session_id='".$_SESSION['user_id']."'");

													if (!$sql) {
														$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
														echo $mensaje;
														
													}else{
														$row=mysqli_fetch_array($sql);
														
														if($row['cantidadtotal']<$_SESSION['numeroUnidBase']){
															
																$sumarpromo=mysqli_query($con,"DELETE FROM tmp WHERE promo=1 and tmp.session_id='".$_SESSION['user_id']."'");
																//$activar=true;
															
															
														}else{
															$sql=mysqli_query($con, "select tmp.cantidad_tmp as cantidadtotal, productos.capacidad,nombreLinea,productos.polaridad, tmp.valor_promo, tmp.disminuir_promo, tmp.status, tmp.id_tmp, tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva, productos.promocion, productos.codigoLinea, productos.codigoListaPrecio, tmp.promo from productos, tmp, listalinea where productos.idProducto=tmp.id_producto and productos.codigoLinea=listalinea.codigoLinea and tmp.session_id='".$_SESSION['user_id']."'  order by productos.nombreProducto ASC,tmp.promo DESC");
														
															if (!$sql) {
																$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
																echo $mensaje;
																return '';
															}
																$count=mysqli_num_rows($sql);
																$cantidadTotal=0;
																if($count>0){
																	while ($row=mysqli_fetch_array($sql)){
																		$cantidad=$row['cantidadtotal'];
																		$promocion=$row['promocion'];
																		$promo=$row['promo'];
																		if($promocion==1 && $promo!=1){
																			
																			$activar=true;
																	
																			$cantidadTotal=$cantidadTotal+$cantidad;
																			
																		
																		}

																	}
																	$sqlValidarPromo=mysqli_query($con, "select sum(cantidad_tmp) as cantidad, sum(precio_tmp) as precio from tmp where promo=1 and session_id='".$_SESSION['user_id']."'");
																	$rowValidarPromo=mysqli_fetch_array($sqlValidarPromo);
																	$comprobarnumero= floor($cantidadTotal/$_SESSION['numeroUnidBase'])-$rowValidarPromo['cantidad'];
																	
																	if($comprobarnumero<0){
																		$sumarpromo=mysqli_query($con,"DELETE  FROM tmp WHERE promo=1 and tmp.session_id='".$_SESSION['user_id']."' limit 1");
																		$activar=true;

																	}
															}
														}
														
													}
												break;
											}
										
										}while($totalvalor<=0);
										if($activar===true){
											echo '<script> M.toast({html: "Advertencia alguna de sus promociones han sido eliminadas por motivos de modificación",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
										}
										//fin control venta
									//}
									
								
								//verificar varias cantidades
							}else{
								//aumento más productos
								$sql=mysqli_query($con,"DELETE FROM tmp WHERE id_tmp=".$_GET['id']."");
								if (!$sql) {
									$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
									$mensaje .= 'Consulta completa: ' . $sql;
									echo '<script> M.toast({html: "Error en eliminar el producto con ID :'.$_GET['id'].'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
								}else{
									echo '<script> M.toast({html: "Producto '.utf8_encode(str_replace('"',"",$nombrerow['nombreProducto'])).' eliminado exitosamente ",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
								}
							}
						
				
			}else{
				$sql=mysqli_query($con,"DELETE FROM tmp WHERE id_tmp=".$_GET['id']."");
					if (!$sql) {
						$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
						$mensaje .= 'Consulta completa: ' . $sql;
						echo '<script> M.toast({html: "Error en eliminar el producto con ID :'.$_GET['id'].'",classes: "error",displayLength:4000,inDuration:700,outDuration:700});</script>';
					}else{
						echo '<script> M.toast({html: "Producto '.utf8_encode(str_replace('"',"",$nombrerow['nombreProducto'])).' eliminado exitosamente ",classes: "correcto",displayLength:4000,inDuration:700,outDuration:700});</script>';
					}
			}
	
		}
	}
	
$simbolo_moneda="$";
?>
<div class="table-responsive" style="overflow-x:auto;">
<table class="table table-responsive table-striped table-bordered table-sm  fixed_header table-hover "  cellspacing="0" width="100%" >

<tbody class="container_data" id="cuerpo-tabla" style="overflow-y: auto; height:auto; max-height:600px; min-height:auto; width: 100%" >
	<tr>
		<th class='text-center'  width="20%">CANT.</th>
		<th class="" width="30%">DESCRIPCIÓN</th>
		<!--<th class="text-center"   width="5%">CAPACIDAD</th>
		<th class="text-center"   width="10%">POLARIDAD</th>-->
		<th class="text-center"    width="10%">PRECIO UNIT</th>
		<th class="text-center"   width="10%">DESC. UNIT</th>
		<th class="text-center"   width="15%">PRECIO TOTAL (Sin IVA)</th>
		<th class="text-center"   width="15%">ACCIONES</th>
	</tr>

<?php
	$sumador_total=0;
	$sumador_descuento=0;
	$cantidadTotal=0;
	$ProductosTotales=0;
	$sumador_total_promo=0;
	$valorproducto=0;
	$total_sumar=0;
	$activar=null;


	
	$sql=mysqli_query($con, "select tmp.cantidad_tmp as catidadtotal, productos.capacidad,nombreLinea,productos.polaridad, tmp.valor_promo, tmp.disminuir_promo, tmp.status, tmp.id_tmp, tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva, productos.promocion, productos.codigoLinea, productos.codigoListaPrecio, tmp.promo from productos, tmp, listalinea where productos.idProducto=tmp.id_producto and tmp.promo!=1 and productos.codigoLinea=listalinea.codigoLinea and tmp.session_id='".$_SESSION['user_id']."'  order by productos.orden ASC, tmp.promo DESC");
	if (!$sql) {
		$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
		echo $mensaje;
		return '';
	}
		$count=mysqli_num_rows($sql);
		if($count>0){
			while ($row=mysqli_fetch_array($sql))
				{
					$id_tmp=$row['id_tmp'];
					$codigo_producto=$row['id_producto'];
					$codigo_producto1='----';
					$codigoListaPrecio=$row['codigoListaPrecio'];
					$cantidad=$row['catidadtotal'];
					$promo=$row['promo'];
					$capacidad=$row['capacidad'];
					$polaridad=$row['polaridad'];
					$valor1=$row['valor_promo'];
					$valor2=$row['disminuir_promo'];
					$resta_valor=$valor1-$valor2;
					$valorproducto=1;
					$ProductosTotales= $ProductosTotales+$cantidad;
					$nombre_producto=$row['nombreProducto'];
					$promocion=$row['promocion'];
					$codigoLinea=$row['codigoLinea'];
					$nombrelinea=$row['nombreLinea'];
					if($promo==1){
						$precio_venta=0;
						$aviso="Promocion";
					}else{
						$precio_venta=$row['precio_tmp'];
					}


					
					if($promocion==1 && $promo!=1){
						$activar=true;
						$cantidadTotal=$cantidadTotal+$cantidad;
						
						$precio_venta_f=number_format($precio_venta,2);//Formateo variables
						$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comás
						$precio_total=$precio_venta_r*$cantidad;
						$precio_total_f=number_format($precio_total,2);//Precio total formateado
						$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comás
						$sumador_total+=$precio_total_r;//Sumador
					
				
						$sumador_total_promo+=$precio_total_r;//Sumador	
					}else{
						$precio_venta_f=number_format($precio_venta,2);//Formateo variables
						$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comás
						$precio_total=$precio_venta_r*$cantidad;
						$precio_total_f=number_format($precio_total,2);//Precio total formateado
						$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comás
						$sumador_total+=$precio_total_r;//Sumador
					}

					
				

					$iva=$row['iva'];
					$bandera=0;
					$sqlDescCL=mysqli_query($con, "select porcentajeDesCL from descuentoclientelinea where codigoLinea='".$codigoLinea."' and codigoCliente='".$_SESSION['user_id']."'");
					$rowDescCL=mysqli_fetch_array($sqlDescCL);
					$precio_total_f=str_replace(",","",$precio_total_f);
				
					if(@$rowDescCL['porcentajeDesCL']>'0'){
					
						$descuento= (($precio_total_f * $rowDescCL['porcentajeDesCL'])/100);
						@$general= ((@$precio_venta_f *$rowDescCL['porcentajeDesCL'])/100);
						
						$bandera='descuentoclientelinea';
					}else{
					
						$sqlDescCP=mysqli_query($con, "select porcentajeDes from descuentoclienteproducto where idProducto='".$codigo_producto."' and codigoCliente='".$_SESSION['user_id']."'");
						$rowDescCP=mysqli_fetch_array($sqlDescCP);
						if(@$rowDescCP['porcentajeDes']>'0'){
						
							$descuento= (($precio_total_f * $rowDescCP['porcentajeDes'])/100);
							@$general= ((@$precio_venta_f *$rowDescCP['porcentajeDes'])/100);
							$bandera='descuentoclienteproducto';
							
						}else{
							
							$sqlDescLP=mysqli_query($con, "select descuentolistaprecios.porcentajeDesLP, descuentolistaprecios.precioLP from descuentolistaprecios, clientes where descuentolistaprecios.codigoLisPre=clientes.codigoLisPre and descuentolistaprecios.idProducto='".$codigo_producto."' and clientes.codigoCliente='".$_SESSION['user_id']."'");
							
							$rowDescLP=mysqli_fetch_array($sqlDescLP);
							if(@$rowDescLP['precioLP']>'0'){
								
								$row['precio_tmp']= $rowDescLP['precioLP'];
							
								@$descuento=((@$precio_total_f * @$rowDescLP['porcentajeDesLP'])/100);
								@$general=((@$precio_venta_f * @$rowDescLP['porcentajeDesLP'])/100);
								$bandera='descuentolistaprecios';
								
							}else{
							
								$sqlDescCliente=mysqli_query($con, "select porcentajeDesLL from descuentolistalinea,clientes where descuentolistalinea.codigoLisPre=clientes.codigoLisPre and descuentolistalinea.codigoLinea=".$row['codigoLinea']." and clientes.codigoCliente='".$_SESSION['user_id']."' and descuentolistalinea.estadoLL=1");
							
								if (!$sqlDescCliente) {
									$mensaje  = 'Consulta no válidas: ' .mysqli_error($con) . "\n";
									$mensaje .= 'Consulta completa: ' . $sqlDescCliente;
									echo $mensaje;
								}
								$rowDescCliente=mysqli_fetch_array($sqlDescCliente);
								
								if(@$rowDescCliente['porcentajeDesLL']>'0'){
						
									@$descuento= ((@$precio_total_f * @$rowDescCliente['porcentajeDesLL'])/100);
									$bandera='descuentoListalinea';

									@$general= ((@$precio_venta_f *@$rowDescCliente['porcentajeDesLL'])/100);
									
								}else{
								
									$sqlDescCliente=mysqli_query($con, "select descuentoCliente from clientes where clientes.codigoCliente='".$_SESSION['user_id']."'");
									$rowDescCliente=mysqli_fetch_array($sqlDescCliente);
									if(@$rowDescCliente['descuentoCliente']>'0'){
					/* 					print($precio_total_f."-".$rowDescCliente['descuentoCliente']);
										die(); */
										@$descuento= ((@$precio_total_f * @$rowDescCliente['descuentoCliente'])/100);
										$bandera='descuentoCliente';
									
										@$general= ((@$precio_venta_f * @$rowDescCliente['descuentoCliente'])/100);
									

									}else{
										@$descuento=0;
									}
										
								}
							}
						}
					}

	
					$bandera="";
					@$aviso='';
			
					$descuento=str_replace(",","",$descuento);
					$sumador_descuento+=$descuento;//Sumador

					//transformar dato
					$precio_total_f=number_format($precio_total_f,2);
					//validar
					if(empty(@$general))$valor=0;else$valor=@$general;
					if (empty(@$iva))$valor2=0;else$valor2=@$iva;

					$update=mysqli_query($con,"UPDATE tmp SET descuento_unitario=".$valor.", descuento_iva=".$valor2." WHERE id_producto=".$row["id_producto"]." and session_id='".$_SESSION['user_id']."'");
					if (!$update) {
						$mensaje  = 'Consulta no válidas: ' .mysqli_error($con) . "\n";
						echo $mensaje;
						return '';
					}
					?>
						<tr >
							<!--<td class='text-center' style="display:none"><?php //if($codigoListaPrecio==''){echo $codigo_producto1;}else{echo $codigoListaPrecio;} ?></td>-->
							<?php 
								if($promo!=1){
							?>	
								<td class="text-center"><input min="1" style="padding:5px;width:100%;text-align:center;" type="number" onkeyup="el('<?php echo $id_tmp; ?>')" pattern="^[0-9]+"  id="cantidad_<?php echo $id_tmp; ?>" value="<?php echo $cantidad;?>"></td>	
							<?php		
								}else{
							?>
								<td class="text-center" ><?php echo $cantidad;?></td>
							<?php
								}
							?>
							
  
							<td class="" style="white-space:pre-wrap!important;" ><?php echo utf8_encode($nombre_producto);?><h2 class="listalinea"><?php echo utf8_encode($nombrelinea); ?></h2></td>
							<!--<td class="text-center" ><?php echo $capacidad;?></td>
							<td class="text-center"  ><?php echo $polaridad;?></td>-->
							<td class="text-center"  ><?php echo $precio_venta_f."".@$aviso;?></td>
							<td class="text-center"  ><?php echo number_format(@$general,2)." ".$bandera;?></td>
							<td class="text-center"  ><?php echo $precio_total_f;?></td>
							<td class="text-center"  >
							<?php if($promo!=1){?>
								<a href="#" onclick="editar('<?php echo $id_tmp ?>')" class="accion_nuevo" id="accion_nuevo" title="Modificar"><i class="glyphicon glyphicon-pencil"></i></a>
							<?php }else{?>
								<a href="# " class=""></a>
							<?php	
							}
							?>	
								<a href="#" onclick="eliminar('<?php echo $id_tmp ?>')" class="accion_nuevo borrar" id="accion_nuevo" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
							</td>
							
						
						</tr>		
					<?php
				}


				//promociones imprimir

				$sql=mysqli_query($con, "select tmp.cantidad_tmp as catidadtotal, productos.capacidad,nombreLinea,productos.polaridad, tmp.valor_promo, tmp.disminuir_promo, tmp.status, tmp.id_tmp, tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva, productos.promocion, productos.codigoLinea, productos.codigoListaPrecio, tmp.promo from productos, tmp, listalinea where productos.idProducto=tmp.id_producto and tmp.promo=1 and productos.codigoLinea=listalinea.codigoLinea and tmp.session_id='".$_SESSION['user_id']."'  order by productos.orden ASC, tmp.promo DESC");
				if (!$sql) {
					$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
					echo $mensaje;
					return '';
				}
				$count=mysqli_num_rows($sql);
				if($count>0){
					while ($row=mysqli_fetch_array($sql))
						{
							$id_tmp=$row['id_tmp'];
							$codigo_producto=$row['id_producto'];
							$codigo_producto1='----';
							$codigoListaPrecio=$row['codigoListaPrecio'];
							$cantidad=$row['catidadtotal'];
							$promo=$row['promo'];
							$capacidad=$row['capacidad'];
							$polaridad=$row['polaridad'];
							$valor1=$row['valor_promo'];
							$valor2=$row['disminuir_promo'];
							$resta_valor=$valor1-$valor2;
							$valorproducto=1;
							$ProductosTotales= $ProductosTotales+$cantidad;
							$nombre_producto=$row['nombreProducto'];
							$promocion=$row['promocion'];
							$codigoLinea=$row['codigoLinea'];
							$nombrelinea=$row['nombreLinea'];
							if($promo==1){
								$precio_venta=0;
								$aviso="Promocion";
							}else{
								$precio_venta=$row['precio_tmp'];
							}


							
							if($promocion==1 && $promo!=1){
								$activar=true;
								$cantidadTotal=$cantidadTotal+$cantidad;
								$precio_venta_f=number_format($precio_venta,2);//Formateo variables
								$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comás
								$precio_total=$precio_venta_r*$cantidad;
								$precio_total_f=number_format($precio_total,2);//Precio total formateado
								$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comás
								$sumador_total+=$precio_total_r;//Sumador
								$sumador_total_promo+=$precio_total_r;//Sumador	
							}
							else{
								$precio_venta_f=number_format($precio_venta,2);//Formateo variables
								$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comás
								$precio_total=$precio_venta_r*$cantidad;
								$precio_total_f=number_format($precio_total,2);//Precio total formateado
								$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comás
								$sumador_total+=$precio_total_r;//Sumador
							}
							
							$iva=$row['iva'];
							$bandera=0;
							$sqlDescCL=mysqli_query($con, "select porcentajeDesCL from descuentoclientelinea where codigoLinea='".$codigoLinea."' and codigoCliente='".$_SESSION['user_id']."'");
							$rowDescCL=mysqli_fetch_array($sqlDescCL);
							$precio_total_f=str_replace(",","",$precio_total_f);
						
							if(@$rowDescCL['porcentajeDesCL']>'0'){
							
								$descuento= (($precio_total_f * $rowDescCL['porcentajeDesCL'])/100);
								@$general= ((@$precio_venta_f *$rowDescCL['porcentajeDesCL'])/100);
								
								$bandera='descuentoclientelinea';
							}else{
							
								$sqlDescCP=mysqli_query($con, "select porcentajeDes from descuentoclienteproducto where idProducto='".$codigo_producto."' and codigoCliente='".$_SESSION['user_id']."'");
								$rowDescCP=mysqli_fetch_array($sqlDescCP);
								if(@$rowDescCP['porcentajeDes']>'0'){
								
									$descuento= (($precio_total_f * $rowDescCP['porcentajeDes'])/100);
									@$general= ((@$precio_venta_f *$rowDescCP['porcentajeDes'])/100);
									$bandera='descuentoclienteproducto';
									
								}else{
									
									$sqlDescLP=mysqli_query($con, "select descuentolistaprecios.porcentajeDesLP, descuentolistaprecios.precioLP from descuentolistaprecios, clientes where descuentolistaprecios.codigoLisPre=clientes.codigoLisPre and descuentolistaprecios.idProducto='".$codigo_producto."' and clientes.codigoCliente='".$_SESSION['user_id']."'");
									
									$rowDescLP=mysqli_fetch_array($sqlDescLP);
									if(@$rowDescLP['precioLP']>'0'){
										
										$row['precio_tmp']= $rowDescLP['precioLP'];
										
										@$descuento=((@$precio_total_f * @$rowDescLP['porcentajeDesLP'])/100);
										@$general=((@$precio_venta_f * @$rowDescLP['porcentajeDesLP'])/100);
										$bandera='descuentolistaprecios';
										
									}else{
									
										$sqlDescCliente=mysqli_query($con, "select porcentajeDesLL from descuentolistalinea,clientes where descuentolistalinea.codigoLisPre=clientes.codigoLisPre and descuentolistalinea.codigoLinea=".$row['codigoLinea']." and clientes.codigoCliente='".$_SESSION['user_id']."' and descuentolistalinea.estadoLL=1");
										
										if (!$sqlDescCliente) {
											$mensaje  = 'Consulta no válidas: ' .mysqli_error($con) . "\n";
											$mensaje .= 'Consulta completa: ' . $sqlDescCliente;
											echo $mensaje;
										}
										$rowDescCliente=mysqli_fetch_array($sqlDescCliente);
										
										if(@$rowDescCliente['porcentajeDesLL']>'0'){
								
											@$descuento= ((@$precio_total_f * @$rowDescCliente['porcentajeDesLL'])/100);
											$bandera='descuentoListalinea';

											@$general= ((@$precio_venta_f *@$rowDescCliente['porcentajeDesLL'])/100);
											
										}else{
										
											$sqlDescCliente=mysqli_query($con, "select descuentoCliente from clientes where clientes.codigoCliente='".$_SESSION['user_id']."'");
											$rowDescCliente=mysqli_fetch_array($sqlDescCliente);
											if(@$rowDescCliente['descuentoCliente']>'0'){

												@$descuento= ((@$precio_total_f * @$rowDescCliente['descuentoCliente'])/100);
												$bandera='descuentoCliente';
											
												@$general= ((@$precio_venta_f * @$rowDescCliente['descuentoCliente'])/100);
											

											}else{
												@$descuento=0;
											}
												
										}
									}
								}
							}
							$bandera="";
							@$aviso='';
		
							$descuento=str_replace(",","",$descuento);
							$sumador_descuento+=$descuento;//Sumador

							//transformar dato
							$precio_total_f=number_format($precio_total_f,2);
							//validar
							if(empty(@$general))$valor=0;else$valor=@$general;
							if (empty(@$iva))$valor2=0;else$valor2=@$iva;

							$update=mysqli_query($con,"UPDATE tmp SET descuento_unitario=".$valor.", descuento_iva=".$valor2." WHERE id_producto=".$row["id_producto"]." and session_id='".$_SESSION['user_id']."'");
							if (!$update) {
								$mensaje  = 'Consulta no válidas: ' .mysqli_error($con) . "\n";
								echo $mensaje;
								return '';
							}
							?>
								<tr >
									<!--<td class='text-center' style="display:none"><?php //if($codigoListaPrecio==''){echo $codigo_producto1;}else{echo $codigoListaPrecio;} ?></td>-->
									<?php 
										if($promo!=1){
									?>	
										<td class="text-center"><input min="1" style="padding:5px;width:100%;text-align:center;" type="number" onkeyup="el('<?php echo $id_tmp; ?>')" pattern="^[0-9]+"  id="cantidad_<?php echo $id_tmp; ?>" value="<?php echo $cantidad;?>"></td>	
									<?php		
										}else{
									?>
										<td class="text-center" ><?php echo $cantidad;?></td>
									<?php
										}
									?>
									
		
									<td class="" style="white-space:pre-wrap!important;" ><?php echo utf8_encode($nombre_producto);?><h2 class="listalinea"><?php echo utf8_encode($nombrelinea); ?></h2></td>
									<!--<td class="text-center" ><?php echo $capacidad;?></td>
									<td class="text-center"  ><?php echo $polaridad;?></td>-->
									<td class="text-center"  ><?php echo $precio_venta_f."".@$aviso;?></td>
									<td class="text-center"  ><?php echo number_format(@$general,2)." ".$bandera;?></td>
									<td class="text-center"  ><?php echo $precio_total_f;?></td>
									<td class="text-center"  >
									<?php if($promo!=1){?>
										<a href="#" onclick="editar('<?php echo $id_tmp ?>')" class="accion_nuevo" id="accion_nuevo" title="Modificar"><i class="glyphicon glyphicon-pencil"></i></a>
									<?php }else{?>
										<a href="# " class=""></a>
									<?php	
									}
									?>	
										<a href="#" onclick="eliminar('<?php echo $id_tmp ?>')" class="accion_nuevo borrar" id="accion_nuevo" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
									</td>
									
								
								</tr>		
							<?php
						}
					}
				?> </tbody> <?php

	//valores de suma
				

	$subtotal=number_format($sumador_total,2,'.','');
	$subtotaldesc=$subtotal-$sumador_descuento;
	
	$total_iva=($subtotaldesc * @$iva )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotaldesc+$total_iva;

	$sqlValidarPromo=mysqli_query($con, "select * from tmp where promo=1 and session_id='".$_SESSION['user_id']."'");
    if(($count=mysqli_num_rows($sqlValidarPromo))>0){
        while($rowValidarPromo=mysqli_fetch_array($sqlValidarPromo)){
                $cant=$rowValidarPromo['cantidad_tmp'];
                $precio=$rowValidarPromo['precio_tmp'];
                $sumar=$cant*$precio;
                $total_sumar=$total_sumar+$sumar;
        }
    }else{
        $total_sumar=0;
    }
    $sqlValidarPromo=mysqli_query($con, "select sum(cantidad_tmp) as cantidad, sum(precio_tmp) as precio from tmp where promo=1 and session_id='".$_SESSION['user_id']."'");
	$rowValidarPromo=mysqli_fetch_array($sqlValidarPromo);


	if(!empty(@$_SESSION['promoactiva'])){
		$comprobarnumero= floor($cantidadTotal/$_SESSION['numeroUnidBase'])-$rowValidarPromo['cantidad'];
	}


	if(@$activar==true and @$_SESSION['prmoactiva']<>'1016371' and !empty(@$_SESSION['promoactiva'])){
		if($cantidadTotal>=$_SESSION['numeroUnidBase']){
			if($_SESSION['numeroUnidBase']>0){
				$promoActiva=$cantidadTotal/$_SESSION['numeroUnidBase'];
				$_SESSION['promoActiva']=$promoActiva;
			}else{
				$promoActiva=0;
				$_SESSION['promoActiva']=$promoActiva;
			}
			if($valorproducto>0){
			
				$_SESSION['promoActiva']=$_SESSION['promoActiva']-$rowValidarPromo['cantidad'];
				
			}
			
			
				$maxPrecioPromo=($sumador_total_promo*$_SESSION['porcentaje'])/100;
			
				if(isset($_GET['eliminar'])){
				
					$_SESSION['maxPrecioPromo']=$maxPrecioPromo-$total_sumar;
				
				}else{
					if($valorproducto>0){
						$_SESSION['maxPrecioPromo']=$maxPrecioPromo-$total_sumar;
					}else{
					
						
						$_SESSION['maxPrecioPromo']=$maxPrecioPromo-$total_sumar;
					}
					
				}
				
				//mostrar valor en modal promocion
				?>
				<script>
					$(".mensajepromo").html("Promo Activa, Puede Agregar <?php echo  floor($_SESSION["promoActiva"]); ?>  producto(s) a su pedido actual. Con un valor máximo de: <?php echo number_format(str_replace(",","",$_SESSION["maxPrecioPromo"]),2); ?>");
				</script>
				<?php
				$validar='$rowValidarPromo["cantidad"]<=$_SESSION["promoActiva"] and $rowValidarPromo["precio"]<=$_SESSION["maxPrecioPromo"]';
				$aColumns = array('codigoProducto', 'nombreProducto', 'caja', 'listalinea.codigoLinea', 'codigoListaPrecio','listalinea.nombreLinea');//Columnas de busqueda
				$sTable = "productos,listalinea,clientelinea,clientes";
				$sWhere = " WHERE clientelinea.codigoCliente=clientes.codigoCliente and clientes.codigoCliente='".$_SESSION['user_id']."' and listalinea.codigoLinea=clientelinea.codigoLinea and clientelinea.estado=0 and listalinea.codigoLinea=productos.codigoLinea and productos.estadoProd=1 and productos.facturar=1 and productos.web=1 and productos.promocion=1 and productos.precioUnitario>0 and productos.precioUnitario <= ".$maxPrecioPromo." order by productos.precioUnitario DESC";
			   
				$sWhere = "WHERE clientelinea.codigoCliente=clientes.codigoCliente and clientes.codigoCliente='".$_SESSION['user_id']."' and listalinea.codigoLinea=clientelinea.codigoLinea and clientelinea.estado=0 and listalinea.codigoLinea=productos.codigoLinea and productos.estadoProd=1 and productos.facturar=1 and productos.web=1 and productos.promocion=1 and productos.precioUnitario>0 and  productos.precioUnitario <= ".$_SESSION['maxPrecioPromo']." ";
				$sWhere .= ' order by productos.precioUnitario DESC';

			   	$sql="SELECT *, listalinea.nombreLinea as nombreLinea FROM  $sTable $sWhere";
	
				$query = mysqli_query($con, $sql);
				$count=mysqli_num_rows($query);			
				echo '<div class="alert alert-primary promociones" role="alert" style="display:flex;justify-content:flex-start!important;color:#323232;font-weight:bold;background-color:#F4B415;">';
					echo'<div class="promo1" style="flex:0 1 70%; width:100%; margin:auto;">';
						print("Promo Activa, Puede Agregar ".floor($_SESSION['promoActiva'])." producto(s) a su pedido actual. Con un valor máximo de:".number_format(str_replace(",","",$_SESSION['maxPrecioPromo']),2)."<br>");
						if($rowValidarPromo['cantidad']!=0 && $rowValidarPromo['precio']!=0)
						print($rowValidarPromo['cantidad']."---".$total_sumar);
					echo'</div>';
					
					if($count>0 && floor($_SESSION['promoActiva'])!=0 && ($rowValidarPromo['cantidad']<($promoActiva) || $rowValidarPromo['precio']<$_SESSION['maxPrecioPromo'] )){
					?>
					<script>
						M.toast({html: 'Cliente ha activado su promoción!',classes: 'promocion',displayLength:4000,inDuration:700,outDuration:700});
					</script>
					<div class="promo2" style="flex:0 1 30%;width:100%;">
						<input type="hidden" value="<?php echo number_format($_SESSION['maxPrecioPromo'],2);?>" id="maxPrecioPromo" name="maxPrecioPromo">
						<button type="button" class="btn btn-dark" style="padding:10px 20px;text-color:#155724;float:right; margin-top:10px; margin-bottom:10px;margin-right:9px!important;" data-toggle="modal" data-target="#myModalpromo">
						<span class="glyphicon glyphicon-plus" ></span> Agregar Promo
						</button>
					</div>
					<?php
					}else{
						echo '<div class="promo2" style="flex:0 1 30%;width:100%;font-weight:600!important">';
							echo '<div class="des_promocion">';
								echo 'Promoción Desactivada';
							echo '</div>';
						echo '</div>';
						echo '<script>$("#myModalpromo").modal("hide");
						M.toast({html: "Cliente ha desactivado las promociones asignadas!",classes: "error",displayLength:3000,inDuration:700,outDuration:700});
						</script>';
						
					}
				echo '</div>';
		}
	}else{
		
		
		?>
		<script>
			M.toast({html: 'Cliente tiene desactivado promociones!',classes: 'error',displayLength:4000,inDuration:700,outDuration:700});
		</script>
		<?php
	}
	
?>
<tbody style="overflow:hidden!important;" class="total_datos">
	<tr>
	
		<td style="border:none;font-size:15px;font-weight:bold;"> <?php echo $ProductosTotales; ?> </td>
		<td style="border:none;font-size:15px;font-weight:bold;" class="text-center" >Productos Totales</td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none" class='text-center pintar'  colspan=4>SUBTOTAL sin IVA <?php echo "";?>
		<td style="border:none" class='text-center'  id="sin_iva"><?php echo number_format($subtotal,2);?></td>
		<td style="border:none"></td>
		
	</tr>
	<tr>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none" class='text-center pintar' colspan=4>DESCUENTO <?php echo "";?></td>
		<td style="border:none"class='text-center' id="descuento"><?php echo number_format($sumador_descuento,2);?></td>
		<td style="border:none"></td>

	</tr>
	<tr>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none" class='text-center pintar' colspan=4>SUBTOTAL<?php echo "";?></td>
		<td style="border:none" class='text-center' id="con_iva"><?php echo number_format($subtotaldesc,2);?></td>
		<td style="border:none"></td>

	</tr>
	<tr>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none" class='text-center pintar' colspan=4>IVA (<?php echo @$iva;?>)% <?php echo "";?></td>
		<td style="border:none" class='text-center' id="iva" ><?php echo number_format($total_iva,2);?></td>
		<td style="border:none"></td>

	</tr>
	<tr>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none"></td>
		<td style="border:none" class='text-center pintar' colspan=4>VALOR TOTAL <?php echo "";?></td>
		<td style="border:none" class='text-center' id="valor"><?php echo number_format($total_factura,2);?></td>
		<td style="border:none"></td>

	</tr>
</tbody
<?php }else{?>

	<script>
		M.toast({html: 'Sin productos actualmente!',classes: 'error',displayLength:3000,inDuration:700,outDuration:700});
	</script>
	
	<tr style="display:inline-table;width:100%">
		
		<td style="width:100%">
			<div class="alert alert-primary" style="background:#c8c8c8;width:100%;color:#495560!important;font-weight:600" role="alert">
				<span class="text-center">No existen productos seleccionados</span>
			</div>
		</td>
		
	
	</tr>

	<tr style="display:inline-table;width:100%">

		<td class='text-right' style="width:70%" colspan=4>VALOR TOTAL <?php echo "$";?></td>
		<td class='text-right' style="width:30%" id="valor">0.00</td>

	</tr>
<?php }?>

</table>
</div>
