<?php
session_start();
if ($_SESSION['role'] != 'Utilizador'){
	header( "Location:../utilizador/log.php" );
}
include("../utilizador/topfooterU.php"); 
include("../conectar_bd.php");

$id = $_GET["id_geral"];
$id_utilizador = $_SESSION['id'];

$sqldata ="SELECT nome_fiscal,nome_comercial,tipo,morada,localidade,codigo_postal,num_fiscal,num_telefone,email,obs FROM `clientes` WHERE id_cliente ='$id'";
$result= mysqli_query($connection,$sqldata);
$row_c=mysqli_fetch_assoc($result);

$sql_check_admin = "SELECT user_type,id_utilizador FROM `clientes` INNER JOIN `utilizadores` ON clientes.id_utilizador = utilizadores.id_user WHERE id_cliente = '$id'";
$result_check= mysqli_query($connection,$sql_check_admin);
$row=mysqli_fetch_assoc($result_check);

if($row['user_type'] == 'Gestor' || $row['id_utilizador'] != $id_utilizador){
	?>
	<div class="container alert alert-danger" role="alert">
		Não tem permissão para editar este cliente!
	</div>
	<?php
	header("refresh:2;url=../utilizador/gerir_clientes.php");
	return;
}
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

	// COMPARAR DADOS NA EDIÇÃO
 	//Instrução SQL para selecionar diferentes dados

	$sql_fetch_nome_fiscal = "SELECT nome_fiscal FROM clientes WHERE id_cliente NOT IN ('$id') AND nome_fiscal = '$nome_fiscal'";
	$sql_fetch_nome_comercial = "SELECT nome_comercial FROM clientes WHERE id_cliente NOT IN ('$id') AND nome_comercial = '$nome_comercial'";
	$sql_fetch_morada = "SELECT morada FROM clientes WHERE id_cliente NOT IN ('$id') AND morada = '$morada'";
	$sql_fetch_num_fiscal = "SELECT num_fiscal FROM clientes WHERE id_cliente NOT IN ('$id') AND num_fiscal = '$num_fiscal'";
	$sql_fetch_num_telefone = "SELECT num_telefone FROM clientes WHERE id_cliente NOT IN ('$id') AND num_telefone = '$num_telefone'";
	$sql_fetch_email = "SELECT email FROM clientes WHERE id_cliente NOT IN ('$id') AND email = '$email'";

  //usado para comparar dados introduzidos com os da base de dados.

	$query_nome_fiscal = mysqli_query($connection,$sql_fetch_nome_fiscal); 
	$query_nome_comercial = mysqli_query($connection,$sql_fetch_nome_comercial);
	$query_morada = mysqli_query($connection,$sql_fetch_morada);
	$query_num_fiscal = mysqli_query($connection,$sql_fetch_num_fiscal);
	$query_num_telefone = mysqli_query($connection,$sql_fetch_num_telefone);
	$query_email = mysqli_query($connection,$sql_fetch_email);

  // if statments para verificar campos

	if (mysqli_num_rows($query_nome_fiscal)){
		?>
		<div class="container alert alert-danger" role="alert">
			<strong>Nome Fiscal em uso!</strong> 
		</div>
		<?php
		header('Refresh:2');
		return;
	}
	if (mysqli_num_rows($query_nome_comercial)){
		?>
		<div class="container alert alert-danger" role="alert">
			<strong>Nome Comercial em uso!</strong> 
		</div>
		<?php
		header('Refresh:2');
		return;
	}
	if (mysqli_num_rows($query_morada)){
		?>
		<div class="container alert alert-danger" role="alert">
			<strong>Morada em uso!</strong> 
		</div>
		<?php
		header('Refresh:2');
		return;
	}
	if (mysqli_num_rows($query_num_fiscal)){
		?>
		<div class="container alert alert-danger" role="alert">
			<strong>Número Fiscal em uso!</strong> 
		</div>
		<?php
		header('Refresh:2');
		return;
	}
	if (mysqli_num_rows($query_num_telefone)){
		?>
		<div class="container alert alert-danger" role="alert">
			<strong>Número de Telefone em uso!</strong> 
		</div>
		<?php
		header('Refresh:2');
		return;
	}
	if (mysqli_num_rows($query_email)){
		?>
		<div class="container alert alert-danger" role="alert">
			<strong>Email em uso!</strong> 
		</div>
		<?php
		header('Refresh:2');
		return;
	}


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
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<strong>*Campos obrigatórios</strong>
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form method="POST" action="#">
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Nome Fiscal*</label> 
										<div class="col-8">
											<input value="<?php echo $row_c["nome_fiscal"]; ?>" name="nome_fiscal" class="form-control here" required="required" type="text">
										</div>
									</div>
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Nome Comercial*</label> 
										<div class="col-8">
											<input value="<?php echo $row_c["nome_comercial"]; ?>" name="nome_comercial" class="form-control here" type="text" required="required">
										</div>
									</div>
									<div class="form-group row">
										<label for="select" class="col-4 col-form-label">Tipo*</label> 
										<div class="col-8">
											<select name="tipo" class="custom-select" required="required">
												<option value="Farmacia"<?php if($row_c["tipo"]=="Farmácia") echo 'selected="selected"';?>>Farmácia</option>
												<option value="Parafarmacia"<?php if($row_c["tipo"]=="Parafarmácia") echo 'selected="selected"';?>>Parafarmácia</option>
												<option value="Ouriversaria"<?php if($row_c["tipo"]=="Ouriversaria") echo 'selected="selected"';?>>Ouriversaria</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Morada*</label> 
										<div class="col-8">
											<input value="<?php echo $row_c["morada"]; ?>"name="morada" class="form-control here" type="text">
										</div>
									</div>
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Localidade</label> 
										<div class="col-8">
											<input value="<?php echo $row_c["localidade"]; ?>" name="localidade" class="form-control here" type="text">
										</div>
									</div>
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Código-Postal</label> 
										<div class="col-8">
											<input value="<?php echo $row_c["codigo_postal"]; ?>" name="codigo_postal" class="form-control here" type="int" maxlength="8">
										</div>
									</div>
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">NIF*</label> 
										<div class="col-8">
											<input value="<?php echo $row_c["num_fiscal"]; ?>" name="num_fiscal" class="form-control here" required="required" type="int" maxlength="9">
										</div>
									</div>  
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Telefone*</label> 
										<div class="col-8">
											<input value="<?php echo $row_c["num_telefone"]; ?>" name="num_telefone" class="form-control here" required="required" type="int" maxlength="9">
										</div>
									</div> 
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Email*</label> 
										<div class="col-8">
											<input value="<?php echo $row_c["email"]; ?>" name="email" class="form-control here" type="email" required="required">
										</div>
									</div>
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Observações</label> 
										<textarea class="form-control here" row="10" cols="60" name="comentario"><?php echo $row_c["obs"];?></textarea>
									</div>
									<div class="form-group row">
										<div class="offset-4 col-8">
											<button name="edit_client" type="submit" class="btn btn-primary" onclick="return confirm('De certeza que quer editar?')">Submeter Alterações</button>
										</div>
									</div>
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

?>