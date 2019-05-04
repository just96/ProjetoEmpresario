	<?php
	session_start();

	if ($_SESSION['role'] != 'Gestor'){
		header( "Location:../utilizador/log.php" );
	}
	require('topfooterA.php');
	include("../conectar_bd.php");
	// SQL DO Material de Apoio
	$query = "SELECT * FROM material_apoio ORDER BY id_material ASC";
	$resultM = mysqli_query($connection,$query);

	if(mysqli_num_rows($resultM) >0)
	{
		?>
		<div class="container">
			<h4>Material de Apoio</h4>
			<br>
			<table id="myTable" class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Id</th>
						<th>Imagem</th>
						<th>Nome do Material</th>
						<th>Tipo</th>
						<th>Quantidade</th>
					</tr>
				</thead>
				<tbody>
					<?php while($rowM = $resultM->fetch_assoc()) {
						?>
						<tr>
							<?php	
							$id_material = $rowM["id_material"];
							?>
							<td><?php echo $rowM["id_material"];?><input type="hidden" name="id_material[]" value="<?php echo $id_material; ?>"></td>
							<td><img class="img-responsive" width="70" height="55" src="../img/<?php echo $rowM['imagem'];?>"></td>
							<td><?php echo $rowM["nome_material"]; ?></td>
							<td><?php echo $rowM["tipo"]; ?></td>
							<td><input size='1' type="text" value="0" min='0' name="qnt[]" max='10'></td></tr>
							<?php
						}};
						?> 
					</tbody>
				</table>
			</div>
			<hr>