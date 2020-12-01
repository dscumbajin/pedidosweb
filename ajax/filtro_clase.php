<?php
/*---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();
$sesioncode=$_SESSION['user_id'];
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
include("../funciones.php");


if(isset($_GET['marca'],$_GET['listanegocio'])){
    $marca=$_GET['marca'];
    $negocio=$_GET['listanegocio'];
    $sql="SELECT distinct(listaclase.codigoClase) as codigoClase,listaclase.nombreclase 
    FROM clientelinea
    INNER JOIN productos
    ON productos.codigoLinea = clientelinea.codigoLinea
    INNER JOIN listaclase
    ON listaclase.codigoclase = productos.codigoClase 
    WHERE codigoCliente = $sesioncode 
    and productos.precioUnitario>0 
    and codigoMarca='".$marca."' 
    and codigoFamilia='".$negocio."' 
    and listaclase.estadoclase=1
    GROUP BY listaclase.codigoclase";
  
}else{
    $sql="SELECT listaclase.codigoclase, listaclase.nombreclase FROM clientelinea
    LEFT JOIN productos
    ON productos.codigoLinea = clientelinea.codigoLinea
    LEFT JOIN listaclase
    ON listaclase.codigoclase = productos.codigoClase 
    WHERE codigoCliente = $sesioncode
    and productos.precioUnitario>0
    and listaclase.estadoclase=1
    GROUP BY listaclase.codigoclase";
}
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
            $json_string = json_encode($array);
        }else{
            $array=null;
            $json_string=json_encode($array);
        }
       
        echo $json_string;
    }


?>