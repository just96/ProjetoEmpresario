<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] != 'Utilizador'){
	header( "Location:../utilizador/log.php" );
}
$id_utilizador = $_SESSION['id'];
include("../conectar_bd.php");
// SELECT no SQL para selecionar os dados a serem imprimidos na tabela
$sql = "SELECT id_encomenda,id_material,nome_fiscal,data_encomenda,comentario,autorizada FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `utilizadores` ON encomendas.id_utilizador = utilizadores.id_user WHERE autorizada LIKE '1' AND encomendas.id_utilizador = '$id_utilizador' AND id_material IS NOT NULL GROUP BY id_encomenda ASC;";
$result = mysqli_query($connection, $sql) or die(mysql_error());
?>

<title>Menu Utilizador-Histórico de Encomendas-Material de apoio</title>

<?php require('topfooterU.php');
require('filtros.php');
if ($result->num_rows > 0) {
	?>
	<body>
		<h1 align="center">Histórico de Encomendas-Material de apoio</h1>
		<hr>
		<br>
		<div class="d-flex justify-content-center">
			<button onclick="window.location.href='../pdf/pdf_hist_encomendas_material_utilizador.php'" type="submit" class="btn btn-warning" name="gerar_pdf">Gerar PDF&nbsp<img src="../img/pdf.png" width="30" height="30"></img></button>
		</div>
		<div class="container-fluid">
			<table id="minhaTabela" class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Número do Envio</th>
						<th>Data</th>
						<th>Observações</th>
						<th>Cliente</th>
						<th>Visualizar</th>
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
							<td><a onclick="return confirm('Ver esta encomenda?')" href="../funcoes_utilizador/ver_encomenda_material.php?&id_geral=<?php echo $row["id_encomenda"];?>"><img height="35" width="35" border="0" src="../img/ver_encomenda.png"></a></td></tr>
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



