<?php
require('fpdf/fpdf.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmeilder/Exception.php';
require 'phpmeilder/PHPMailer.php';
require 'phpmeilder/SMTP.php';
include("../config/db.php");
include("../config/conexion.php");
include("../funciones.php");
include('../ajax/is_logged.php');
$session_id= session_id();
$mail = new PHPMailer(true);
$pdf = new FPDF();

//ingersar datos

        $sql=mysqli_query($con, "select * from tmp where id_factura=".$_GET['id_factura']."");// consulta a la tabla temporal
		$count=mysqli_num_rows($sql);
		//echo $count;
		//echo "select * from tmp where id_factura=".$_GET['id_factura']."";
		if ($count>0){
			//return 0;
			$delete=mysqli_query($con, "DELETE FROM detalle_pedido WHERE numero_pedido=".$_GET["id_factura"]."");
			while($row=mysqli_fetch_array($sql)){
				$id_producto=$row['id_producto'];
				$cantidad=$row['cantidad_tmp'];
				$precio_tmp=$row['precio_tmp'];
				$promocion=$row['promo'];
				$valorid=$_GET['id_factura'];
				$descuento=$row['descuento_unitario'];
				$iva=$row['descuento_iva'];
				if($promocion==null){
					$insert_detail=mysqli_query($con, "INSERT INTO detalle_pedido(numero_pedido,codigo_producto,cantidad,precio_unitario,status,descuento_unitario,porcentaje_iva) VALUES ('$valorid','$id_producto', '$cantidad','$precio_tmp',null,$descuento,$iva)");	
				}else
				{
					$insert_detail=mysqli_query($con, "INSERT INTO detalle_pedido(numero_pedido,codigo_producto,cantidad,precio_unitario,promocion,status,descuento_unitario,porcentaje_iva) VALUES ('$valorid','$id_producto', '$cantidad','$precio_tmp',$promocion,1,$descuento,$iva)");
				}
				if (!$insert_detail) {
					$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
					echo $mensaje;
				}
            }
        }
$pdf->AddPage();

$pdf->Image('logo.png',10,10,-300,"asd");


$pdf->SetFont('Arial','B',10);
$pdf->SetXY(95,15); 
$pdf->Cell(10,0,'BATERIAS ECUADOR',0,0,'L');

$pdf->SetFont('Arial','B',6);
$pdf->SetXY(81,19); 
$pdf->Cell(0,0,'DIRECCION: Av. Occidental y Fray Marcos Jofre/Quito - Ecuador',0,0,'L');

$pdf->SetFont('Arial','B',6);
$pdf->SetXY(100,22); 
$pdf->Cell(0,0,utf8_decode('Edificio Baterías Ecuador'),0,0,'L');

$pdf->SetXY(106,25); 
$pdf->Cell(98,0,utf8_decode('EC 170104'),0,0,'L');
$pdf->SetXY(92,28); 
$pdf->Cell(0,0,'PBX +593 2 393-1210 - 1800-56-56-56 ',0,0,'L');
//obetener año de factura
$year=date("Y");

$pdf->SetFont('Arial','B',10);
$pdf->SetXY(150,15); 
$pdf->Cell(10,0,utf8_decode('© bateriasecuador.com '.$year),0,0,'L');

$pdf->SetFont('Arial','B',9);
$pdf->SetXY(165,20); 
//dato factura 
$factura="PEDIDO Nº".$valorid;
$pdf->Cell(0,0,utf8_decode($factura),0,0,'L');
$fecha=date("d/m/Y");
date_default_timezone_set('America/Guayaquil');
$horaactua=time();
$hora_creacion=date('H:i:s',$horaactua);

$pdf->SetFont('Arial','B',9);
$pdf->SetXY(152,26);
$facturar="Fecha: ".$fecha.'  -  '.$hora_creacion; 
$pdf->Cell(0,0,utf8_decode($facturar),0,0,'L');

$pdf->SetFillColor(5, 27, 50);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(10,30);  
$pdf->Cell(190,6,utf8_decode(''),0,0,'L',true);


$nombres="SELECT * 
FROM clientes 
WHERE codigoCliente='".$_SESSION['user_id']."'";
$datos=mysqli_query($con,$nombres);
$nombress=mysqli_fetch_array($datos);

//FACTURAR A
$pdf->SetTextColor(5,27,50);
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(10,40); 
$pdf->SetFillColor(255,255,255);
$fecha_envio=$_GET['distribuidor'];
$pdf->Cell(0,0,utf8_decode('Cliente:'.$fecha_envio),0,0,'L',true);
$pdf->SetXY(10,36.5); 
$pdf->Cell(190,27,'',1,0,'L');


$pdf->SetXY(10,44); 
$pdf->Cell(0,0,utf8_decode('RUC:'.$nombress['codigoCliente']),0,0,'L',true);


$pdf->SetFont('Arial','B',10);
$pdf->SetXY(10,48); 
$pdf->SetFillColor(255,255,255);
$pdf->Cell(0,0,utf8_decode('Dirección:'.$nombress['direccion']),0,0,'L',true);


$pdf->SetFont('Arial','B',10);
$pdf->SetXY(10,52); 
$pdf->SetFillColor(255,255,255);
$pdf->Cell(0,0,utf8_decode('Teléfono: '.$nombress['telefono']),0,0,'L',true);


$pdf->SetFont('Arial','B',10);
$pdf->SetXY(10,56); 
$pdf->SetFillColor(255,255,255);
$pdf->Cell(0,0,utf8_decode('Email:'.$nombress['mailCliente']),0,0,'L',true);

$pdf->SetFont('Arial','B',10);
$pdf->SetXY(10,60); 
$pdf->SetFillColor(255,255,255);
$pdf->Cell(0,0,utf8_decode('Forma de pago: Credito'),0,0,'L',true);
// PARTE 3
$pdf->SetFont('Arial','B',10);

$pdf->Cell(20,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);

$pdf->Cell(100,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);

$pdf->Cell(50,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(175,60); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(40,6,'',0,1,'L');

// PARTE 3
$pdf->SetFont('Arial','B',10);

$pdf->SetFillColor(5, 27, 50);
$pdf->SetTextColor(255,255,255);
//$pdf->SetXY(10,6); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(20,6,utf8_decode('CANT.'),0,0,'C',true);

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(20,6); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(100,6,utf8_decode('DESCRIPCIÓN'),0,0,'L',true);

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(100,6); 
//$pdf->SetFillColor(130,0,153);
$pdf->Cell(35,6,utf8_decode('PRECIO UNIT.'),0,0,'C',true);

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(175,60); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(35,6,utf8_decode('PRECIO TOTAL'),0,1,'C',true);


$nums=1;
$sumador_total=0;

$detalle=mysqli_query($con, "select sum(detalle_pedido.cantidad) as catidadtotal, productos.codigoFamilia,productos.codigoMarca, detalle_pedido.codigo_producto, productos.nombreProducto, detalle_pedido.precio_unitario, productos.iva, productos.promocion, productos.codigoLinea, productos.codigoListaPrecio, detalle_pedido.promocion as promo,nombreLinea from productos, detalle_pedido,listalinea where productos.idProducto=detalle_pedido.codigo_producto and detalle_pedido.promocion!=1 and productos.codigoLinea=listalinea.codigoLinea and detalle_pedido.numero_pedido=".$_GET['id_factura']." group by detalle_pedido.codigo_producto, detalle_pedido.promocion!=1, productos.nombreProducto, detalle_pedido.precio_unitario, productos.iva, productos.promocion, productos.codigoLinea order by productos.orden asc");
if (!$detalle) {
	$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
	$mensaje .= 'Consulta completa: ' . $detalle;
    echo $mensaje;
}
$factura=mysqli_query($con,"select * from pedido where numero_pedido=".$_GET['id_factura']."");	
if (!$factura) {
	$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
	$mensaje .= 'Consulta completa: ' . $factura;
    echo $mensaje;
}			
$fila=mysqli_fetch_array($factura);
while ($row=mysqli_fetch_array($detalle))
	{
		
        $nombre_producto=$row['nombreProducto'];
        $codigo_producto=$row['codigo_producto'];
        $cantidad=$row['catidadtotal'];
		$precio_venta=$row['precio_unitario'];
		$nombrelinea=$row['nombreLinea'];
		$codigoFamilia=$row['codigoFamilia'];
		$codigoMarca=$row['codigoMarca'];
		$nombre_producto_general=$codigoMarca.' - '.$codigoFamilia;
		if($row['promo']==1){
			$precio_venta_f=0.00;
			$precio_total_f=0.00;
			$nombre_producto= utf8_decode($nombre_producto_general.' - '.$nombre_producto.' - Promo');
        }else{
				
			$precio_venta_f=number_format($precio_venta,2);//Formateo variables
			$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
			$precio_total=$precio_venta_r*$cantidad;
			$precio_total_f=number_format($precio_total,2);//Precio total formateado
			$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
			$sumador_total+=$precio_total_r;//Sumador
		
			$iva=$row['iva'];
			$nombre_producto= utf8_decode($nombre_producto_general.' - '.$nombre_producto);
		}
		
		$pdf->SetTextColor(5, 27, 50);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetFont('Arial','B',10);
		//verificar altura
		$cellWidth=100;//wrapped cell width
		$cellHeight=5;//normal one-line cell height
		
		//check whether the text is overflowing
		if($pdf->GetStringWidth($nombre_producto) < $cellWidth){
			//if not, then do nothing
			$line=1;
		}else{
			//if it is, then calculate the height needed for wrapped cell
			//by splitting the text to fit the cell width
			//then count how many lines are needed for the text to fit the cell
			
			$textLength=strlen($nombre_producto);	//total text length
			$errMargin=10;		//cell width error margin, just in case
			$startChar=0;		//character start position for each line
			$maxChar=0;			//maximum character in a line, to be incremented later
			$textArray=array();	//to hold the strings for each line
			$tmpString="";		//to hold the string for a line (temporary)
			
			while($startChar < $textLength){ //loop until end of text
				//loop until maximum character reached
				while( 
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString=substr($nombre_producto,$startChar,$maxChar);
				}
				//move startChar to next line
				$startChar=$startChar+$maxChar;
				//then add it into the array so we know how many line are needed
				array_push($textArray,$tmpString);
				//reset maxChar and tmpString
				$maxChar=0;
				$tmpString='';
				
			}
			//get number of line
			$line=count($textArray);
		}
		
		//write the cells
		$pdf->Cell(20,($line * $cellHeight),$cantidad,1,0,'C',true); //adapt height to number of lines
	
		
		//use MultiCell instead of Cell
		//but first, because MultiCell is always treated as line ending, we need to 
		//manually set the xy position for the next cell to be next to it.
		//remember the x and y position before writing the multicell
		$xPos=$pdf->GetX();
		$yPos=$pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,$nombre_producto,1,'L',true);
		
		//return the position for next cell next to the multicell
		//and offset the x with multicell width
		$pdf->SetXY($xPos + $cellWidth , $yPos);
		$pdf->Cell(35,($line * $cellHeight),$precio_venta_f,1,0,'C',true); //adapt height to number of lines
	
		
		$pdf->Cell(35,($line * $cellHeight),$precio_total_f,1,1,'C',true); //adapt height to number of lines
        
        
        
        $nums++;
	}
	
//promociones impresion
$detalle=mysqli_query($con, "select sum(detalle_pedido.cantidad) as catidadtotal, productos.codigoFamilia,productos.codigoMarca, detalle_pedido.codigo_producto, productos.nombreProducto, detalle_pedido.precio_unitario, productos.iva, productos.promocion, productos.codigoLinea, productos.codigoListaPrecio, detalle_pedido.promocion as promo,nombreLinea from productos, detalle_pedido,listalinea where productos.idProducto=detalle_pedido.codigo_producto and detalle_pedido.promocion=1 and productos.codigoLinea=listalinea.codigoLinea and detalle_pedido.numero_pedido=".$_GET['id_factura']." group by detalle_pedido.codigo_producto, detalle_pedido.promocion!=1, productos.nombreProducto, detalle_pedido.precio_unitario, productos.iva, productos.promocion, productos.codigoLinea order by productos.orden asc");
if (!$detalle) {
	$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
	$mensaje .= 'Consulta completa: ' . $detalle;
    echo $mensaje;
}

while ($row=mysqli_fetch_array($detalle))
	{
		
        $nombre_producto=$row['nombreProducto'];
        $codigo_producto=$row['codigo_producto'];
        $cantidad=$row['catidadtotal'];
		$precio_venta=$row['precio_unitario'];
		$nombrelinea=$row['nombreLinea'];
		$codigoFamilia=$row['codigoFamilia'];
		$codigoMarca=$row['codigoMarca'];
		$nombre_producto_general=$codigoMarca.' - '.$codigoFamilia;
		if($row['promo']==1){
			$precio_venta_f=0.00;
			$precio_total_f=0.00;
			$nombre_producto= utf8_decode($nombre_producto_general.' - '.$nombre_producto.' - Promo');
        }else{
				
			$precio_venta_f=number_format($precio_venta,2);//Formateo variables
			$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
			$precio_total=$precio_venta_r*$cantidad;
			$precio_total_f=number_format($precio_total,2);//Precio total formateado
			$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
			$sumador_total+=$precio_total_r;//Sumador
		
			$iva=$row['iva'];
			$nombre_producto= utf8_decode($nombre_producto_general.' - '.$nombre_producto);
		}
		
		$pdf->SetTextColor(5, 27, 50);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetFont('Arial','B',10);
		//verificar altura
		$cellWidth=100;//wrapped cell width
		$cellHeight=5;//normal one-line cell height
		
		//check whether the text is overflowing
		if($pdf->GetStringWidth($nombre_producto) < $cellWidth){
			//if not, then do nothing
			$line=1;
		}else{
			//if it is, then calculate the height needed for wrapped cell
			//by splitting the text to fit the cell width
			//then count how many lines are needed for the text to fit the cell
			
			$textLength=strlen($nombre_producto);	//total text length
			$errMargin=10;		//cell width error margin, just in case
			$startChar=0;		//character start position for each line
			$maxChar=0;			//maximum character in a line, to be incremented later
			$textArray=array();	//to hold the strings for each line
			$tmpString="";		//to hold the string for a line (temporary)
			
			while($startChar < $textLength){ //loop until end of text
				//loop until maximum character reached
				while( 
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString=substr($nombre_producto,$startChar,$maxChar);
				}
				//move startChar to next line
				$startChar=$startChar+$maxChar;
				//then add it into the array so we know how many line are needed
				array_push($textArray,$tmpString);
				//reset maxChar and tmpString
				$maxChar=0;
				$tmpString='';
				
			}
			//get number of line
			$line=count($textArray);
		}
		
		//write the cells
		$pdf->Cell(20,($line * $cellHeight),$cantidad,1,0,'C',true); //adapt height to number of lines
	
		
		//use MultiCell instead of Cell
		//but first, because MultiCell is always treated as line ending, we need to 
		//manually set the xy position for the next cell to be next to it.
		//remember the x and y position before writing the multicell
		$xPos=$pdf->GetX();
		$yPos=$pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,$nombre_producto,1,'L',true);
		
		//return the position for next cell next to the multicell
		//and offset the x with multicell width
		$pdf->SetXY($xPos + $cellWidth , $yPos);
		$pdf->Cell(35,($line * $cellHeight),$precio_venta_f,1,0,'C',true); //adapt height to number of lines
	
		
		$pdf->Cell(35,($line * $cellHeight),$precio_total_f,1,1,'C',true); //adapt height to number of lines
        
        
        
        $nums++;
    }


    
    $subtotal=number_format($sumador_total,2,'.','');
    $subtotal2=$subtotal-$fila[6];
    $subtotal2=number_format($subtotal2,2,'.','');
	$total_iva=($subtotal2 * @$iva )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal2+$total_iva;
	  



