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
// SQL DO Material de Apoio
$query = "SELECT * FROM material_apoio ORDER BY id_material ASC";
$resultM = mysqli_query($connection,$query);


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
<?php require('topfooterA.php');
require('filtros.php');?>
<body>
	<h1 align="center">Encomendas</h1>
	<hr>
	<?php if ($result_clientes->num_rows > 0) {?>
		<div class="container">
			<form method="POST" action="encomenda.php">
				<h4>Clientes</h4>
				<div class="form-group row">
					<div class="col-8">
						<select name="cliente" class="custom-select" required="required">
							<?php while($row_clientes= mysqli_fetch_array($result_clientes,MYSQLI_ASSOC)){?>
								<option value="select">Selecionar</option>
								<option value="<?php echo $row_clientes["nome_fiscal"];?>"><?php echo $row_clientes["nome_fiscal"];?></option>
								<input type="hidden" value="<?php echo $row_clientes["id_cliente"];?>">
							</select>
						</div>
					</div>
				<?php }}else{?>
					<div class="alert alert-danger" style="top:10px;" role="alert">
						<strong>Não há clientes registados!</strong>
					</div> 
				</div> ?>
				<?php
			}
			if(mysqli_num_rows($result) >0)
			{
				?>
				<hr>
				<h4>Produtos</h4>	
				<br>
				<div class="container">
					<table id="minhaTabela" class="table table-bordered">
						<thead class="thead-dark">
							<tr>
								<th>Imagem</th>
								<th>Referência</th>
								<th>Nome do Produto</th>
								<th>Preço( € )</th>
								<th>Quantidade</th>
							</tr>
						</thead>
						<tbody>
							<?php while($row = $result->fetch_assoc()) {
								echo "<tr><td><img class='rounded' height='50' width='60' src='../img/"
								. $row["imagem"]."'></td><td>"
								. $row["codigo_produto"]. "</td><td>" 
								. $row["nome_produto"]. "</td><td>"
								. $row["valor"]."&euro;</td><td>
								<input type='number' style='width:20px;'
								</td></tr>";
							}}?> 
						</tbody>
					</table>
				</div>
				<hr>

				<?php
				if(mysqli_num_rows($resultM) >0)
				{
					?>
					<h4>Material de Apoio</h4>
					<br>
					<div class="container">
						<table id="myTable" class="table table-bordered">
							<thead class="thead-dark">
								<tr>
									<th>Imagem</th>
									<th>Nome do Material</th>
									<th>Tipo</th>
									<th>Quantidade</th>
								</tr>
							</thead>
							<tbody>
								<?php while($rowM = $resultM->fetch_assoc()) {
									echo "<tr><td><img class='rounded' height='50' width='60' src='../img/"
									.$rowM["imagem"]."'></td><td>"
									. $rowM["nome_material"]. "</td><td>" 
									. $rowM["tipo"]."</td><td>
									<input type='number' min='0' max='10'></td></tr>";
								}};?> 
							</tbody>
						</table>
						<label class="total">Total</label>
						<input type="text" id="Total" readonly>
						<a href="javascript:document.tax_form.submit();">Submit</a>
					</div>
					<hr>
					<div class="container">
						<div class="form-group row">
							<label for="text" class="col-4 col-form-label">Observações</label> 
							<textarea class="form-control here" row="10" cols="60" name="comentario_encomenda"></textarea>
						</div>
						<div class="form-group row">
							<div class="offset-4 col-8">
								<button onclick="return confirm('Tem a certeza que quer fazer a encomenda?')" name="add_encomenda" type="submit" class="btn btn-primary">Submeter Encomenda</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</body>
		</html>

		<?php
		if(isset($_POST['add_encomenda'])) {

			include("../conectar_bd.php");

		}

		?>
