<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
// SELECT no SQL para selecionar os dados a serem imprimidos na tabela
$sql = "SELECT id_encomenda, nome_fiscal,data_encomenda,comentario,autorizada FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente WHERE autorizada LIKE '1' AND id_material IS NOT NULL GROUP BY id_encomenda ASC;";
$result = mysqli_query($connection, $sql) or die(mysql_error());
?>

<title>Menu Gestor-Histórico de Encomendas-Material de apoio</title>

<?php require('topfooterA.php');
require('filtros.php');
if ($result->num_rows > 0) {
	?>
	<body>
		<h1 align="center">Histórico de Encomendas-Material de apoio</h1>
		<hr>
		<br>
		<div class="d-flex justify-content-center">
			<button onclick="window.location.href='../fpdf/pdf_hist_encomendas_material_admin.php'" type="submit" class="btn btn-warning" name="gerar_pdf">Gerar PDF&nbsp<img src="../img/pdf.png" width="30" height="30"></img></button>
		</div>
		<div class="container-fluid">
			<table id="minhaTabela" class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Número da Encomenda</th>
						<th>Data em que foi feita</th>
						<th>Comentário</th>
						<th>Cliente</th>
						<th>Ver Encomenda</th>
						<th>Pdf</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = $result->fetch_assoc()) {
						?>
						<tr>
							<?php	
							$id_encomenda = $row["id_encomenda"];
							?>
							<td><?php echo $id_encomenda;?></td>
							<td><?php echo $row["data_encomenda"]; ?></td>
							<td><?php echo $row["comentario"]; ?></td>
							<td><?php echo $row["nome_fiscal"]; ?></td>
							<td><a onclick="return confirm('Ver esta encomenda?')" href="../funcoes_admin/ver_encomenda_material.php?&id_geral=<?php echo $row["id_encomenda"];?>"><img height="35" width="35" border="0" src="../img/ver_encomenda.png"></a></td>
							<td><a onclick="return confirm('Gerar pdf?')" href="../fpdf/pdf_encomenda_admin.php?&id_geral=<?php echo $row["id_encomenda"];?>"><img height="35" width="35" border="0" src="../img/pdf.png"></a></td></tr>
							<?php
						}?> 
					</tbody>
				</table>
			<?php }else{?>
				<div class="container alert alert-danger" style="top:10px;" role="alert">
					<strong>Não há encomendas registadas!</strong>
				</div> 
				<?php
			}
			?>
		</div>

	</body>

	</html>



