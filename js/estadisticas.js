/*Necesaria para la busqueda!*/
function ActualizarLista(fun,tipo_lista,parametros)
{
	$(tipo_lista).html('<div class="text-center"><img src="imagenes/loading.gif"></div>');
	parametros['funcion'] = fun;
	$.post("modules/estadisticas.module.php", parametros, function(data){
		//console.log(data);
		if(data != false)
		{		
			$(tipo_lista).html(data);
		}
    	else
    	{			
			$(tipo_lista).html("<div class='text-center'>Sin productos</div>");
    	}
    });
}

$(document).ready(function(){

	//AL ENTRAR AL INFORME GENERAL
	ActualizarLista(1,'#lista1',{});
	ActualizarLista(2,'#lista2',{});
	ActualizarLista(3,'#lista3',{});
	ActualizarLista(4,'#lista4',{});
});