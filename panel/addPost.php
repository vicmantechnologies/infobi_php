<?php
require_once('../layout/plantilla.php');
require_once('./funcionesData.php');
head();
initBody();
topMenu();
sideBar();
menuFooter();
topNavigation();
IniContenido("Cargos registrados");
?>

<div class="row">
  <div class="col-12">
    <button type="button" class="btn btn-success" onclick="abrirModal()"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear Nuevo Cargo</button>
  </div>
</div>
<hr />
<div class="x_content">
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box table-responsive">
        <p class="text-muted font-13 m-b-30"> Listado de cargos registrados en InfoBI</p>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>NOMBRE DEL CARGO</th>
              <th>ACTIVO</th>
              <th>ACCION</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Small modal -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="FormModal">
  <div class="modal-dialog modal-sm8">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel2">Cargo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span> </button>
      </div>
      <div class="modal-body">
        <input id="id" type="hidden" value="0" readonly />
        <form id="formcargo"  >
          <div class="col-sm-6">
            <label for="nom_cargo" class="form-label">Nombre Cargo</label>
            <input type="text" class="form-control" id="nom_cargo" name="nom_cargo" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase()">
          </div>
          <div class="col-sm-6">
            <label for="cbEstado" class="form-label">Activo</label>
            <select name="cbEstado" class="form-control" id="cbEstado" aria-label="Default select example">
              <option value="1">SI</option>
              <option value="0">NO</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="Guardar()">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
        <div class="row mt-2">
          <div class="col-12">
            <div id="mensajeError" class="alert alert-danger" role="alert"> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
finContenido();
footer();
?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script> 
<script>
var tabladata;
var filaSeleccionada;

tabladata = $("#datatable-responsive").DataTable({
            responsive: true,
            ordering: false,
            "ajax": {
                url: './CapaDatos/listPost.php',
                type: "GET",
                dataType: "json"
            },
            "columns": [
                { "data": "id" },
                { "data": "nombre_cargo" },
                { "data": "estado", "render": function (valor) {
                        if (valor=="1") {
                            return '<span class="badge bg-success">SI</span>'
                        }
                        else {
                            return '<span class="badge bg-danger">NO</span>'
                        }
                    }
                },
				{
                    "defaultContent": '<button type="button" class="btn btn-primary btn-sm btn-editar"><i class="fa fa-pencil-square"></i></button>',
                    "orderable": false,
                    "searchable": false,
                    "width": "90px"
                }
            ],
			"language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
            }
});

	$("#formcargo").validate({
		rules: {
			nombre: { required: true, minlength: 8},
      cbEstado: {required: true}
		},
		messages: {
			nombre: "El nombre no cumple con los requisitos minimos.",
      cbEstado: "No ha selecionado un estado."
		},
		errorElement: "div",
    errorLabelContainer: ".alert-danger"
	});


$("#datatable-responsive tbody").on("click", '.btn-editar', function () {
	if($(this).closest("tr").hasClass('child'))
	{ //vemos si el actual row es child row y nos devolvemos uno
		filaSeleccionada = $(this).closest("tr").prev();
	} 
	else
	{
		filaSeleccionada = $(this).closest("tr"); 
	}
     var data = tabladata.row(filaSeleccionada).data();
     abrirModal(data)
})





function abrirModal(dataJson) {

      //borramos los datos de los input
			$("#id").val(0);
      $("#nom_cargo").val("");
			$("#cbEstado").val(1);
      $("#mensajeError").hide();
            if (dataJson != null){
              $("#id").val(dataJson.id);
              $("#nom_cargo").val(dataJson.nombre_cargo);
              $("#cbEstado").val(dataJson.estado == "1" ? 1 : 0);
            }
$("#FormModal").modal("show");
}

		
function Guardar() {
if (!$('#formcargo').valid())
{
	return;
}		
var cargo = {
				id: $("#id").val(),
        nombre_cargo: $("#nom_cargo").val(),
				estado: $("#cbEstado").val()
            }
$.ajax({
        type:'POST',
        url: './CapaDatos/nuevoPost.php',
        data: cargo,
        dataType: 'json',
        async: true,
    })
    .done(function ajaxDone(res){
       console.log(res);
	   if (cargo.id == 0)
	   {
		   if(res.resultado != 0)
		   {
			   //swal("Buen Trabajo!", res.mensaje, "success").then((value) => {$("#FormModal").modal("hide")});
//			   $("#FormModal").on("hidden.bs.modal", function () {
//					location.reload();
//				});
 				cargo.id = res.resultado;
        tabladata.row.add(cargo).draw(false);
				swal("Buen Trabajo!", res.mensaje, "success");
				$("#FormModal").modal("hide");
			   return false;
		   }
		   else
		   {
			   swal("Revise los datos ingresados", res.mensaje, "info")
			   $("#mensajeError").text("Revise los datos ingresados.").show();
		   }
	   }
	   else
	   {
		   if(res.resultado != 0)
		   {
			   tabladata.row(filaSeleccionada).data(cargo).draw(false);
          filaSeleccionada = null;
			   swal("Buen Trabajo!", res.mensaje, "success");
			   $("#FormModal").modal("hide");
			   return false;
		   }
		   else
		   {
			   swal("No es posible actualizar", res.mensaje, "info")
			   $("#mensajeError").text("No es posible actualizar.").show();
		   }
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
