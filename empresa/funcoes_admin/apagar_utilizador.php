<?php
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../admin/topfooterA.php"); 

$sql_search = "SELECT * FROM utilizadores";
$result_search = mysqli_query($connection, $sql_search);
$row_search=mysqli_fetch_array($result_search);

if ($row_search['nome'] == 'admin'){
	?>
	<div class="container alert alert-danger" role="alert">
		Não tem permissão para apagar este utilizador!
	</div>
	<?php
	header("url../admin/gerir_utilizadores.php");
}else{
	$id = $_GET["id_geral"];   

	$deleteuser= "DELETE FROM utilizadores WHERE id_user='$id'";
	mysqli_query($connection,$deleteuser) or die($deleteuser); ?>
	<div class="container alert alert-success" role="alert">
		Utilizador eliminado com sucesso!
	</div>
	<?php
	header('refresh:2;url=../admin/gerir_utilizadores.php')
};
?>