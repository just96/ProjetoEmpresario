<?php
session_start();
require_once '../vendor/autoload.php';
include("../conectar_bd.php");

$id = $_GET["id_geral"];
$role = $_SESSION['role'];
$id_user = $_SESSION['id'];

if ($role == 'Gestor'){
	include("../pdf/pdf_material.php");
}elseif($role == 'Utilizador'){
	// sql para ver se tem permissão na pagina, o utilizador
	$sql_check_admin = "SELECT * FROM `encomendas` INNER JOIN `utilizadores` ON encomendas.id_utilizador = utilizadores.id_user WHERE id_encomenda = '$id'";
	$result_check= mysqli_query($connection,$sql_check_admin);
	$row=mysqli_fetch_assoc($result_check);

	if($row['id_user'] != $id_user){
		?>
		<div class="container alert alert-danger" role="alert">
			Não tem permissão para ver esta encomenda!
		</div>
		<?php
		header("refresh:2;url=../utilizador/ver_encomendas_material.php");
		return;
	}
	include("../pdf/pdf_material.php");
}
?>