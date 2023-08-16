<?php
require_once('../layout/plantilla.php');
require_once('./funcionesData.php');
head();
initBody();
topMenu();
sideBarUser();
menuFooter();
topNavigation();
IniContenido("Listado Informes");
?>
<div class="x_content">
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box table-responsive">
        <p class="text-muted font-13 m-b-30"> Aca encontrara el listado de informes disponibles para el usuario actual </p>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID INFORME</th>
              <th>NOMBRE INFORME</th>
              <th>INFORME</th>
              <th>USUARIO</th>
            </tr>
          </thead>
          <tbody>
            <?php echo $data = obtenerInformes2($_SESSION["user_id"]);?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Large modal -->

<div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-hidden="true" id="FormModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Informe</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
      </div>
      <div class="modal-body">
        <h4><!--Text in a modal--></h4>
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="" frameborder="0" allowFullScreen="true" id="miIframe"></iframe>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<?php
finContenido();
footer();
?>
<script>
function modal(url)
{
	$("#miIframe").attr("src",url);
	$("#FormModal").modal("show");
}
$("#FormModal").on("hidden.bs.modal", function () {
    $("#miIframe").attr("src","");
});
</script>