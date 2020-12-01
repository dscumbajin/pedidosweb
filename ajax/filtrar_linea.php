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
$sql="SELECT distinct(listalinea.nombreLinea) as nombreLinea,listalinea.codigoLinea 
FROM listalinea,clientelinea 
WHERE listalinea.codigoLinea=clientelinea.codigolinea  
and clientelinea.codigoCliente='".$sesioncode."' 
and clientelinea.estado=0 
and estadoLinea=0 
order by ordenLinea asc ";
$query = mysqli_query($con, $sql);

if (!$query) {
    $mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
    echo $mensaje;
    return '';
}else{
    //$data=mysqli_fetch_array($query);
    $count=mysqli_num_rows($query);
    if($count>0){
        $array=[];
        $i=0;
        while (($fila = mysqli_fetch_array($query)) != NULL) {
                $array[$i]['codigolinea']=$fila['codigoLinea'];
                $array[$i]['nombrelinea']=$fila['nombreLinea'];
                $i=$i+1;
        }
    }else{
        $array=null;
    }
    $json_string = json_encode($array);
    echo $json_string;
}

?>