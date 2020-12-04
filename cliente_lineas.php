<?php
	/*-------------------------
	Autor: Jorge F prieto L
	Web: bateriasecuador.com
	Mail: info@bateriasecuador.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_facturas="";
	$active_productos="";
	$active_clientes="active";
	$active_usuarios="";	
	$title="Clientes | Baterias _ Pedidos";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php");?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</head>

<body>
    <?php
	include("navbar.php");
	?>

    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoClienteLinea"><span
                            class="glyphicon glyphicon-plus"></span> Asignar linea</button>
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Buscar Lineas</h4>
            </div>
            <div class="panel-body">



                <?php
				include("modal/registro_cliente_lineas.php");
				include("modal/editar_cliente_lineas.php");
			?>
                <form class="form-horizontal" role="form" id="datos_cotizacion">

                    <div class="form-group row">
                        <label for="q" class="col-md-2 control-label">Linea de negocio</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="q" placeholder="Código o Linea de negocio"
                                onkeyup='load(1);'>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-default" onclick='load(1);'>
                                <span class="glyphicon glyphicon-search"></span> Buscar</button>
                            <span id="loader"></span>
                        </div>

                    </div>



                </form>
                <div id="resultados"></div><!-- Carga los datos ajax -->
                <div class='outer_div'></div><!-- Carga los datos ajax -->

            </div>
        </div>

    </div>
    <hr>
    <?php
	include("footer.php");
	?>
    <script type="text/javascript" src="js/VentanaCentrada.js"></script>
    <script type="text/javascript" src="js/cliente_lineas.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</body>

</html>