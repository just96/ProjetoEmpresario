<?php
session_start();
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
require("../admin/topfooterA.php"); 
include("../conectar_bd.php");

$id = $_GET["id_geral"];   
$sqldata ="SELECT nome_fiscal,nome_comercial,tipo,morada,localidade,codigo_postal,num_fiscal,num_telefone,email,obs FROM `clientes` WHERE id_cliente ='$id'";
$result= mysqli_query($connection,$sqldata);
$row=mysqli_fetch_assoc($result);

if(isset($_POST['edit_client'])) { 
	$nome_fiscal = strip_tags($_POST['nome_fiscal']); 		// remove tags de html e php exemplo <br>
	$nome_comercial = strip_tags($_POST['nome_comercial']);
	$tipo = strip_tags($_POST['tipo']);
	$morada = strip_tags($_POST['morada']);
	$localidade = strip_tags($_POST['localidade']); 
	$codigo_postal = strip_tags($_POST['codigo_postal']);
	$num_fiscal = strip_tags($_POST['num_fiscal']);
	$num_telefone = strip_tags($_POST['num_telefone']);
	$email = strip_tags($_POST['email']); 
	$comentario = strip_tags($_POST['comentario']);

	$nome_fiscal = stripcslashes($nome_fiscal);			// esta função remove a barra invertida da string
	$nome_comercial = stripcslashes($nome_comercial);
	$tipo = stripcslashes($tipo);
	$morada = stripcslashes($morada);
	$localidade = stripcslashes($localidade);
	$codigo_postal = stripcslashes($codigo_postal);
	$num_fiscal = stripcslashes($num_fiscal);
	$num_telefone = stripcslashes($num_telefone);
	$email = stripcslashes($email);
	$comentario = stripcslashes($comentario);

	$nome_fiscal = mysqli_real_escape_string($connection,$nome_fiscal); // esta função esquece os carateres especiais para a string ser usada numa instrução de SQL
	$nome_comercial = mysqli_real_escape_string($connection,$nome_comercial); 
	$tipo = mysqli_real_escape_string($connection,$tipo); 
	$morada = mysqli_real_escape_string($connection,$morada); 
	$localidade = mysqli_real_escape_string($connection,$localidade); 
	$codigo_postal = mysqli_real_escape_string($connection,$codigo_postal); 
	$num_fiscal = mysqli_real_escape_string($connection,$num_fiscal); 
	$num_telefone = mysqli_real_escape_string($connection,$num_telefone); 
	$email = mysqli_real_escape_string($connection,$email); 
	$comentario = mysqli_real_escape_string($connection,$comentario); 

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

	date_default_timezone_set('Europe/Lisbon');
	$editado = date('Y-m-d H:i:s');

	$sqleditcliente = "UPDATE `clientes` SET nome_fiscal='$nome_fiscal', nome_comercial='$nome_comercial', tipo='$tipo', morada='$morada', localidade='$localidade', codigo_postal='$codigo_postal' , num_fiscal='$num_fiscal' , num_telefone='$num_telefone' , email='$email' , obs='$comentario' , editado = '$editado' WHERE id_cliente='$id'";
	mysqli_query($connection,$sqleditcliente);
	?> 
	<div class="container alert alert-success" role="alert">
		Alterações guardadas!
	</div>
	<?php
	header('refresh:2;url=../admin/gerir_clientes.php');	
}



?>
<body>
	<h1 align="center">Editar Cliente</h1>
	<hr>
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="card">
					<strong>*Campos obrigatórios</strong>
					<div class="card-body">
						<div class="row">
						</div>
						<div class="row">
							<div class="col-md-12">
								<form method="POST" action="#">
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Nome Fiscal*</label> 
										<div class="col-8">
											<input value="<?php echo $row["nome_fiscal"]; ?>" name="nome_fiscal" class="form-control here" type="text" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Nome Comercial*</label> 
										<div class="col-8">
											<input value="<?php echo $row["nome_comercial"]; ?>" name="nome_comercial" class="form-control here" type="text" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="select" class="col-4 col-form-label">Tipo*</label> 
										<div class="col-8">
											<select name="tipo" class="custom-select" required>
												<option value="Farmácia"<?php if($row["tipo"]=="Farmácia") echo 'selected="selected"';?>>Farmácia</option>
												<option value="Parafarmácia"<?php if($row["tipo"]=="Parafarmácia") echo 'selected="selected"';?>>Parafarmácia</option>
												<option value="Ouriversaria"<?php if($row["tipo"]=="Ouriversaria") echo 'selected="selected"';?>>Ouriversaria</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Morada*</label> 
										<div class="col-8">
											<input required value="<?php echo $row["morada"]; ?>"name="morada" class="form-control here" type="text">
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
											<input required value="<?php echo $row["num_fiscal"]; ?>" name="num_fiscal" class="form-control here" type="int" maxlength="9">
										</div>
									</div>  
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Telefone*</label> 
										<div class="col-8">
											<input required value="<?php echo $row["num_telefone"]; ?>" name="num_telefone" class="form-control here" type="int" maxlength="9">
										</div>
									</div> 
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Email*</label> 
										<div class="col-8">
											<input required value="<?php echo $row["email"]; ?>" name="email" class="form-control here" type="email">
										</div>
									</div>
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Observações</label> 
										<textarea class="form-control here" row="10" cols="60" name="comentario"><?php echo $row["obs"];?></textarea>
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