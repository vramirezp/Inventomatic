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
	$.post("modules/prestamo.module.php", parametros, function(data){
		if(data != false)
		{
			$('#codigoF').val("");			
			$('#listaVentas').html(data);
			ActualizarDatos();
		}
    	else
    	{
    		/*swal({
				type: 'error',
				html: 'Producto no encontrado',
				title: 'Ups, ocurrio un error',
			});*/
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


	//AGREGAR A LA LISTA
	$(document).on('click', '#agregarLista', function(e){
    	e.preventDefault();
		
		var parametros = $('#agregarProductoLista').serializeArray();//

		if(ComprobarCampos(parametros) == true)
    	{
			$.post("modules/prestamo.module.php", parametros, function(data){
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
		}
    });

	
	//ELIMINAR
	$(document).on('click', '#eliminar_item', function(e){
    	e.preventDefault();
		var parametros = {};
		var id_prod = $(this).attr('id_producto');

		parametros['funcion'] = 2;
		parametros['id'] = id_prod;

		var _this = this;
		$.post("modules/prestamo.module.php", parametros, function(data){
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

	//CANCELAR
	$(document).on('click', '#cancelarC', function(e){
    	e.preventDefault();
		
		var parametros = {};

		parametros['funcion'] = 4;

		

		var answer = '¿Estás seguro de anular el prestamo completo?',
			cancel = 'Cancelar',
			accept = 'Aceptar';
		
		swal({
			title: answer,  
			type: "warning",
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: accept,
			cancelButtonText: cancel
		}).then((result) => {
			$.post("modules/prestamo.module.php", parametros, function(data){
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
    //guardar
	$(document).on('click', '#guardar3', function(e){
    	e.preventDefault();
		
		var parametros = {};

		parametros['funcion'] = 5;

		
		var answer = '¿Estás seguro del prestamo que  realizará?',
			cancel = 'Cancelar',
			accept = 'Aceptar';
		
		swal({
			title: answer,  
			type: "warning",
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: accept,
			cancelButtonText: cancel
		}).then((result) => {
			$.post("modules/prestamo.module.php", parametros, function(data){
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
});