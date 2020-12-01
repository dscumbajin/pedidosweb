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
$mail = new PHPMailer(true);

$consultaretorno=mysqli_query($con,"SELECT * FROM tmp where session_id='".$_GET['id_usuario']."'");
$count=mysqli_num_rows($consultaretorno);
if($count==0)
{ $variable= '<script> alert(No existen productos seleccionados para envio); </script>';
die('../ajax/is_logged.php');
return $variable;
exit();}

$session_id= session_id();
$pdf = new FPDF();
$pdf->AddPage();
//consulta numero factura
$sqlpedido=mysqli_query($con,"SELECT MAX(numero_pedido) as id FROM pedido");
		
if(isset($sqlpedido)){
	$row= mysqli_fetch_array($sqlpedido);
	$valorid=$row['id']+1;
}else{$valorid=1;}
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



$fecha=date("Y/m/d");
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
WHERE codigoCliente='".$_GET['id_usuario']."'";
$datos=mysqli_query($con,$nombres);
$nombress=mysqli_fetch_array($datos);

//FACTURAR A
$pdf->SetTextColor(5,27,50);
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(10,40); 
$pdf->SetFillColor(255,255,255);

$pdf->Cell(0,0,utf8_decode('Cliente:'.$nombress['nombreCliente']),0,0,'L',true);
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

//productos normales impresion

$detalle="SELECT sum(tmp.cantidad_tmp) as catidadtotal, productos.codigoFamilia,productos.codigoMarca, tmp.id_producto, tmp.session_id, tmp.promo, productos.nombreProducto, tmp.precio_tmp, productos.iva, nombreLinea
FROM productos, tmp , listalinea
WHERE productos.idProducto=tmp.id_producto and promo!=1  and productos.codigoLinea=listalinea.codigoLinea and tmp.session_id='".$_SESSION['user_id']."' group by tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva order by productos.orden asc";
$factura=mysqli_query($con,$detalle);

while ($row=mysqli_fetch_array($factura))
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
		$nombrelinea=$row['nombreLinea'];

		$codigoFamilia=$row['codigoFamilia'];
		$codigoMarca=$row['codigoMarca'];

		$iva=$row['iva'];
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
        

}

//productos con promocion 

$detalle="SELECT sum(tmp.cantidad_tmp) as catidadtotal,productos.codigoFamilia,productos.codigoMarca,  tmp.id_producto, tmp.session_id, tmp.promo, productos.nombreProducto, tmp.precio_tmp, productos.iva, nombreLinea
FROM productos, tmp , listalinea
WHERE productos.idProducto=tmp.id_producto and promo=1  and productos.codigoLinea=listalinea.codigoLinea and tmp.session_id='".$_SESSION['user_id']."' group by tmp.id_producto, tmp.session_id, productos.nombreProducto, tmp.precio_tmp, productos.iva order by productos.orden asc";
$factura=mysqli_query($con,$detalle);

while ($row=mysqli_fetch_array($factura))
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
		$nombrelinea=$row['nombreLinea'];

		$codigoFamilia=$row['codigoFamilia'];
		$codigoMarca=$row['codigoMarca'];

		$iva=$row['iva'];
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
        

}


//subtotales

$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(100,6,'',0,0,'C');	

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239,239,239);
$subtotal=$_GET['sin_iva'];
$pdf->Cell(35,6,utf8_decode('SUBTOTAL $'),1,0,'L',true);
$pdf->Cell(35,6,utf8_decode($subtotal),1,1,'C',true);


$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(100,6,'',0,0,'C');	

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239,239,239);
$descuento=$_GET['descuento'];
$pdf->Cell(35,6,utf8_decode('DESCUENTO $'),1,0,'L',true);
$pdf->Cell(35,6,utf8_decode($descuento),1,1,'C',true);


$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(100,6,'',0,0,'C');	


$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239,239,239);
$subtotal1=$_GET['subtotal'];
$pdf->Cell(35,6,utf8_decode('SUBTOTAL(IVA) $'),1,0,'L',true);
$pdf->Cell(35,6,utf8_decode($subtotal1),1,1,'C',true);

$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(100,6,'',0,0,'C');	


$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239,239,239);
$iva=$_GET['iva'];
$pdf->Cell(35,6,utf8_decode('IVA (12)% $	'),1,0,'L',true);
$pdf->Cell(35,6,utf8_decode($iva),1,1,'C',true);


