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
$aColumns = array('codigoProducto', 'nombreProducto', 'caja', 'listalinea.codigoLinea', 'codigoListaPrecio','listalinea.nombreLinea');//Columnas de busqueda
$sTable = "productos,listalinea,clientelinea,clientes";
$sWhere = " WHERE clientelinea.codigoCliente=clientes.codigoCliente and clientes.codigoCliente='".$sesioncode."' and listalinea.codigoLinea=clientelinea.codigoLinea and clientelinea.estado=0 and listalinea.codigoLinea=productos.codigoLinea and productos.estadoProd=1 and productos.facturar=1 and productos.web=1  and productos.precioUnitario>0";
$sql="SELECT nombreProducto FROM  $sTable $sWhere ";

$query = mysqli_query($con, $sql);

if (!$query) {
    $mensaje  = 'Consulta no válida: ' .mysqli_error($con) . "\n";
    echo $mensaje;
    return '';
}else{
   try{
        //$data=mysqli_fetch_array($query);
        $count=mysqli_num_rows($query);
      
        if($count>0){
            $i=0; 
            while (($fila = mysqli_fetch_array($query)) != NULL) {
                if ($i == 0) {
                    $array = $fila["nombreProducto"];
                } else{
                    $array = $array . "," . $fila["nombreProducto"];
                   
                }
                $i++;
            }
            $aColumns = array('codigoProducto', 'nombreProducto', 'caja', 'listalinea.codigoLinea', 'codigoListaPrecio','listalinea.nombreLinea');//Columnas de busqueda
            $sTable = "productos,listalinea,clientelinea,clientes";
            $sWhere = " WHERE clientelinea.codigoCliente=clientes.codigoCliente and clientes.codigoCliente='".$sesioncode."' and listalinea.codigoLinea=clientelinea.codigoLinea and clientelinea.estado=0 and listalinea.codigoLinea=productos.codigoLinea and productos.estadoProd=1 and productos.facturar=1 and productos.web=1  and productos.precioUnitario>0";
            $sql="SELECT distinct(nombreLinea) FROM  $sTable $sWhere ";
            $query = mysqli_query($con, $sql);
            $count=mysqli_num_rows($query);
            if($count>0){
                while (($fila = mysqli_fetch_array($query)) != NULL) {
                   
                        $array = $array . "," . $fila["nombreLinea"];
                    
                }
            }
        }else{
            $array=null;
        }
        $json_string =$array;
        print_r($json_string);
    }catch(Exception $e){
        echo $e->getMessage();
        $json_string = $e->getMessage();

        echo $json_string;
    }
}

?>