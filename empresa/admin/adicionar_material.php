<title>Menu Gestor-Adicionar Material de Apoio</title>
<?php
session_start();
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
require('topfooterA.php');
require('filtros.php');
?>
<body>
	<h1 align="center">Adicionar Material de Apoio</h1>
	<hr>
	<div class="container-fluid">
		<form align="center" class ="form-inline" method="POST" action="#" enctype="multipart/form-data">
			<div class="form-group mx-sm-3 mb-2">
				<h4 align="center" for="imagem">Adicionar Imagem</h4>
				<input type="file" name="uploadfile">
			</div>
			<div class="form-group mx-sm-3 mb-2">
				<input  size="50" name ="nome_material" type="text" class="form-control" placeholder="Nome do Material" required>
			</div>
			<div class="form-group mx-sm-3 mb-2">
				<label for="select" class="col-1 col-form-label">Tipo</label> 
				<div class="col-8">
					<select id="tipo" name="tipo" class="custom-select" required="required">
						<option value="Mostruarios">Mostruarios</option>
						<option value="Expositores">Expositores</option>
						<option value="Folhetos">Folhetos</option>
						<option value="MaterialTecnico">Material Tecnico</option>
					</select>
				</div>
			</div>
			<button onclick="return confirm('Tem a certeza que quer adicionar?')" name ="add_material" type="submit" class="btn btn-primary mb-2">Adicionar material</button>
		</form>
	</div>

</body>

<?php

// ADICIONAR Material
if(isset($_POST['add_material'])){
	include("../conectar_bd.php");

	$nome_material = strip_tags($_POST['nome_material']);
	$tipo = strip_tags($_POST['tipo']);

	$nome_material =stripcslashes($nome_material);
	$tipo =stripcslashes($tipo);

	$nome_material = mysqli_real_escape_string($connection,$nome_material);
	$tipo = mysqli_real_escape_string($connection,$tipo);

	$filename = $_FILES['uploadfile']['name'];
	$filetmpname = $_FILES['uploadfile']['tmp_name'];

	date_default_timezone_set('Europe/Lisbon');
	$criado = date('Y-m-d H:i:s');

		//folder where images will be uploaded
	$folder = '/xampp/htdocs/empresa/img/';
	//function for saving the uploaded images in a specific folder
	move_uploaded_file($filetmpname, $folder.$filename);

	//Instrução SQL para selecionar diferentes dados

	$sql_fetch_nome_material = "SELECT nome_material FROM material_apoio WHERE nome_material = '$nome_material'";

	//usado para comparar os dados introduzidos com os da base de dados.


	$query_nome_material = mysqli_query($connection,$sql_fetch_nome_material) or die(mysql_error());

	if (mysqli_num_rows($query_nome_material)){
		?>
		<div class="container alert alert-danger" role="alert">
			<strong>Nome de material já em uso!</strong> 
		</div>
		<?php
		header("Refresh:2;url=adicionar_material.php");
		return;
	}

	mysqli_query($connection,"INSERT INTO `material_apoio`(`nome_material`,`imagem`,`tipo`,`criado`) VALUES ('$nome_material','$filename','$tipo','$criado')")or die(mysqli_error($connection));

	?>
	<div class="container alert alert-success" role="alert">
		<strong>Material adicionado com sucesso!</strong>
	</div>
	<?php  
	header("Refresh:2; url=gerir_material.php");

}
?>
