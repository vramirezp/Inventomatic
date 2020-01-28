/*Necesaria para la busqueda!*/
function ActualizarLista(parametros, pagina = 1)
{
	$('#listaProductos').html('<div class="text-center"><img src="imagenes/loading.gif"></div>');
    parametros['funcion'] = 1;

    parametros['pagina'] = pagina;
	$.post("modules/ajuste.module.php", parametros, function(data){
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

function dato()
{
	return $("#test").val();
}

$(document).ready(function(){

	//AL ENTRAR AL INFORME de ajuste
	var pagina = $('#pagina').val();
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
	$(document).on('click', '#ajustarStock', function(e){
    	e.preventDefault();
		console.log("ENTRAR");
		var parametros = {};
		//var parametros = $('#formularioAjustar').serializeArray();
		var id_producto = $("#id").val();//$(this).attr('id_producto');
    	
		var valor = $("#NewStock").val();

		console.log(valor);

		parametros['funcion'] = 2;
		parametros['id'] = id_producto;
		parametros['valor'] = valor;
		parametros['motivo'] = $("#razon").val();
		console.log(parametros);
		$.post("modules/ajuste.module.php", parametros, function(data){
			if(data == true)
			{
				swal({
					type: 'success',
					title: 'Producto modificado correctamente',
				}).then((result) => {//PARA REDIRIGIR
					parent.location.reload();
					parent.$.fancybox.close();
					//parent.ActualizarLista({}, pagina);
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
		
    });

});