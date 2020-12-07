	<?php
		if (isset($con))
		{
			$phptemp = $_COOKIE["query"];
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoClienteLinea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
	                        aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar Linea de negocio a cliente</h4>
	            </div>
	            <div class="modal-body">
	                <form class="form-horizontal" method="post" id="guardar_cliente_linea" name="guardar_cliente_linea">
	                    <div id="resultados_ajax"></div>

	                    <div class="form-group">
	                        <label for="codigo" class="col-sm-3 control-label">RUC</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" id="codigo" name="codigo" value= "<?php echo $phptemp?>" readonly= "true" required>
	                        </div>
	                    </div>

						<div class="form-group">
	                        <label for="codigo_linea" class="col-sm-3 control-label">Linea de negocio</label>
	                        <div class="col-sm-8">
	                            <select class="form-control" id="codigo_linea" name="codigo_linea" required>
	                                <?php
										try {
											$sql = " SELECT * FROM listalinea WHERE listalinea.codigoLinea NOT IN ( SELECT clientelinea.codigoLinea FROM clientelinea WHERE clientelinea.codigoCliente = $phptemp)";

											$resultado = $con->query($sql);
											while ($lineaNegocio = $resultado->fetch_assoc()) { ?>
														<option value="<?php echo $lineaNegocio['codigoLinea']; ?>">
															<?php echo $lineaNegocio['codigoLinea'] . " - ". $lineaNegocio['nombreLinea']; ?></option>
														<?php }
										} catch (Exception $e) {
											echo "Error: " . $e->getMessage();
										}
										?>
	                            </select>
	                        </div>
	                    </div>


	                    <div class="form-group">
	                        <label for="estado" class="col-sm-3 control-label">Estado</label>
	                        <div class="col-sm-8">
	                            <select class="form-control" id="estado" name="estado" required>
	                                <option value="">-- Selecciona estado --</option>
	                                <option value="1" selected>Activo</option>
	                                <option value="0">Inactivo</option>
	                            </select>
	                        </div>
	                    </div>			

	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	                <button type="submit" class="btn btn-primary" id="guardar_datos" >Guardar datos</button>
	            </div>
	            </form>
	        </div>
	    </div>
	</div>
	<?php
		}
	?>

	