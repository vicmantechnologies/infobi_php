<?php 



$connect = mysqli_connect("localhost", "gvml_userbi", "H5AL%-16.)m.", "gvml_infobi");



$query = "UPDATE iframe SET ".$_POST["name"]." ='".$_POST["value"]."' WHERE id = '".$_POST["pk"]."'";

	mysqli_query($connect, $query);