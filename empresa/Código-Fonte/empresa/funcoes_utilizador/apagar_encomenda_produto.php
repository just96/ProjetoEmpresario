<?php
session_start();
if ($_SESSION['role'] != 'Utilizador'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../utilizador/topfooterU.php"); 

$id = $_GET["id_geral"];   
$id_user = $_SESSION['id'];

// sql para ver se tem permissão na pagina, o utilizador
$sql_check_admin = "SELECT * FROM `encomendas` INNER JOIN `utilizadores` ON encomendas.id_utilizador = utilizadores.id_user WHERE id_encomenda = '$id'";
$result_check= mysqli_query($connection,$sql_check_admin);
$row=mysqli_fetch_assoc($result_check);

if(($row['user_type'] == 'Gestor') || ($row['id_user'] != $id_user)){
	?>
	<div class="container alert alert-danger" role="alert">
		Não tem permissão para apagar esta encomenda!
	</div>
	<?php
	header("refresh:2;url=../utilizador/ver_encomendas_produtos.php");
	return;
}

$deletematerial= "DELETE FROM encomendas WHERE id_encomenda='$id'";
mysqli_query($connection,$deletematerial) or die($deletematerial); ?>
<div class="container alert alert-success" role="alert">
	Encomenda eliminada com sucesso!
</div>
<?php
header('refresh:2;url=../utilizador/ver_encomendas_produtos.php');
?>