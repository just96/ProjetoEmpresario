<?php
session_start();
require('topfooterA.php');

if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}

include("../conectar_bd.php");
// SQL DOS CLIENTES
$sql_clientes = "SELECT * FROM `clientes`";
$result_clientes = mysqli_query($connection, $sql_clientes);
$row_clientes=mysqli_fetch_array($result_clientes);
// SQL DOS produtos
$qury = "SELECT * FROM produtos ORDER BY codigo_produto ASC";
$result = mysqli_query($connection,$qury);

$id = $_SESSION ['id'];

if (isset($_POST['add_encomenda']) && $_POST['add_encomenda']=="Fazer encomenda") {

	include("../conectar_bd.php");

		//dados
	date_default_timezone_set('Europe/Lisbon');
	$data_encomenda = date('Y-m-d H:i:s',time());
	$comentario_encomenda = $_POST['comentario_encomenda'];
	$cliente = $_POST['cliente'];
	$tipo_pagamento = $_POST['tipo_pagamento'];
		//SQL
	$sql_enc = "SELECT id_encomenda FROM encomendas ORDER BY id_encomenda DESC LIMIT 1";
	$result_enc = mysqli_query($connection, $sql_enc);
	$row_enc=mysqli_fetch_array($result_enc);
	$id_encomenda = $row_enc['id_encomenda'];
	$id_encomenda++;

	if($cliente == 'null'){
		?>
		<div class="container">
			<div class="alert alert-warning" role="alert">
				<strong>Selecione um cliente!</strong>
			</div> 
		</div>
		<?php
		header('Refresh:2; url=encomendar_produtos.php');
		return;
	}
	if($tipo_pagamento =='null'){
		?>
		<div class="container">
			<div class="alert alert-warning" role="alert">
				<strong>Selecione um tipo de pagamento!</strong>
			</div> 
		</div>
		<?php
		header('Refresh:2; url=encomendar_produtos.php');
		return;
	}
	foreach($_POST['qntP'] as $index=>$value){
		if($value > 0){
			mysqli_query($connection,"INSERT INTO `encomendas`(`id_encomenda`,`id_utilizador`,`id_cliente`,`id_produto`,`quantidadeP`,`tipo_pagamento`,`data_encomenda`,`comentario`,`total_s_iva`,`total_geral_cheque`,`total_liquido_pp`,`total_geral_pp`,`autorizada`) VALUES ('$id_encomenda','$id','$cliente',".$_POST['id_produto'][$index].",".$value.",'$tipo_pagamento','$data_encomenda','$comentario_encomenda','','','','','0')") or die(mysqli_error($connection));
		}
	}
	?><div class="container">
		<div class="alert alert-success" role="alert">
			<strong>Encomenda feita com sucesso!</strong>
		</div> 
	</div>
	<?php
	$url= "ver_encomenda_produto.php?id_geral=$id_encomenda";
	header('Refresh:2; url=../funcoes_admin/'.$url);
	return;
};

?>

<title>Menu Gestor - Encomendar Produtos</title>
<body>
	<h1 align="center">Nota de Encomenda - Produtos</h1>
	<hr>
	<?php 
	if ($result_clientes->num_rows > 0) {?>
		<div class="container">
			<form method="POST" action="#">
				<h4>Clientes</h4>
				<div class="form-group row">
					<div class="col-3">
						<select name="cliente" class="custom-select" required>
							<option value="null">Selecione o cliente</option>
							<option value="<?php echo $row_clientes["id_cliente"];?>"><?php echo $row_clientes["nome_fiscal"];?></option>
							<?php while($row_clientes = mysqli_fetch_array($result_clientes,MYSQLI_ASSOC)){
								?>
								<option value="<?php echo $row_clientes["id_cliente"];?>"><?php echo $row_clientes["nome_fiscal"];?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-4">
						<h4>Tipo de Pagamento</h4>
						<select name="tipo_pagamento" class="custom-select" required>
							<option value="null">Selecione o tipo de pagamento</option>
							<option value="Pronto Pagamento Contra Entrega - c/ Desconto">Pronto Pagamento Contra Entrega - c/ Desconto</option>
							<option value="Cheque a 30 Dias - s/ Desconto">Cheque a 30 Dias - s/ Desconto</option>
						</select>
					</div>
				</div>
			<?php }else{?>
				<div class="container">
					<div class="alert alert-danger" style="top:10px;" role="alert">
						<strong>Não há clientes registados!</strong>
					</div> 
				</div>
			</div> 
			<?php
		}
		if(mysqli_num_rows($result) >0)
		{
			?>
			<hr>
			<br>
			<div class="container">
				<h4>Produtos</h4>
				<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pesquisar produtos" title="produtos">	
				<table id="myTable" class="table table-bordered">
					<thead class="thead-dark">
						<tr>
							<th>Id</th>
							<th>Imagem</th>
							<th>Referência</th>
							<th>Nome do Produto</th>
							<th>Valor s/ IVA</th>
							<th>Quantidade</th>
						</tr>
					</thead>
					<tbody>
						<?php while($row = $result->fetch_assoc()) {
							?>
							<tr>
								<?php	
								$id_produto = $row["id_produto"];
								?>
								<td><?php echo $row["id_produto"];?><input type="hidden" name="id_produto[]" value="<?php echo $id_produto; ?>"></td>
								<td><img class="img-responsive" width="70" height="55" src="../img/<?php echo $row['imagem'];?>"></td>
								<td><?php echo $row["codigo_produto"]; ?></td>
								<td><?php echo $row["nome_produto"]; ?></td>
								<td><?php echo $row["valor_s_iva"];?>&euro;<input type="hidden" name="valor" value="<?php echo $row["valor_s_iva"]; ?>"></td>
								<td><input size='1' type="number" value="0" min='0' name="qntP[]" max="100"></td></tr>
								<?php
							}}?> 
						</div>
					</tbody>
				</table>
			</div>
			<hr>
			<div class="container">
				<div class="form-group row">
					<label for="text" class="col-4 col-form-label">Observações</label> 
					<textarea class="form-control here" row="5" cols="50" name="comentario_encomenda"></textarea>
				</div>
				<div class="form-group row">
					<div class="offset-4 col-8">
						<button onclick="return confirm('Tem a certeza que quer fazer a encomenda?')" name="add_encomenda" type="submit" class="btn btn-primary" value="Fazer encomenda">Submeter Encomenda</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#myTable tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>