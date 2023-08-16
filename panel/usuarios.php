<?php
require_once('../layout/plantilla.php');
require_once('./funcionesData.php');
head();
initBody();
topMenu();
sideBar();
menuFooter();
topNavigation();
IniContenido("Usuarios del Sistema");


?>


<div class="row">
  <div class="col-12">
    <button type="button" class="btn btn-success" onclick="abrirModal()"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear Nuevo Usuario</button>
  </div>
</div>
<hr />
<div class="x_content">
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box table-responsive">
        <p class="text-muted font-13 m-b-30"> Listado usuarios registrados en InfoBI</p>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>NOMBRE </th>
              <th>CARGO</th>
              <th>AREA</th>
              <th>CORREO</th>
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
        <h4 class="modal-title" id="myModalLabel2">Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span> </button>
      </div>
      <div class="modal-body">
        <input id="id" type="hidden" value="0" readonly />
        <form id="formusuario">
          <div class="col-sm-6">
            <label for="nombre" class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase()">
          </div>
          <div class="col-sm-6">
            <label for="area" class="form-label">Área</label>
            <select class="form-control" id="area" name="area">
              <option value="">Seleccionar...</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label for="cargo" class="form-label">Cargo</label>
            <select class="form-control" id="cargo" name="cargo">
              <option value="">Seleccionar...</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label for="Correo" class="form-label">Correo</label>
            <input class="form-control" id="correo" name="correo" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase()" required="required" type="email">
          </div>
          <div class="col-sm-6" id="passwordContainer">
            <label for="Contrasena" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" autocomplete="off">
          </div>
          <div class="col-sm-6">
            <label for="cbPerfil" class="form-label">Perfil</label>
            <select name="cbPerfil" class="form-control" id="cbPerfil" aria-label="Default select example">
              <option value="0">Seleccionar...</option>
            </select>
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

<!-- Modal de Restablecer Contraseña -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myModalLabelPass"" id="ModalPass">
  <div class="modal-dialog modal-sm8">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabelPass">Restablecer Contraseña</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="id-usuario" value="<?php echo $array_devolver['id'] ?>">
        <form id="formpassword">
          <div class="col-sm-12">
            <label for="nueva-contrasena" class="form-label">Nueva Contraseña</label>
            <input type="password" class="form-control" id="nuevacontrasena" name="nuevacontrasena" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase()">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="guardarNuevaContrasena()">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
        <div class="row mt-2">
          <div class="col-12">
            <div id="mensajeError2" class="alert alert-danger" role="alert"> </div>
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
                url: './CapaDatos/listarUsuarios.php',
                type: "GET",
                dataType: "json"
            },
            "columns": [
                { "data": "nombre" },
                { "data": "cargo" },
                { "data": "area" },
                { "data": "correo" },
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
                    "defaultContent": '<div class="btn-group" role="group"><button type="button" data-toggle="tooltip" title="Modificar Usuario" class="btn btn-primary btn-sm btn-editar mr-1"><i class="fa fa-pencil-square"></i></i></button><button type="button" class="btn btn-secondary btn-sm btn-password ml-1" data-toggle="tooltip" title="Restablecer Contraseña"  id="btn-password-modal" onclick="abrirModalPass()" data-password="true"><i class="fa fa-key" aria-hidden="true"></i></button></div>',
                    "orderable": false,
                    "searchable": false,
                    "width": "90px",
                }
              
                

            ],
			"language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
            }
});

	$("#formusuario").validate({
		rules: {
			nombre: { required: true, minlength: 8},
			cargo: { required:true},
			area: { required: true},
			correo: { required:true,  email: true, minlength: 10},
			contrasena: { required:true, minlength: 8},
			cbPerfil: { required: true }
		},
		messages: {
			nombre: "El nombre no cumple con los requisitos minimos.",
			cargo : "El seleccionar un cargo es obligatorio.",
			area : "El seleccionar una areá es obligatorio",
			correo : "El campo correo es obligatorio y debe tener formato de email correcto.",
			contrasena : "La contraseña debe ser de mas de 8 caracteres .",
			cbPerfil : "Debe seleccionar el perfil.",
		},
		errorElement: "div",
        errorLabelContainer: ".alert-danger"
	});

