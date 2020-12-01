<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="comentario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Enviar Comentario</h4>
		  </div>
		  <div class="modal-body">
          <div class="alert alert-danger" style="margin-top:10px; margin-bottom:10px; display:none;" id="alerta" class="alerta" role="alert">
                    Maximo hasta 100 caracteres
                </div>
			<form class="form-horizontal" method="post" id="descripcion"  name="descripcion">

			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Descripción</label>
                
				<div class="col-sm-8">
				  <textarea  max="100" min="1"  class="form-control" cols="40" name="texto" max-length="100" onKeyUp="return limitar(event,this.value,100)" onKeyDown="return limitar(event,this.value,100)" rows="5" onclick="cambiarcolor()" id="comentario" name="comentario"  name="comentario" required></textarea>
                  
				</div>
			  </div>
              <div class="form-group">
              <label for="nombre" class="col-sm-3 control-label">Caracteres</label>
				<div class="col-sm-2">
                        <input type="text" style="text-align:center;" readonly name="caracteres" value="0"; size=1> 
				</div>
			  </div>
              <div class="form-group">
                <small style=" display:block; margin:auto;text-align:center;">Nota: Si no envía un comentario el sistema determinará uno por default</small>
              </div>
             
		  </div>
		  <div class="modal-footer" style="display:flex;">
			<button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
			<button type="button" onclick="imprimirfactura()" class="btn btn-dark" id="guardar_datos">Enviar Pedido</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>