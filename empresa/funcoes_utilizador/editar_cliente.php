<?php
session_start();
if ($_SESSION['role'] != 'Utilizador'){
	header( "Location:../utilizador/log.php" );
}
include("../utilizador/topfooterU.php"); 
include("../conectar_bd.php");


$id = $_GET["id_geral"];   
$sqldata ="SELECT nome_fiscal,nome_comercial,tipo,morada,localidade,codigo_postal,num_fiscal,num_telefone,email,obs FROM `clientes` WHERE id_cliente ='$id'";
$result= mysqli_query($connection,$sqldata);

if(isset($_POST['edit_client'])) { 
	$nome_fiscal = $_POST['nome_fiscal']; 
	$nome_comercial = $_POST['nome_comercial'];
	$tipo = $_POST['tipo'];
	$morada = $_POST['morada'];
	$localidade = $_POST['localidade']; 
	$codigo_postal = $_POST['codigo_postal'];
	$num_fiscal = $_POST['num_fiscal'];
	$num_telefone = $_POST['num_telefone'];
	$email = $_POST['email']; 
	$comentario = $_POST['comentario'];

	date_default_timezone_set('Europe/Lisbon');
	$editado = date('Y-m-d H:i:s');

	$sqleditcliente = "UPDATE `clientes` SET nome_fiscal='$nome_fiscal', nome_comercial='$nome_comercial', tipo='$tipo', morada='$morada', localidade='$localidade', codigo_postal='$codigo_postal' , num_fiscal='$num_fiscal' , num_telefone='$num_telefone' , email='$email' , obs='$comentario' , editado = '$editado' WHERE id_cliente='$id'";
	mysqli_query($connection,$sqleditcliente);
	?> 
	<div class="container alert alert-success" role="alert">
		Alterações guardadas!
	</div>
	<?php
	header('refresh:2;url=../utilizador/gerir_clientes.php');
}

?>
<body>
	<h1 align="center">Editar Cliente</h1>
	<hr>
	<div class="container" style="margin-top: 70px;margin-right:250px;">
		<?php if ($result->num_rows > 0) { 
			?>
			<div class="row">
				<div class="col-md-9">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<form method="POST" action="#">
										<?php while($row=mysqli_fetch_assoc($result)){
											?>
											<div class="form-group row">
												<label for="text" class="col-4 col-form-label">Nome Fiscal*</label> 
												<div class="col-8">
													<input value="<?php echo $row["nome_fiscal"]; ?>" name="nome_fiscal" class="form-control here" required="required" type="text">
												</div>
											</div>
											<div class="form-group row">
												<label for="text" class="col-4 col-form-label">Nome Comercial*</label> 
												<div class="col-8">
													<input value="<?php echo $row["nome_comercial"]; ?>" name="nome_comercial" class="form-control here" type="text" required="required">
												</div>
											</div>
											<div class="form-group row">
												<label for="select" class="col-4 col-form-label">Tipo*</label> 
												<div class="col-8">
													<select name="tipo" class="custom-select" required="required">
														<option value="Farmacia"<?php if($row["tipo"]=="Farmácia") echo 'selected="selected"';?>>Farmácia</option>
														<option value="Parafarmacia"<?php if($row["tipo"]=="Parafarmácia") echo 'selected="selected"';?>>Parafarmácia</option>
														<option value="Ouriversaria"<?php if($row["tipo"]=="Ouriversaria") echo 'selected="selected"';?>>Ouriversaria</option>
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label for="text" class="col-4 col-form-label">Morada*</label> 
												<div class="col-8">
													<input value="<?php echo $row["morada"]; ?>"name="morada" class="form-control here" type="text">
												</div>
											</div>
											<div class="form-group row">
												<label for="text" class="col-4 col-form-label">Localidade</label> 
												<div class="col-8">
													<input value="<?php echo $row["localidade"]; ?>" name="localidade" class="form-control here" type="text">
												</div>
											</div>
											<div class="form-group row">
												<label for="text" class="col-4 col-form-label">Código-Postal</label> 
												<div class="col-8">
													<input value="<?php echo $row["codigo_postal"]; ?>" name="codigo_postal" class="form-control here" type="int" maxlength="8">
												</div>
											</div>
											<div class="form-group row">
												<label for="text" class="col-4 col-form-label">NIF*</label> 
												<div class="col-8">
													<input value="<?php echo $row["num_fiscal"]; ?>" name="num_fiscal" class="form-control here" required="required" type="int" maxlength="9">
												</div>
											</div>  
											<div class="form-group row">
												<label for="text" class="col-4 col-form-label">Telefone*</label> 
												<div class="col-8">
													<input value="<?php echo $row["num_telefone"]; ?>" name="num_telefone" class="form-control here" required="required" type="int" maxlength="9">
												</div>
											</div> 
											<div class="form-group row">
												<label for="text" class="col-4 col-form-label">Email*</label> 
												<div class="col-8">
													<input value="<?php echo $row["email"]; ?>" name="email" class="form-control here" type="email" required="required">
												</div>
											</div>
											<div class="form-group row">
												<label for="text" class="col-4 col-form-label">Observações</label> 
												<textarea class="form-control here" row="10" cols="60" name="comentario"><?php echo $row["obs"];?></textarea>
											</div>
											<div class="form-group row">
												<div class="offset-4 col-8">
													<button name="edit_client" type="submit" class="btn btn-primary" onclick="return confirm('De certeza que quer editar?')">Editar Cliente</button>
												</div>
											</div>
											<hr>
											<strong>*Campos obrigatórios</strong>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<p></p>
		</body>
		<?php
	}
}	

?>