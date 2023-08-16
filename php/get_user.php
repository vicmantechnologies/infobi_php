<?php 
session_start();
 if(!empty($_SESSION["user_id"])): ?>
<script src="../js/openModals.js"></script>
<script> // 
function OpenUs(str) {
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
                     url:"../php/get_frame.php?q="+str,  
                     method:"POST",  
                     success:function(data){
                          $('#frame').modal('show');
                          $('#get_frameModal').html(data);
                     }  
                });
                
}

</script>
<?php
require_once('clases/conexion.php');
require_once('clases/clases.php');

$usuarios = (new usuarios)->consultar();
$output = "";

$output .= '
<br><br>
<div class="card">
      <article class="containe" style="padding: 0px 121px; padding-top: 11px;">
<div class="container">
	<div class="row">
		<div class="col-md-12" id="conten" style="width: 90%">
	<table id="table_id" class="table table-striped table-hover table-bordered" style="font-size: 12px">
	<thead>
	<tr>
		<th scope="col">Nombres</th>
		<th scope="col">Area</th>
		<th scope="col">Correo</th>
		<th scope="col">Pass</th>
		<th scope="col">Cargo</th>
		<th scope="col">Perfil</th>
		<th scope="col">
			<a href="#" onclick="OpenModal()">
			<i class="material-icons md-12" style="color: green;">
			Agregar_usuario
			</i>
		</a>
		</th>
	</tr>
	</thead>
	<tbody>';
		foreach($usuarios as $u){
			$output .=  '<tr>
				<td>'.$u["nombre"].'</td>
				<td>'.$u["area"].'</td>
				<td>'.$u["correo"].'</td>
				<td>'.$u["pass"].'</td>
				<td>'.$u["cargo"].'</td>
				';
	if ($u["perfil"] == 1) {
		$output .= '<td>Admin</td>';
	}else{
		$output .= '<td>Usuario</td>';
	}
				$output .= '<td>
				<div class="row">
				<div class="col">
			<a  style="padding-left: 20px;" href="#" onclick="OpenUs('.$u["ID"].')">
			<i class="fa fa-check" style="color: black;">
			
			</i>
			<a href="#" onclick="EditUser('.$u["ID"].')">
			<i class="fa fa-edit" style="color: #35CB99;">
			
			</i>
			<a href="#" onclick="DeleteUser('.$u["ID"].')">
			<i class="fa fa-close" style="color: red;">
			
			</i>
				</div>
				</div>
				</td>

			</tr>';
		}
	$output .= '</tbody>
	</table>
		</div>
	</div>
</div>
</article>
  </div>
<script type="text/javascript">
	$(document).ready( function () {
    $("#table_id").DataTable();
} );
</script>
';

echo $output;

?>
<?php else: ?>
	<p>Fallo de sesión.</p>
<?php endif; ?>
