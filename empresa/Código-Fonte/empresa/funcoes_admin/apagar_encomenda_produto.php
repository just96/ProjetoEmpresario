<?php
session_start();
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../admin/topfooterA.php"); 

$id = $_GET["id_geral"];
$nome_log = $_SESSION['Utilizador']; 

$sqldata ="SELECT nome FROM utilizadores INNER JOIN `encomendas` ON encomendas.id_utilizador = utilizadores.id_user WHERE id_encomenda = '$id'";
$result= mysqli_query($connection,$sqldata);
$row=mysqli_fetch_assoc($result);

if($nome_log != 'admin' AND $row['nome'] == 'admin' ){
	?>
	<div class="container alert alert-danger" role="alert">
		Não tem permissão para apagar esta encomenda!
	</div>
	<?php
	header("refresh:2;url=../admin/ver_encomendas_produtos.php");
	return;
}else{
	$deletematerial= "DELETE FROM encomendas WHERE id_encomenda='$id'";
	mysqli_query($connection,$deletematerial) or die($deletematerial); ?>
	<div class="container alert alert-success" role="alert">
		Encomenda eliminada com sucesso!
	</div>
	<?php
	header('refresh:2;url=../admin/ver_encomendas_produtos.php');
}
?>