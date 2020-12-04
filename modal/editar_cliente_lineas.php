	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal22" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Permisos linea de negocio</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_cliente_linea" name="editar_cliente_linea">
			<div id="resultados_ajax2"></div>
			  <div class="form-group">
				<label for="mod_id_cliente" class="col-sm-3 control-label">Ruc</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_id_cliente" name="mod_id_cliente"  required>
					<!-- <input type="hidden" name="mod_id" id="mod_id"> -->
				</div>
			  </div>
			   <div class="form-group">
				<label for="mod_id_linea" class="col-sm-3 control-label">Código linea de negocio</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_id_linea" name="mod_id_linea">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="mod_estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_estado" name="mod_estado" required>
					<option value="">-- Selecciona estado --</option>
					<option value="0" selected>Activo</option>
					<option value="1">Inactivo</option>
				  </select>
				</div>
			  </div>
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>