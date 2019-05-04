<?php

include("../conectar_bd.php");
include("../admin/topfooterA.php"); 

$id = $_GET["id_geral"];   

$deleteuser= "DELETE FROM utilizadores WHERE id_user='$id'";
mysqli_query($connection,$deleteuser) or die($deleteuser); ?>
<div class="container alert alert-success" role="alert">
	Utilizador eliminado com sucesso!
</div>
<?php
header('refresh:2;url=../admin/gerirutilizadores.php');
?>