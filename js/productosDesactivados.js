/*Necesaria para la busqueda!*/
function ActualizarLista(parametros, pagina)
{
	$('#listaProductos').html('<div class="text-center"><img src="imagenes/loading.gif"></div>');
    parametros['funcion'] = 4;

    parametros['pagina'] = pagina;
	$.post("modules/informegeneral.module.php", parametros, function(data){
		//console.log(data);
		if(data != false)
		{
			$('#codigoF').val("");			
			$('#listaProductos').html(data);

		}
    	else
    	{
    		$('#codigoF').val("");			
			$('#listaProductos').html("<div class='text-center'>Sin productos</div>");
			//ActualizarLista({});
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

	var pagina = $('#pagina').val();
	//AL ENTRAR AL INFORME GENERAL
	ActualizarLista({}, pagina);


	//BUSCAR
	$(document).on('click', '#mTodos', function(e){
    	e.preventDefault();

		ActualizarLista({}, pagina);
    });
	$(document).on('click', '#buscar', function(e){
    	e.preventDefault();
		
		
		var parametros = $('#buscarProducto').serializeArray();//

		ActualizarLista(parametros, pagina);
    });

    //ACTIVAR
	$(document).on('click', '#activar', function(e){
    	e.preventDefault();
		
		
		var parametros = $('#formularioActivar').serializeArray();//

		if(ComprobarCampos(parametros) == true)
    	{
    		
			var _this = this;
			$.post("modules/informegeneral.module.php", parametros, function(data){
				if(data == true)
				{
					swal({
						type: 'success',
						title: 'Producto activado correctamente',
					}).then((result) => {//PARA REDIRIGIRs
						parent.location.reload();
						parent.$.fancybox.close();
					});
					
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

});
