<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<script>
print();
</script>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "bateriasecuador.com "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <?php include("encabezado_factura.php");?>
    <br>
    

	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>FACTURAR A</td>
        </tr>
		<tr>
           <td style="width:50%;" >
			<?php 
				$sql_cliente=mysqli_query($con,"select * from clientes where codigoCliente='".$_SESSION['user_id']."'");
				$rw_cliente=mysqli_fetch_array($sql_cliente);
				echo "Distribuidor: ".$rw_cliente['nombreCliente'];
				echo "<br>";
				echo "Aqui Direccion Distribuidor";
				echo "<br> Teléfono: ";
				echo "Telefono Distribuidor";
				echo "<br> Email: ";
				echo $rw_cliente['mailCliente'];
			?>
			
		   </td>
        </tr>
        
   
    </table>
    
       <br>
		<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:35%;" class='midnight-blue'>DISTRIBUIDOR</td>
		  <td style="width:25%;" class='midnight-blue'>FECHA</td>
		   <td style="width:40%;" class='midnight-blue'>FORMA DE PAGO</td>
        </tr>
		<tr>
           <td style="width:35%;">
			<?php 
				$sql_user=mysqli_query($con,"select * from clientes where codigoCliente='".$_SESSION['user_id']."'");
				$rw_user=mysqli_fetch_array($sql_user);
				echo $rw_user['nombreCliente'];
			?>
		   </td>
		  <td style="width:25%;"><?php echo date("d/m/Y");?></td>
		   <td style="width:40%;" >
				<?php 
				if ($condiciones==1){echo "Efectivo";}
				elseif ($condiciones==2){echo "Cheque";}
				elseif ($condiciones==3){echo "Transferencia bancaria";}
				elseif ($condiciones==4){echo "Crédito";}
				?>
		   </td>
        </tr>
		
        
   
    </table>
	<br>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 10%;text-align:center;" class='midnight-blue'>CANT.</th>
            <th style="width: 60%" class='midnight-blue'>DESCRIPCION</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO UNIT.</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>
            
        </tr>

<?php
$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "select sum(tmp.cantidad_tmp) as catidadtotal, tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva from productos, tmp where productos.idProducto=tmp.id_producto and tmp.session_id='".$_SESSION['user_id']."' group by tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva");
//$sql=mysqli_query($con, "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
while ($row=mysqli_fetch_array($sql))
	{
	$codigo_producto=$row['id_producto'];
	$cantidad=$row['catidadtotal'];
	$nombre_producto=$row['nombreProducto'];
	
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador

	$iva=$row['iva'];
	if ($nums%2==0){
		$clase="label-info";
	} else {
		$clase="label-success";
	}
	?>

        <tr>
            <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $cantidad; ?></td>
            <td class='<?php echo $clase;?>' style="width: 60%; text-align: left"><?php echo $nombre_producto;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_venta_f;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td>
            
        </tr>

	<?php 
	//Insert en la tabla detalle_cotizacion
	$insert_detail=mysqli_query($con, "INSERT INTO detalle_pedido(numero_pedido,codigo_producto,cantidad,precio_unitario) VALUES ('$numero_pedido','$codigo_producto', '$cantidad','$precio_venta_r')");
/* 	print("INSERT INTO detalle_pedido(numero_pedido,codigo_producto,cantidad,precio_unitario) VALUES ('$numero_pedido','$codigo_producto', '','$cantidad','$precio_venta_r')");
	die(); */
	$nums++;
	}
	$subtotal=number_format($sumador_total,2,'.','');
	$total_iva=($subtotal * @$iva )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal+$total_iva;
?>
	  
        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">SUBTOTAL <?php echo "$";?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,2);?></td>
        </tr>
		<tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">IVA (<?php echo $iva; ?>)% <?php echo "$";?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,2);?></td>
        </tr>
		<tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">TOTAL <?php echo "$";?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_factura,2);?></td>
        </tr>
    </table>
	<br>
	<div style="font-size:11pt;text-align:center;font-weight:bold">Gracias por su Pedido!</div>
</page>
<?php
$date=date("Y-m-d H:i:s");
$insert=mysqli_query($con,"INSERT INTO pedido(numero_pedido,fecha_pedido,ruc_cliente,subtotal_pedido,estado_pedido) VALUES ('$numero_pedido','$date','".$_SESSION['user_id']."','$total_factura','01')");
$delete=mysqli_query($con,"DELETE FROM tmp WHERE session_id='".$_SESSION['user_id']."'");

// Settings
$name        = "Baterias Ecuador";
$email       = $_SESSION['user_email'];
$to          = $_SESSION['user_email'];
$from        = "Baterias Ecuador";
$subject     = "Su Pedido - Baterias Ecuador";
$mainMessage = "Hola, Adjunto su pedido. Muchas Gracias.";
$fileatt     = "pedido-Baterias-Ecuador.pdf"; //file location
$fileatttype = "application/pdf";
$fileattname = "pedido-Baterias-Ecuador.pdf"; //name that you want to use to send or you can use the same name
$headers = "From: $from";

// File
$file = fopen($fileatt, 'rb');
$data = fread($file, filesize($fileatt));
fclose($file);

// This attaches the file
$semi_rand     = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
$headers      .= "\nMIME-Version: 1.0\n" .
  "Content-Type: multipart/mixed;\n" .
  " boundary=\"{$mime_boundary}\"";
  $message = "This is a multi-part message in MIME format.\n\n" .
  "--{$mime_boundary}\n" .
  "Content-Type: text/plain; charset=\"iso-8859-1\n" .
  "Content-Transfer-Encoding: 7bit\n\n" .
  $mainMessage  . "\n\n";

$data = chunk_split(base64_encode($data));
$message .= "--{$mime_boundary}\n" .
  "Content-Type: {$fileatttype};\n" .
  " name=\"{$fileattname}\"\n" .
  "Content-Disposition: attachment;\n" .
  " filename=\"{$fileattname}\"\n" .
  "Content-Transfer-Encoding: base64\n\n" .
$data . "\n\n" .
 "--{$mime_boundary}--\n";

// Send the email
if(mail($to, $subject, $message, $headers)) {
  print("<script>alert('Su pedido fue enviado correctamente.');</script>");
}
else {
	print("<script>alert('Error, no se pudo enviar su pedido.');</script>");
}
?>

