function ActualizarDatos() {


    var cantidad_sumar = 0;
	$('*[id*=cantidad_sumar]').each(function() {
		cantidad_sumar = cantidad_sumar + parseInt($(this).html());
	});
    $("#total_items").html(cantidad_sumar);
}

function ActualizarListaVentas(parametros)
{
	$('#listaVentas').html('<div class="text-center"><img src="imagenes/loading.gif"></div>');
    parametros['funcion'] = 1;
	$.post("modules/devolucion.module.php", parametros, function(data){
		if(data != false)
		{
			$('#codigoF').val("");			
			$('#listaVentas').html(data);
			ActualizarDatos();
		}
    	else
    	{
			$('#codigoF').val("");			
			$('#listaVentas').html("");
			ActualizarDatos();
    	}
    });
}



/*Comprobar los campos no esten vacios*/
function ComprobarCampos(parametros)
{
	var puede = true;
	jQuery.each( parametros, function( i, campo ) {
		if(campo.value.length == 0) 
		{
			swal({
				type: 'error',
				html: 'Campos vacios, rellene',
				title: 'Ups, ocurrio un error',
			});
			puede = false;
		}
	});
	return puede;
}

$(document).ready(function(){


	ActualizarListaVentas({});

	$("#codigoF").on("keyup", function() {
		console.log("pulsa");
    	if ($("#codigoF").val().length >=13) {
			var obj= $("#devolverLista");

			obj.click();
		}
	});


	
	//Devolver la mierda
	$(document).on('click', '#devolverProducto', function(e){
    	e.preventDefault();
		var parametros = $('#agregarProductoLista').serializeArray();
		if(ComprobarCampos(parametros) == true)
    	{
			$.post("modules/devolucion.module.php", parametros, function(data){
				if(data == true)
				{
					ActualizarListaVentas({});
					$("#cantidad").val(1);
					document.getElementById('codigoF').focus();
				}
				else
				{
					swal({
						type: 'error',
						title: data,
					});
				}
		    });
		}
		
    });

    //Devolver la mierda
	$(document).on('click', '#eliminar_item', function(e){
    	e.preventDefault();
		var parametros = {};
		var id_prod = $(this).attr('id_producto');

		parametros['funcion'] = 2;
		parametros['id'] = id_prod;

		var _this = this;
		$.post("modules/devolucion.module.php", parametros, function(data){
			if(data == true)
			{
				ActualizarListaVentas({});
				
			}
			else
			{
				swal({
					type: 'error',
					title: data,
				});
			}
	    });
		
    });



});