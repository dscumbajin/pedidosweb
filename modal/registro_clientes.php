	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
	                        aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo
	                    cliente</h4>
	            </div>
	            <div class="modal-body">
	                <form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente">
	                    <div id="resultados_ajax"></div>

	                    <div class="form-group">
	                        <label for="codigo" class="col-sm-3 control-label">RUC</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" id="codigo" name="codigo" required>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label for="nombre" class="col-sm-3 control-label">Nombre</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" id="nombre" name="nombre" required>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label for="telefono" class="col-sm-3 control-label">Teléfono</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" id="telefono" name="telefono">
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label for="email" class="col-sm-3 control-label">Email</label>
	                        <div class="col-sm-8">
	                            <input type="email" class="form-control" id="email" name="email">

	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label for="direccion" class="col-sm-3 control-label">Dirección</label>
	                        <div class="col-sm-8">
	                            <textarea class="form-control" id="direccion" name="direccion" maxlength="255"></textarea>

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

						<div class="form-group">
	                        <label for="permitirPromocion" class="col-sm-3 control-label">Promoción</label>
	                        <div class="col-sm-8">
	                            <select class="form-control" id="permitirPromocion" name="permitirPromocion" required>
	                                <option value="">-- Selecciona Promoción --</option>
	                                <option value="1" selected>Activo</option>
	                                <option value="0">Inactivo</option>
	                            </select>
	                        </div>
	                    </div>

						<div class="form-group">
	                        <label for="codigoPromo1" class="col-sm-3 control-label">Promoción 1</label>
	                        <div class="col-sm-8">
	                            <select class="form-control" id="codigoPromo1" name="codigoPromo1" required>
	                                <?php
										try {
											$sql = 'SELECT * FROM promociones';

											$resultado = $con->query($sql);
											while ($promocion1 = $resultado->fetch_assoc()) { ?>
														<option value="<?php echo $promocion1['codigoPromocion']; ?>">
															<?php echo $promocion1['nombre']; ?></option>
														<?php }
										} catch (Exception $e) {
											echo "Error: " . $e->getMessage();
										}
										?>
	                            </select>
	                        </div>
	                    </div>
						<div class="form-group">
	                        <label for="codigoPromo2" class="col-sm-3 control-label">Promoción 2</label>
	                        <div class="col-sm-8">
	                            <select class="form-control" id="codigoPromo2" name="codigoPromo2" required>
	                                <?php
										try {
											$sql = 'SELECT * FROM promociones';

											$resultado = $con->query($sql);
											while ($promocion2 = $resultado->fetch_assoc()) { ?>
														<option value="<?php echo $promocion2['codigoPromocion']; ?>">
															<?php echo $promocion2['nombre']; ?></option>
														<?php }
										} catch (Exception $e) {
											echo "Error: " . $e->getMessage();
										}
										?>
	                            </select>
	                        </div>
	                    </div>
						<div class="form-group">
	                        <label for="codigoPromo3" class="col-sm-3 control-label">Promoción 3</label>
	                        <div class="col-sm-8">
	                            <select class="form-control" id="codigoPromo3" name="codigoPromo3" required>
	                                <?php
										try {
											$sql = 'SELECT * FROM promociones';

											$resultado = $con->query($sql);
											while ($promocion3 = $resultado->fetch_assoc()) { ?>
														<option value="<?php echo $promocion3['codigoPromocion']; ?>">
															<?php echo $promocion3['nombre']; ?></option>
														<?php }
										} catch (Exception $e) {
											echo "Error: " . $e->getMessage();
										}
										?>
	                            </select>
	                        </div>
	                    </div>

						<div class="form-group">
	                        <label for="codigoLisPre" class="col-sm-3 control-label">Lista precio</label>
	                        <div class="col-sm-8">
	                            <select class="form-control" id="codigoLisPre" name="codigoLisPre" required>
	                                <!-- <option value="">-- Selecciona lista precio  --</option> -->
	                                <?php
										try {
											$sql = 'SELECT * FROM listaprecios';

											$resultado = $con->query($sql);
											while ($listaprecio = $resultado->fetch_assoc()) { ?>
														<option value="<?php echo $listaprecio['codigoLisPre']; ?>">
															<?php echo $listaprecio['nombreLisPre']; ?></option>
														<?php }
										} catch (Exception $e) {
											echo "Error: " . $e->getMessage();
										}
										?>
	                            </select>
	                        </div>
	                    </div>

						<div class="form-group">
	                        <label for="descuentoCliente" class="col-sm-3 control-label">Descuento</label>
	                        <div class="col-sm-8">
							<input type="text" class="form-control" id="descuentoCliente" name="descuentoCliente" require placeholder ="0.0">
	                        </div>
	                    </div>
						

	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	                <button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
	            </div>
	            </form>
	        </div>
	    </div>
	</div>
	<?php
		}
	?>