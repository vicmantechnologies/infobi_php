$(document).on("submit", "#add", function(event){
    event.preventDefault();
    var $form = $(this);
   
    var data_form = {
        email: $("input[type='email']",$form).val(),
        password: $("input[type='password']", $form).val(),
        user: $("input[name='user']", $form).val(),
        perfil: $("select[name='perfil']", $form).val()
    }
    if(data_form.email.length < 6 ){
        $("#msg_error").text("Necesitamos un email valido.").show();
        return false;        
    }else if(data_form.password.length < 8){
        $("#msg_error").text("La contraseña debe ser minimo de 8 caracteres.").show();
        return false;   
    }
    $("#alerta").hide();
    $("#msg_error").hide();
    var url_php = '../php/insertarU.php';

    $.ajax({
        type:'POST',
        url: url_php,
        data: data_form,
        dataType: 'json',
        async: true,
        success:function(res){ 
        if(res != ""){
            if(res.save !== undefined){
            $("#alerta").html(res.save).show();
            $('#usuarios').load("../php/get_user.php");
            document.getElementById("add").reset();
            return false;
       }
        if(res.error !== undefined){
            $("#msg_error").html(res.error).show();
            return false;
       }
        }   
        }
    })
    .fail(function ajaxError(e){
        console.log(e);
    })
    .always(function ajaxSiempre(){
        console.log('Final de la llamada.');
    })
    return false;
});
//-------------- REGISTRAR iFRAME

