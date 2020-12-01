<?php
	/*-------------------------
	Autor: Jorge F prieto L
	Web: bateriasecuador.com
	Mail: info@bateriasecuador.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
		exit;
    }
	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");
	//Archivo de funciones PHP
	include("../../funciones.php");
	$numero_pedido= intval($_GET['numero_pedido']);
	$sql_count=mysqli_query($con,"select * from pedido where numero_pedido='".$numero_pedido."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('Pedido no encontrado')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	$sql_factura=mysqli_query($con,"select * from pedido where numero_pedido='".$numero_pedido."'");
	$rw_factura=mysqli_fetch_array($sql_factura);
	$numero_factura=$rw_factura['numero_pedido'];
	$id_cliente=$rw_factura['ruc_cliente'];
	$id_vendedor=$rw_factura['ruc_cliente'];
	$fecha_factura=$rw_factura['fecha_pedido'];
	$condiciones='NA';
	//$simbolo_moneda=get_row('perfil','moneda', 'id_perfil', 1);
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
    // get the HTML
     
     include(dirname('__FILE__').'/res/ver_pedido_html.php');
    $content = ob_get_clean();

        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        //$html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Pedido.pdf', 'I');

    // get the HTML
    ob_start();
    include(dirname(__FILE__).'/res/ver_pedido_html.php');
    $content = ob_get_clean();
 
    // convert to PDF
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', false, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('Pedido.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }