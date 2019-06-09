<?php
session_start();
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../admin/topfooterA.php"); 

$id = $_GET["id_geral"];   

$sqldata ="SELECT nome_produto,imagem,valor_s_iva,codigo_produto,descricao FROM `produtos` WHERE id_produto='$id'";
$result= mysqli_query($connection,$sqldata);
$row=mysqli_fetch_assoc($result);
// EDITAR PRODUTO
if(isset($_POST['edit_prod'])) { 

	$nome_produto = $_POST['nome_produto']; 
	$valor = $_POST['valor'];
	$codigo_produto = $_POST['codigo_produto'];
	$descricao = $_POST['descricao'];

	date_default_timezone_set('Europe/Lisbon');
	$editado = date('Y-m-d H:i:s');


	// COMPARAR DADOS NA EDIÇÃO
	//Instrução SQL para selecionar diferentes dados

	$sql_fetch_nome_produto = "SELECT nome_produto FROM produtos WHERE id_produto NOT IN ('$id') AND nome_produto = '$nome_produto'";
	$sql_fetch_codigo_produto = "SELECT codigo_produto FROM produtos WHERE id_produto NOT IN ('$id') AND codigo_produto = '$codigo_produto'";
	$sql_fetch_descricao = "SELECT descricao FROM produtos WHERE id_produto NOT IN ('$id') AND descricao = '$descricao'";

	//usado para comparar os dados introduzidos com os da base de dados.

	$query_nome_produto = mysqli_query($connection,$sql_fetch_nome_produto) or die(mysql_error());; 
	$query_codigo_produto = mysqli_query($connection,$sql_fetch_codigo_produto) or die(mysql_error());;
	$query_descricao = mysqli_query($connection,$sql_fetch_descricao) or die(mysql_error());;

	if (mysqli_num_rows($query_nome_produto)){
		?>
		<div class="container alert alert-danger" role="alert">
			<strong>Nome de produto já em uso!</strong> 
		</div>
		<?php
		header("Refresh:2");
		return;
	}
	if (mysqli_num_rows($query_codigo_produto)){
		?>
		<div class="container alert alert-danger" role="alert">
			<strong>Referência já em uso</strong> 
		</div>
		<?php
		header("Refresh:2");
		return;
	}
	if (mysqli_num_rows($query_descricao)){
		?>
		<div class="container alert alert-danger" role="alert">
			<strong>Descrição já em uso</strong> 
		</div>
		<?php
		header("Refresh:2");
		return;
	}

	$sqleditproduto = "UPDATE `produtos` SET nome_produto='$nome_produto', valor_s_iva='$valor', codigo_produto='$codigo_produto', descricao='$descricao' , editado = '$editado' WHERE id_produto='$id'";
	mysqli_query($connection,$sqleditproduto);
	?>  
	<div class="container alert alert-success" role="alert">
		Alterações guardadas!
	</div>
	<?php
	header('refresh:2;url=../admin/gerir_produtos.php');
}
if(isset($_POST['btnAI'])){

	$filename = $_FILES['uploadfile']['name'];
	$filetmpname = $_FILES['uploadfile']['tmp_name'];
	date_default_timezone_set('Europe/Lisbon');
	$editado = date('Y-m-d H:i:s');

	//folder where images will be uploaded
	$folder = '/xampp/htdocs/empresa/img/';
	//function for saving the uploaded images in a specific folder
	move_uploaded_file($filetmpname, $folder.$filename);

	mysqli_query($connection,"UPDATE `produtos` SET imagem = '$filename' , editado = '$editado' WHERE id_produto='$id' ") or die(mysqli_error($connection));
	?>
	<div class="container alert alert-success" role="alert">
		<strong>Imagem editada com sucesso!</strong>
	</div>
	<?php  
	header("Refresh:2; url=../admin/gerir_produtos.php");

}
?>
<body>
	<h1 align="center">Editar Produto</h1>
	<hr>
	<div class="container">
		<a href="#" data-target="#exampleModAvatar" data-toggle="modal">Alterar imagem do produto</a>
		<form method="POST" action="#" enctype="multipart/form-data">
			<div class="modal fade" id="exampleModAvatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Alterar imagem do produto</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="text-center">
											<div class="panel-body">
												<div class="form-row">
													<div class="form-group col-md-6">
														<input type="file" name="uploadfile">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
							<button onclick="return confirm('Alterar imagem do produto?')" type="submit" class="btn btn-primary" id="btnAI" name="btnAI">Submeter alteração</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<form method="POST" action="#" enctype="multipart/form-data">
			<div class="form-row">
				<div class="form-group col-md-3">
					<img class="rounded" height='180' width='200' src='../img/<?php echo $row["imagem"]?>'>
					<p></p>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="nome_produto">Nome do Produto</label>
					<input name ="nome_produto" type="text" class="form-control" value="<?php echo $row["nome_produto"]; ?>"required>
				</div>
				<div class="form-group col-md-6">
					<label for="valor">Preço</label>
					<input name ="valor" class="form-control" value="<?php echo $row["valor_s_iva"]; ?>" type="number" min="1" max="10000" step="any" required>
				</div>
			</div>
			<div class="form-group">
				<label for="codigo_produto">Referência</label>
				<input name ="codigo_produto" type="text" class="form-control" value="<?php echo $row["codigo_produto"]; ?>" required>
			</div>
			<div class="form-group row">
				<label for="descricao" class="col-4 col-form-label">Descrição do Produto</label> 
				<textarea class="form-control here" row="10" cols="60" name="descricao"><?php echo $row["descricao"]; ?></textarea>
			</div>
			<button name ="edit_prod" type="submit" class="btn btn-primary" onclick="return confirm('De certeza que quer editar?')">Submeter Alterações</button>
		</form>
	</div>

