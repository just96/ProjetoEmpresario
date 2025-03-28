<?php
session_start();
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../admin/topfooterA.php"); 

$id = $_GET["id_geral"];   

$sqldata ="SELECT id_user,nome_completo,nome,email,num_fiscal,num_telefone,user_type,password,obs FROM `utilizadores` WHERE id_user ='$id'";
$result= mysqli_query($connection,$sqldata);
$row=mysqli_fetch_assoc($result);

if($row['nome'] == 'admin'){
	?>
	<div class="container alert alert-danger" role="alert">
		Não tem permissão para editar este utilizador!
	</div>
	<?php
	header("refresh:2;url=../admin/gerir_utilizadores.php");
	return;
}

if(isset($_POST['edit_user'])) { 

	$nome_completo = strip_tags($_POST['nome_completo']); 
	$username = strip_tags($_POST['username']);
	$email = strip_tags($_POST['email']);
	$num_fiscal = strip_tags($_POST['num_fiscal']);
	$num_telefone = strip_tags($_POST['num_telefone']); 
	$pw1 = strip_tags($_POST['pw1']);
	$pw2 = strip_tags($_POST['pw2']);
	$role = strip_tags($_POST['role']);
	$comentario = strip_tags($_POST['comentario']);

	$nome_completo = stripcslashes($nome_completo);
	$username = stripcslashes($username);
	$email = stripcslashes($email);
	$num_fiscal = stripcslashes($num_fiscal);
	$num_telefone = stripcslashes($num_telefone);
	$pw1 = stripcslashes($pw1);
	$pw2 = stripcslashes($pw2);
	$role = stripcslashes($role);
	$comentario = stripcslashes($comentario);

	$nome_completo = mysqli_real_escape_string($connection,$nome_completo); 
	$username = mysqli_real_escape_string($connection,$username); 
	$email = mysqli_real_escape_string($connection,$email); 
	$num_fiscal = mysqli_real_escape_string($connection,$num_fiscal); 
	$num_telefone = mysqli_real_escape_string($connection,$num_telefone); 
	$pw1 = mysqli_real_escape_string($connection,$pw1); 
	$pw2 = mysqli_real_escape_string($connection,$pw2); 
	$role = mysqli_real_escape_string($connection,$role); 
	$comentario = mysqli_real_escape_string($connection,$comentario); 

	date_default_timezone_set('Europe/Lisbon');
	$editado = date('Y-m-d H:i:s');

	// COMPARAR DADOS NA EDIÇÃO

	//Instrução SQL para selecionar diferentes dados

	$sql_fetch_username = "SELECT nome FROM utilizadores WHERE id_user NOT IN ('$id') AND nome = '$username'";
	$sql_fetch_email = "SELECT email FROM utilizadores WHERE id_user NOT IN ('$id') AND email = '$email'";
	$sql_fetch_n_fiscal = "SELECT num_fiscal FROM utilizadores WHERE id_user NOT IN ('$id') AND num_fiscal = '$num_fiscal'";
	$sql_fetch_n_telefone = "SELECT num_telefone FROM utilizadores WHERE id_user NOT IN ('$id') AND num_telefone  = '$num_telefone'";

  //usado para comparar o nome/email de utilizador introduzido com os da base de dados.

	$query_username = mysqli_query($connection,$sql_fetch_username); 
	$query_email = mysqli_query($connection,$sql_fetch_email);
	$query_n_fiscal = mysqli_query($connection,$sql_fetch_n_fiscal);
	$query_n_telefone = mysqli_query($connection,$sql_fetch_n_telefone);

	// guarda a password antiga se os campos desta estiverem vazios
	$sql_pw = "SELECT * FROM `utilizadores` WHERE id_user='$id'";
	$result_pw=mysqli_query($connection,$sql_pw);
	$row_pw=mysqli_fetch_array($result_pw);
	$pw=$row_pw['password'];

	if((empty($pw1)) || (empty($pw2))){

		  // if statments para verificar campos
		if(!empty($num_fiscal) AND strlen($num_fiscal)<9)
		{
			?>
			<div class="container alert alert-danger" role="alert">
				NIF tem de ter 9 digitos!
			</div>
			<?php
			header("Refresh:2");
			return;
		}

		if(!empty($num_telefone) AND strlen($num_telefone)<9){
			?>
			<div class="container alert alert-danger" role="alert">
				Número de telefone tem de ter 9 digitos!
			</div>
			<?php
			header("Refresh:2");
			return;
		}

		if (strlen($username)<=4){
			?>
			<div class="container alert alert-danger" role="alert">
				O nome de utilizador tem de ter pelo menos 5 caracteres.
			</div>
			<?php
			header("Refresh:2");
			return;
		}

		if (mysqli_num_rows($query_username)){
			?>
			<div class="container alert alert-danger" role="alert">
				<strong>Nome de utilizador em uso!</strong> 
			</div>
			<?php
			header("Refresh:2");
			return;
		}

		if(!empty($email) AND mysqli_num_rows($query_email)){
			?>
			<div class="container alert alert-danger" role="alert">
				<strong>Email já em uso!</strong>
			</div>
			<?php
			header("Refresh:2;");
			return;
		}
		if(!empty($n_telefone) AND mysqli_num_rows($query_n_telefone)){
			?>
			<div class="container alert alert-danger" role="alert">
				<strong>Número de Telefone já em uso!</strong>
			</div>
			<?php
			header("Refresh:2;");
			return;
		}
		if(!empty($n_fiscal) AND mysqli_num_rows($query_n_fiscal)){
			?>
			<div class="container alert alert-danger" role="alert">
				<strong>Número de Identificação Fiscal já em uso!</strong>
			</div>
			<?php
			header("Refresh:2;");
			return;
		}

		$sqledituser1 = "UPDATE `utilizadores` SET nome_completo='$nome_completo', nome='$username', email='$email', num_fiscal='$num_fiscal', num_telefone='$num_telefone', password='$pw' , editado = '$editado' , user_type = '$role' , obs = '$comentario' WHERE id_user='$id'";
		mysqli_query($connection,$sqledituser1);
		?>  
		<div class="container alert alert-success" role="alert">
			Alterações guardadas!
		</div>
		<?php
		header('refresh:2;url=../admin/gerir_utilizadores.php');
		return;
	}else{
		$error="";

		if(strlen($pw1) < 8 ){
			$error .= "Password muito curta! 
			";
		}

		if(strlen($pw1) > 20 ){
			$error .= "Password muito longa! 
			";
		}

		if( !preg_match("#[0-9]+#", $pw1)){
			$error .= "Password tem de incluir pelo menos um número! 
			";
		}


		if( !preg_match("#[a-z]+#", $pw1)){
			$error .= "Password tem de incluir pelo menos uma letra minúscula!
			";
		}


		if( !preg_match("#[A-Z]+#", $pw1)){
			$error .= "Password tem de incluir pelo menos uma letra maiúscula!
			";
		}


		if( !preg_match("#\W+#", $pw1)){
			$error .= "Password tem de incluir pelo menos um símbolo!
			";
		}

		if($error){
			?>
			<div class="container alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong>Validação da Password(password fraca):</strong><?php echo "<dd>$error</dd>" ;?>
			</div>
			<?php
			header("Refresh:2;url=../admin/gerir_utilizadores.php");
			return;
		}

		if($pw1 != $pw2){
			?>
			<div class="container alert alert-danger" role="alert">
				<strong>Passwords diferentes!</strong>
			</div>
			<?php 
			header("Refresh:2;url=../admin/gerir_utilizadores.php"); 
			return;
		}

		  // if statments para verificar campos
		if(!empty($num_fiscal) AND strlen($num_fiscal)<9)
		{
			?>
			<div class="container alert alert-danger" role="alert">
				NIF tem de ter 9 digitos!
			</div>
			<?php
			header("Refresh:2");
			return;
		}

		if(!empty($num_telefone) AND strlen($num_telefone)<9){
			?>
			<div class="container alert alert-danger" role="alert">
				Número de telefone tem de ter 9 digitos!
			</div>
			<?php
			header("Refresh:2");
			return;
		}

		if (strlen($username)<=4){
			?>
			<div class="container alert alert-danger" role="alert">
				O nome de utilizador tem de ter pelo menos 5 caracteres.
			</div>
			<?php
			header("Refresh:2");
			return;
		}

		if (mysqli_num_rows($query_username)){
			?>
			<div class="container alert alert-danger" role="alert">
				<strong>Nome de utilizador em uso!</strong> 
			</div>
			<?php
			header("Refresh:2");
			return;
		}

		if(!empty($email) AND mysqli_num_rows($query_email)){
			?>
			<div class="container alert alert-danger" role="alert">
				<strong>Email já em uso!</strong>
			</div>
			<?php
			header("Refresh:2;");
			return;
		}
		if(!empty($n_telefone) AND mysqli_num_rows($query_n_telefone)){
			?>
			<div class="container alert alert-danger" role="alert">
				<strong>Número de Telefone já em uso!</strong>
			</div>
			<?php
			header("Refresh:2;");
			return;
		}
		if(!empty($n_fiscal) AND mysqli_num_rows($query_n_fiscal)){
			?>
			<div class="container alert alert-danger" role="alert">
				<strong>Número de Identificação Fiscal já em uso!</strong>
			</div>
			<?php
			header("Refresh:2;");
			return;
		}

		$pw1= md5($pw1);
		$pw2 = md5($pw2);
		$sqledituser2 = "UPDATE `utilizadores` SET nome_completo='$nome_completo', nome='$username', email='$email', num_fiscal='$num_fiscal', num_telefone='$num_telefone', password='$pw1' , editado = '$editado' , user_type = '$role' , obs = '$comentario' WHERE id_user='$id'";
		mysqli_query($connection,$sqledituser2);
		?>  
		<div class="container alert alert-success" role="alert">
			Alterações guardadas!
		</div>
		<?php
		header('refresh:2;url=../admin/gerir_utilizadores.php');
		return;
	}
}

