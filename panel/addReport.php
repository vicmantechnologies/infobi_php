<?php
require_once('../layout/plantilla.php');
require_once('./funcionesData.php');
head();
initBody();
topMenu();
sideBar();
menuFooter();
topNavigation();
IniContenido("Agregar Informe");
?>

<form id="addInforme" data-parsley-validate>
  <label for="nomInforme">Nombre Informe* :</label>
  <input type="text" id="nomInforme" class="form-control" name="nomInforme" required onKeyUp="this.value=this.value.toUpperCase()"/>
  <label for="urlInforme">Link Informe * :</label>
  <input type="text" id="urlInforme" class="form-control" name="urlInforme" data-parsley-trigger="change" required />
  <br>
  <label>Asignar Reporte (minimo un usuario):</label>
  <?php echo $data = listarUsuarios2();?>
  <div class="row mt-2">
    <div class="col-12">
      <div id="mensajeError" class="alert alert-danger" role="alert"> </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" onclick="Guardar()">Guardar</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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


$("#addInforme").validate({
		rules: {
			nomInforme: { required: true, minlength: 6},
			urlInforme: { required: true, minlength: 8},
			"usuarios[]": { required: true, minlength: 2}
		},
		messages: {
			nomInforme: "El nombre de informe no cumple con los requisitos minimos.",
			urlInforme : "El campo url es obligatorio.",
			"usuarios[]" : "El campo check es obligatorio."
		},
		errorElement: "div",
        errorLabelContainer: ".alert-danger"
	});


function Guardar() {
var chequeados = 0;
$(".js-switch").each(function(index){
	if($(this).is(':checked'))
	{
        chequeados++;
	}
});

if(chequeados <= 0)
{
	$("#mensajeError").text("Debe seleccionar por lo menos un usuario.").show();
	return;
}
else
{
	$("#mensajeError").text("").show();
}

if (!$('#addInforme').valid())
{
	return;
}		
var Informe = {
                informe: $("#nomInforme").val(),
                url: $("#urlInforme").val(),
                usuarios: $('.js-switch:checked').serializeArray()
            }
$.ajax({
        type:'POST',
        url: './CapaDatos/nuevoInforme.php',
        data: Informe,
        dataType: 'json',
        async: true,
    })
    .done(function ajaxDone(res){
       console.log(res);
	   if(res.resultado != 0)
		{
			swal("Buen Trabajo!", res.mensaje, "success").then((value) => {location.reload()});
			//$("#addInforme")[0].reset();
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




/*$.ajax({
        type:'GET',
        url: './CapaDatos/listarUsuarios.php',
        dataType: 'json',
        async: true,
    })
    .done(function ajaxDone(res){
		var con = 0;
		$.each(res.data, function(i, item) {
			console.log(item);
			$('#usuarios').append('<input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat"/>').append(item.nombre +'<br />');
		});
		
	   
        
    })
    .fail(function ajaxError(e){
        console.log(e);
    })
    .always(function ajaxSiempre(){
        console.log('Final de la llamada ajax.');
    })*/

</script>