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
	// SQL DOS CLIENTES
$sql_clientes = "SELECT * FROM `clientes`";
$result_clientes = mysqli_query($connection, $sql_clientes);
$row_clientes=mysqli_fetch_array($result_clientes);

$id = $_SESSION ['id'];

if (isset($_POST['add_encomenda']) && $_POST['add_encomenda']=="Fazer encomenda") {

		//dados
	date_default_timezone_set('Europe/Lisbon');
	$data_encomenda = date('Y-m-d H:i:s',time());
	$comentario_encomenda = $_POST['comentario_encomenda'];
	$cliente = $_POST['cliente'];
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
		header('Refresh:2; url=encomendar_material.php');
		return;
	}
	foreach($_POST['qntP'] as $index=>$value){
		if($value > 0){
			mysqli_query($connection,"INSERT INTO `encomendas`(`id_encomenda`,`id_utilizador`,`id_cliente`,`id_material`,`quantidadeP`,`data_encomenda`,`comentario`,`total_s_iva`,`autorizada`) VALUES ('$id_encomenda','$id','$cliente',".$_POST['id_material'][$index].",".$value.",'$data_encomenda','$comentario_encomenda','','0')") or die(mysqli_error($connection));
		}
	}
	?>
	<div class="container">
		<div class="alert alert-success" role="alert">
			<strong>Material de Apoio submetido com sucesso!</strong>
		</div> 
	</div>
	<?php
	$url= "ver_encomenda_material.php?id_geral=$id_encomenda";
	header('Refresh:2; url=../funcoes_admin/'.$url);
	return;
};

?>
<title>Menu Gestor - Encomendar Material de Apoio</title>
<body>
	<h1 align="center">Encomendar - Material de Apoio</h1>
	<hr>
	<?php 
	if ($result_clientes->num_rows > 0) {?>
		<div class="container">
			<form method="POST" action="#">
				<h4>Clientes</h4>
				<div class="form-group row">
					<div class="col-8">
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
			<?php }else{?>
				<div class="container">
					<div class="alert alert-danger" style="top:10px;" role="alert">
						<strong>Não há clientes registados!</strong>
					</div> 
				</div>
			</div> 
			<?php
		}
		if(mysqli_num_rows($resultM) >0)
		{
			?>
			<hr>
			<br>
			<div class="container">
				<h4>Produtos</h4>
				<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pesquisar Material" title="Material">	
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
						<?php while($row = $resultM->fetch_assoc()) {
							?>
							<tr>
								<?php	
								$id_material = $row["id_material"];
								?>
								<td><?php echo $row["id_material"];?><input type="hidden" name="id_material[]" value="<?php echo $id_material; ?>"></td>
								<td><img class="img-responsive" width="70" height="55" src="../img/<?php echo $row['imagem'];?>"></td>
								<td><?php echo $row["nome_material"]; ?></td>
								<td><?php echo $row["tipo"]; ?></td>
								<td><input class ="productTextInput" size='1' type="number" value="0" min='0' name="qntP[]" max='10'></td></tr>
								<?php
							}}?> 
						</tbody>
					</table>
				</div>
				<hr>
				<div class="container">
					<div class="form-group row">
						<label for="text" class="col-4 col-form-label">Observações</label> 
						<textarea class="form-control here" row="10" cols="60" name="comentario_encomenda"></textarea>
					</div>
					<div class="form-group row">
						<div class="offset-4 col-8">
							<button onclick="return confirm('Tem a certeza que quer submeter?')" name="add_encomenda" type="submit" class="btn btn-primary" value="Fazer encomenda">Submeter</button>
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