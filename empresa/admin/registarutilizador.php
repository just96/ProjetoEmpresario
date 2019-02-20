<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] != 'admin'){
  header( "Location:../utilizador/log.php" );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Tiago Moura">

  <title>Registar Utilizador</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/thumbnail-gallery.css" rel="stylesheet">

  <!-- Responsive CSS -->
  <link href="css/responsive.css" rel="stylesheet"> 

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>
<body>
  <?php require('topfooterA.php');?>
  <h1 align="center">Utilizadores</h1>
  <hr>
  <div class="container" style="margin-top: 70px;margin-right:250px;">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h4>Registo</h4>
                <hr>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <form method="POST" action="registarutilizador.php">
                  <div class="form-group row">
                    <label for="username" class="col-4 col-form-label">Username*</label> 
                    <div class="col-8">
                      <input name="username" placeholder="Nome do Utilizador" class="form-control here" required="required" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="name" class="col-4 col-form-label">Email</label> 
                    <div class="col-8">
                      <input name="email" placeholder="Email" class="form-control here" type="email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="select" class="col-4 col-form-label">Cargo*</label> 
                    <div class="col-8">
                      <select id="role" name="role" class="custom-select" required="required">
                        <option value="utilizador">Utilizador</option>
                        <option value="admin">Admin</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="username" class="col-4 col-form-label">NIF</label> 
                    <div class="col-8">
                      <input name="n_fiscal" placeholder="Número de Identificação Fiscal" class="form-control here" type="int" maxlength="9">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="username" class="col-4 col-form-label">Telefone</label> 
                    <div class="col-8">
                      <input name="n_telefone"  placeholder="Número de Telefone" class="form-control here" type="int" maxlength="9">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Password*</label> 
                    <div class="col-8">
                      <input id="pw1" name="pw1" placeholder="Password" class="form-control here" required="required" type="password">
                    </div>
                  </div>  
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Confirmar Password*</label> 
                    <div class="col-8">
                      <input id="pw2" name="pw2" placeholder="Confirmar Password" class="form-control here" required="required" type="password" onkeyup="checkPass();">
                      <span id="confirmMessage" class="confirmMessage"></span>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <div class="offset-4 col-8">
                      <button name="add_user" type="submit" class="btn btn-primary">Adicionar Cliente</button>
                    </div>
                  </div>
                  <hr>
                  <p>
                    <button type="button" class="btn btn-light dropdown-toggle" data-target="#collapseExample" aria-controls="collapseExample" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">
                     Ver política de dados
                   </button>
                 </p>
                 <div class="collapse" id="collapseExample">
                  <div class="card card-body">
                    <dl>
                      <dt>Nome de Utilizador</dt>
                      <dd>-Tem de ter pelo menos 5 carateres.</dd>
                    </dl>
                    <dl>
                      <dt>Password</dt>
                      <dd>-Password entre 8 e 20 carateres e tem de ter pelo menos um símbolo,número,letra minúscula e maiúscula. </dd>
                    </dl>
                    <strong>*Campos obrigatórios</strong>
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

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>// Script para comparar as duas passwords do formulário com o intuito de avisar o utilizador se estas estão diferentes.
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


</body>
</html>

<?php
// ADICIONAR UTILIZADOR
if(isset($_POST['add_user'])){

  include("../conectar_bd.php");

  $username = strip_tags($_POST['username']);   //strip_tags para retirar das variais exemplo <b>
  $email = strip_tags($_POST['email']);
  $cargo = strip_tags($_POST['role']);
  $n_fiscal = strip_tags($_POST['n_fiscal']);
  $n_telefone = strip_tags($_POST['n_telefone']);
  $pw1 = strip_tags($_POST['pw1']);
  $pw2 = strip_tags($_POST['pw2']);

  $username = stripcslashes($username);   // esta função remove a barra invertida da string
  $email = stripcslashes($email);
  $cargo = stripcslashes($cargo);
  $n_fiscal = stripcslashes($n_fiscal);
  $n_telefone = stripcslashes($n_telefone);
  $pw1 = stripcslashes($pw1);
  $pw2 = stripcslashes($pw2);

  $username = mysqli_real_escape_string($connection,$username);   // esta função esquece os carateres especiais para a string ser usada numa instrução de SQL
  $email = mysqli_real_escape_string($connection,$email);
  $cargo = mysqli_real_escape_string($connection,$cargo);
  $n_fiscal = mysqli_real_escape_string($connection,$n_fiscal);
  $n_telefone = mysqli_real_escape_string($connection,$n_telefone);
  $pw1 = mysqli_real_escape_string($connection,$pw1);
  $pw2 = mysqli_real_escape_string($connection,$pw2);

  //Instrução SQL para selecionar diferentes dados

  $sql_fetch_username = "SELECT nome FROM utilizadores WHERE nome = '$username'";
  $sql_fetch_email = "SELECT email FROM utilizadores WHERE email = '$email'";
  $sql_fetch_n_fiscal = "SELECT num_fiscal FROM utilizadores WHERE num_fiscal = '$n_fiscal' AND num_fiscal = 'IS NOT NULL'";
  $sql_fetch_n_telefone = "SELECT num_telefone FROM utilizadores WHERE num_telefone  = '$n_telefone' AND num_telefone = 'IS NOT NULL'";

  //usado para comparar o nome/email de utilizador introduzido com os da base de dados.

  $query_username = mysqli_query($connection,$sql_fetch_username); 
  $query_email = mysqli_query($connection,$sql_fetch_email);
  $query_n_fiscal = mysqli_query($connection,$sql_fetch_n_fiscal);
  $query_n_telefone = mysqli_query($connection,$sql_fetch_n_telefone);

  // if statments para verificar campos
  if(!empty($n_fiscal) AND strlen($n_fiscal)<9)
  {
    ?>
    <div class="container">
      <div class="alert alert-danger" role="alert">
        NIF tem de ter 9 digitos!
      </div>
    </div>
    <?php
    return;
  }

  if(!empty($n_telefone) AND strlen($n_telefone)<9){
    ?>
    <div class="container">
      <div class="alert alert-danger" role="alert">
       Número de telefone tem de ter 9 digitos!
     </div>
   </div>
   <?php
   return;
 }

 if (strlen($username)<=4){
  ?>
  <div class="w-25 bg-warning">
    <div class="alert alert-danger" role="alert">
     O nome de utilizador tem de ter pelo menos 5 caracteres.
   </div>
 </div>
 <?php
 return;
}

if (mysqli_num_rows($query_username)){
  ?>
  <div class="container">
    <div class="alert alert-danger" role="alert">
      <strong>Nome de utilizador em uso!</strong> 
    </div>
  </div>
  <?php
  return;
}

if (mysqli_num_rows($query_email)){
  ?>
  <div class="container">
    <div class="alert alert-danger" role="alert">
     <strong>Email já em uso!</strong>
   </div>
 </div>
 <?php
 return;
}

if (mysqli_num_rows($query_n_telefone)){
  ?>
  <div class="container">
    <div class="alert alert-danger" role="alert">
     <strong>Número de Telefone já em uso!</strong>
   </div>
 </div>
 <?php
 return;
}

if (mysqli_num_rows($query_n_fiscal)){
  ?>
  <div class="container">
    <div class="alert alert-danger" role="alert">
      <strong>Número de Identificação Fiscal já em uso!</strong>
    </div>
  </div>
  <?php
  return;
}

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
  <div class="container">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>Validação da Password(password fraca):</strong><?php echo "<dd>$error</dd>" ;?>
    </div>
  </div>
  <?php
  return;
}

$hash = password_hash($pw1,PASSWORD_BCRYPT);
mysqli_query($connection,"INSERT INTO `utilizadores`(`nome`, `email`, `user_type`, `num_fiscal` , `num_telefone`, `password`) VALUES ('$username','$email','$cargo','$n_fiscal','$n_telefone','$hash')") or die(mysqli_error($connection));

?>
<div class="container">
  <div class="alert alert-success" role="alert">
    <strong>Registo efetuado com sucesso!</strong>
  </div>
</div>
<?php  
header("location: index.php");
}
?>
