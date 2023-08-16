<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>InfoBI</title>

<!-- Bootstrap -->
<link href="./vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="./vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="./vendors/nprogress/nprogress.css" rel="stylesheet">
<!-- Animate.css -->
<link href="./vendors/animate.css/animate.min.css" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="./build/css/custom.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body class="login">
<div> <a class="hiddenanchor" id="signup"></a> <a class="hiddenanchor" id="signin"></a>
  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <form class="form_login" id="resetPassword">
          <h1>
            <p>Recuperación de Contraseña</p>
          </h1>
          <div class="small mb-3 text-muted">
            <h6>Ingrese su dirección de correo electrónico y le enviaremos su nueva contraseña.</h6>
          </div>
          <div>
            <input type="email" class="form-control" placeholder="Correo" required  id="correo" name="correo" value="" autofocus/>
          </div>
          <div id="mensajeError" class="alert alert-danger" role="alert"> </div>
          <div>
          <a class="small" href="index.php">Regresar al Login</a>
          <button type="button" class="btn btn-primary" onclick="Guardar()" />
          Restablecer la Contraseña
          </div>
          <div class="clearfix"></div>
          <div class="separator">
            <p class="change_link"></p>
            <div class="clearfix"></div>
            <br />
            <div>
              <h1><i class="fa fa-archive"></i> InfoBI</h1>
              <p>©2023 Todos los derechos reservados.</p>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
$(document).ready(function(){
$("#mensajeError").hide();
});


$("#resetPassword").validate({
		rules: {
			correo: { required:true,  email: true, minlength: 10},
		},
		messages: {
			correo : "El campo correo es obligatorio y debe tener formato de email correcto.",
		},
		errorElement: "div",
        errorLabelContainer: ".alert-danger"
	});


function Guardar() {
$("#mensajeError").text("").hide();
if (!$('#resetPassword').valid())
{
	return;
}
	
var data = {
				correo: $("#correo").val()
            }

$.ajax({
        type:'POST',
        url: './php/resetPassword.php',
        data: data,
        dataType: 'json',
        async: true,
    })
    .done(function ajaxDone(res){
       if(res.resultado != 0)
		{
			swal("Buen Trabajo!", res.mensaje, "success")
			.then((value) => {
				  window.location = 'index.php';
			});
				
			return false;
		}
		else
		{
			swal("Información", res.mensaje, "info")
			$("#mensajeError").text("Revise los datos ingresados.").show();
		}
    })
    .fail(function ajaxError(e){
        console.log(e);
    })
    .always(function ajaxSiempre(){
        console.log('Final de la llamada ajax.');
    })
    return false;
}
</script>