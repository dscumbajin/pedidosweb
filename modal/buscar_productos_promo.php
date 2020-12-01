	<?php
		if (isset($con))
		{
	?>	
			<!-- Modal -->
			<div class="modal fade bs-example-modal-lg" id="myModalpromo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" onload="loadpromo(1)" style="padding:50px;">
			<div class="modal-dialog modal-lg" role="document" style="width:auto;margin-bottom:30px;margin-left:30px;margin-right:30px;margin-top:0;" >
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Buscar productos de promoción </h4>
				  </div>
				  <div class="modal-body" style="padding:10px; display:flex;">
					<div class="seccion1" style="flex:0 1 20%;width:100%">
						<div class="contenedor-titulo">
							<h2 class="titulo"><?php if(isset($tituloFiltro)) echo $tituloFiltro?></h2>
							<hr class="barra" style="display:none;">
						</div>
						
						<nav id="sidebar">
							<ul class="list-unstyled components">
								<li>
									<a href="#marca_general"  data-toggle="collapse" aria-expanded="true" class="noactivar dropdown-toggle">
										<?php if(isset($nombrePrincipal)) echo $nombrePrincipal?><i class="flecha glyphicon glyphicon-menu-down"></i>
									</a>
									<ul class=" list-unstyled show collapsed in" id="marca_general">
										
										<li class="principal-nav">
											<a href="#linea1" data-toggle="collapse" id="atributo1"  aria-expanded="true" class="dropdown-toggle subtitulo">
											<?php if(isset($primerFiltro)) echo $primerFiltro?>
											</a>
											<ul class="list-unstyled collapse  show estilos" id="linea1">
												
											</ul>
										</li>

										<li class="principal-nav">
											<a href="#marca" data-toggle="collapse" aria-expanded="true" id="atributo2"  class="dropdown-toggle subtitulo">
											<?php if(isset($segundoFiltro)) echo $segundoFiltro?>
											</a>
											<ul class="list-unstyled collapse  show estilos" id="marca">
												
											</ul>
										</li>
										
										
										<li class="principal-nav cambioauto">
											<a href="#clase1" data-toggle="collapse" id="atributo3"  aria-expanded="true" class="dropdown-toggle subtitulo">
											<?php if(isset($tercerFiltro)) echo $tercerFiltro?>
											</a>
											<ul class="list-unstyled collapse  show estilos" id="clase1">
												
											</ul>
										</li>
									</ul>	
								<li>
							</ul>
						</nav>
						<a href="#" class="limpiar btn btn-dark" title="Refrescar filtro" onclick="cargarfiltro_2()"><h2 class="titulo">Refrescar</h2></a>
					</div>
					<div class="seccion2" style="flex:0 1 80%;width:100%">
					  	<div class="form-group row busqueda"  style="display:flex;padding-top:5px;justify-content:center;margin:auto;5px;padding-bottom:20px;width:100%">

							<div class="col-md-10" style="padding:0; padding-right:10px;">
							<input type="text" class="form-control" style="" id="q3" placeholder="Buscar productos" onkeyup="loadpromo(1)" onkeydown="loadpromo(1)" >
							</div>
							<button type="button" class="col-md-2 btn btn-dark" onclick="loadpromo(1)"><span class='glyphicon glyphicon-search'></span> Buscar</button>
					  </div>
					  	<div class="mensajepromo alert alert-primary promociones" role="alert">
						  <div class="promo1 mensaje" style="flex:0 1 70%; width:100%; margin:auto;">
						  </div>
						</div>
						<div id="loaderpromo" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"><div class="preloader"></div></div><!-- Carga gif animado -->
						<div class="outer_divpromo" id="outer_divpromo"></div><!-- Datos ajax Final -->
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
					
				  </div>
				</div>
			  </div>
			</div>
	<?php
		}
	?>