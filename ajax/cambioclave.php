<?php
	/*-------------------------
	Autor: Jorge F prieto L
	Web: bateriasecuador.com
	Mail: info@bateriasecuador.com
	---------------------------*/

if (isset($_POST['nombre'])){$nombre=$_POST['nombre'];}
if (isset($_POST['contrasena'])){$c1=$_POST['contrasena'];}
if (isset($_POST['confirmar'])){$c2=$_POST['confirmar'];}


	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");

if (!empty($nombre) and !empty($c1) and !empty($c2) )
{
    if($c1!=$c2){
        $problema="Las contraseñas ingresadas no coinciden";
        echo $problema;
    }else{
        $reset=mysqli_query($con,"SELECT * from clientes WHERE nombreCliente='".$nombre."' ");
        $count=mysqli_num_rows($reset);
        if($count>0){
            $data=mysqli_fetch_array($reset);
            if($data['token_']!=" " || $data['token_']!=null){
                $passHash = password_hash($c1, PASSWORD_BCRYPT);
                $vacio=null;
                $resultado=mysqli_query($con,"UPDATE clientes set password='".$passHash."',token_='".$vacio."' WHERE nombreCliente='".$nombre."'");
            
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
                $problema="Su token ha sido alterado debera enviar nuevamente los datos";
                echo $problema;
            }
        }else{
            $problema="Usuario no existe en la información de Baterias Ecuador";
            echo $problema;
        }
    }
}else{
    $problema="la claves estan vacias";
    echo $problema;
}