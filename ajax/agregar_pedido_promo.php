<?php
	/*-------------------------
	Autor: Jorge F prieto L
	Web: bateriasecuador.com
	Mail: info@bateriasecuador.com
	---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();
if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}


	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");

if (!empty($id) and !empty($cantidad) and !empty($precio_venta) and $precio_venta<=$_SESSION['maxPrecioPromo'] and $cantidad<=$_SESSION['promoActiva'])
{
$insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id,promo) VALUES ('$id','$cantidad','$precio_venta','".$_SESSION['user_id']."','1')");

}else{
	echo "<script>alert('El precio o la cantidad del producto no puede ser mayor al maximo de promocion');</script>";
}


if (isset($_GET['id']))//codigo elimina un elemento del array
{
$id_tmp=intval($_GET['id']);	
$delete=mysqli_query($con, "DELETE FROM tmp WHERE id_producto='".$id_tmp."' and session_id='".$_SESSION['user_id']."'");
}
$simbolo_moneda="$";
?>
<table class="table">
<tr class="info">
	<th class='text-center'>CODIGO</th>
	<th class='text-center'>CANT.</th>
	<th>DESCRIPCION</th>
	<th class='text-right'>PRECIO UNIT</th>
	<th class='text-right'>DESCUENTO UNIT</th>
	<th class='text-right'>PRECIO TOTAL (Sin IVA)</th>
	<th></th>
	<td></td>
</tr>
<?php
	$sumador_total=0;
	$sumador_descuento=0;
	$cantidadTotal=0;
	$ProductosTotales=0;
	$sumador_total_promo=0;
	$sql=mysqli_query($con, "select sum(tmp.cantidad_tmp) as catidadtotal, tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva, productos.promocion, productos.codigoLinea, productos.codigoListaPrecio, tmp.promo from productos, tmp where productos.idProducto=tmp.id_producto and tmp.session_id='".$_SESSION['user_id']."' group by  tmp.session_id, productos.nombreProducto, tmp.promo!=1, tmp.precio_tmp, productos.iva, productos.promocion, productos.codigoLinea order by tmp.promo desc");
/* 	print("select sum(tmp.cantidad_tmp) as catidadtotal, tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva, productos.promocion, productos.codigoLinea from productos, tmp where productos.idProducto=tmp.id_producto and tmp.session_id='".$_SESSION['user_id']."' group by tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva, productos.promocion, productos.codigoLinea");
	die(); */
	while ($row=mysqli_fetch_array($sql))
	{
	$codigo_producto=$row['id_producto'];
	$codigo_producto1='----';
	$codigoListaPrecio=$row['codigoListaPrecio'];
	$cantidad=$row['catidadtotal'];
	$promo=$row['promo'];

	$ProductosTotales= $ProductosTotales+$cantidad;
	$nombre_producto=$row['nombreProducto'];
	$promocion=$row['promocion'];
	$codigoLinea=$row['codigoLinea'];
	if($promo==1){
		$precio_venta=0;
	}else{
		$precio_venta=$row['precio_tmp'];
	}

	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador

	
	if($row['promocion']==1){
		$cantidadTotal=$cantidadTotal+$cantidad;
		$sumador_total_promo+=$precio_total_r;//Sumador
	}

	$iva=$row['iva'];
	$bandera=0;
	$sqlDescCL=mysqli_query($con, "select porcentajeDesCL from descuentoclientelinea where codigoLinea='".$codigoLinea."' and codigoCliente='".$_SESSION['user_id']."'");
	$rowDescCL=mysqli_fetch_array($sqlDescCL);
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
			$sqlDescLP=mysqli_query($con, "select descuentolistaprecios.precioLP from descuentolistaprecios, clientes where descuentolistaprecios.codigoLisPre=clientes.codigoLisPre and descuentolistaprecios.idProducto='".$codigo_producto."' and clientes.codigoCliente='".$_SESSION['user_id']."'");
			$rowDescLP=mysqli_fetch_array($sqlDescLP);
			if(@$rowDescLP['precioLP']>'0'){
				$row['precio_tmp']= $rowDescLP['precioLP'];
				$descuento=0;
				@$general=$descuento;
				$bandera='descuentolistaprecios';
			}else{
				$sqlDescCliente=mysqli_query($con, "select descuentoCliente from clientes where clientes.codigoCliente='".$_SESSION['user_id']."'");
				$rowDescCliente=mysqli_fetch_array($sqlDescCliente);
				if(@$rowDescCliente['descuentoCliente']>'0'){

					@$descuento= ((@$precio_total_f * @$rowDescCliente['descuentoCliente'])/100);
					@$general= ((@$precio_venta_f *@$rowDescCliente['descuentoCliente'])/100);
					$bandera='descuentoCliente';
				}
			}
		}
	}



	$descuento=number_format(@$descuento,2);//Formateo variables
	$sumador_descuento+=$descuento;//Sumador
	$bandera="";
	@$aviso='';
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
		<tr style="display:inline-table;width:100%;">
			<td class='text-center'><?php if($codigoListaPrecio==''){echo $codigo_producto1;}else{echo $codigoListaPrecio;} ?></td>
			<td class='text-center'><?php echo $cantidad;?></td>
			<td><?php echo $nombre_producto;?></td>
			<td class='text-right'><?php echo $precio_venta_f;?></td>
			<td class='text-right'><?php echo number_format(@$general,2)." ".$bandera;?></td>
			<td class='text-right'><?php echo $precio_total_f;?></td>
			<td class='text-center'><a href="#" class="btn btn-danger activar2" onclick="eliminar('<?php echo $codigo_producto ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>		
		<?php
	}

	$subtotal=number_format($sumador_total,2,'.','');
	$subtotaldesc=$subtotal-$sumador_descuento;
	$total_iva=($subtotaldesc * @$iva )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotaldesc+$total_iva;
	$sqlValidarPromo=mysqli_query($con, "select sum(cantidad_tmp) as cantidad, sum(precio_tmp) as precio from tmp where promo=1 and session_id='".$_SESSION['user_id']."'");
	$rowValidarPromo=mysqli_fetch_array($sqlValidarPromo);


	if(@$promocion==1 and @$_SESSION['prmoactiva']<>'1016371'){
		if($cantidadTotal>=$_SESSION['numeroUnidBase']){
			if($_SESSION['numeroUnidBase']>0){
				$promoActiva=$cantidadTotal/$_SESSION['numeroUnidBase'];
				$_SESSION['promoActiva']=$promoActiva-$rowValidarPromo['cantidad'];
			}else{
				$promoActiva=0;
				$_SESSION['promoActiva']=$rowValidarPromo['cantidad']-$promoActiva;
			}
				
				$maxPrecioPromo=($sumador_total_promo*$_SESSION['porcentaje'])/100;

				print("Total General de Productos:".$ProductosTotales."<br>");
				$_SESSION['maxPrecioPromo']=number_format($maxPrecioPromo,2)-$rowValidarPromo['precio'];
				print("Promo Activa, Puede Agregar ".floor($_SESSION['promoActiva'])." producto(s) a su pedido actual. Con un valor maximo de:".number_format($_SESSION['maxPrecioPromo'],2)."<br>");
				print($rowValidarPromo['cantidad']."---".$rowValidarPromo['precio']);
				if($rowValidarPromo['cantidad']<=$_SESSION['promoActiva'] and $rowValidarPromo['precio']=$_SESSION['maxPrecioPromo']){
				?>
				<input type="hidden" value="<?php echo number_format($_SESSION['maxPrecioPromo'],2);?>" id="maxPrecioPromo" name="maxPrecioPromo">
					<button type="button" class="btn btn-dark" style="padding:10px 20px; margin-top:10px; margin-bottom:10px;" data-toggle="modal" data-target="#myModalpromo">
					<span class="glyphicon glyphicon-plus"></span> Agregar Promo
					</button>
				<?php
				}
		}
	}
	
?>
<tr>
	<td></td>
	<td class='text-right' colspan=4>SUBTOTAL sin IVA <?php echo "$";?></td>
	<td class='text-right' id="sin_iva"><?php echo number_format($subtotal,2);?></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td class='text-right' colspan=4>DESCUENTO <?php echo "$";?></td>
	<td class='text-right'  id="descuento"><?php echo number_format($sumador_descuento,2);?></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td class='text-right' colspan=4>SUBTOTAL <?php echo "$";?></td>
	<td class='text-right' id="con_iva"><?php echo number_format($subtotaldesc,2);?></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td class='text-right' colspan=4>IVA (<?php echo @$iva;?>)% <?php echo "$";?></td>
	<td class='text-right' id="iva" ><?php echo number_format($total_iva,2);?></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td class='text-right' colspan=4>VALOR TOTAL <?php echo "$";?></td>
	<td class='text-right' id="valor" ><?php echo number_format($total_factura,2);?></td>
	<td></td>
</tr>

</table>
