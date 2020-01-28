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

/*Necesaria para la busqueda!*/
function ActualizarLista(parametros, pagina)
{
	$('#listaProductos').html('<div class="text-center"><img src="imagenes/loading.gif"></div>');
    
    parametros['funcion'] = 1;

    parametros['pagina'] = pagina;
	$.post("modules/informegeneral.module.php", parametros, function(data){
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

$(document).ready(function(){


    /*MODIFICAR CANTIDAD RAPIDA*/
    $(document).on('click', '#guardar3', function(e){
    	e.preventDefault();
		var parametros = $('#formularioAddRapido').serializeArray();

		if(ComprobarCampos(parametros) == true)
    	{

			$.post("modules/agregarInventario.module.php", parametros, function(data){
				//console.log(data);
				console.log("formularioAddRapido");
				if(data == true)
				{
					swal({
						type: 'success',
						html: 'Stock agregado correctamente',
						title: 'Éxito',
					}).then((result) => {

						ActualizarLista({});
						location.reload();
						
					});
					$.each($("#formularioAddRapido input"), function() {
						if($(this).attr('name') != 'funcion')
						{
							$(this).val("");
						}
					});
					
				}
				else
				{
					swal({
						type: 'error',
							html: data,
							title: 'Ups, ocurrio un error',
					});
				}
		    });
		}
    });
   

        $(document).on('click', '#agregar', function(e){
    	e.preventDefault(); //Evitar que se envie el formulario hasta que procese todo el contenido
		
		var parametros = $("#formularioAgregarTipo").serializeArray();
		var datos = new FormData();
		
		$.each(parametros, function(index, item) 
		{
			datos.append(item.name, item.value);
		});
		
		if(ComprobarCampos(parametros) == true)
    	{
			
			$.ajax({
				
				url : 'modules/agregarInventario.module.php',
				type: 'post',
				dataType: 'html',
				cache: false,
				processData: false,
				contentType:false,
				
				data: datos,
				success: function(data) {
					console.log("formularioAgregarTipo");
					if(data == true)
					{
						swal({
							type: 'success',
							html: 'Producto agregado correctamente',
							title: 'Éxito',
						}).then((result) => {
							//ActualizarLista({}, pagina);
							location.reload();
							$.each($("#formularioAgregarTipo input"), function() {
								if($(this).attr('name') != 'funcion')
								{
									$(this).val("");
								}
							});
						});
						
						
					}
					else
					{
						if (data == 'redi') 
						{
							swal({
								type: 'error',
								html: 'El producto ya existe pero esta desactivado, se rediccionará a la pestaña para reactivar Producto',
								title: 'Producto existente',
							}).then((result) => {//PARA REDIRIGIR
							//location.reload();
								window.location.href = 'productos_desactivados.php';
							});
						}
						else
						{
							swal({
								type: 'error',
								html: data,
								title: 'Ups, ocurrio un error',
							});
						}						
					}
				}
			});
			
		}
    });
	


});

