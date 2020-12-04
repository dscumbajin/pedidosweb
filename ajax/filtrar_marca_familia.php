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

if(isset($_GET['familia']))
$familia = mysqli_real_escape_string($con,(strip_tags($_GET['familia'], ENT_QUOTES)));
if(isset($_GET['marca']))
$marca = mysqli_real_escape_string($con,(strip_tags($_GET['marca'], ENT_QUOTES)));
if(isset($_GET['clase']))
$clase = mysqli_real_escape_string($con,(strip_tags($_GET['clase'], ENT_QUOTES)));



$sql=" SELECT distinct(listaclase.codigoClase) as codigoclase,listaclase.nombreclase 
FROM clientelinea
INNER JOIN productos
ON productos.codigoLinea = clientelinea.codigoLinea
INNER JOIN listaclase
ON listaclase.codigoclase = productos.codigoClase 
WHERE codigoCliente = $sesioncode and estado = 0
and productos.precioUnitario>0";

if(isset($familia)!=null){
    $sql.=" and productos.codigoFamilia='".$_GET["familia"]."'";
}
if(isset($marca)!=null){
    $sql.=" and productos.codigoMarca='".$_GET["marca"]."'";
}
if(isset($clase)!=null){
    $sql.=" and productos.codigoClase='".$_GET["clase"]."'";
}


$sql.=" and listaclase.estadoclase=1 ";


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
                $array[$i]['codigoclase']=$fila['codigoclase'];
                $array[$i]['nombreclase']=$fila['nombreclase'];
                $i=$i+1;
        }
    }else{
        $array=null;
    }
    $json_string = json_encode($array);
    echo $json_string;
}

?>