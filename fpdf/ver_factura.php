<?php
require('fpdf/fpdf.php');
include("../config/db.php");
include("../config/conexion.php");
include("../funciones.php");
include('../ajax/is_logged.php');

$session_id= session_id();
$pdf = new FPDF();
$pdf->AddPage();

$_GET['id_factura']=mysqli_real_escape_string($con,(strip_tags($_GET['id_factura'],ENT_QUOTES)));
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
);
$_GET['distribuidor']=mysqli_real_escape_string($con,(strip_tags($_GET['distribuidor'],ENT_QUOTES)));
$_GET['distribuidor']=str_replace(
	array("\\", "¨", "º", "-", "~",
		 "#", "@", "|", "!", "\"",
		 "·", "$", "%", "&", "/",
		 "(", ")", "?", "'", "¡",
		 "¿", "[", "^", "<code>", "]",
		 "+", "}", "{", "¨", "´",
		 ">", "< ", ";", ",", ":",
		 ".", ""),
	'',
	$_GET['distribuidor']
);

//obetener año de factura
$year=date("Y");


$_GET['fecha_envio']=mysqli_real_escape_string($con,(strip_tags($_GET['fecha_envio'],ENT_QUOTES)));
$_GET['fecha_envio']=str_replace(
	array("\\", "¨", "º", "-", "~",
		 "#", "@", "|", "!", "\"",
		 "·", "$", "%", "&",
		 "(", ")", "?", "'", "¡",
		 "¿", "[", "^", "<code>", "]",
		 "+", "}", "{", "¨", "´",
		 ">", "< ", ";", ",", ":",
		 ".", " "),
	' ',
	$_GET['fecha_envio']
);
$pdf->Image('logo.png',10,10,-300,"asd");

$pdf->SetFont('Arial','B',10);
$pdf->SetXY(97,15); 
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

$pdf->SetFont('Arial','B',10);
$pdf->SetXY(150,15); 
$pdf->Cell(10,0,utf8_decode('© bateriasecuador.com '.$year),0,0,'L');

$pdf->SetFont('Arial','B',9);
$pdf->SetXY(165,20); 
//dato factura 
$valorid=$_GET['id_factura'];
$factura="PEDIDO Nº".$valorid;
$pdf->Cell(0,0,utf8_decode($factura),0,0,'L');

$pdf->SetFont('Arial','B',9);
$pdf->SetXY(152,26); 
//dato factura 
$factura=mysqli_query($con,"select * from pedido where numero_pedido=".$_GET['id_factura']."");	
$factura=mysqli_fetch_array($factura);
if (!$factura) {
	$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
	$mensaje .= 'Consulta completa: ' . $factura;
    echo $mensaje;
}	

if(empty($factura['fecha_envio']) && empty($factura['hora_envio']) || $factura['fecha_envio']==null || $factura['fecha_envio']=="0000-00-00" ){
    //echo getType($factura['fecha_pedido']);
    
    $facturar="Fecha: ".$factura['fecha_pedido'].'  -  '.$factura['hora_creacion'];

}else{

    $facturar="Fecha: ".$factura['fecha_envio'].'  -  '.$factura['hora_envio'];
}

$pdf->Cell(0,0,utf8_decode($facturar),0,0,'L');

$pdf->SetFillColor(5, 27, 50);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(10,30);  
$pdf->Cell(190,6,utf8_decode(''),0,0,'L',true);

$fecha_envio=$_GET['distribuidor'];

$nombres="SELECT * 
FROM clientes 
WHERE nombreCliente='".$fecha_envio."'";
$datos=mysqli_query($con,$nombres);
$nombress=mysqli_fetch_array($datos);



//FACTURAR A
$pdf->SetTextColor(5,27,50);
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(10,40); 
$pdf->SetFillColor(255,255,255);

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


// PARTE 2


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

