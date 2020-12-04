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

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if (isset($_GET['id'])) {
	$id_cliente = intval($_GET['id']);
	$query = mysqli_query($con, "select * from pedido where ruc_cliente='" . $id_cliente . "'");
	$count = mysqli_num_rows($query);
	if ($count == 0) {
		if ($delete1 = mysqli_query($con, "DELETE FROM clientes WHERE codigoCliente='" . $id_cliente . "'")) {
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
	} else {
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Error!</strong> No se pudo eliminar éste cliente. Existen facturas vinculadas a éste producto.
		</div>
	<?php
	}
}

if ($action == 'ajax') {
	// escaping, additionally removing everything that could be (html/javascript-) code
	$q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$aColumns = array('nombreCliente'); //Columnas de busqueda
	$sTable = "clientes";
	$sWhere = "";
	if ($_GET['q'] != "") {
		$sWhere = "WHERE (";
		for ($i = 0; $i < count($aColumns); $i++) {
			$sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= ')';
	}
	$sWhere .= " order by nombreCliente";
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
	$reload = './clientes.php';
	//main query to fetch the data
	$sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
	$query = mysqli_query($con, $sql);
	//loop through fetched data
	if ($numrows > 0) {

	?>
		<div class="table-responsive">
			<table id="registrosTable" class="table ">
				<tr class="info">
					<th style="padding: 0 0 !important; margin: 0 0 !important;">Linea</th>
					<th style="padding: 0 0 !important; margin: 0 0 !important;">Nombre</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th>Dirección</th>
					<th>Estado</th>
					<th style="padding: 0 0 !important; margin: 0 0 !important;">Acciones</th>

				</tr>
				<?php
				while ($row = mysqli_fetch_array($query)) {
					$id_cliente = $row['codigoCliente'];
					$nombre_cliente = $row['nombreCliente'];
					$telefono_cliente = $row['telefono'];
					$email_cliente = $row['mailCliente'];
					$direccion_cliente = $row['direccion'];
					$status_cliente = $row['estadoCliente'];
					if ($status_cliente == 1) {
						$estado = "Activo";
					} else {
						$estado = "Inactivo";
					}
				?>

					<input type="hidden" value="<?php echo $nombre_cliente; ?>" id="nombre_cliente<?php echo $id_cliente; ?>">
					<input type="hidden" value="<?php echo $telefono_cliente; ?>" id="telefono_cliente<?php echo $id_cliente; ?>">
					<input type="hidden" value="<?php echo $email_cliente; ?>" id="email_cliente<?php echo $id_cliente; ?>">
					<input type="hidden" value="<?php echo $direccion_cliente; ?>" id="direccion_cliente<?php echo $id_cliente; ?>">
					<input type="hidden" value="<?php echo $status_cliente; ?>" id="status_cliente<?php echo $id_cliente; ?>">

					<tr>
						<td>
							<a onclick="crearCookie('query', '<?php echo $id_cliente; ?>', 2 );" href="cliente_lineas.php?ruc=<?php echo $id_cliente; ?>" title='Cliente Linea'><i class="glyphicon glyphicon-plus" style="color: green;"></i></a>

						</td>
						<td style="padding: 0 0 !important; margin: 0 0 !important;"><?php echo $nombre_cliente; ?></td>
						<td class="ellipsis">
							<p class="reducir150">
							<?php echo $telefono_cliente; ?>
							</p>
						</td>
						<td class="ellipsis">
							<div class="reducir200">
							<?php echo $email_cliente; ?>
							</div>
						</td>
						<td class="ellipsis">
							<div class="reducir200">
								<?php echo $direccion_cliente; ?>
							</div>
						</td>
						<td><?php echo $estado; ?></td>
						<td><span >
								<a href="#" title='Editar cliente' onclick="obtener_datos('<?php echo $id_cliente; ?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>
								<a href="#" title='Borrar cliente' onclick="eliminar('<?php echo $id_cliente; ?>')"><i class="glyphicon glyphicon-trash" style="color: red;"></i> </a>
							</span>
						</td>

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
<script>
	function crearCookie(nombre, valor, dias) {
		var expira;
		if (dias) {
			var date = new Date();
			date.setTime(date.getTime() + (dias * 24 * 60 * 60 * 1000));
			expira = "; expires=" + date.toGMTString();
		} else {
			expira = "";
		}
		document.cookie = escape(nombre) + "=" + escape(valor) + expira + "; path=/";
	}
</script>