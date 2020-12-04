<?php

/*-------------------------
	Autor: Jorge F prieto L
	Web: bateriasecuador.com
	Mail: info@bateriasecuador.com
	---------------------------*/
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

$phptemp = $_COOKIE["query"];
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if (isset($_GET['id']) && isset($_GET['idLinea'])) {
	$id_cliente = ($_GET['id']);
	$id_linea = ($_GET['idLinea']);

		if ($delete1 = mysqli_query($con, "DELETE FROM clientelinea WHERE codigoCliente='" . $id_cliente . "' AND codigoLinea='" . $id_linea . "'")) {
?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
		<?php
		} else {
		?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
		<?php

		}
	
}

if ($action == 'ajax') {
	// escaping, additionally removing everything that could be (html/javascript-) code
	$q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$aColumns = array('clientelinea.codigoLinea', 'nombreLinea'); //Columnas de busqueda
	$sTable = "clientelinea, clientes, listalinea";
	$sWhere = "WHERE clientelinea.codigoCliente = $phptemp 
		 AND clientelinea.codigoCliente = clientes.codigoCliente
		 AND clientelinea.codigoLinea = listalinea.codigoLinea ";
	if ($_GET['q'] != "") {
		$sWhere = "WHERE clientelinea.codigoCliente = $phptemp AND clientelinea.codigoCliente = clientes.codigoCliente
			AND clientelinea.codigoLinea = listalinea.codigoLinea AND (";
		for ($i = 0; $i < count($aColumns); $i++) {
			$sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= ')';
	}

	/* echo $sWhere; */

	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
	$per_page = 10; //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
	$row = mysqli_fetch_array($count_query);
	$numrows = $row['numrows'];
	$total_pages = ceil($numrows / $per_page);
	$reload = './cliente_lineas.php';
	//main query to fetch the data
	$sql = "SELECT clientelinea.codigoCliente, nombreCliente, clientelinea.codigoLinea, nombreLinea, clientelinea.estado
		FROM  $sTable $sWhere LIMIT $offset,$per_page";
	$query = mysqli_query($con, $sql);
	//loop through fetched data

	if ($numrows > 0) {

	?>
		<div class="table-responsive">
			<table id="registros" class="table table-bordered table-striped">
				<tr class="info">
					<th>Código cliente</th>
					<th>Nombre cliente</th>
					<th>Código Linea</th>
					<th>Linea de negocio</th>
					<th>Estado</th>
					<th>Acciones</th>

				</tr>
				<?php
				while ($row = mysqli_fetch_array($query)) {
					$id_cliente = $row['codigoCliente'];
					$nombre_cliente = $row['nombreCliente'];
					$id_linea = $row['codigoLinea'];
					$linea_negocio = $row['nombreLinea'];
					$status_linea = $row['estado'];
					if ($status_linea == 0) {
						$estado = "Activo";
					} else {
						$estado = "Inactivo";
					}
				?>
					<input type="hidden" value="<?php echo $linea_negocio; ?>" id="linea_negocio<?php echo $id_cliente; ?>">
					<input type="hidden" value="<?php echo $id_linea; ?>" id="id_linea_estado<?php echo $id_cliente; ?>">
					<input type="hidden" value="<?php echo $status_linea; ?>" id="status_linea<?php echo $id_cliente; ?>">
					<tr>
						<td><?php echo $id_cliente; ?></td>
						<td><?php echo $nombre_cliente; ?></td>
						<td><?php echo $id_linea; ?></td>
						<td><?php echo $linea_negocio; ?></td>
						<td><?php echo $estado; ?></td>
						<td><span>
								<a href="#" title='Editar cliente linea' onclick="obtener_datos('<?php echo $id_cliente; ?>', '<?php echo $id_linea; ?>', '<?php echo $status_linea; ?>');" data-toggle="modal" data-target="#myModal22"><i class="glyphicon glyphicon-edit"></i></a>
								<a href="#" title='Borrar cliente linea' onclick="eliminar('<?php echo $id_cliente; ?>','<?php echo $id_linea; ?>')"><i class="glyphicon glyphicon-trash" style="color: red;"></i> </a></span></td>

					</tr>
				<?php
				}
				?>

			</table>
			<div class="paginacion">

				<?php
				echo paginate($reload, $page, $total_pages, $adjacents);
				?>

			</div>
		</div>
		<?php
	} else {
		if ($_GET['q'] != "") {
		?>
			<div class="alert alert-danger text-center" role="alert">
				No existen usuarios filtrados con el dato: <?php echo $_GET['q']; ?>
			</div>
<?php
		}
	}
}
?>