// Validaciones de restablecer contraseña
// joel.gonzalez@holdingvml.net
  $("#formpassword").validate({
		rules: {
			nuevacontrasena: { required:true, minlength: 8},
		},
		messages: {
			nuevacontrasena: "La contraseña debe ser de mas de 8 caracteres .",
		},
		errorElement: "div",
    errorLabelContainer: ".alert-danger",
	});

  //Limpiar input nuevacontraseña, ya que no se borraba
  // joel.gonzalez@holdingvml.net
  $("#ModalPass").on("hidden.bs.modal", function() {
  $("#nuevacontrasena").val(""); // Limpiar el campo de contraseña
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
// identificador de la fila seleccionada con id
// joel.gonzalez@holdingvml.net
$("#datatable-responsive tbody").on("click", ".btn-password", function() {
  var filaSeleccionada = $(this).closest("tr");
  var data = tabladata.row(filaSeleccionada).data();
  var idUsuario = data.id; // Supongamos que la columna que contiene el ID del usuario se llama "id"

  $("#id-usuario").val(idUsuario);
  $("#ModalPass").modal("show");
});

// Traer las areas que vienen en un array para mostraralas en formulario
// joel.gonzalez@holdingvml.net
function obtenerAreas() {
  fetch('CapaDatos/obtenerAreas.php?estado=1')
    .then(function(response) {
      if (response.ok) {
        return response.json();
      }
      throw new Error('Error en la respuesta del servidor');
    })
    .then(function(areas) {
      console.log('Datos recibidos:', areas);

      var options = '<option value="">Seleccionar...</option>';
      areas.forEach(function(area) {
        options += '<option value="' + area.id + '">' + area.nom_area + '</option>';
      });

      $("#area").html(options);
      
    })
    .catch(function(error) {
      console.log('Error en la solicitud AJAX:', error);
    });
}

// Llama a la función obtenerAreas para cargar las opciones del selector al cargar la página
obtenerAreas();

// Traer los cargos que vienen en un array para mostraralas en formulario
// joel.gonzalez@holdingvml.net
function obtenerCargos() {
  fetch('CapaDatos/obtenerCargos.php?estado=1')
    .then(function(response) {
      if (response.ok) {
        return response.json();
      }
      throw new Error('Error en la respuesta del servidor');
    })
    .then(function(cargos) {
      console.log('Datos recibidos:', cargos);

      var options = '<option value="">Seleccionar...</option>';
      cargos.forEach(function(cargo) {
        options += '<option value="' + cargo.id + '">' + cargo.nom_cargo + '</option>';
      });

      $("#cargo").html(options);
      
    })
    .catch(function(error) {
      console.log('Error en la solicitud AJAX:', error);
    });
}

// Llama a la función obtenerCargos para cargar las opciones del selector al cargar la página
obtenerCargos();


// Traer los perfiles que vienen en un array para mostraralas en formulario
// joel.gonzalez@holdingvml.net
function obtenerPerfil() {
  fetch('CapaDatos/obtenerPerfil.php?estado=1')
    .then(function(response) {
      if (response.ok) {
        return response.json();
      }
      throw new Error('Error en la respuesta del servidor');
    })
    .then(function(perfiles) {
      console.log('Datos recibidos:', perfiles);

      var options = '<option value="">Seleccionar...</option>';
      perfiles.forEach(function(perfil) {
        options += '<option value="' + perfil.id + '">' + perfil.nom_perfil + '</option>';
      });

      $("#cbPerfil").html(options);
      
    })
    .catch(function(error) {
      console.log('Error en la solicitud AJAX:', error);
    });
}

// Llama a la función obtenerPerfil para cargar las opciones del selector al cargar la página
obtenerPerfil();

 function abrirModalPass(isPassword = false) {
    $("#mensajeError2").hide();
    $("#ModalPass").modal("show");
  }

  function abrirModal(dataJson) {
  // Borramos los datos de los input
  $("#id").val(0);
  $("#nombre").val("");
  $("#area").val("");
  $("#cargo").val("");
  $("#correo").val("");
  $("#contrasena").val("");
  $("#cbPerfil").val("");
  $("#cbEstado").val(1);
  $("#mensajeError").hide();

  if (dataJson != null) {
    console.log(dataJson);
    $("#id").val(dataJson.id);
    $("#nombre").val(dataJson.nombre);
    $("#area").val(dataJson.nom_area);
    $("#cargo").val(dataJson.nom_cargo);
    $("#correo").val(dataJson.correo);
    $("#cbPerfil").val(dataJson.perfil);
    $("#cbEstado").val(dataJson.estado == "1" ? 1 : 0);

    if (dataJson.contrasena != null) {
      
      $("#contrasena").val(dataJson.contrasena);
    } else {
      $("#passwordContainer").hide();
    }
  }

  $("#FormModal").modal("show");
}
function guardarNuevaContrasena() {
    if (!$('#formpassword').valid()) {
        return;
    }

    var nuevaContrasena = $("#nuevacontrasena").val();
    var idUsuario = $("#id-usuario").val();

    $.ajax({
        type: 'POST',
        url: './CapaDatos/nuevoContrasena.php',
        data: {  
          id: idUsuario,
          contrasena: nuevaContrasena
        },
        dataType: 'json',
        async: true,
    })
    .done(function (res) {
      console.log(res);
      if (res.resultado != 0) {
        swal("Buen Trabajo!", res.mensaje, "success").then(function () {
          $("#ModalPass").modal("hide");
          location.reload(); // Refrescar la página
        });
      } else {
        swal("Revise los datos ingresados", res.mensaje, "info");
        $("#mensajeError2").text("Revise los datos ingresados.").show();
      }
    })
    .fail(function (e) {
      console.log(e);
    })
    .always(function () {
      console.log('Final de la llamada ajax.');
    });

    return false;
}


function Guardar() {
    if (!$('#formusuario').valid()) {
        return;
    }

    var Usuario = {
        id: $("#id").val(),
        nombre: $("#nombre").val(),
        area: $("#area").val(),
        cargo: $("#cargo").val(),
        correo: $("#correo").val(),
        contrasena: $("#contrasena").val(),
        perfil: $("#cbPerfil").val(),
        estado: $("#cbEstado").val()
    }

    var NewUsuario = {
        nombre: $("#nombre").val(),
        area: $("#area option:selected").text(),
        cargo: $("#cargo option:selected").text(),
        area: $("#area").val(),
        cargo: $("#cargo").val(),
        correo: $("#correo").val(),
        contrasena: $("#contrasena").val(),
        perfil: $("#cbPerfil").val(),
        estado: $("#cbEstado").val()
    }


    $.ajax({
        type: 'POST',
        url: './CapaDatos/nuevoUsuario.php',
        data: Usuario,
        dataType: 'json',
        async: true,
    })
    .done(function ajaxDone(res) {
    console.log(res);
    if (Usuario.id == 0) {
        if (res.resultado != 0) {
            Usuario.id = res.resultado;
            //tabladata.row.add(NewUsuario).draw(false);
            swal("Buen Trabajo!", res.mensaje, "success").then(function() {
                $("#FormModal").modal("hide");
                location.reload(); // Refrescar la página
            });
            return false;
        } else {
            swal("Revise los datos ingresados", res.mensaje, "info");
            $("#mensajeError").text("Revise los datos ingresados.").show();
        }
    } else {
        if (res.resultado != 0) {
           // tabladata.row(filaSeleccionada).data(NewUsuario).draw(false);
            filaSeleccionada = null;
            swal("Buen Trabajo!", res.mensaje, "success").then(function() {
                $("#FormModal").modal("hide");
                location.reload(); // Refrescar la página
            });
            return false;
        } else {
            swal("No es posible actualizar", res.mensaje, "info");
            $("#mensajeError").text("No es posible actualizar.").show();
        }
    }
})

        .fail(function ajaxError(e) {
            console.log(e);
        })
        .always(function ajaxSiempre() {
            console.log('Final de la llamada ajax.');
        });

    return false;
}




</script> 