?>
<html>
<body>
	<h1 align="center">Editar Utilizador</h1>
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
										<label for="username" class="col-4 col-form-label">Nome Completo</label> 
										<div class="col-8">
											<input value="<?php echo $row["nome_completo"]; ?>" name="nome_completo" class="form-control here" type="text">
										</div>
									</div>
									<div class="form-group row">
										<label for="username" class="col-4 col-form-label">Username*</label> 
										<div class="col-8">
											<input value="<?php echo $row["nome"]; ?>" name="username" class="form-control here" type="text">
										</div>
									</div>
									<div class="form-group row">
										<label for="select" class="col-4 col-form-label">Cargo*</label> 
										<div class="col-8">
											<select id="role" name="role" class="custom-select">
												<option value="Utilizador" <?php if($row["user_type"]=="Utilizador") echo 'selected="selected"';?>>Utilizador</option>
												<option value="Gestor" <?php if($row["user_type"]=="Gestor") echo 'selected="selected"';?>>Gestor</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="name" class="col-4 col-form-label">Email</label> 
										<div class="col-8">
											<input value="<?php echo $row["email"]; ?>" name="email" class="form-control here" type="email">
										</div>
									</div>
									<div class="form-group row">
										<label for="username" class="col-4 col-form-label">NIF</label> 
										<div class="col-8">
											<input value="<?php echo $row["num_fiscal"]; ?>"  name="num_fiscal" class="form-control here" type="int" maxlength="9">
										</div>
									</div>
									<div class="form-group row">
										<label for="username" class="col-4 col-form-label">Telefone</label> 
										<div class="col-8">
											<input value="<?php echo $row["num_telefone"]; ?>" name="num_telefone" class="form-control here" type="int" maxlength="9">
										</div>
									</div>
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Password</label> 
										<div class="col-8">
											<input id="pw1" name="pw1" placeholder="Password" class="form-control here" type="password">
										</div>
									</div>  
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label">Confirmar Password</label> 
										<div class="col-8">
											<input id="pw2" name="pw2" placeholder="Confirmar Password" class="form-control here" type="password" onkeyup="checkPass();">
											<span id="confirmMessage" class="confirmMessage"></span>
										</div>
									</div> 
									<div class="form-group row">
										<label for="text" class="col-4 col-form-label" maxlength="50">Observações</label> 
										<textarea class="form-control here" row="10" cols="60" name="comentario" ><?php echo $row['obs'];?></textarea>
									</div>
									<div class="form-group row">
										<div class="offset-4 col-8">
											<button onclick="return confirm('Tem a certeza que quer editar este utilizador?')" name="edit_user" type="submit" class="btn btn-primary">Submeter Alterações</button>
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
</body>
</html>


<script type="text/javascript">
	function checkPass()
	{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pw1');
    var pass2 = document.getElementById('pw2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#FF9999";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Iguais!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Diferentes!"
    }
}
</script>



