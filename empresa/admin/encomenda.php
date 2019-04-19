<?php
session_start();

if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}

include("../conectar_bd.php");
$sql = "SELECT nome_comercial FROM `clientes`";
$result = mysqli_query($connection, $sql);
$row=mysqli_fetch_array($result);
?>

<title>Fazer Encomenda</title>
<?php require('topfooterA.php');?>
<body>
	<h1 align="center">Encomendas</h1>
	<hr>
	<?php if ($result->num_rows > 0) {?>
		<div class="container">
			<form method="POST" action="encomenda.php">
				<div class="form-group row">
					<label for="select" class="col-4 col-form-label">Cliente</label> 
					<div class="col-8">
						<select name="cliente" class="custom-select" required="required">
							<?php while($row = mysqli_fetch_array($result)){;?>
								<option><?php echo $row["nome_comercial"];?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="text" class="col-4 col-form-label">Observações</label> 
					<textarea class="form-control here" row="10" cols="60" name="comentario_encomenda"></textarea>
				</div>
				<div class="form-group row">
					<div class="offset-4 col-8">
						<button name="add_encomenda" type="submit" class="btn btn-primary">Submeter Encomenda</button>
					</div>
				</div>
			</form>
		<?php }else{?>
			<div class="container">
				<div class="alert alert-danger" style="top:10px;" role="alert">
					<strong>Não há clientes registados!</strong>
				</div> 
			</div>
			<?php
		}
		?>
	</div>
</body>
</html>