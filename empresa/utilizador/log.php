<?php
session_start();
if (isset($_SESSION['role']) == 'Gestor' ){
  header("Location:../admin/index.php");
}elseif(isset($_SESSION['role']) == 'Utilizador' ){
  header("Location:../utilizador/index.php");
}
if(isset($_POST['login_btn'])) {      // LOGIN
  include("../conectar_bd.php");

  //Funções php

  $nome = strip_tags($_POST['nome']); // esta função retira uma string do HTML,XML,PHP tag
  $password = strip_tags($_POST['password']);
  
  $nome = stripcslashes($nome); // esta função remove a barra invertida da string
  $password = stripcslashes($password);

  $nome = mysqli_real_escape_string($connection,$nome); // esta função esquece os carateres especiais para a string ser usada numa instrução de SQL
  $password = mysqli_real_escape_string($connection,$password);

  $password=md5($password);
  // SQL

  $sql_select="SELECT * FROM `utilizadores` WHERE nome='$nome'";

  // sql query

  $sql_query=mysqli_query($connection,$sql_select);
  $row=mysqli_fetch_array($sql_query);

  $id=$row['id_user']; // busca o id 
  $bd_password=$row['password']; // busca a password da bd
  $role=$row['user_type'];

  if($password == $bd_password){
    ?>
    <div class="container">
      <div class="alert alert-success" style="top:10px;" role="alert">
        <strong>Login Efetuado com sucesso!</strong>
      </div>
    </div>
    <?php
    $_SESSION['role'] = $role;
    $_SESSION['Utilizador'] = $nome;
    $_SESSION['id'] = $id ;
    if ($_SESSION['role'] == 'Utilizador'){
      header("refresh:1;url=../utilizador/index.php");
    } else if($_SESSION['role'] == 'Gestor'){
      header("refresh:1;url=../admin/index.php");
    }
  }else{
    ?>
    <div class="container">
      <div class="alert alert-danger" style="top:10px;" role="alert">
        <strong>Erro:</strong>
        Dados não válidos, Tente outra vez.
      </div> 
    </div>
    <?php
    header("refresh:2;url=../utilizador/log.php");
  }
}

?>
<!DOCTYPE html>
<html>
<!--Autenticação-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
  .login-clean {
    background:#f1f7fc;
    padding:250px 0;
  }

  .login-clean form {
    max-width:320px;
    width:90%;
    margin:0 auto;
    background-color:#ffffff;
    padding:40px;
    border-radius:4px;
    color:#505e6c;
    box-shadow:1px 1px 5px rgba(0,0,0,0.1);
  }

  .login-clean .illustration {
    text-align:center;
    padding:0 0 20px;
    font-size:100px;
    color:rgb(244,71,107);
  }

  .login-clean form .form-control {
    background:#f7f9fc;
    border:none;
    border-bottom:1px solid #dfe7f1;
    border-radius:0;
    box-shadow:none;
    outline:none;
    color:inherit;
    text-indent:8px;
    height:42px;
  }

  .login-clean form .btn-primary {
    background:#99c2ff;
    border:none;
    border-radius:4px;
    padding:11px;
    box-shadow:none;
    margin-top:26px;
    text-shadow:none;
    outline:none !important;
  }

  .login-clean form .btn-primary:hover, .login-clean form .btn-primary:active {
    background:#0066ff;
  }

  .login-clean form .btn-primary:active {
    transform:translateY(1px);
  }

  .login-clean form .forgot {
    display:block;
    text-align:center;
    font-size:12px;
    color:#6f7a85;
    opacity:0.9;
    text-decoration:none;
  }

  .login-clean form .forgot:hover, .login-clean form .forgot:active {
    opacity:1;
    text-decoration:none;
  }
</style>

<body>
  <div class="login-clean">
    <form method="POST" action="log.php"> 
      <h2>Área Pessoal</h2>
      <p></p>
      <h2 class="sr-only">Login Form</h2>
      <div class="form-group"><i class="fa fa-user icon"></i><input class="form-control" required="required" type="text" name="nome" placeholder="Username"></div>
      <div class="form-group"><i class="fa fa-key icon"></i><input class="form-control" required="required" type="password" name="password" placeholder="Password"></div>
      <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name ="login_btn" >Log In</button></div>
    </div>
  </form>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>