//subtotales

$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(100,6,'',0,0,'C');	

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239,239,239);
$subtotal= number_format($subtotal,2);
$pdf->Cell(35,6,utf8_decode('SUBTOTAL $'),1,0,'L',true);
$pdf->Cell(35,6,utf8_decode($subtotal),1,1,'C',true);


$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(100,6,'',0,0,'C');	


$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239,239,239);
$iva=number_format($total_iva,2);
$pdf->Cell(35,6,utf8_decode('DESCUENTO $	'),1,0,'L',true);
$pdf->Cell(35,6,utf8_decode($_GET['descuento']),1,1,'C',true);

$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(100,6,'',0,0,'C');

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239,239,239);
$iva=number_format($total_iva,2);
$pdf->Cell(35,6,utf8_decode('SUBTOTAL (S/IVA)'),1,0,'L',true);
$pdf->Cell(35,6,utf8_decode($_GET['sin_iva']),1,1,'C',true);

$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(100,6,'',0,0,'C');	


$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239,239,239);
$iva=number_format($total_iva,2);
$pdf->Cell(35,6,utf8_decode('IVA ('.@$ivas.')% $	'),1,0,'L',true);
$pdf->Cell(35,6,utf8_decode($_GET['iva']),1,1,'C',true);


$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(100,6,'',0,0,'C');	

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239,239,239);
$total=number_format($total_factura,2);
$pdf->Cell(35,6,utf8_decode('TOTAL $	'),1,0,'L',true);
$pdf->Cell(35,6,utf8_decode($_GET['total']),1,1,'C',true);


