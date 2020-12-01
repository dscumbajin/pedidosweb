<?php
/*---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();
$sesioncode=$_SESSION['user_id'];
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
include("../funciones.php");


if(isset($_GET['id'])){
    $id=$_GET['id'];
 
    $sql="SELECT distinct(listalinea.codigoLinea), listalinea.codigoLinea,listalinea.nombreLinea  
    FROM productos,listalinea,clientelinea 
    WHERE productos.codigoLinea=listalinea.codigoLinea 
    and productos.codigoLinea=clientelinea.codigoLinea 
    and clientelinea.estado=0 
    and clientelinea.codigoCliente='".$sesioncode."' 
    and codigoMarca='".$id."' 
    and productos.precioUnitario>0 
    and listalinea.estadoLinea=0";
  
    $query = mysqli_query($con, $sql);
  

    if (!$query ) {
        $mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
        echo $mensaje;
        return '';
    }else{
        //$data=mysqli_fetch_array($query);
        $count=mysqli_num_rows($query);
        if($count>0){
            $array=[];
            $arrayproducto=[];
            $i=0;
            while (($fila = mysqli_fetch_array($query)) != NULL) {
                    $array[$i]['codigolinea']=$fila['codigoLinea'];
                    $array[$i]['nombrelinea']=$fila['nombreLinea'];
                    $i=$i+1;
            }
            $i=0;
            
            $json_string = json_encode($array);
        }else{
            $array=null;
            $json_string=json_encode($array);
        }
       
        echo $json_string;
    }
}

?>