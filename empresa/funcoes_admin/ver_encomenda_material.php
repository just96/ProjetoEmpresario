<?php
session_start();
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../admin/topfooterA.php"); 

$id = $_GET["id_geral"]; 


	// SQL ENCOMENDA
	$sql_encomenda = "SELECT * FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `material_apoio` ON encomendas.id_material = material_apoio.id_material WHERE id_encomenda='$id'"; // query inner join para ir buscar id do cliente com determinado id encomenda
	$result_encomenda = mysqli_query($connection, $sql_encomenda);
	// get cliente
	$row_cliente= mysqli_fetch_array($result_encomenda);
	$id_cliente = $row_cliente['nome_fiscal'];


	if(mysqli_num_rows($result_encomenda) > 0 )
	{
		?>
		<hr>
		<br>
		<div class="container">
			<h4>Cliente a que foi feito a encomenda</h4>	
			<input class="form-control" type="text" disabled="" value="<?php echo $id_cliente ?>">
			<br>
			<h4>Produtos</h4>	
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
				<div class="form-group row">
					<label for="text" class="col-4 col-form-label">Observações</label> 
					<textarea disabled class="form-control here" row="10" cols="60" name="comentario_encomenda" ><?php echo $row_cliente["comentario"]; ?></textarea>
				</div>
			</div>
