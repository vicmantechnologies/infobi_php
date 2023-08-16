<?php
require_once('../layout/plantilla.php');
require_once('./funcionesData.php');
head();
initBody();
topMenu();
sideBar();
menuFooter();
topNavigation();
IniContenido("Cambio de Contraseña");
?>

<form id="formPassword" data-parsley-validate class="form-horizontal form-label-left">
  <input id="idUsuario" type="hidden" value="<?php echo $_SESSION['user_id']?>" readonly/>
  <div class="item form-group">
    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Usuario<span class="required">*</span> </label>
    <div class="col-md-6 col-sm-6 ">
      <input type="text" id="first-name" required class="form-control" readonly value="<?php echo $_SESSION['nombre']?>" >
    </div>
  </div>
  <div class="item form-group">
    <label class="col-form-label col-md-3 col-sm-3 label-align" for="passActual">Contraseña Actual<span class="required">*</span> </label>
    <div class="col-md-6 col-sm-6 ">
      <input type="text" id="passActual" name="passActual" required class="form-control">
    </div>
  </div>
  <div class="item form-group">
    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Nueva Contraseña</label>
    <div class="col-md-6 col-sm-6 ">
      <input id="passNuevo" class="form-control" type="password" name="passNuevo">
    </div>
  </div>
  <div class="item form-group">
    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Confirmar Contraseña</label>
    <div class="col-md-6 col-sm-6 ">
      <input id="passConfirm" class="form-control" type="password" name="passConfirm">
    </div>
  </div>
  <div class="ln_solid"></div>
  <div class="row mt-2">
    <div class="col-12">
      <div id="mensajeError" class="alert alert-danger" role="alert"> </div>
    </div>
  </div>
  <div class="item form-group">
    <div class="col-md-6 col-sm-6 offset-md-3">
      <button type="button" class="btn btn-success" onclick="Guardar()">Actualizar</button>
      <button class="btn btn-secondary" type="reset">Borrar Campos</button>
      <button class="btn btn-primary" type="button" onclick="location.href='admin.php';">Cancelar</button>
    </div>
  </div>
</form>
<?php
finContenido();
footer();
?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script> 
<script>
$(document).ready(function() {
$("#mensajeError").hide();
});

$("#formPassword").validate({
		rules: {
			passActual: { required: true, minlength: 8, maxlength: 20},
			passNuevo: { required: true, minlength: 8, maxlength: 20},
			passConfirm: { required: true, minlength: 8, maxlength: 20},
		},
		messages: {
			passActual: "La contraseña actual es requerida.",
			passNuevo : "Debe ingresar una nueva contraseña.",
			passConfirm : "Debe confirmar la contraseña.",
		},
		errorElement: "div",
        errorLabelContainer: ".alert-danger"
	});
	
function Guardar() {
if (!$('#formPassword').valid())
{
	return;
}

var pass1 = $('#passNuevo').val();
var pass2 = $('#passConfirm').val();
if(pass1 != pass2)
{
	$("#mensajeError").text("Las contraseñas no coinciden").show();
	return;
}
		
var Usuario = {
				id: $("#idUsuario").val(),
                clave: $("#passActual").val(),
                nuevaClave: $("#passNuevo").val(),
				tipoAccion: "password",
            }
$.ajax({
        type:'POST',
        url: './CapaDatos/cambiarContrasena.php',
        data: Usuario,
        dataType: 'json',
        async: true,
    })
    .done(function ajaxDone(res){
       if(res.resultado != 0)
		   {
				swal("Buen Trabajo!", res.mensaje, "success");
				$("#passActual").val("");
				$("#passNuevo").val("");
				$("#passConfirm").val("");
			   return false;
		   }
		   else
		   {
			   swal("Revise los datos ingresados", res.mensaje, "info")
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