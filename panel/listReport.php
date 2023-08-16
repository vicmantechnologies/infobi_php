<?php
require_once('../layout/plantilla.php');
require_once('./funcionesData.php');
head();
initBody();
topMenu();
sideBar();
menuFooter();
topNavigation();
IniContenido("Listado Reportes");
?>
<div class="x_content">
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box table-responsive">
        <p class="text-muted font-13 m-b-30"> Listado reportes InfoBI</p>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>REPORTE</th>
              <th>URL REPORTE</th>
              <th>ACTIVO</th>
              <th></th>
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
    <h4 class="modal-title" id="myModalLabel2">Reportes</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span> </button>
  </div>
  <div class="modal-body">
    <input id="id" type="hidden" value="0" readonly />
    <form id="formusuario"  >
      <div class="col-sm-6">
        <label for="nombre" class="form-label">Nombre Reporte</label>
        <input type="text" class="form-control" id="nombre" name="nombre" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase()">
      </div>
      <div class="col-sm-6">
        <label for="area" class="form-label">URL</label>
        <input type="text" class="form-control" id="url" name="url" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase()" readonly>
      </div>
      <div class="col-sm-12">
        <label for="cbEstado" class="form-label">Estado</label>
        <select name="cbEstado" class="form-control" id="cbEstado" aria-label="Default select example">
          <option value="1">ACTIVO</option>
          <option value="0">INACTIVO</option>
        </select>
      </div>
      <div class="col-sm-12">
      <div id="checkboxList"></div>

      <?php //echo $data = listarUsuariosReporte();?>
      </div>
      <div class="modal-footer">
        <div class="row">
                    <div class="col-12">
                      <button type="button" class="btn btn-primary" onclick="Guardar()">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
      </div>
    </form>
    <div class="row mt-2">
      <div class="col-12">
        <div id="mensajeError" class="alert alert-danger" role="alert"> </div>
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
                url: './CapaDatos/listarReportes.php',
                type: "GET",
                dataType: "json"
            },
            "columns": [
                { "data": "id" },
                { "data": "nombre" },
                { "data": "url" },
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

	$("#formusuario").validate({
		rules: {
			nombre: { required: true, minlength: 8},
			url: { required: true, minlength: 2, maxlength: 50}
		},
		messages: {
			nombre: "El nombre no cumple con los requisitos minimos.",
			url : "El campo URL es obligatorio y debe tener formato de URL correcto."
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
            $("#nombre").val("");
            $("#url").val("");
			$("#cbEstado").val(1);
            $("#mensajeError").hide();

            if (dataJson != null)
			{
				$("#id").val(dataJson.id);
                $("#nombre").val(dataJson.nombre);
				$("#url").val(dataJson.url);
				$("#cbEstado").val(dataJson.estado == "1" ? 1 : 0);
				usuariosInforme(dataJson.id);
            }
			
            $("#FormModal").modal("show");
        }

		
function Guardar() {
if (!$('#formusuario').valid())
{
	return;
}


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

		
var Usuario = {
				id: $("#id").val(),
                nombre: $("#nombre").val(),
                url: $("#url").val(),
				estado: $("#cbEstado").val(),
				usuarios: $('.js-switch:checked').serializeArray()
            }
$.ajax({
        type:'POST',
        url: './CapaDatos/setReporte.php',
        data: Usuario,
        dataType: 'json',
        async: true,
    })
    .done(function ajaxDone(res){
       console.log(res);
	   if (Usuario.id == 0)
	   {
		   if(res.resultado != 0)
		   {
			   //swal("Buen Trabajo!", res.mensaje, "success").then((value) => {$("#FormModal").modal("hide")});
//			   $("#FormModal").on("hidden.bs.modal", function () {
//					location.reload();
//				});
 				Usuario.id = res.resultado;
                tabladata.row.add(Usuario).draw(false);
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
			   tabladata.row(filaSeleccionada).data(Usuario).draw(false);
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

function usuariosInforme(idReporte)
{
	var informacion = {
				id: idReporte
            }
	

	$('#checkboxList').empty();
	$.ajax({
    url: './CapaDatos/listarUsuariosReporte.php',
	data: informacion,
    type: 'POST',
    dataType: 'html',
    success: function(data){
      var checkboxList = $('#checkboxList');
	  checkboxList.append(data);
	  
    }
  });

  
}

</script> 
