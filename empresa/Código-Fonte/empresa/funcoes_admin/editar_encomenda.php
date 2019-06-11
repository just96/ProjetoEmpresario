<?php
session_start();

if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
};

require("../admin/topfooterA.php"); 
include("../conectar_bd.php");

$id = $_GET["id_geral"];   
$id_utilizador = $_SESSION['id'];


	// SQL ENCOMENDA já feita
	$sql_encomenda = "SELECT * FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `produtos` ON encomendas.id_produto = produtos.id_produto WHERE id_encomenda='$id'"; // query inner join para ir buscar id do cliente com determinado id encomenda
	$result_encomenda = mysqli_query($connection, $sql_encomenda);
	$row_cliente= mysqli_fetch_array($result_encomenda);
	$tipo_pagamento = $row_cliente['tipo_pagamento'];

	// SQL DOS CLIENTES
	$sql_clientes = "SELECT * FROM `clientes`";
	$result_clientes = mysqli_query($connection, $sql_clientes);
	$row_clientes=mysqli_fetch_array($result_clientes);

    // SQL DOS produtos
	$qury = "SELECT * FROM produtos ORDER BY codigo_produto ASC";
	$result = mysqli_query($connection,$qury);

	// SQL dos produtos a ser adicionados

	$query_add_product = "SELECT * FROM produtos WHERE produtos.nome_produto NOT IN (SELECT produtos.nome_produto FROM encomendas INNER JOIN produtos ON encomendas.id_produto = produtos.id_produto WHERE id_encomenda='$id')";
	$result_add_product = mysqli_query($connection,$query_add_product);

	$id_cliente = $row_cliente['nome_fiscal'];
	$data = $row_cliente['data_encomenda'];
	$tipo_pagamento = $row_cliente['tipo_pagamento'];
	$autorizada = $row_cliente['autorizada'];

	
	if($autorizada == '1'){
		?>
		<div class="container alert alert-danger" role="alert">
			Encomenda já autorizada!
		</div>
		<?php
		header('Refresh:2; url=../admin/ver_encomendas_produtos.php');
		return;
	}

	if(isset($_POST['edit_encomenda'])){

		date_default_timezone_set('Europe/Lisbon');
		$data_encomenda = date('Y-m-d H:i:s',time());
		$comentario_encomenda = $_POST['comentario_encomenda'];
		$cliente = $_POST['cliente'];
		$tipo_pagamento = $_POST['tipo_pagamento'];

		foreach($_POST['qntP'] as $index=>$value){
			if($value >= 0){
				mysqli_query($connection,"UPDATE `encomendas` SET data_encomenda = '$data' , comentario = '$comentario_encomenda' , id_cliente = '$cliente' , tipo_pagamento = '$tipo_pagamento' , id_produto = ".$_POST['id_produto'][$index]." , quantidadeP = ".$value." WHERE id_encomenda = $id") or die(mysqli_error($connection));
			}
		}
		?><div class="container">
			<div class="alert alert-success" role="alert">
				<strong>Encomenda alterada com sucesso!</strong>
			</div> 
		</div>
		<?php
		$url= "ver_encomenda_produto.php?id_geral=$id";
		header('Refresh:2; url=../funcoes_admin/'.$url);
		return;
	};
	?>
	<br>
	<div class="container">
		<strong>Encomenda nº<?php echo $id;?></strong>
		<hr>
		<h5>Nome do Cliente</h5>
		<form method="POST" action="#">
			<div class="form-group row">
				<div class="col-3">
					<select name="cliente" class="custom-select" required>
						<option value="<?php echo $row_clientes["id_cliente"];?>"><?php echo $row_clientes["nome_fiscal"];?></option>
						<?php while($row_clientes = mysqli_fetch_array($result_clientes,MYSQLI_ASSOC)){
							?>
							<option value="<?php echo $row_clientes["id_cliente"];?>"><?php echo $row_clientes["nome_fiscal"];?></option>
						<?php }?>
					</select>
				</div>
			</div>
			<hr>
			<h5>Data da encomenda</h5>
			<div class="form-group row">
				<div class="col-4">		
					<input class="form-control" type="text" disabled="" value="<?php echo $data ?>">
				</div>
			</div>
			<hr>
			<div class="form-group row">
				<div class="col-4">
					<h5>Tipo de Pagamento</h5>
					<select name="tipo_pagamento" class="custom-select" required>
						<option value="Pronto Pagamento Contra Entrega - c/ Desconto" 
						<?php if ($row_cliente["tipo_pagamento"]=="Pronto Pagamento Contra Entrega - c/ Desconto") echo 'selected="selected"';?>> Pronto Pagamento Contra Entrega - c/ Desconto </option>
						<option  value="Cheque a 30 Dias - s/ Desconto" <?php if($row_cliente["tipo_pagamento"]=="Cheque a 30 Dias - s/ Desconto") echo 'selected="selected"';?>> Cheque a 30 Dias - s/ Desconto </option>
					</select>
				</div>
			</div>
			<?php
			if(mysqli_num_rows($result_encomenda) > 0 )
			{
				?>
				<hr>
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
						<tr>
						</thead>
						<tbody>
							<?php
							$id_produto = $row_cliente["id_produto"];
							?>
							<td><?php echo $row_cliente["id_produto"];?><input type="hidden" name="id_produto[]" value="<?php echo $id_produto; ?>"></td>
							<td><img class="img-responsive" width="70" height="55" src="../img/<?php echo $row_cliente['imagem'];?>"></td>
							<td><?php echo $row_cliente["codigo_produto"]; ?></td>
							<td><?php echo $row_cliente["nome_produto"]; ?></td>
							<td><?php echo $row_cliente["valor_s_iva"];?>&euro;</td>
							<td><input size='1' type="text" value="<?php echo $row_cliente["quantidadeP"]; ?>" min='0' name="qntP[]" max='100'></td>
						</tr>
						<?php 
						while($row_encomenda = mysqli_fetch_array($result_encomenda)){
							?>
							<tr>
								<?php
								$id_produto = $row_encomenda["id_produto"];
								?>
								<td><?php echo $row_encomenda["id_produto"];?><input type="hidden" name="id_produto[]" value="<?php echo $id_produto; ?>"></td>
								<td><img class="img-responsive" width="70" height="55" src="../img/<?php echo $row_encomenda['imagem'];?>"></td>
								<td><?php echo $row_encomenda["codigo_produto"]; ?></td>
								<td><?php echo $row_encomenda["nome_produto"]; ?></td>
								<td><?php echo $row_encomenda["valor_s_iva"];?>&euro;</td>
								<td><input size='1' type="text" value="<?php echo $row_encomenda["quantidadeP"]; ?>" min='0' name="qntP[]" max='100'></td></tr>
								<?php
							}
						}
						if(mysqli_num_rows($result_add_product) > 0 )
						{
							while($row_add = mysqli_fetch_array($result_add_product)){
								?>
								<tr>
									<?php
									$id_produto = $row_add["id_produto"];
									?>
									<td><?php echo $row_add["id_produto"];?><input type="hidden" name="id_produto[]" value="<?php echo $id_produto; ?>"></td>
									<td><img class="img-responsive" width="70" height="55" src="../img/<?php echo $row_add['imagem'];?>"></td>
									<td><?php echo $row_add["codigo_produto"]; ?></td>
									<td><?php echo $row_add["nome_produto"]; ?></td>
									<td><?php echo $row_add["valor_s_iva"];?>&euro;</td>
									<td><input size='1' type="text" value="" min='0' name="qntP[]" max='100'></td></tr>
									<?php
								}
							};
							?>
						</tbody>
					</table>
					<hr>
					<div class="form-group row">
						<label for="text" class="col-4 col-form-label">Observações</label> 
						<textarea class="form-control here" row="10" cols="60" name="comentario_encomenda" ><?php echo $row_cliente["comentario"]; ?></textarea>
					</div>
					<div class="form-group row">
						<div class="offset-4 col-8">
							<button onclick="return confirm('Tem a certeza que quer editar a encomenda?')" name="edit_encomenda" type="submit" class="btn btn-primary" value="Fazer encomenda">Submeter Alterações</button>
						</div>
					</div>
				</form>
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