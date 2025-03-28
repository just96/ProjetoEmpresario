<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] != 'Utilizador'){
	header( "Location:../utilizador/log.php" );
}
$id_utilizador = $_SESSION['id'];
include("../conectar_bd.php");
// SELECT no SQL para selecionar os dados a serem imprimidos na tabela
$sql = "SELECT encomendas.id_encomenda, encomendas.data_encomenda, encomendas.comentario,clientes.nome_fiscal,encomendas.total_s_iva FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `utilizadores` ON encomendas.id_utilizador = utilizadores.id_user WHERE autorizada LIKE '1' AND encomendas.id_utilizador = '$id_utilizador' AND id_material IS NULL GROUP BY id_encomenda ASC;";
$result = mysqli_query($connection, $sql) or die(mysql_error());
$total = 0;
?>

<title>Menu Utilizador-Histórico de Encomendas-Produtos</title>

<?php require('topfooterU.php');
require('filtros.php');
if ($result->num_rows > 0) {
	?>
	<body>
		<h1 align="center">Histórico de Encomendas-Produtos</h1>
		<hr>
		<br>
		<div class="d-flex justify-content-center">
			<button onclick="window.location.href='../pdf/pdf_hist_encomendas_produto_utilizador.php'" type="submit" class="btn btn-warning" name="gerar_pdf">Gerar PDF&nbsp<img src="../img/pdf.png" width="30" height="30"></img></button>
		</div>
		<div class="container-fluid">
			<table id="minhaTabela" class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Número da Encomenda</th>
						<th>Data em que foi feita</th>
						<th>Observações</th>
						<th>Cliente</th>
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
							<?php $total = $total + $row['total_s_iva'];?>
							<td><a onclick="return confirm('Ver esta encomenda?')" href="../funcoes_utilizador/ver_encomenda_produto.php?&id_geral=<?php echo $row["id_encomenda"];?>"><img height="35" width="35" border="0" src="../img/ver_encomenda.png"></a></td></tr>
							<?php
						}?> 
					</tbody>
				</table>
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



