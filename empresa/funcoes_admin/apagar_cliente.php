<?php

if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../admin/topfooterA.php"); 

$id = $_GET["id_geral"];   

$deletecliente= "DELETE FROM clientes WHERE id_cliente='$id'";
mysqli_query($connection,$deletecliente) or die($deletecliente); ?>
<div class="container alert alert-success" role="alert">
	Cliente eliminado com sucesso!
</div>
<?php
header('refresh:2;url=../admin/gerir_clientes.php');
?>