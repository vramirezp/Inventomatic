/*Necesaria para la busqueda!*/
function ActualizarLista(fun,tipo_lista,parametros)
{
	$(tipo_lista).html('<div class="text-center"><img src="imagenes/loading.gif"></div>');
	parametros['funcion'] = fun;
	$.post("modules/perdidas.module.php", parametros, function(data){
		//console.log(data);
		if(data != false)
		{
			$('#codigoF').val("");			
			$(tipo_lista).html(data);

		}
    	else
    	{
    		$('#codigoF').val("");			
			$(tipo_lista).html("<div class='text-center'>Sin productos</div>");
    	}
    });
}

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

	//AL ENTRAR AL INFORME GENERAL
	ActualizarLista(1,'#listaPerdidas',{});
	ActualizarLista(2,'#listaEliminados',{});

	//BUSCAR 1
	$(document).on('click', '#mTodos1', function(e){
    	e.preventDefault();
    	ActualizarLista(1,'#listaPerdidas',{});
    });

	$(document).on('click', '#buscar1', function(e){
    	e.preventDefault();
		var parametros = $('#buscarProducto1').serializeArray();//

		ActualizarLista(1,'#listaPerdidas',parametros);
    });

   	//BUSCAR 2
	$(document).on('click', '#mTodos2', function(e){
    	e.preventDefault();
    	ActualizarLista(2,'#listaEliminados',{});
    });

	$(document).on('click', '#buscar2', function(e){
    	e.preventDefault();
		var parametros = $('#buscarProducto2').serializeArray();//

		ActualizarLista(2,'#listaEliminados',parametros);
    });

});