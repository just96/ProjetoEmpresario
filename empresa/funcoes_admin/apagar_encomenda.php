<?php
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../admin/topfooterA.php"); 

$id = $_GET["id_geral"];   

$deletematerial= "DELETE FROM encomendas WHERE id_encomenda='$id'";
mysqli_query($connection,$deletematerial) or die($deletematerial); ?>
<div class="container alert alert-success" role="alert">
	Encomenda eliminada com sucesso!
</div>
<?php
header('refresh:2;url=../admin/index.php');
?>