<?php
	/*-------------------------
	Autor: Jorge F prieto L
	Web: bateriasecuador.com
	Mail: info@bateriasecuador.com
	---------------------------*/

if (isset($_POST['nombre'])){$nombre=$_POST['nombre'];}


	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");

if (!empty($nombre) )
{
        $vacio=null;
   
        $resultado=mysqli_query($con,"UPDATE clientes set token_='".$vacio."' WHERE nombreCliente='".$nombre."'");
        
      
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
            $mensaje .= 'Consulta completa: ' . $resultado;
            echo $mensaje;
        }
        if($resultado){
            $correcto="Su cambio se ha produccido exitosamente";
            echo $correcto;
        }else{
            $problema="Ha ocurrido un error en almacenar los datos";
            echo $problema;
        }
    
}else{
    $problema="la claves estan vacias";
    echo $problema;
}