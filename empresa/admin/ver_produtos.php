<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
// SELECT no SQL para selecionar os dados a serem imprimidos na tabela
$sql = "SELECT id_produto,nome_produto,imagem,valor,codigo_produto,descricao,criado,editado FROM `produtos` ORDER BY id_produto ASC;";
$result = mysqli_query($connection, $sql) or die(mysql_error());
?>

<title>Menu Gestor - Gerir Produtos</title>

<?php require('topfooterA.php');
require('filtros.php');
if ($result->num_rows > 0) {
	?>
	<body>
		<h1 align="center">Produtos</h1>
		<hr>
		<br>
		<div class="d-flex justify-content-center">
			<button onclick="window.location.href='../fpdf/pdf_produtos.php'" type="submit" class="btn btn-warning" name="gerar_pdf">Gerar PDF&nbsp<img src="../img/pdf.png" width="30" height="30"></img></button>
		</div>
		<div class="container-fluid">
			<table id="minhaTabela" class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Imagem</th>
						<th>Referência</th>
						<th>Nome do Produto</th>
						<th>Descrição do Produto</th>
						<th>Preço €</th>
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
						. $row["codigo_produto"]. "</td><td>" 
						. $row["nome_produto"]. "</td><td>" 
						. $row["descricao"]. "</td><td>"
						. $row["valor"]."&euro;</td><td>" 
						. $row["criado"]. "</td><td>"
					.$row["editado"]."</td>"?><td>
						<a onclick="return confirm('Editar este produto?')" href="funcoes.php?funcao=EditarProduto&id_geral=<?php echo $row["id_produto"] ?>"><img border="0" src="../img/baseline_edit_black_18dp.png"></a></td>
						<td><a onclick="return confirm('Deseja apagar este produto?')" href="funcoes.php?funcao=ApagarProduto&id_geral=<?php echo $row["id_produto"] ?>"><img border="0" src="../img/baseline_delete_black_18dp.png"></a></td></tr><?php
					};?> 
				</tbody>
			</table>
		<?php }else{?>
			<div class=" alert alert-danger" style="top:10px;" role="alert">
				<strong>Não há produtos registados!</strong>
			</div> 
			<?php
		}
		?>
	</div>

</body>

</html>



