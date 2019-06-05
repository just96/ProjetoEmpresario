<?php
session_start();
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
require('topfooterA.php');

// ADICIONAR PRODUTO
if(isset($_POST['add_produto'])){

	include("../conectar_bd.php");

	$nome_produto =strip_tags($_POST['nome_produto']); 	//remove tags de html e php exemplo <br>
	$valor =strip_tags($_POST['valor']); 
	$codigo_produto =strip_tags($_POST['codigo_produto']); 
	$descricao =strip_tags($_POST['descricao']); 
	date_default_timezone_set('Europe/Lisbon');
	$criado = date('Y-m-d H:i:s');
	$filename = $_FILES['uploadfile']['name'];
	$filetmpname = $_FILES['uploadfile']['tmp_name'];

	//folder where images will be uploaded
	$folder = '/xampp/htdocs/empresa/img/';
	//function for saving the uploaded images in a specific folder
	move_uploaded_file($filetmpname, $folder.$filename);

	$nome_produto =stripcslashes($nome_produto);	// esta função remove a barra invertida da string
	$valor =stripcslashes($valor);
	$codigo_produto =stripcslashes($codigo_produto);
	$descricao =stripcslashes($descricao);

	$nome_produto = mysqli_real_escape_string($connection,$nome_produto); // esta função esquece os carateres especiais para a string ser usada numa instrução de SQL
	$valor = mysqli_real_escape_string($connection,$valor);
	$codigo_produto = mysqli_real_escape_string($connection,$codigo_produto);
	$descricao = mysqli_real_escape_string($connection,$descricao);

	//Instrução SQL para selecionar diferentes dados

	$sql_fetch_nome_produto = "SELECT nome_produto FROM produtos WHERE nome_produto = '$nome_produto'";
	$sql_fetch_codigo_produto = "SELECT codigo_produto FROM produtos WHERE codigo_produto = '$codigo_produto'";

	//usado para comparar os dados introduzidos com os da base de dados.

	$query_nome_produto = mysqli_query($connection,$sql_fetch_nome_produto) or die(mysql_error());; 
	$query_codigo_produto = mysqli_query($connection,$sql_fetch_codigo_produto) or die(mysql_error());;

	if (mysqli_num_rows($query_nome_produto)){
		?>
		<div class="container alert alert-danger" role="alert">
			<strong>Nome de produto já em uso!</strong> 
		</div>
		<?php
		header("Refresh:2;url=adicionar_produto.php");
		return;
	}
	if (mysqli_num_rows($query_codigo_produto)){
		?>
		<div class="container alert alert-danger" role="alert">
			<strong>Referência já em uso</strong> 
		</div>
		<?php
		header("Refresh:2;url=adicionar_produto.php");
		return;
	}
	mysqli_query($connection,"INSERT INTO `produtos`(`nome_produto`,`imagem`,`valor_s_iva`, `codigo_produto`, `descricao` , `criado`) VALUES ('$nome_produto','$filename','$valor','$codigo_produto','$descricao','$criado')") or die(mysqli_error($connection));
	?>
	<div class="container alert alert-success" role="alert">
		<strong>Produto adicionado com sucesso!</strong>
	</div>
	<?php  
	header("Refresh:2; url=gerir_produtos.php");
}
?>

<title>Menu Gestor - Adicionar produtos</title>
<body>
	<h1 align="center">Adicionar produtos</h1>
	<hr>
	<div class="container">
		<form method="POST" action="#" enctype="multipart/form-data">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="imagem">Adicionar Imagem</label>
					<input type="file" name="uploadfile">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="nome_produto">Nome do Produto</label>
					<input name ="nome_produto" type="text" class="form-control" placeholder="Nome do Produto" required>
				</div>
				<div class="form-group col-md-6">
					<label for="valor">Preço &euro;</label>
					<input name ="valor" class="form-control"placeholder="Preço &euro;" type="number" min="1" max="10000" step="any" required>
				</div>
			</div>
			<div class="form-group">
				<label for="codigo_produto">Referência</label>
				<input name ="codigo_produto" type="text" class="form-control" placeholder="Referência" required>
			</div>
			<div class="form-group row">
				<label for="descricao" class="col-4 col-form-label">Descrição do Produto</label> 
				<textarea class="form-control here" row="10" cols="60" name="descricao"></textarea>
			</div>
			<button onclick="return confirm('Tem a certeza que quer adicionar?')" name ="add_produto" type="submit" class="btn btn-primary">Adicionar Produto</button>
		</form>
	</div>

</body>

</html>
