<title>Menu Gestor - Material de Apoio</title>
<?php
session_start();
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
require('topfooterA.php');
require('filtros.php');
?>
<body>
	<h1 align="center">Material de Apoio</h1>
	<hr>
	<div class="container-fluid">
		<form align="center" class ="form-inline" method="POST" action="material.php" enctype="multipart/form-data">
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
		<div class=" alert alert-danger" role="alert">
			<strong>Nome de material já em uso!</strong> 
		</div>
		<?php
		return;
	}

	mysqli_query($connection,"INSERT INTO `material_apoio`(`nome_material`,`imagem`,`tipo`,`criado`) VALUES ('$nome_material','$filename','$tipo','$criado')")or die(mysqli_error($connection));

	?>
	<div class=" alert alert-success" role="alert">
		<strong>Material adicionado com sucesso!</strong>
	</div>
	<?php  
	header("Refresh:2; url=material.php");

}
?>
<?php

include("../conectar_bd.php");
$sql = "SELECT id_material,nome_material,imagem,tipo,criado,editado FROM `material_apoio` ORDER BY id_material ASC;";
$result = mysqli_query($connection, $sql) or die(mysql_error());

if ($result->num_rows > 0) {
	?>
	<body>
		<hr>
		<div class="container-fluid">
			<div class="d-flex justify-content-center">
				<button  onclick="window.location.href='../fpdf/pdf_materiais.php'" type="submit" class="btn btn-warning">Gerar PDF&nbsp<img src="../img/pdf.png" width="30" height="30"></img></button>
			</div>
			<br>
			<table id="minhaTabela" class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Imagem</th>
						<th>Nome do Material</th>
						<th>Tipo</th>
						<th>Data em que foi adicionado</th>
						<th>Data em que foi editado</th>
						<th>Editar</th>
						<th>Apagar</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = $result->fetch_assoc()) {
						echo "<tr><td><img class='rounded' height='100' width='150' src='../img/"
						.$row["imagem"]."'></td><td>"
						. $row["nome_material"]. "</td><td>" 
						. $row["tipo"]."</td><td>"
						. $row["criado"]. "</td><td>"
					.$row["editado"]. "</td>"?><td>
						<a onclick="return confirm('Editar este material?')" href="funcoes.php?funcao=EditarMaterial&id_geral=<?php echo $row["id_material"] ?>"><img border="0" src="../img/baseline_edit_black_18dp.png"></a></td>
						<td><a onclick="return confirm('Deseja apagar este material?')" href="funcoes.php?funcao=ApagarMaterial&id_geral=<?php echo $row["id_material"] ?>"><img border="0" src="../img/baseline_delete_black_18dp.png"></a></td></tr><?php
					};?> 
				</tbody>
			</table>
		<?php }else{?>
			<div class=" alert alert-danger" style="top:10px;" role="alert">
				<strong>Não há material registado!</strong>
			</div> 
			<?php
		}
		?>
	</div>