$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(100,6,'',0,0,'C');	

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239,239,239);
$total=$_GET['total'];
$pdf->Cell(35,6,utf8_decode('TOTAL $	'),1,0,'L',true);
$pdf->Cell(35,6,utf8_decode($total),1,1,'C',true);

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

	$id_usuario=$_GET['id_usuario'];
   	$detalle="SELECT *
	FROM tmp  
	WHERE tmp.session_id='".$id_usuario."'";
	$factura=mysqli_query($con,$detalle);

	while ($row=mysqli_fetch_array($factura))
	{
		$codigo_producto=$row['id_producto'];
		$cantidad=$row['cantidad_tmp'];
		$precio_tmp=$row["precio_tmp"];
		$descuento=$row['descuento_unitario'];
		$iva=$row['descuento_iva'];
		$status=1;
		if($row['promo']==1){
				
			   	$insert_detail=mysqli_query($con, "INSERT INTO detalle_pedido(numero_pedido,codigo_producto,cantidad,precio_unitario,status,promocion,descuento_unitario,porcentaje_iva) VALUES ('$valorid','$codigo_producto', '$cantidad','$precio_tmp',$status,1,$descuento,$iva)");
		}else{
				$insert_detail=mysqli_query($con, "INSERT INTO detalle_pedido(numero_pedido,codigo_producto,cantidad,precio_unitario,status,descuento_unitario,porcentaje_iva) VALUES ('$valorid','$codigo_producto', '$cantidad','$precio_tmp',$status,$descuento,$iva)");
		}
	}
	if (!$insert_detail) {

		$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
		echo $mensaje;
		return $mensaje;
	}else{	
		$ruc=$_SESSION['user_id'];
		date_default_timezone_set('America/Guayaquil');
	
		$lista=$nombress['codigoLisPre'];
		$horaactua=time();
		$hora_creacion=date('H:i:s',$horaactua);
		$hora_envio=date('H:i:s',$horaactua);
		$total=str_replace(",","",$subtotal);

		
		//Reemplazamos caracteres especiales latinos
		
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_GET['comentario'], ENT_QUOTES)));
	
		$nombre=$nombress['nombreCliente'];
		$descuento=str_replace(",","",$_GET['descuento']);
	
		if(!empty($_SESSION['promoactiva']))
			$copromo=$_SESSION['promoactiva'];
		else{

			$copromo=1016371;
		}
		$insert_detail=mysqli_query($con, "INSERT INTO pedido(numero_pedido,fecha_pedido,fecha_envio,ruc_cliente,subtotal_pedido,descuento_pedido,estado_pedido,hora_creacion,hora_envio,descripcion,nombre_cliente,codigo_lista_precios,codigo_promocion) VALUES ('$valorid','$fecha', '$fecha','$ruc',$total,$descuento,'06','$hora_creacion','$hora_envio','$descripcion','$nombre',$lista,$copromo)");
		if (!$insert_detail) {

			$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
			echo $mensaje;
			return $mensaje;
		}else{
			$delete=mysqli_query($con,"DELETE FROM tmp WHERE session_id='".$id_usuario."'");
		}
	
	}
 $modo="I"; 
 $num_cot=1;
 $nombre_archivo="C".$_SESSION['user_id'].'_'.trim($num_cot).".pdf"; 

$pdf->SetXY(25, 50);
mysqli_close($con);
$pdf->Output('Baterias-Ecuador-Pedido','I');
$pdfdoc = $pdf->Output('Baterias-Ecuador-Pedido', 'S');

try {
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'soporte@bateriasecuador.com';                     // SMTP username
    $mail->Password   = 'baterias1956';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to
    $mail->setFrom('no-responder@fabribat.com', 'Gerente');
    $mail->addAddress('mcartagena@bateriasecuador.com');     // Add a recipient
	 $mail->addAddress('soporte@bateriasecuador.com');               // Name is optional
	 $mail->addAddress('srobles@nacion-digital.com');
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
	$problema= "Problemas en enviar el mensaje: {$mail->ErrorInfo}";
	$problema=mysqli_query($con,"DELETE FROM pedido WHERE numero_pedido='".$valor_id."'");
	return ;
 }
?>