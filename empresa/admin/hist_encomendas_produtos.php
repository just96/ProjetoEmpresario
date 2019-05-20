<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
// SELECT no SQL para selecionar os dados a serem imprimidos na tabela
$sql = "SELECT id_encomenda,nome,nome_fiscal,data_encomenda,comentario,autorizada FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `utilizadores` ON encomendas.id_utilizador = utilizadores.id_user WHERE autorizada LIKE '1' AND id_material IS NULL GROUP BY id_encomenda ASC;";
$result = mysqli_query($connection, $sql) or die(mysql_error());
?>

<title>Menu Gestor-Histórico de Encomendas-Produtos</title>

<?php require('topfooterA.php');
require('filtros.php');
if ($result->num_rows > 0) {
	?>
	<body>
		<h1 align="center">Histórico de Encomendas-Produtos</h1>
		<hr>
		<br>
		<div class="d-flex justify-content-center">
			<button onclick="window.location.href='../fpdf/pdf_hist_encomendas_produto_admin.php'" type="submit" class="btn btn-warning" name="gerar_pdf">Gerar PDF&nbsp<img src="../img/pdf.png" width="30" height="30"></img></button>
		</div>
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
							<td><a onclick="return confirm('Ver esta encomenda?')" href="../funcoes_admin/ver_encomenda_produto.php?&id_geral=<?php echo $row["id_encomenda"];?>"><img height="35" width="35" border="0" src="../img/ver_encomenda.png"></a></td></tr>
							<?php
						}?> 
					</tbody>
				</table>
				<?php
				$total = 0;
				// SQL PARA CALCULAR TOTAL S/ IVA , select distinct não pode ser(a resolver..)
				$sql_total = "SELECT DISTINCT total_s_iva FROM `encomendas` WHERE autorizada = 1";
				$result_total = mysqli_query($connection,$sql_total);
				if (mysqli_num_rows($result_total) > 0 ){
					while($row_total = mysqli_fetch_array($result_total)){
						$total = $total + $row_total['total_s_iva'];
					}
				}
				?>
				<div class="container form-group row">
					<h4>Valor total em encomendas(s/IVA):</h4>
					<div class="container form-group row">
						<h6><?php echo $total;?>&euro;</h6>
					</div>
				</div>
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



