<?php
session_start();
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../admin/topfooterA.php"); 

$id = $_GET["id_geral"];   

$deleteproduto= "DELETE FROM produtos WHERE id_produto='$id'";
mysqli_query($connection,$deleteproduto) or die($deleteproduto); ?>
<div class="container alert alert-success" role="alert">
	Produto eliminado com sucesso!
</div>
<?php
header('refresh:2;url=../admin/gerir_produtos.php');

?>
