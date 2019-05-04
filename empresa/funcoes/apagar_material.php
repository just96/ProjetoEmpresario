<?php

include("../conectar_bd.php");
include("../admin/topfooterA.php"); 

$id = $_GET["id_geral"];   

$deletematerial= "DELETE FROM material_apoio WHERE id_material='$id'";
mysqli_query($connection,$deletematerial) or die($deletematerial); ?>
<div class="container alert alert-success" role="alert">
	Material eliminado com sucesso!
</div>
<?php
header('refresh:2;url=../admin/material.php');
?>