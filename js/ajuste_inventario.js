/*Necesaria para la busqueda!*/
function ActualizarLista(parametros, pagina = 1)
{
	$('#ListarReporteUsuarios').html('<div class="text-center"><img src="imagenes/loading.gif"></div>');
    parametros['funcion'] = 1;

    parametros['pagina'] = pagina;
	$.post("modules/ajuste_historico.module.php", parametros, function(data){
		//console.log($('codigo'));
		if(data != false)
		{
			$('#codigoF').val("");			
			$('#ListarReporteUsuarios').html(data);

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
			$('#ListarReporteUsuarios').html("<div class='text-center'>Sin Resultados</div>");
			//ActualizarLista({});
    	}
    });
}

$(document).ready(function(){

//AL ENTRAR AL INFORME de ajuste
ActualizarLista({}, 1);
	
	$(document).on('click', '#mTodos', function(e){
	e.preventDefault();

	ActualizarLista({},1);
    });


	$(document).on('click', '#buscar', function(e){
	e.preventDefault();
	
	
	var parametros = $('#buscarx').serializeArray();//

	ActualizarLista(parametros,1);
});

	
});