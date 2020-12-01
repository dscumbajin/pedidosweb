

<?php

	/*-------------------------
	Autor: Jorge F prieto L
	Web: bateriasecuador.com
	Mail: info@bateriasecuador.com
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
	if ( isset($_GET['q']) != "" ){
		$q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		
		//$maxPrecioPromo=$_SESSION['maxPrecioPromo'];
		$aColumns = array('codigoProducto', 'nombreProducto', 'caja', 'listalinea.codigoLinea', 'codigoListaPrecio','listalinea.nombreLinea');//Columnas de busqueda
		$sTable = "productos,listalinea,clientelinea,clientes";
		$sWhere = " WHERE clientelinea.codigoCliente=clientes.codigoCliente and clientes.codigoCliente='".$_SESSION['user_id']."' and listalinea.codigoLinea=clientelinea.codigoLinea and clientelinea.estado=0 and listalinea.codigoLinea=productos.codigoLinea and productos.estadoProd=1 and productos.facturar=1 and productos.web=1  and productos.precioUnitario>0";
	   if ( $_GET['q'] != "" )
	   {
		   $sWhere = "WHERE clientelinea.codigoCliente=clientes.codigoCliente and clientes.codigoCliente='".$_SESSION['user_id']."' and listalinea.codigoLinea=clientelinea.codigoLinea and clientelinea.estado=0 and listalinea.codigoLinea=productos.codigoLinea and productos.precioUnitario>0 and productos.estadoProd=1 and productos.facturar=1 and productos.web=1  and (";
		   for ( $i=0 ; $i<count($aColumns) ; $i++ )
		   {
			   $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
		   }
		   $sWhere = substr_replace( $sWhere, "", -3 );
		   $sWhere .= ') ';
	   }
	  

	}else{
		//evitar inyeccion sql
		$familia = mysqli_real_escape_string($con,(strip_tags($_GET['familia'], ENT_QUOTES)));
		$marca = mysqli_real_escape_string($con,(strip_tags($_GET['marca'], ENT_QUOTES)));
		$clase = mysqli_real_escape_string($con,(strip_tags($_GET['clase'], ENT_QUOTES)));
		$parametro = mysqli_real_escape_string($con,(strip_tags($_GET['parametro'], ENT_QUOTES)));

		$aColumns = array('codigoProducto', 'nombreProducto', 'codigoFamilia','codigoMarca','codigoClase','caja', 'listalinea.codigoLinea', 'codigoListaPrecio','listalinea.nombreLinea');//Columnas de busqueda
		$sTable = "productos,listalinea,clientelinea,clientes";
		$sWhere = " WHERE clientelinea.codigoCliente=clientes.codigoCliente and listalinea.codigoLinea=clientelinea.codigoLinea and clientelinea.estado=0 and listalinea.codigoLinea=productos.codigoLinea and productos.estadoProd=1 and productos.facturar=1 and productos.web=1 and clientes.codigoCliente='".$_SESSION['user_id']."'
		and productos.precioUnitario>0";

		if($familia!=""){
			$sWhere .=" and codigoFamilia='".$familia."' "; 
		}
		if($marca!=""){
			$sWhere .=" and codigoMarca='".$marca."' "; 
		}
		if($clase!=""){
			$sWhere .=" and codigoClase='".$clase."' "; 
		}

		if($parametro!=""){
			$sWhere .= " and (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$parametro."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}

	}
		$sWherenum =$sWhere;
		$sWhere .= ' GROUP by productos.nombreProducto order by productos.orden asc ';		
		$count_query   = mysqli_query($con, "SELECT count(distinct(productos.nombreProducto)) AS numrows FROM $sTable  $sWherenum");

		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		//$total_pages = ceil($numrows/$per_page);
		//$reload = './index.php';
		//main query to fetch the data
		$sql="SELECT *, listalinea.nombreLinea FROM  $sTable $sWhere ";

		$query = mysqli_query($con, $sql);
		

		if (!$query) {
    		$mensaje  = 'Consulta no válidas: ' .mysqli_error($con) . "\n";
			echo $mensaje;
			
			return '';
		}
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="alert" role="alert" style="color: #155724!important;background-color: #d4edda!important;border-color: #c3e6cb!important;font-weight:550">
				Total de Productos encontrados: <?php echo $numrows ?>
			</div>
			<div class="table-responsive" >
			  <table class=" table table-responsive table-striped table-bordered table-sm fixed_header table-hover" cellspacing="0" >
			 
				<tbody style=" height:auto; max-height:950px; min-height:auto;">
					<tr class="" style="background-color:#faebcc!important;">
						<th style="text-align:center;" width="5%">#</th>
						<th  style="text-align:center;" width="20%">Marca</th>
						<th  style="text-align:center;" width="10%">Producto</th>
						<th  style="text-align:center;" width="30%">Nombre</th>
						<th  style="text-align:center;" width="15%" class="text-center"><span class="text-center">Cantidad</span></th>
						<th  style="text-align:center;" width="10%" class="text-center"><span class="text-center">Precio</span></th>
						<th  style="text-align:center;" width="10%" class='text-center' >Agregar</th>
					</tr>
						<?php
						$i=1;
						while ($row=mysqli_fetch_array($query)){
								$id_producto=$row['idProducto'];

								$sqlnombreLinea=mysqli_query($con, "select nombreLinea from listalinea where codigoLinea=".$row['codigoLinea']."");
								$rownombreLinea=mysqli_fetch_array($sqlnombreLinea);

								$codigo_linea=$rownombreLinea['nombreLinea'];
								$caja=$row['caja'];
								$codigoClase=$row['codigoClase'];
								$codigo_producto=$row['codigoListaPrecio'];
								$nombre_producto=$row['nombreProducto'];
								$precio_venta=$row["precioUnitario"];
								$precio_venta=number_format($precio_venta,2,'.','');
								//variables de muestra informativa
								$codigoMarca=$row['codigoMarca'];
								$codigoProducto=$row['codigoFamilia'];
								?>
								<tr >
									<td style="text-align:center;"><?php echo $i ?></td>
									<td style="text-align:center;"><?php echo utf8_encode($codigoMarca); ?></td>
									<td style="text-align:center;"><?php echo utf8_encode($codigoProducto); ?></td>
									<td style="text-align:center;white-space:pre-wrap!important;"><?php echo utf8_encode($nombre_producto); ?></td>
									<td  style="text-align:center;"><div class="pull-right">
										<input type="number"  class="form-control" style="text-align:center" min="1" onkeyup="el1('<?php echo $id_producto; ?>')" id="cantidad_<?php echo $id_producto; ?>"  value="1" >
									</div></td>
									<td  style="text-align:center;" ><div class="pull-right">
										<input type="text" class="form-control" readonly disabled  style="text-align:center" id="precio_venta_<?php echo $id_producto; ?>"  value="<?php echo $precio_venta;?>" >
									</div></td>
									<td style="" class='text-center'><button  class='agregar' href="#" onclick="agregar('<?php echo $id_producto ?>')"><i class="glyphicon glyphicon-plus"></i></button></td>
								</tr>
								<?php
							$i=$i+1;
						}
								?>
				</tbody>
			  </table>
			</div>
			<?php
		}else{
			$valor=" ";
				if(isset($_GET['marca']) != null || isset($_GET['parametro'])!=null || isset($_GET['clase'])!=null || isset($_GET['familia'])){
					if(isset($_GET['familia'])){
						if($_GET['familia']!="")
						$valor.='Familia: '.$_GET['familia']." - ";
						
					}

					if(isset($_GET['marca'])){
						if($_GET['marca']!="")
							$valor.='Marca: '.$_GET['marca']." - ";
						
					}
					
					if(isset($_GET['clase'])){
						if($_GET['clase']!="")
							$valor.='Clase: '.$_GET['clase']." - ";
					}
					if(isset($_GET['parametro'])){
						if($_GET['parametro']!="")
						$valor.='Parametro: '.$_GET['parametro']." - ";
					}
					?>
						<div class="alert alert-danger text-center" role="alert">
						No existen productos encontrados con lo siguiente parametros de filtro: <?php echo $valor; ?>
						</div>
					<?php
			}else{
			?>
				<div class="alert alert-danger text-center" role="alert">
					  No existen productos activos para el cliente con RUC: <?php echo $_SESSION['user_id']; ?>
				</div>
			<?php
			}
		}
	}
?>