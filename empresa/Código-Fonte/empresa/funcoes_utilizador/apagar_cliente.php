<?php
session_start();
if ($_SESSION['role'] != 'Utilizador'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../utilizador/topfooterU.php"); 

$id = $_GET["id_geral"];
$id_user = $_SESSION['id'];

$sql_check_admin = "SELECT * FROM `clientes` INNER JOIN `utilizadores` ON clientes.id_utilizador = utilizadores.id_user WHERE id_cliente = '$id'";
$result_check= mysqli_query($connection,$sql_check_admin);
$row=mysqli_fetch_assoc($result_check);

if($row['user_type'] == 'Gestor' || $row['id_user'] != $id_user){
	?>
	<div class="container alert alert-danger" role="alert">
		Não tem permissão para apagar este cliente!
	</div>
	<?php
	header("refresh:2;url=../utilizador/gerir_clientes.php");
	return;
}else{
	$deletecliente= "DELETE FROM clientes WHERE id_cliente='$id'";
	mysqli_query($connection,$deletecliente) or die($deletecliente); 
	?>
	<div class="container alert alert-success" role="alert">
		Cliente eliminado com sucesso!
	</div>
	<?php
	header('refresh:2;url=../utilizador/gerir_clientes.php');
}
?>