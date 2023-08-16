function Delete_frame(id, user) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
                $.ajax({  
                     url:"../php/delete_frame.php?q="+id,  
                     method:"POST",  
                     success:function(data){ 
                          $('#get_frameModal').load("../php/get_frame.php?q="+user);
                     }  
                });
}

$(document).on("submit", "#add", function(event){
    event.preventDefault();
    var $form = $(this);
   
    var data_form = {
        email: $("input[type='email']",$form).val(),
        password: $("input[type='password']", $form).val(),
        area: $("input[name='area']", $form).val(),
        perfil: $("select[name='perfil']", $form).val(),
        name: $("input[name='name']", $form).val(),
        cargo: $("input[name='cargo']", $form).val()
    }
    if(data_form.email.length < 6 ){
        $("#msg_error").text("Necesitamos un email valido.").show();
        return false;        
    }else if(data_form.password.length < 8){
        $("#msg_error").text("La contraseña debe ser minimo de 8 caracteres.").show();
        return false;   
    }else if(data_form.name.length < 6){
        $("#msg_error").text("Necesitamos un nombre completo.").show();
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
function Add_frame(id) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
                $.ajax({  
                     url:"../php/insert_frame.php?q="+id,  
                     method:"POST",  
                     success:function(data){  
                          $('#get_frameModal').load("../php/get_frame.php?q="+id);
                     }  
                });
}
$(document).on("submit", "#edit", function(event){
    event.preventDefault();
    var $form = $(this);
   
    var data_form = {
        email: $("input[type='email']",$form).val(),
        password: $("input[type='password']", $form).val(),
        area: $("input[name='area']", $form).val(),
        perfil: $("select[name='perfil']", $form).val(),
        identificador: $("input[name='id']", $form).val(),
        nombre: $("input[name='name']", $form).val(),
        cargo: $("input[name='cargo']", $form).val()
    }
    if(data_form.email.length < 6 ){
        alert('Necesitamos un email valido.');
        return false;        
    }else if(data_form.password.length < 8){
        alert('La contraseña debe ser minimo de 8 caracteres.');
        return false;   
    }else if(data_form.nombre.length < 6){
        alert('Necesitamos un nombre completo.');
        return false; 
    }
    $("#alerta").hide();
    $("#msg_error").hide();
      $.ajax({
        type:'POST',
        url: '../php/update_user.php',
        data: data_form,
        dataType: 'json',
        async: true,
        success:function(res){
          if(res = 1){
            alert('¡Exito!.');
            $('#usuarios').load("../php/get_user.php");
          }else{
            alert('Correo duplicado');
          }
        }
    })
    return false;
});