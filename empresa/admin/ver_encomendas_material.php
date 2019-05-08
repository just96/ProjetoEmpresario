<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
// SELECT no SQL para selecionar os dados a serem imprimidos na tabela
$sql = "SELECT id_encomenda,nome,id_material,nome_fiscal,data_encomenda,comentario,autorizada FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `utilizadores` ON encomendas.id_utilizador = utilizadores.id_user WHERE autorizada LIKE '0' AND id_material IS NOT NULL GROUP BY id_encomenda ASC;";
$result = mysqli_query($connection, $sql) or die(mysql_error());
?>

<title>Menu Gestor-Ver encomendas-Material de apoio</title>

<?php require('topfooterA.php');
require('filtros.php');
if ($result->num_rows > 0) {
	?>
	<body>
		<h1 align="center">Encomendas-Material de apoio</h1>
		<hr>
		<br>
		<div class="container-fluid">
			<table id="minhaTabela" class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Número da Encomenda</th>
						<th>Data em que foi feita</th>
						<th>Comentário</th>
						<th>Cliente</th>
						<th>Utilizador</th>
						<th>Ver Encomenda</th>
						<th>Autorizar Encomenda</th>	
						<th>Apagar</th>
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
							<td><?php echo $row["nome"]; ?></td>
							<td><a onclick="return confirm('Ver esta encomenda?')" href="../funcoes_admin/ver_encomenda_material.php?&id_geral=<?php echo $row["id_encomenda"]?>"><img height="35" width="35" border="0" src="../img/ver_encomenda.png"></a></td>
							<td><a onclick="return confirm('Autorizar esta encomenda?')" href="../funcoes_admin/autorizar_encomenda_material.php?&id_geral=<?php echo $row["id_encomenda"] ?>"><img height="35" width="35" border="0" src="../img/check.png"></td>
								<td><a onclick="return confirm('Deseja apagar esta encomenda?')" href="../funcoes_admin/apagar_encomenda.php?&id_geral=<?php echo $row["id_encomenda"] ?>"><img height="35" width="35" border="0" src="../img/baseline_delete_black_18dp.png"></a></td></tr>
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



