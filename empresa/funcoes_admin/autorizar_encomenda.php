<?php
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../admin/topfooterA.php"); 

$id = $_GET["id_geral"];   

$sql_update_aut = "UPDATE `encomendas` SET autorizada = '1' WHERE id_encomenda = '$id'";
mysqli_query($connection,$sql_update_aut);
?>  
<div class="container alert alert-success" role="alert">
	Encomenda autorizada!
</div>
<?php
header('refresh:2;url=../admin/ver_encomendas.php');
?>