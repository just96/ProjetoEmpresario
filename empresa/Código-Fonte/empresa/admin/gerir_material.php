<title>Menu Gestor - Gerir Material de Apoio</title>
<?php
session_start();
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
require('topfooterA.php');
require('filtros.php');
include("../conectar_bd.php");
$sql = "SELECT id_material,nome_material,imagem,tipo,criado,editado FROM `material_apoio` ORDER BY tipo ASC;";
$result = mysqli_query($connection, $sql) or die(mysql_error());

if ($result->num_rows > 0) {
	?>
	<body>
		<h1 align="center">Gestão do Material de Apoio</h1>
		<hr>
		<div class="container-fluid">
			<div class="d-flex justify-content-center">
				<button onclick="window.location.href='../pdf/pdf_materiais_admin.php'" type="submit" class="btn btn-warning">Gerar PDF&nbsp<img src="../img/pdf.png" width="25" height="25"></img></button>
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
						echo "<tr><td><img class='rounded' height='65' width='80' src='../img/"
						.$row["imagem"]."'></td><td>"
						. $row["nome_material"]. "</td><td>" 
						. $row["tipo"]."</td><td>"
						. $row["criado"]. "</td><td>"
					.$row["editado"]. "</td>"?><td>
						<a onclick="return confirm('Editar este material?')" href="../funcoes_admin/editar_material.php?&id_geral=<?php echo $row["id_material"] ?>"><img border="0" src="../img/baseline_edit_black_18dp.png"></a></td>
						<td><a onclick="return confirm('Deseja apagar este material?')" href="../funcoes_admin/apagar_material.php?&id_geral=<?php echo $row["id_material"] ?>"><img border="0" src="../img/baseline_delete_black_18dp.png"></a></td></tr>
						<?php
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