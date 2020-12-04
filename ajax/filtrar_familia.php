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
include("../funciones.php");
$sql="SELECT listafamilia.codigofamilia, listafamilia.nombrefamilia FROM clientelinea
LEFT JOIN productos
ON productos.codigoLinea = clientelinea.codigoLinea
LEFT JOIN listafamilia
ON listafamilia.codigofamilia = productos.codigoFamilia
WHERE codigoCliente = $sesioncode and estado = 0
and estadofamilia=1
GROUP BY listafamilia.codigofamilia ";
$query = mysqli_query($con, $sql);

if (!$query) {
    $mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
    echo $mensaje;
    return '';
}else{
    //$data=mysqli_fetch_array($query);
    $array=[];
    $i=0;
    while (($fila = mysqli_fetch_array($query)) != NULL) {
            $array[$i]['codigofamilia']=$fila['codigofamilia'];
            $array[$i]['nombrefamilia']=$fila['nombrefamilia'];
            $i=$i+1;
    }
    $json_string = json_encode($array);
    echo $json_string;
}

?>