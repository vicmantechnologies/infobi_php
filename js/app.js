$(document).on("submit", ".form_login", function(event){
    event.preventDefault();
    var $form = $(this);
	var a = $("#correo").val();
	
    var data_form = {
        email: $("#correo").val(),
        password: $("#contrasena").val()
    }
    if(data_form.email.length < 6 ){
        $("#mensajeError").text("Necesitamos un email valido.").show();
        return false;        
    }else if(data_form.password.length < 8){
		console.log(a);
		$("#mensajeError").text("Tu password debe ser minimo de 8 caracteres.").show();
        return false;   
    }
    $("#mensajeError").hide();
    var url_php = 'php/procesar_login.php';

    $.ajax({
        type:'POST',
        url: url_php,
        data: data_form,
        dataType: 'json',
        async: true,
    })
    .done(function ajaxDone(res){
       console.log(res); 
       if(res.error !== undefined){
            $("#mensajeError").html(res.error).show();
            return false;
       } 
       if(res.redirect !== undefined){
           window.location = res.redirect;
       }
    })
    .fail(function ajaxError(e){
        console.log(e);
    })
    .always(function ajaxSiempre(){
        console.log('Final de la llamada ajax.');
    })
    return false;
});



