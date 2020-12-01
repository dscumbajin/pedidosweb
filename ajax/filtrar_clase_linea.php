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

if(isset($_GET['clase']))
$clase = mysqli_real_escape_string($con,(strip_tags($_GET['clase'], ENT_QUOTES)));
if(isset($_GET['marca']))
$marca = mysqli_real_escape_string($con,(strip_tags($_GET['marca'], ENT_QUOTES)));


$sql="SELECT distinct(productos.codigoFamilia), listafamilia.codigofamilia,listafamilia.nombrefamilia  
FROM clientelinea
INNER JOIN productos
ON productos.codigoLinea = clientelinea.codigoLinea
INNER JOIN listafamilia
ON listafamilia.codigofamilia = productos.codigoFamilia 
WHERE codigoCliente = $sesioncode 
and productos.precioUnitario>0 ";

if(isset($clase)!=null){
    $sql.=" and productos.codigoClase='".$_GET["clase"]."'";
}
if(isset($marca)!=null){
    $sql.=" and productos.codigoMarca='".$_GET["marca"]."'";
}

$sql.=" and listafamilia.estadofamilia=1 ";


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
                $array[$i]['codigofamilia']=$fila['codigofamilia'];
                $array[$i]['nombrefamilia']=$fila['nombrefamilia'];
                $i=$i+1;
        }
    }else{
        $array=null;
    }
    $json_string = json_encode($array);
    echo $json_string;
}

?>