$detalle=mysqli_query($con, "select sum(detalle_pedido.cantidad) as catidadtotal,	productos.codigoFamilia,productos.codigoMarca,  detalle_pedido.codigo_producto, productos.nombreProducto, detalle_pedido.precio_unitario, productos.iva, productos.promocion, productos.codigoLinea, productos.codigoListaPrecio, detalle_pedido.promocion as promo,nombreLinea from productos, detalle_pedido, listalinea where productos.idProducto=detalle_pedido.codigo_producto  and productos.codigoLinea=listalinea.codigoLinea and detalle_pedido.promocion!=1 and detalle_pedido.numero_pedido=".$_GET['id_factura']." group by detalle_pedido.codigo_producto, productos.nombreProducto, detalle_pedido.promocion!=1, detalle_pedido.precio_unitario, productos.iva, productos.promocion, productos.codigoLinea order by productos.orden asc ");
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

//detalle de productos
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


	//detalle de promociones
	$detalle=mysqli_query($con, "select sum(detalle_pedido.cantidad) as catidadtotal,productos.codigoFamilia,
	productos.codigoFamilia,productos.codigoMarca, 
	detalle_pedido.codigo_producto, productos.nombreProducto, 
	detalle_pedido.precio_unitario, productos.iva, productos.promocion, productos.codigoLinea, 
	productos.codigoListaPrecio, detalle_pedido.promocion as promo,nombreLinea from productos, 
	detalle_pedido, listalinea where productos.idProducto=detalle_pedido.codigo_producto  
	and productos.codigoLinea=listalinea.codigoLinea and detalle_pedido.promocion=1 and 
	detalle_pedido.numero_pedido=".$_GET['id_factura']." group by detalle_pedido.codigo_producto, 
	productos.nombreProducto, detalle_pedido.promocion!=1, detalle_pedido.precio_unitario, 
	productos.iva, productos.promocion, productos.codigoLinea order by productos.orden  asc");



if (!$detalle) {
	$mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
	$mensaje .= 'Consulta completa: ' . $detalle;
    echo $mensaje;
}


//detalle de productos
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


//calcular total y valores de factura
    
$subtotal=number_format($sumador_total,2,'.','');
$subtotal2=$subtotal-$fila['subtotal_pedido'];
    
$subtotal2=number_format($sumador_total,2,'.','');

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
$pdf->Cell(35,6,utf8_decode('DESCUENTO $	'),1,0,'L',true);
$pdf->Cell(35,6,utf8_decode($fila['descuento_pedido']),1,1,'C',true);

$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(100,6,'',0,0,'C');

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239,239,239);
$subtotal=str_replace(",",'',$subtotal);
$subtotal=number_format($subtotal-$fila['descuento_pedido'],2);
$subtotal=str_replace(",",'',$subtotal);
$total1=$subtotal2-$fila['descuento_pedido'];

$pdf->Cell(35,6,utf8_decode('SUBTOTAL (S/IVA)'),1,0,'L',true);
$pdf->Cell(35,6,number_format($subtotal,2),1,1,'C',true);

$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(100,6,'',0,0,'C');	

$ivas=number_format((($subtotal2-$fila['descuento_pedido'])*$iva)/100,2);
$total2=(($subtotal2-$fila['descuento_pedido'])*$iva)/100;
$ivas=str_replace(",",'',$ivas);
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239,239,239);
$pdf->Cell(35,6,utf8_decode('IVA ('.@$iva.')% $	'),1,0,'L',true);
$pdf->Cell(35,6,utf8_decode(number_format($ivas,2)),1,1,'C',true);


$pdf->Cell(20,6,'',0,0,'C');
$pdf->Cell(100,6,'',0,0,'C');	

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(239,239,239);

$pdf->Cell(35,6,utf8_decode('TOTAL $	'),1,0,'L',true);
$pdf->Cell(35,6,number_format($total1+$total2,2),1,1,'C',true);

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
$comentario="Nota:".$fila['descripcion'];

//$contador=count($comentario);
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
mysqli_close($con);
$pdf->Output('Baterias_Ecuador_pedido'.$valorid,'I');


?>

?>