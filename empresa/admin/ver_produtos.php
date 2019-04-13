<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] != 'admin'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
// SELECT no SQL para selecionar os dados a serem imprimidos na tabela
$sql = "SELECT nome_produto,valor,codigo_produto,descricao,data FROM `produtos`";
$result = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ver Produtos</title>
</head>
<?php require('topfooterA.php');
if ($result->num_rows > 0) {
	?>
	<body>
		<h1 align="center">Produtos</h1>
		<hr>
		<div class="container-fluid">
			<input class="form-control" id="myInput" type="text" placeholder="Procurar...">
			<br>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Referência</th>
						<th>Nome do Produto</th>
						<th>Descrição do Produto</th>
						<th>Preço</th>
						<th>Data em que foi adicionado</th>
						<th>Editar</th>
						<th>Apagar</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php while($row = $result->fetch_assoc()) {
						echo "<tr><td>" . $row["codigo_produto"]. "</td><td>" . $row["nome_produto"]. "</td><td>" . $row["descricao"]. "</td><td>". $row["valor"]. "</td><td>" . $row["data"]. "</td>"?><td><a href="#"><img border="0" src="../img/baseline_edit_black_18dp.png" href="#"></a></td>
							<td><a href="#"><img border="0" src="../img/baseline_delete_black_18dp.png" href="#"></a></td></tr><?php
						};?>
					</tbody>
				</table>
				<div class="d-flex justify-content-center">
					<button type="button" class="btn btn-warning">Gerar PDF&nbsp<img src="../img/pdf.png" width="30" height="30"></img></button>
				</div>
			<?php }else{?>
				<div class="container">
					<div class="alert alert-danger" style="top:10px;" role="alert">
						<strong>Não há produtos registados!</strong>
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
</body>

</html>