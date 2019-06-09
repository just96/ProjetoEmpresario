<?php
session_start();
if ($_SESSION['role'] != 'Utilizador'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../utilizador/topfooterU.php"); 

$id = $_GET["id_geral"]; 
$id_user = $_SESSION['id'];

	// SQL ENCOMENDA
	$sql_encomenda = "SELECT * FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `material_apoio` ON encomendas.id_material = material_apoio.id_material WHERE id_encomenda='$id'"; // query inner join para ir buscar id do cliente com determinado id encomenda
	$result_encomenda = mysqli_query($connection, $sql_encomenda);
	// sql para ver se tem permissão na pagina, o utilizador
	$sql_check_admin = "SELECT * FROM `encomendas` INNER JOIN `utilizadores` ON encomendas.id_utilizador = utilizadores.id_user WHERE id_encomenda = '$id'";
	$result_check= mysqli_query($connection,$sql_check_admin);
	$row=mysqli_fetch_assoc($result_check);
	
	if(($row['user_type'] == 'Gestor') || ($row['id_user'] != $id_user)){
		?>
		<div class="container alert alert-danger" role="alert">
			Não tem permissão para ver esta encomenda!
		</div>
		<?php
		header("refresh:2;url=../utilizador/ver_encomendas_produtos.php");
		return;
	}
	// get cliente
	$row_cliente= mysqli_fetch_array($result_encomenda);
	$id_cliente = $row_cliente['nome_fiscal'];
	$data = $row_cliente['data_encomenda'];
	$autorizada = $row_cliente['autorizada'];

	if($autorizada == '1'){?>
		<div class="container alert alert-primary" role="alert">
			Já foi aprovada pelo gestor!
		</div>
		<?php
	}else{
		?>
		<div class="container alert alert-info" role="alert">
			Em espera para ser aprovada pelo gestor!
		</div>
		<?php
	}
	if(mysqli_num_rows($result_encomenda) > 0 )
	{
		?>
		<hr>
		<br>
		<div class="container">
			<strong>Encomenda nº<?php echo $id;?></strong>
			<hr>
			<h5>Nome do Cliente</h5>	
			<div class="form-group row">
				<div class="col-4">	
					<input class="form-control" type="text" disabled="" value="<?php echo $id_cliente ?>">
				</div>
			</div>
			<hr>
			<h5>Data</h5>
			<div class="form-group row">
				<div class="col-4">	
					<input class="form-control" type="text" disabled="" value="<?php echo $data ?>">
				</div>
			</div>
			<hr>
			<h4>Material</h4>	
			<table id="minhaTabela" class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Id</th>
						<th>Imagem</th>
						<th>Nome do Material</th>
						<th>Tipo</th>
						<th>Quantidade</th>
					</tr>
					<tr>
						<td><?php echo $row_cliente["id_material"];?></td>
						<td><img class="img-responsive" width="70" height="55" src="../img/<?php echo $row_cliente['imagem'];?>"></td>
						<td><?php echo $row_cliente["nome_material"]; ?></td>
						<td><?php echo $row_cliente["tipo"]; ?></td>
						<td><input size='1' disabled type="text" value="<?php echo $row_cliente["quantidadeP"]; ?>" min='0' name="qntP[]" max='10'></td></tr>
					</thead>
					<tbody>
						<?php 
						while($row_encomenda = mysqli_fetch_array($result_encomenda)){
							?>
							<tr>
								<td><?php echo $row_encomenda["id_material"];?></td>
								<td><img class="img-responsive" width="70" height="55" src="../img/<?php echo $row_encomenda['imagem'];?>"></td>
								<td><?php echo $row_encomenda["nome_material"]; ?></td>
								<td><?php echo $row_encomenda["tipo"]; ?></td>
								<td><input size='1' disabled type="text" value="<?php echo $row_encomenda["quantidadeP"]; ?>" min='0' name="qntP[]" max='10'></td></tr>
								<?php
							}
						}?> 
					</tbody>
				</table>
			</div>
			<hr>
			<div class="container">
				<h3>Gerar PDF</h3>
				<a onclick="return confirm('Gerar pdf?')" href="../pdf/encomenda_individual_material.php?&id_geral=<?php echo $id;?>"><img height="35" width="35" border="0" src="../img/pdf.png"></a>
				<div class="form-group row">
					<label for="text" class="col-4 col-form-label">Observações</label> 
					<textarea disabled class="form-control here" row="10" cols="60" name="comentario_encomenda" ><?php echo $row_cliente["comentario"]; ?></textarea>
				</div>
			</div>