$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(99,100);
// PARTE 3
$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(10,6); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(20,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(20,6); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(100,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(100,6); 
//$pdf->SetFillColor(130,0,153);
$pdf->Cell(50,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(175,60); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(40,6,'',0,1,'L');
// PARTE 3
$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(10,6); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(20,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(20,6); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(100,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(100,6); 
//$pdf->SetFillColor(130,0,153);
$pdf->Cell(50,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(175,60); 
$pdf->SetFillColor(5,25,50);
$pdf->Cell(40,6,'',0,1,'L');
$comentario="Nota:".$_GET['comentario'];


$width = 190; $lineHeight = 4; $pdf->MultiCell($width, $lineHeight, "{$comentario}");




// PARTE 3
$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(10,6); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(20,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(20,6); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(100,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(100,6); 
//$pdf->SetFillColor(130,0,153);
$pdf->Cell(50,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(175,60); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(40,6,'',0,1,'L');
// PARTE 3
$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(10,6); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(20,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(20,6); 
//$pdf->SetFillColor(153,0,153);
$pdf->Cell(100,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(100,6); 
//$pdf->SetFillColor(130,0,153);
$pdf->Cell(50,6,'',0,0,'L');

$pdf->SetFont('Arial','B',10);
//$pdf->SetXY(175,60); 
$pdf->SetFillColor(5,25,50);
$pdf->Cell(40,6,'',0,1,'L');

$pdf->Cell(190,0.2,'',1,1,'L',true);
$pdf->SetFillColor(255,255,255);

$pdf->Cell(190,9,'Gracias por su Pedido!',0,0,'C');
 $modo="I"; 
 $num_cot=1;
 //$nombre_archivo="C".$_SESSION['user_id'].'_'.trim($num_cot).".pdf"; 

$pdf->SetXY(25, 50);
$pdf->Output('Baterias-Ecuador-Pedido','I');
$pdfdoc = $pdf->Output('Baterias-Ecuador-Pedido', 'S');
date_default_timezone_set('America/Guayaquil');
$fecha=date("Y-m-d");
$horaactua=time();
$hora_creacion=date('H:i:s',$horaactua);
$hora_envio=date('H:i:s',$horaactua);
$total=str_replace(",","",$subtotal);
$descuento=str_replace(",","",$_GET['descuento']);
$descripcion=mysqli_real_escape_string($con,(strip_tags($_GET['comentario'], ENT_QUOTES)));
$insert_tmp=mysqli_query($con, "UPDATE pedido set fecha_envio='".$fecha."', subtotal_pedido=".$total.", hora_envio='".$hora_envio."', descripcion='".$descripcion."', descuento_pedido=".$descuento.", estado_pedido='06' where numero_pedido=".$_GET['id_factura']."");
if (!$insert_tmp) {

    $mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
    echo $mensaje;
    return $mensaje;
}else{
    try {
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'mail.fabribat.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'no-responder@fabribat.com';                     // SMTP username
    $mail->Password   = 'u4=+WWrI0SlD';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                // TCP port to connect to
    $mail->setFrom('soporte@bateriasecuador.com', 'Gerente');
    $mail->addAddress('psegovia@pulpo.ec');     // Add a recipient
	$mail->addAddress('milton.ivan.pozo.coque@gmail.com');               // Name is optional
	$mail->addAddress($nombress['mailCliente']);
	$mail->addStringAttachment($pdfdoc, 'pedidos-Baterias-Ecuador.pdf'); 
    $mail->isHTML(true);                                  
    $mail->Subject = 'Su Pedido - Baterias Ecuador';
    $mail->Body    = 'Hola, Adjunto su pedido. Muchas Gracias.';
	$mail->send();
	if(!$mail->Send()) {
		echo '«Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message sent!';
	}
	return $pdfdoc;
 } catch (Exception $e){
	echo  "Problemas en enviar el mensaje: {$mail->ErrorInfo}";
	$delete=mysqli_query($con,"DELETE FROM pedido WHERE numero_pedido='".$valor_id."'");
	return $echo;
 }
}
?>