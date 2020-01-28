/*Necesaria para la busqueda!*/
function ActualizarLista(parametros, pagina)
{
	$('#listaProductos').html('<div class="text-center"><img src="imagenes/loading.gif"></div>');
    parametros['funcion'] = 1;

    parametros['pagina'] = pagina;
	$.post("modules/informegeneral.module.php", parametros, function(data){
		//console.log(data);
		if(data != false)
		{
			$('#codigoF').val("");			
			$('#listaProductos').html(data);

			$.fn.dataTable.ext.errMode = 'none';
			$('#tablasMax').DataTable( {
		        "language":
		        {
		             "search": 		   "Buscar",
		             "lengthMenu":     "Mostrar _MENU_ resultados",
		             "info":           "",
		          	 "paginate":
		          	 {
					     "first":      "Primera",
					     "last":       "Ultima",
					     "next":       "Siguente",
					     "previous":   "Anterior"
		    		 },
		             "infoEmpty": "No se encuentran datos"
		        }
		    } );
		}
    	else
    	{
    		$('#codigoF').val("");			
			$('#listaProductos').html("<div class='text-center'>Sin productos</div>");
			//ActualizarLista({});
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
	

	//MODIFICAR
	$(document).on('click', '#guardar', function(e){
    	e.preventDefault();
		var paginaV = $('#pagina').val();

		
		var parametros = $('#formularioModificar').serializeArray();//

		if(ComprobarCampos(parametros) == true)
    	{
    		
			var _this = this;
			$.post("modules/informegeneral.module.php", parametros, function(data){
				if(data == true)
				{
					swal({
						type: 'success',
						title: 'Producto modificado correctamente',
					}).then((result) => {//PARA REDIRIGIR
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

	
	//ELIMINAR
	$(document).on('click', '#eliminar', function(e){
    	e.preventDefault();
		
		
		var parametros = $('#formularioEliminar').serializeArray();//

		if(ComprobarCampos(parametros) == true)
    	{
    		
			var _this = this;
			$.post("modules/informegeneral.module.php", parametros, function(data){
				if(data == true)
				{
					swal({
						type: 'success',
						title: 'Producto eliminado correctamente',
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