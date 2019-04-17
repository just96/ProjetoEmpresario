<?php

include("../conectar_bd.php");
include("topfooterA.php"); 

$tarefa = $_GET["funcao"];
$id = $_GET["id_geral"];   

if($tarefa == "ApagarProduto"){


	$deleteproduto= "DELETE FROM produtos WHERE id_produto='$id'";
	mysqli_query($connection,$deleteproduto) or die($deleteproduto); ?>
	<div class="container alert alert-success" role="alert">
		Produto eliminado com sucesso!
	</div>
	<?php
	header('refresh:2;url=ver_produtos.php');

}elseif($tarefa == "ApagarCliente"){

	$deletecliente= "DELETE FROM clientes WHERE id_cliente='$id'";
	mysqli_query($connection,$deletecliente) or die($deletecliente); ?>
	<div class="container alert alert-success" role="alert">
		Cliente eliminado com sucesso!
	</div>
	<?php
	header('refresh:2;url=gerirclientes.php');

}elseif($tarefa =="ApagarUtilizador"){

	$deleteuser= "DELETE FROM utilizadores WHERE id_user='$id'";
	mysqli_query($connection,$deleteuser) or die($deleteuser); ?>
	<div class="container alert alert-success" role="alert">
		Utilizador eliminado com sucesso!
	</div>
	<?php
	header('refresh:2;url=gerirutilizadores.php');
}
?>
