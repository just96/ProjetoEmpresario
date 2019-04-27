<?php
session_start();

if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}

include("../conectar_bd.php");
// SQL DOS CLIENTES
$sql_clientes = "SELECT * FROM `clientes` ORDER BY id_cliente ASC ";
$result_clientes = mysqli_query($connection, $sql_clientes);
$row_clientes=mysqli_fetch_array($result_clientes);
// SQL DOS produtos
$qury = "SELECT * FROM produtos ORDER BY id_produto ASC";
$result = mysqli_query($connection,$qury);


?>

<style>
	#myInput {
		width: 100%;
		font-size: 16px;
		padding: 12px 20px 12px 40px;
		border: 1px solid #ddd;
		margin-bottom: 12px;
	}

</style>

<title>Menu Gestor - Fazer Encomenda</title>
<?php require('topfooterA.php');?>
<body>
	<h1 align="center">Encomendas</h1>
	<hr>
	<?php if ($result_clientes->num_rows > 0) {?>
		<div class="container">
			<form method="POST" action="encomenda.php">
				<div class="form-group row">
					<label for="select" class="col-4 col-form-label">Cliente</label> 
					<div class="col-8">
						<select name="cliente" class="custom-select" required="required">
							<?php while($row_clientes= mysqli_fetch_array($result_clientes,MYSQLI_ASSOC)){?>
								<option value="select">Selecionar</option>
								<option value="<?php echo $row_clientes["nome_fiscal"];?>"><?php echo $row_clientes["nome_fiscal"];?></option>
							</select>
						</div>
					</div>
				<?php }}else{?>
					<div class="alert alert-danger" style="top:10px;" role="alert">
						<strong>Não há clientes registados!</strong>
					</div>  ?>
					<?php
				}
				if(mysqli_num_rows($result) >0)
				{
					?>
					<div class="container">
						<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pesquisar produtos" title="Type in a name">
						<table id="minhaTabela" class="table table-bordered">
							<thead>
								<tr>
									<th>Referência</th>
									<th>Nome do Produto</th>
									<th>Preço €</th>
									<th>Quantidade</th>
								</tr>
							</thead>
							<tbody id="myTable">
								<?php while($row = $result->fetch_assoc()) {
									echo "<tr><td>"
									. $row["codigo_produto"]. "</td><td>" 
									. $row["nome_produto"]. "</td><td>" 
									. $row["valor"]."&euro;</td><td>
									<input type='number' min='0' max='10'>
									</tr>";
								}}?> 
							</tbody>
						</table>
						<div class="form-group row">
							<label for="text" class="col-4 col-form-label">Observações</label> 
							<textarea class="form-control here" row="10" cols="60" name="comentario_encomenda"></textarea>
						</div>
						<div class="form-group row">
							<div class="offset-4 col-8">
								<button name="add_encomenda" type="submit" class="btn btn-primary">Submeter Encomenda</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</body>
		</html>

		<script>
			function myFunction() {
				var input, filter, table, tr, td, i, txtValue;
				input = document.getElementById("myInput");
				filter = input.value.toUpperCase();
				table = document.getElementById("myTable");
				tr = table.getElementsByTagName("tr");
				for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[0];
					if (td) {
						txtValue = td.textContent || td.innerText;
						if (txtValue.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						} else {
							tr[i].style.display = "none";
						}
					}       
				}
			}
		</script>