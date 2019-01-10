<?php
session_start();
if ($_SESSION['role'] != 'admin'){
  header( "Location:../utilizador/log.php" );
}

$id = $_SESSION['id'];

include("../conectar_bd.php");
$sqldata ="SELECT nome_completo,nome,email,num_fiscal,num_telefone,user_type FROM `utilizadores` WHERE id_user='$id'";
$result= mysqli_query($connection,$sqldata);
?>
<!DOCTYPE html>
<html lang="en">
<!--Perfil do User-->
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="perfil">
  <meta name="author" content="Tiago Moura">

  <title>Perfil</title>

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
  <?php require('topfooterA.php');?>
  <div class="container" style="margin-top: 70px;margin-right:250px;">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h4>Perfil</h4>
                <hr>
                <form method="POST" action="perfil.php" >
                  <div class="user one">
                    <img src="../img/gusto.jpg" class="user one">
                  </div>
                  <input type="file" name="image">
                  <input type="submit" name="upload" value="Upload image">
                </form>
                <hr>
              </div>
            </div>
            <?php
            if(mysqli_num_rows($result)>0){
              ?>
              <div class="row">
                <div class="col-md-12">
                  <form method="POST" action="perfil.php">
                   <?php
                   while($row=mysqli_fetch_assoc($result)){
                    ?>
                    <div class="form-group row">
                      <label for="ntele" class="col-4 col-form-label">Cargo</label> 
                      <div class="col-8">
                        <input  disabled id="cargo" name="cargo" class="form-control here" value="<?php echo $row["user_type"]; ?>">
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
                        <input id="user" name="user" class="form-control here" type="text" value="<?php echo $row["nome"]; ?>">
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
                        <input id="nif" name="nif" class="form-control here" required="required" type="int" maxlength="9" value="<?php echo $row["num_fiscal"]; ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="ntele" class="col-4 col-form-label">Número Telefone</label> 
                      <div class="col-8">
                        <input id="ntele" name="ntele" class="form-control here" required="required" type="int" maxlength="9" value="<?php echo $row["num_telefone"]; ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-4 col-8">
                        <button name="submit" type="submit" class="btn btn-primary">Atualizar perfil</button>
                      </div>
                    </div>
                    <?php
                  }
                  ?>
                </form>
                <?php
              }
              ?>
              <hr>
              <p><a href="#">Alterar password</a></p>
              <p><a href="#">Eliminar Conta</a></p>
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

</body>

</html>

<?php
// IMAGEM ver dps
/*$msg ="";
  // se o botão upload foi premido
if(isset($_POST['upload'])){
  include("../conectar_bd.php");
    // caminho para guardar a imagem na bd
  $caminho ="../img/".basename($_FILES['image']['name']);

  $image = $_FILES['image']['name'];

  $sql = "INSERT INTO `utilizadores` (`image`) VALUES ('$image') WHERE id= 'id_user'";
  mysqli_query($connection,$sql);

  // mover a imagem para a respetiva pasta
  if(move_uploaded_file($_FILES('image')['tmp_name'],$caminho)){
    $msg = "Upload da imagem feito com sucesso!";
  }else{
    $msg = "Houve um problema no upload da imagem!";
  }
}*/

?>