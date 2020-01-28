/*Necesaria para la busqueda!*/
function ActualizarLista(parametros, pagina = 1)
{
	$('#listaPermisos').html('<div class="text-center"><img src="imagenes/loading.gif"></div>');
    parametros['funcion'] = 2;

    parametros['pagina'] = pagina;
	$.post("modules/agregarPermiso.module.php", parametros, function(data){
		//console.log($('codigo'));
		if(data != false)
		{
			$('#codigoF').val("");			
			$('#listaPermisos').html(data);

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
			$('#listaPermisos').html("<div class='text-center'>Sin Resultados</div>");
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

//AL ENTRAR AL INFORME de ajuste
	var pagina = $('#pagina').val();
	ActualizarLista({}, pagina);

    /*AGREGAR TIPOS DE PERMISOS*/
    $(document).on('click', '#agregar', function(e){
    	e.preventDefault();
		var parametros = $('#formularioAgregarPermiso').serializeArray();

		if(ComprobarCampos(parametros) == true)
    	{

			$.post("modules/agregarPermiso.module.php", parametros, function(data){
				console.log(parametros);
				console.log("formularioAgregarPermiso");
				if(data == true)
				{
					swal({
						type: 'success',
						html: 'Permiso agregado correctamente',
						title: 'Éxito',
					}).then((result) => {
					ActualizarLista({}, pagina);
					location.reload();	
					});
					$.each($("#formularioAgregarPermiso input"), function() {
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

    $(document).on('click', '#buscar', function(e){
    	e.preventDefault();
		
		
		var parametros = $('#buscarPermisos').serializeArray();//

		ActualizarLista(parametros, pagina);
    });

    $(document).on('click', '#mTodos', function(e){
    	e.preventDefault();

		ActualizarLista({}, pagina);
    });
	
    
	//MODIFICAR
	$(document).on('click', '#Modificar', function(e){
    	e.preventDefault();
		var paginaV = $('#pagina').val();

		
		var parametros = $('#formularioModificarPermiso').serializeArray();//

		if(ComprobarCampos(parametros) == true)
    	{
    		
			var _this = this;
			$.post("modules/agregarPermiso.module.php", parametros, function(data){
				if(data == true)
				{
					swal({
						type: 'success',
						title: 'Permiso modificado correctamente',
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
			$.post("modules/agregarPermiso.module.php", parametros, function(data){
				if(data == true)
				{
					swal({
						type: 'success',
						title: 'Permiso eliminado correctamente',
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
    $(document).on('click', '#cancelar', function(e){
    	e.preventDefault();
    	parent.$.fancybox.close();
    	$("#link_pagina").val("");
    	$("#nombre_permiso").val("");
    	$("#descrip_permiso").val("");
    	$("#link_pagina").val("");
    });
});