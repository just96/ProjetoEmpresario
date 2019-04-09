<!DOCTYPE html>
<html>
<head>
	<title>Ver Produtos</title>
</head>
<?php require('topfooterA.php');?>

<body>
	<h1 align="center">Produtos</h1>
	<hr>
	<div class="container mt-3">
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
				</tr>
			</thead>
			<tbody id="myTable">
			</tbody>
		</table>
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