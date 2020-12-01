<?php
	/*-------------------------
	Autor: Jorge F prieto L
	Web: bateriasecuador.com
	Mail: info@bateriasecuador.com
	---------------------------*/
	session_start();

	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");
	//Archivo de funciones PHP
	include("../../funciones.php");
	$session_id= session_id();
	$sql_count=mysqli_query($con,"select * from tmp where session_id='".$_SESSION['user_id']."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('No hay productos agregados al pedido')</script>";
	echo "<script>window.close();</script>";
	exit;
	}

	require_once(dirname(__FILE__).'/../html2pdf.class.php');
		
	//Variables por GET
	$id_cliente=intval($_GET['id_cliente']);
	$id_vendedor=intval($_GET['id_vendedor']);
	$condiciones=mysqli_real_escape_string($con,(strip_tags($_REQUEST['condiciones'], ENT_QUOTES)));

	//Fin de variables por GET
	$sql=mysqli_query($con, "select LAST_INSERT_ID(numero_pedido) as last from pedido order by numero_pedido desc limit 0,1 ");
	$rw=mysqli_fetch_array($sql);
	$numero_pedido=$rw['last']+1;	
	$simbolo_moneda="$";
    // get the HTML

     include(dirname('__FILE__').'/res/pedido_html.php');
    $content = ob_get_clean();


        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        //$html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Pedido.pdf', 'I');

