<?php

include("../conectar_bd.php");
include("topfooterA.php"); 

$tarefa = $_GET["funcao"];
$id = $_GET["id_geral"];   

if($tarefa == "ApagarProduto"){


	$deleteproduto= "DELETE FROM produtos WHERE id_produto='$id'";
	mysqli_query($connection,$deleteproduto) or die($deleteproduto); ?>
	<div class="container alert alert-success" role="alert">
		Produto eliminado com sucesso!
	</div>
	<?php
	header('refresh:2;url=ver_produtos.php');

}elseif($tarefa == "ApagarCliente"){

	$deletecliente= "DELETE FROM clientes WHERE id_cliente='$id'";
	mysqli_query($connection,$deletecliente) or die($deletecliente); ?>
	<div class="container alert alert-success" role="alert">
		Cliente eliminado com sucesso!
	</div>
	<?php
	header('refresh:2;url=gerirclientes.php');

}elseif($tarefa =="ApagarUtilizador"){

	$deleteuser= "DELETE FROM utilizadores WHERE id_user='$id'";
	mysqli_query($connection,$deleteuser) or die($deleteuser); ?>
	<div class="container alert alert-success" role="alert">
		Utilizador eliminado com sucesso!
	</div>
	<?php
	header('refresh:2;url=gerirutilizadores.php');

}elseif($tarefa == "EditarProduto"){

	$sqldata ="SELECT nome_produto,valor,codigo_produto,descricao FROM `produtos` WHERE id_produto='$id'";
	$result= mysqli_query($connection,$sqldata);
	?>
	<body>
		<h1 align="center">Editar Produto</h1>
		<hr><?php
		if(mysqli_num_rows($result)>0){
			?>
			<div class="container">
				<form method="POST" action="#">
					<?php while($row=mysqli_fetch_assoc($result)){
						?>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="nome_produto">Nome do Produto</label>
								<input name ="nome_produto" type="text" class="form-control" value="<?php echo $row["nome_produto"]; ?>"required>
							</div>
							<div class="form-group col-md-6">
								<label for="valor">Preço</label>
								<input name ="valor" class="form-control" value="<?php echo $row["valor"]; ?>" type="number" min="1" max="10000" step="any" required>
							</div>
						</div>
						<div class="form-group">
							<label for="codigo_produto">Referência</label>
							<input name ="codigo_produto" type="text" class="form-control" value="<?php echo $row["codigo_produto"]; ?>" required>
						</div>
						<div class="form-group row">
							<label for="descricao" class="col-4 col-form-label">Descrição do Produto</label> 
							<textarea class="form-control here" row="10" cols="60" name="descricao"><?php echo $row["descricao"]; ?></textarea>
						</div>
						<button name ="edit_prod" type="submit" class="btn btn-primary" onclick="return confirm('De certeza que quer editar?')">Editar Produto</button>
					</form>
				</div>

			<?php }}
			if(isset($_POST['edit_prod'])) { 
				$nome_produto = $_POST['nome_produto']; 
				$valor = $_POST['valor'];
				$codigo_produto = $_POST['codigo_produto'];
				$descricao = $_POST['descricao'];


				$sqleditproduto = "UPDATE `produtos` SET nome_produto='$nome_produto', valor='$valor', codigo_produto='$codigo_produto', descricao='$descricao' WHERE id_produto='$id'";
				mysqli_query($connection,$sqleditproduto);
				?>  
				<div class="container alert alert-success" role="alert">
					Alterações guardadas!
				</div>
				<?php
				header('refresh:2;url=ver_produtos.php');
			}
			?>
		</body> 
		<?php
	}elseif($tarefa == "EditarCliente"){

		$sqldata ="SELECT nome_fiscal,nome_comercial,tipo,morada,localidade,codigo_postal,num_fiscal,num_telefone,email,obs FROM `clientes` WHERE id_cliente ='$id'";
		$result= mysqli_query($connection,$sqldata);

		?>
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
														<select name="tipo" name="tipo" class="custom-select" required="required">
															<option value="Farmácia">Farmácia</option>
															<option value="Parafarmácia">Parafarmácia</option>
															<option value="Ouriversaria">Ouriversaria</option>
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

		$sqleditcliente = "UPDATE `clientes` SET nome_fiscal='$nome_fiscal', nome_comercial='$nome_comercial', tipo='$tipo', morada='$morada', localidade='$localidade', codigo_postal='$codigo_postal' , num_fiscal='$num_fiscal' , num_telefone='$num_telefone' , email='$email' , obs='$comentario' WHERE id_cliente='$id'";
		mysqli_query($connection,$sqleditcliente);
		?>  
		<div class="container alert alert-success" role="alert">
			Alterações guardadas!
		</div>
		<?php
		header('refresh:2;url=gerirclientes.php');

	}
}elseif($tarefa == 'EditarUtilizador'){
	$sqldata ="SELECT nome_completo,nome,email,num_fiscal,num_telefone,user_type,password FROM `utilizadores` WHERE id_user ='$id'";
	$result= mysqli_query($connection,$sqldata);
	?>
	<h1 align="center">Editar Utilizador</h1>
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
												<label for="username" class="col-4 col-form-label">Nome Completo</label> 
												<div class="col-8">
													<input value="<?php echo $row["nome_completo"]; ?>" name="nome_completo" class="form-control here" type="text">
												</div>
											</div>
											<div class="form-group row">
												<label for="username" class="col-4 col-form-label">Username</label> 
												<div class="col-8">
													<input value="<?php echo $row["nome"]; ?>"name="username" class="form-control here" type="text">
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
												<div class="offset-4 col-8">
													<button onclick="return confirm('Tem a certeza que quer editar este utilizador?')" name="edit_user" type="submit" class="btn btn-primary">Editar Utilizador</button>
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
			<?php
		}
	}
	?>
	<?php
	if(isset($_POST['edit_user'])) { 
		$nome_completo = $_POST['nome_completo']; 
		$username = $_POST['username'];
		$email = $_POST['email'];
		$num_fiscal = $_POST['num_fiscal'];
		$num_telefone = $_POST['num_telefone']; 
		$pw1 = $_POST['pw1'];
		$pw2 = $_POST['pw2'];

		$sql_pw = "SELECT * FROM `utilizadores` WHERE id_user='$id'";
		$sql_query=mysqli_query($connection,$sql_pw);
		$row=mysqli_fetch_array($sql_query);
		$pw=$row['password'];

		if((empty($pw1)) || (empty($pw2))){

			$sqledituser1 = "UPDATE `utilizadores` SET nome_completo='$nome_completo', nome='$username', email='$email', num_fiscal='$num_fiscal', num_telefone='$num_telefone', password='$pw' WHERE id_user='$id'";
			mysqli_query($connection,$sqledituser1);
			?>  
			<div class="container alert alert-success" role="alert">
				Alterações guardadas!
			</div>
			<?php
			header('refresh:1;url=gerirutilizadores.php');
		}else{
			$hash = password_hash($pw1,PASSWORD_BCRYPT);
			$sqledituser2 = "UPDATE `utilizadores` SET nome_completo='$nome_completo', nome='$username', email='$email', num_fiscal='$num_fiscal', num_telefone='$num_telefone', password='$hash' WHERE id_user='$id'";
			mysqli_query($connection,$sqledituser2);
			?>  
			<div class="container alert alert-success" role="alert">
				Alterações guardadas!
			</div>
			<?php
			header('refresh:1;url=gerirutilizadores.php');
		}
	}
}
?>
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

