<title>Material de Apoio</title>
<?php
session_start();
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
require('topfooterA.php');
?>
<body>
	<h1 align="center">Material de Apoio</h1>
	<hr>
	<div class="container">
		<form align="center" class ="form-inline" method="POST" action="material.php">
			<div class="form-row">
				<div class="form-group mx-sm-3 mb-2">
					<input name ="nome_material" type="text" class="form-control" placeholder="Nome do Material" required>
				</div>
				<button onclick="return confirm('Tem a certeza que quer adicionar?')" name ="add_material" type="submit" class="btn btn-primary mb-2">Adicionar material</button>
			</form>
		</div>
	</div>
</div>

</body>

<?php

// ADICIONAR Material
if(isset($_POST['add_material'])){
	include("../conectar_bd.php");

	$nome_material = strip_tags($_POST['nome_material']);
	$nome_material =stripcslashes($nome_material);
	$nome_material = mysqli_real_escape_string($connection,$nome_material);

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

	mysqli_query($connection,"INSERT INTO `material_apoio`(`nome_material`,`data`) VALUES ('$nome_material','$data')")or die(mysqli_error($connection));

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
$sql = "SELECT id_material,nome_material,data FROM `material_apoio` ORDER BY id_material ASC;";
$result = mysqli_query($connection, $sql) or die(mysql_error());

if ($result->num_rows > 0) {
	?>
	<body>
		<hr>
		<div class="container-fluid">
			<input class="form-control" id="myInput" type="text" placeholder="Procurar...">
			<br>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Nome do Material</th>
						<th>Data em que foi adicionado</th>
						<th>Editar</th>
						<th>Apagar</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php while($row = $result->fetch_assoc()) {
						echo "<tr><td>". $row["nome_material"]. "</td><td>" . $row["data"]. "</td>"?><td>
							<a onclick="return confirm('Editar este material?')" href="funcoes.php?funcao=EditarMaterial&id_geral=<?php echo $row["id_material"] ?>"><img border="0" src="../img/baseline_edit_black_18dp.png"></a></td>
							<td><a onclick="return confirm('Deseja apagar este material?')" href="funcoes.php?funcao=ApagarMaterial&id_geral=<?php echo $row["id_material"] ?>"><img border="0" src="../img/baseline_delete_black_18dp.png"></a></td></tr><?php
						};?> 
					</tbody>
				</table>
				<div class="d-flex justify-content-center">
					<button type="button" class="btn btn-warning">Gerar PDF&nbsp<img src="../img/pdf.png" width="30" height="30"></img></button>
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

  <script> // Script para método Search , procurar dados na tabela.
  $(document).ready(function(){
  	$("#myInput").on("keyup", function() {
  		var value = $(this).val().toLowerCase();
  		$("#myTable tr").filter(function() {
  			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
  		});
  	});
  });

</script>
