<title>Material de Apoio</title>
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
	<div class="container">
		<form align="center" class ="form-inline" method="POST" action="material.php">
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

	date_default_timezone_set('Europe/Lisbon');
	$data = date('Y-m-d H:i:s');

		//Instrução SQL para selecionar diferentes dados

	$sql_fetch_nome_material = "SELECT nome_material FROM material_apoio WHERE nome_material = '$nome_material'";

	//usado para comparar os dados introduzidos com os da base de dados.


	$query_nome_material = mysqli_query($connection,$sql_fetch_nome_material) or die(mysql_error());

	if (mysqli_num_rows($query_nome_material)){
		?>
		<div class="container">
			<div class="alert alert-danger" role="alert">
				<strong>Nome de material já em uso!</strong> 
			</div>
		</div>
		<?php
		return;
	}

	mysqli_query($connection,"INSERT INTO `material_apoio`(`nome_material`,`tipo`,`data`) VALUES ('$nome_material','$tipo','$data')")or die(mysqli_error($connection));

	?>
	<div class="container">
		<div class="alert alert-success" role="alert">
			<strong>Material adicionado com sucesso!</strong>
		</div>
	</div>
	<?php  
	header("Refresh:2; url=material.php");

}
?>
<?php

include("../conectar_bd.php");
$sql = "SELECT id_material,nome_material,tipo,data FROM `material_apoio` ORDER BY id_material ASC;";
$result = mysqli_query($connection, $sql) or die(mysql_error());

if ($result->num_rows > 0) {
	?>
	<body>
		<hr>
		<div class="container-fluid">
			<br>
			<table id="minhaTabela" class="table table-bordered">
				<thead>
					<tr>
						<th>Nome do Material</th>
						<th>Tipo</th>
						<th>Data em que foi adicionado</th>
						<th>Editar</th>
						<th>Apagar</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php while($row = $result->fetch_assoc()) {
						echo "<tr><td>". $row["nome_material"]. "</td><td>" . $row["tipo"]."</td><td>" . $row["data"]. "</td>"?><td>
							<a onclick="return confirm('Editar este material?')" href="funcoes.php?funcao=EditarMaterial&id_geral=<?php echo $row["id_material"] ?>"><img border="0" src="../img/baseline_edit_black_18dp.png"></a></td>
							<td><a onclick="return confirm('Deseja apagar este material?')" href="funcoes.php?funcao=ApagarMaterial&id_geral=<?php echo $row["id_material"] ?>"><img border="0" src="../img/baseline_delete_black_18dp.png"></a></td></tr><?php
						};?> 
					</tbody>
				</table>
				<div class="d-flex justify-content-center">
					<button  onclick="window.location.href='../fpdf/pdf_materiais.php'" type="submit" class="btn btn-warning">Gerar PDF&nbsp<img src="../img/pdf.png" width="30" height="30"></img></button>
				</div>
			<?php }else{?>
				<div class="container">
					<div class="alert alert-danger" style="top:10px;" role="alert">
						<strong>Não há material registado!</strong>
					</div> 
				</div>
				<?php
			}
			?>
		</div>
