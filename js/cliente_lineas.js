		$(document).ready(function() {
		    load(1);
		});

		function load(page) {
		    var q = $("#q").val();
		    $("#loader").fadeIn('slow');
		    $.ajax({
		        url: './ajax/buscar_cliente_lineas.php?action=ajax&page=' + page + '&q=' + q,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            $(".outer_div").html(data).fadeIn('slow');
		            $('#loader').html('');

		        }
		    })
		}

		function eliminar(id, idLinea ) {
		    var q = $("#q").val();
		    if (confirm("Realmente deseas eliminar la linea de negocio asigna al cliente")) {
		        $.ajax({
		            type: "GET",
		            url: "./ajax/buscar_cliente_lineas.php",
					data: "id="+id+"&idLinea="+idLinea,
		            "q": q,
		            beforeSend: function(objeto) {
		                $("#resultados").html("Mensaje: Cargando...");
		            },
		            success: function(datos) {
						$("#resultados").html(datos);
						location.reload();
		                load(1);
		            }
		        });
		    }
		}

		$("#guardar_cliente_linea").submit(function(event) {
		    $('#guardar_datos').attr("disabled", true);

		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "ajax/nuevo_cliente_linea.php",
		        data: parametros,
		        beforeSend: function(objeto) {
					$("#resultados_ajax").html("Mensaje: Cargando...");
					setInterval(() => {
						location.reload();
					}, 500);
		        },
		        success: function(datos) {
		            $("#resultados_ajax").html(datos);
		            $('#guardar_datos').attr("disabled", false);
		            load(1);
		        }
		    });
		    event.preventDefault();
		})

		$("#editar_cliente_linea ").submit(function(event) {
		    $('#actualizar_datos').attr("disabled", true);

		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "ajax/editar_cliente_linea.php",
		        data: parametros,
		        beforeSend: function(objeto) {
					$("#resultados_ajax2").html("Mensaje: Cargando...");
					setInterval(() => {
						location.reload();
					}, 500);
		        },
		        success: function(datos) {
		            $("#resultados_ajax2").html(datos);
		            $('#actualizar_datos').attr("disabled", false);
		            load(1);
		        }
		    });
		    event.preventDefault();
		})

		function obtener_datos(id, id_linea, status_linea) {

		    $("#mod_id_cliente").val(id);
		    $("#mod_id_linea").val(id_linea);
		    $("#mod_estado").val(status_linea);
		    $("#mod_id_cliente").attr('readonly', true);
		    $("#mod_id_linea").attr('readonly', true);

		}