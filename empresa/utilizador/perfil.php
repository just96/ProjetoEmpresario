<?php
session_start();
if ($_SESSION['role'] != 'Utilizador'){
  header( "Location:../utilizador/log.php" );
}

$id = $_SESSION['id'];
require('topfooterU.php');
include("../conectar_bd.php");
$sqldata ="SELECT nome_completo,nome,imagem,email,num_fiscal,num_telefone,user_type FROM `utilizadores` WHERE id_user='$id'";
$result= mysqli_query($connection,$sqldata);


$sql ="SELECT * FROM utilizadores WHERE id_user='$id'";
$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_array($query);

 if(isset($_POST['btnpEdit'])) {       // Editar perfil

//Instrução SQL para selecionar diferentes dados

$nome = $_POST['name']; // definir as variáveis , POST
$username = $_POST['user'];
$email = $_POST['email'];
$nif = $_POST['nif'];
$ntele = $_POST['ntele'];
date_default_timezone_set('Europe/Lisbon');
$editado = date('Y-m-d H:i:s');

// COMPARAR DADOS NA EDIÇÃO

  //Instrução SQL para selecionar diferentes dados
$sql_fetch_nome_completo = "SELECT nome FROM utilizadores WHERE id_user NOT IN ('$id') AND nome_completo = '$nome'";
$sql_fetch_username = "SELECT nome FROM utilizadores WHERE id_user NOT IN ('$id') AND nome = '$username'";
$sql_fetch_email = "SELECT email FROM utilizadores WHERE id_user NOT IN ('$id') AND email = '$email'";
$sql_fetch_n_fiscal = "SELECT num_fiscal FROM utilizadores WHERE id_user NOT IN ('$id') AND num_fiscal = '$nif'";
$sql_fetch_n_telefone = "SELECT num_telefone FROM utilizadores WHERE id_user NOT IN ('$id') AND num_telefone  = '$ntele'";

  //usado para comparar o nome/email de utilizador introduzido com os da base de dados.

$query_username = mysqli_query($connection,$sql_fetch_username); 
$query_email = mysqli_query($connection,$sql_fetch_email);
$query_n_fiscal = mysqli_query($connection,$sql_fetch_n_fiscal);
$query_n_telefone = mysqli_query($connection,$sql_fetch_n_telefone);

  // if statments para verificar campos
if(!empty($nif) AND strlen($nif)<9)
{
  ?>
  <div class="container alert alert-danger" role="alert">
    NIF tem de ter 9 digitos!
  </div>
  <?php
  header("Refresh:2");
  return;
}

if(!empty($ntele) AND strlen($ntele)<9){
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

if (mysqli_num_rows($query_email)){
  ?>
  <div class="container alert alert-danger" role="alert">
    <strong>Email já em uso!</strong>
  </div>
  <?php
  header("Refresh:2");
  return;
}

if (mysqli_num_rows($query_n_telefone)){
  ?>
  <div class="container alert alert-danger" role="alert">
    <strong>Número de Telefone já em uso!</strong>
  </div>
  <?php
  header("Refresh:2");
  return;
}
if (mysqli_num_rows($query_n_fiscal)){
  ?>
  <div class="container alert alert-danger" role="alert">
    <strong>Número de Identificação Fiscal já em uso!</strong>
  </div>
  <?php
  header("Refresh:2");
  return;
}

  // SQL para fazer update na tabela dos utilizadores

$sqleditperfil = "UPDATE `utilizadores` SET nome_completo='$nome', nome='$username', email='$email', num_fiscal='$nif', num_telefone='$ntele', editado ='$editado' WHERE id_user='$id'";

mysqli_query($connection,$sqleditperfil);
?>  
<div class="container alert alert-success" role="alert">
 Alterações guardadas!
</div>
<?php
header('refresh:2;url=perfil.php');
}

if(isset($_POST['btnApw'])){

  $passwordA = $_POST['pwp'];
  $passwordN = $_POST['pwn1'];
  $passwordN2 = $_POST['pwn2'];
  $bd_password=$row['password'];
  date_default_timezone_set('Europe/Lisbon');
  $editado = date('Y-m-d H:i:s');
  $passwordA=md5($passwordA);


  if($passwordA == $bd_password){

    $error="";

    if(strlen($passwordN) < 8 ){
      $error .= "Password muito curta! 
      ";
    }

    if(strlen($passwordN) > 20 ){
      $error .= "Password muito longa! 
      ";
    }

    if( !preg_match("#[0-9]+#", $passwordN)){
      $error .= "Password tem de incluir pelo menos um número! 
      ";
    }


    if( !preg_match("#[a-z]+#", $passwordN)){
      $error .= "Password tem de incluir pelo menos uma letra minúscula!
      ";
    }


    if( !preg_match("#[A-Z]+#", $passwordN)){
      $error .= "Password tem de incluir pelo menos uma letra maiúscula!
      ";
    }


    if( !preg_match("#\W+#", $passwordN)){
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
      return;
    }

    if($passwordN == $passwordN2){

      $passwordN = md5($passwordN);

  // SQL para fazer update na tabela dos utilizadores

      $sqleditpw = "UPDATE `utilizadores` SET password = '$passwordN' , editado = '$editado' WHERE id_user='$id' ";

      mysqli_query($connection,$sqleditpw);
    }
    ?>
    <div class="container alert alert-success" role="alert">
      <strong>Password alterada com sucesso!</strong>
    </div>
    <?php  
    header('Refresh:2; url=logout.php');
  }else{
    ?> 
    <div class="container alert alert-warning" role="alert">
      Password atual errada!
    </div>
    <?php
  }

}

  if(isset($_POST['btnEacc'])) {   //Eliminar conta

    $password = $_POST['pwe'];
    $password = md5($password);

    $bd_password = $row['password'];

    if(empty($password)){
      ?>
      <div class="container alert alert-warning" role="alert" >
        Insira a sua password!
      </div>
      <?php
      return;
    }

    if($password == $bd_password){

      $apagarconta = "DELETE FROM `utilizadores` WHERE id_user='$id'";

      mysqli_query($connection,$apagarconta);
      ?>
      <div class="container alert alert-success" role="alert">
        Conta eliminada com sucesso!
      </div>
      <?php
      header('refresh:2;url=logout.php');
    }else{
      ?>
      <div class="container alert alert-warning" role="alert">
        Password errada!
      </div>
      <?php
      return;
    }
  }
  if(isset($_POST['btnAI'])){

    $filename = $_FILES['uploadfile']['name'];
    $filetmpname = $_FILES['uploadfile']['tmp_name'];
    date_default_timezone_set('Europe/Lisbon');
    $editado = date('Y-m-d H:i:s');

    //folder where images will be uploaded
    $folder = '/xampp/htdocs/empresa/img/';
  //function for saving the uploaded images in a specific folder
    move_uploaded_file($filetmpname, $folder.$filename);

    mysqli_query($connection,"UPDATE `utilizadores` SET imagem = '$filename' , editado = '$editado' WHERE id_user='$id' ") or die(mysqli_error($connection));
    ?>
    <div class="container alert alert-success" role="alert">
      <strong>Imagem editada com sucesso!</strong>
    </div>
    <?php  
    header("Refresh:2; url=perfil.php");

  }


  ?>


  <title>Menu Gestor - Perfil</title>

  <style>
    .user {
      display: inline-block;
      width: 150px;
      height: 150px;
      border-radius: 50%;

      background-repeat: no-repeat;
      background-position: center center;
      background-size: cover;
    }

    .one {
      background-image: url('http://placehold.it/400x200');
    }

    .img {
      float:left;
      margin: 5px;
      width: 300px;
      height: 140px;
    }

  </style>
  <body>
    <div class="container" style="margin-top: 70px;margin-right:250px;">
      <div class="row">
        <div class="col-md-9">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h4>Perfil</h4>
                  <hr>
                </div>
              </div>
              <?php
              if(mysqli_num_rows($result)>0){
                ?>
                <div class="row">
                  <div class="col-md-12">
                   <?php
                   while($row=mysqli_fetch_assoc($result)){
                    ?>
                    <div class="form-row">
                      <img class="rounded-circle" height='180' width='200' src='../img/<?php echo $row["imagem"]?>'>
                    </div>
                    <hr>
                    <a href="#" data-target="#exampleModAvatar" data-toggle="modal">Alterar imagem de perfil</a>
                    <form method="POST" action="#" enctype="multipart/form-data">
                     <div class="modal fade" id="exampleModAvatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alterar imagem de perfil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="col-md-12">
                              <div class="panel panel-default">
                                <div class="panel-body">
                                  <div class="text-center">
                                    <div class="panel-body">
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <input type="file" name="uploadfile">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button onclick="return confirm('Alterar imagem de perfil?')" type="submit" class="btn btn-primary" id="btnAI" name="btnAI">Alterar imagem de perfil</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <form method="POST" action="#">
                    <a href="#" data-target="#exampleModalA" data-toggle="modal">Alterar password</a>
                    <div class="modal fade" id="exampleModalA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alterar password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="col-md-12">
                              <div class="panel panel-default">
                                <div class="panel-body">
                                  <div class="text-center">
                                    <div class="alert alert-info" role="alert">
                                      <strong>Info<p></p></strong>Password entre 8 e 20 carateres e tem de ter pelo menos um símbolo,número,letra minúscula e maiúscula.
                                    </div>
                                    <h5>Password atual</h5>
                                    <div class="panel-body">
                                      <fieldset>
                                        <div class="form-group">
                                          <input id ="pwp" class="form-control input-md" placeholder="Inserir password atual" name="pwp" type="password">
                                        </div>
                                        <h5>Password nova</h5>
                                        <div class="form-group">
                                          <input id ="pwn1" class="form-control input-md" placeholder="Inserir password nova" name="pwn1" type="password">
                                        </div>
                                        <h5>Confirmar password nova</h5>
                                        <div class="form-group">
                                          <input id ="pwn2" class="form-control input-md" placeholder="Confirmar password" name="pwn2" type="password" onkeyup="checkPass();">
                                          <span id="confirmMessage" class="confirmMessage"></span>
                                        </div>
                                      </fieldset>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button onclick="return confirm('Alterar a password?')" type="submit" class="btn btn-primary" id="btnApw" name="btnApw">Alterar password</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <form action="#" method="POST">
                    <div class="form-group row">
                      <label for="ntele" class="col-4 col-form-label">Cargo</label> 
                      <div class="col-8">
                        <input readonly="readonly" id="cargo" name="cargo" class="form-control here" value="<?php echo $row["user_type"]; ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="name" class="col-4 col-form-label">Nome Completo</label> 
                      <div class="col-8">
                        <input id="name" name="name" class="form-control here" type="text" value="<?php echo $row["nome_completo"]; ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="user" class="col-4 col-form-label">Nome de Utilizador</label> 
                      <div class="col-8">
                        <input <?php if($row["nome"]=='admin'){?> readonly="readonly" <?php }?> id="user" name="user" class="form-control here" type="text" value="<?php echo $row["nome"]; ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-4 col-form-label">Email</label> 
                      <div class="col-8">
                        <input id="email" name="email" class="form-control here" type="email" value="<?php echo $row["email"]; ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="nif" class="col-4 col-form-label">NIF</label> 
                      <div class="col-8">
                        <input id="nif" name="nif" class="form-control here" type="int" maxlength="9" value="<?php echo $row["num_fiscal"]; ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="ntele" class="col-4 col-form-label">Número Telefone</label> 
                      <div class="col-8">
                        <input id="ntele" name="ntele" class="form-control here" type="int" maxlength="9" value="<?php echo $row["num_telefone"]; ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-4 col-8">
                        <button name="btnpEdit" type="submit" class="btn btn-primary" onclick="return confirm('De certeza que quer editar o seu perfil?');">Atualizar perfil</button>
                      </div>
                    </div>
                  </form>
                  <?php
                }
              }
              ?>
              <p>
                <?php
                // query para ver se é admin
                $query_ad = "SELECT * FROM utilizadores WHERE id_user = $id";
                $result_ad = mysqli_query($connection,$query_ad);
                $row_ad = mysqli_fetch_array($result_ad);
                ?>
                <button <?php if($row_ad["nome"] == 'admin'){?> disabled <?php }?>class="btn btn-link" type="button" data-target="#exampleModalE" data-toggle="modal">Eliminar Conta</button>
              </p>
              <form action="#" method="POST">
                <div class="modal fade" id="exampleModalE" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Conta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="col-md-12">
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="text-center">
                                <hr>
                                <div class="alert alert-danger" role="alert">
                                  <strong>Aviso!<p></p></strong>Com esta ação perde o acesso à conta e todos os dados da mesma.
                                </div>
                                <hr>
                                <h5>Password</h5>
                                <form id="form_acc" method="POST" action="#">
                                  <div class="panel-body">
                                   <fieldset>
                                    <div class="form-group">
                                      <input id="pwe" class="form-control input-md" placeholder="Inserir password" name="pwe" type="password">
                                    </div>
                                  </fieldset>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button name ="btnEacc" id="btnEacc" type="submit" class="btn btn-primary" onclick="return confirm('De certeza que quer apagar o seu perfil?');" >Eliminar conta</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>// Script para comparar as duas passwords do formulário com o intuito de avisar o utilizador se estas estão diferentes.
function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pwn1');
    var pass2 = document.getElementById('pwn2');
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

    $(document).ready(function(){
      $('[data-toggle="popover"]').popover();   
    });  
  </script>


</body>

</html>

