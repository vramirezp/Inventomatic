$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});

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
    $(document).on('click', '#iniciar', function(e){
    	e.preventDefault();
		var parametros = $('#formLogin').serializeArray();

		if(ComprobarCampos(parametros) == true)
    	{
		    var datos = new FormData();
		
			$.each(parametros, function(index, item) 
			{
				datos.append(item.name, item.value);
			});

		    $.ajax({				
				url : 'modules/login.module.php',
				type: 'post',
				dataType: 'html',
				cache: false,
				processData: false,
				contentType:false,				
				data: datos,
				success: function(data) {
					console.log(data+"1");
				console.log(parametros);
					if(data == true)
					{
						swal({
							type: 'success',
							html: 'Sesión iniciada correctamente ',
							title: 'Éxito',
						}).then((result) => {
							location.href ="index.php";							
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
			});
		}
    });

    $(document).on('click', '#cerrarSesion', function(e){
    	e.preventDefault();
		//parametros = new Array({'funcion': 2});
		var datos = new FormData();
		datos.append('funcion', 2);
		console.log(datos);
	    $.ajax({
			
			url : 'modules/login.module.php',
			type: 'post',
			dataType: 'html',
			cache: false,
			processData: false,
			contentType:false,
			
			data: datos,
			success: function(data) {
				console.log(data);
				location.href ="login.php";	
			}
		});
    });
});