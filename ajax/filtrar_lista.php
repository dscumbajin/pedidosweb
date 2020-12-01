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
 
    $sql="SELECT distinct(productos.codigoFamilia), listafamilia.codigofamilia,listafamilia.nombrefamilia  
    FROM productos,listafamilia WHERE productos.codigofamilia=listafamilia.codigoFamilia  
    and productos.precioUnitario>0 
    and codigoMarca='".$id."' 
    and listafamilia.estadofamilia=1";
  
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
                    $array[$i]['codigofamilia']=$fila['codigofamilia'];
                    $array[$i]['nombrefamilia']=$fila['nombrefamilia'];
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