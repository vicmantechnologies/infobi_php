<script type="text/javascript">
	$.fn.editable.defaults.mode = 'inline';
	$("#username").editable({

  selector: "a.iframes",
  url: "../php/update_frame.php",
  title: "Cambiar iFrame",
  type: "POST"

}); 
</script>
<?php
require('clases/conexion.php');
require('clases/clases.php');

if(isset($_GET["q"])){
	$user = $_GET["q"];
	$resultado = (new iframe)->consultar($user);
	$output = '';
	
if (!empty($resultado)) {
	$output .= '
		<div class="table-responsive" id="username">
			<table class="table table-striped table-hover table-bordered">
	<thead>
      <tr>
        <th>Nombre iFrame</th>
        <th>Frame</th>
        <th>
            <a href="#" onclick="Add_frame('.$user.')">
			<i class="material-icons md-12" style="color: green;">
			add
			</i>
			</a>
		</th>
      </tr>
    </thead>
    <tbody>';
    foreach($resultado as $r){
			$output .=  '<tr>
				<td><a href="#" data-name="nombre_iframe" class="iframes" data-type="text" data-pk="'.$r["ID"].'">'.$r["nombre_iframe"].'</a></td>
				<td><a href="#" data-name="IFRAEM" class="iframes" data-type="text" data-pk="'.$r["ID"].'">'.$r["IFRAEM"].'</a></td>
				<td>
			<a href="#" onclick="Delete_frame('.$r["ID"].', '.$user.')">
			<i class="material-icons md-12" style="color: black;">
			clear
			</i>
				</td>

			</tr>';
		}

	$output .='</table>
		</div>
	';
}else{
	$output .= '
		<div class="alert alert-danger" id="alerta">
			 <strong>Ups!</strong> El usuario no tiene iFrame.
  		</div>
		<a href="#" onclick="Add_frame('.$user.')">
			<i class="material-icons md-12" style="color: black;">
			add
			</i>
		</a>
	';
}

echo $output;
} ?>