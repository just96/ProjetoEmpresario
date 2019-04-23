<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] != 'Gestor'){
  header( "Location:../utilizador/log.php" );
}
$id = $_SESSION['id'];
?>
<title>Adicionar Cliente</title>
<body>
  <?php require('topfooterA.php');?>
  <h1 align="center">Clientes</h1>
  <hr>
  <div class="container" style="margin-top: 70px;margin-right:250px;">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <div class="row">
            </div>
            <div class="row">
              <div class="col-md-12">
                <form method="POST" action="registarcliente.php">
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Nome Fiscal*</label> 
                    <div class="col-8">
                      <input name="nome_fiscal" placeholder="Nome Fiscal" class="form-control here" required type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Nome Comercial*</label> 
                    <div class="col-8">
                      <input name="nome_comercial" placeholder="Nome Comercial" class="form-control here" type="text" required="required">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="select" class="col-4 col-form-label">Tipo*</label> 
                    <div class="col-8">
                      <select name="tipo" name="tipo" class="custom-select" required>
                        <option value="Farmácia">Farmácia</option>
                        <option value="Parafarmácia">Parafarmácia</option>
                        <option value="Ouriversaria">Ouriversaria</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Morada*</label> 
                    <div class="col-8">
                      <input required name="morada" placeholder="Morada" class="form-control here" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Localidade</label> 
                    <div class="col-8">
                      <input name="localidade" placeholder="Localidade" class="form-control here" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Código-Postal</label> 
                    <div class="col-8">
                      <input name="codigo_postal" placeholder="Código Postal" class="form-control here" type="int" maxlength="8">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">NIF*</label> 
                    <div class="col-8">
                      <input name="num_fiscal" placeholder="Número de Identificação Fiscal" class="form-control here" required type="int" maxlength="9">
                    </div>
                  </div>  
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Telefone*</label> 
                    <div class="col-8">
                      <input name="num_telefone"  placeholder="Número de Telefone" class="form-control here" required type="int" maxlength="9">
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Email*</label> 
                    <div class="col-8">
                      <input name="email" placeholder="Email" class="form-control here" type="email" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Observações</label> 
                    <textarea class="form-control here" row="10" cols="60" name="comentario"></textarea>
                  </div>
                  <div class="form-group row">
                    <div class="offset-4 col-8">
                      <button onclick="return confirm('Tem a certeza que quer adicionar?')" name="add_client" type="submit" class="btn btn-primary">Adicionar Cliente</button>
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

</html>

<?php
if(isset($_POST['add_client'])){

  include("../conectar_bd.php");

  $nome_fiscal = strip_tags($_POST['nome_fiscal']);
  $nome_comercial = strip_tags($_POST['nome_comercial']);
  $tipo = strip_tags($_POST['tipo']);
  $morada = strip_tags($_POST['morada']);
  $localidade = strip_tags($_POST['localidade']);
  $codigo_postal = strip_tags($_POST['codigo_postal']);
  $num_fiscal = strip_tags($_POST['num_fiscal']);
  $num_telefone = strip_tags($_POST['num_telefone']);
  $email = strip_tags($_POST['email']);
  $comentario = strip_tags($_POST['comentario']);

  $nome_fiscal = stripcslashes($nome_fiscal);
  $nome_comercial = stripcslashes($nome_comercial);
  $tipo = stripcslashes($tipo);
  $morada = stripcslashes($morada);
  $localidade = stripcslashes($localidade);
  $codigo_postal = stripcslashes($codigo_postal);
  $num_fiscal = stripcslashes($num_fiscal);
  $num_telefone = stripcslashes($num_telefone);
  $email = stripcslashes($email);
  $comentario = stripcslashes($comentario);

  $nome_fiscal = mysqli_real_escape_string($connection,$nome_fiscal); 
  $nome_comercial = mysqli_real_escape_string($connection,$nome_comercial); 
  $tipo = mysqli_real_escape_string($connection,$tipo); 
  $morada = mysqli_real_escape_string($connection,$morada); 
  $localidade = mysqli_real_escape_string($connection,$localidade); 
  $codigo_postal = mysqli_real_escape_string($connection,$codigo_postal); 
  $num_fiscal = mysqli_real_escape_string($connection,$num_fiscal); 
  $num_telefone = mysqli_real_escape_string($connection,$num_telefone); 
  $email = mysqli_real_escape_string($connection,$email); 
  $comentario = mysqli_real_escape_string($connection,$comentario); 

  date_default_timezone_set('Europe/Lisbon');
  $data = date('Y-m-d H:i:s');

   //Instrução SQL para selecionar diferentes dados

  $sql_fetch_nome_fiscal = "SELECT nome_fiscal FROM clientes WHERE nome_fiscal = '$nome_fiscal'";
  $sql_fetch_nome_comercial = "SELECT nome_comercial FROM clientes WHERE nome_comercial = '$nome_comercial'";
  $sql_fetch_morada = "SELECT morada FROM clientes WHERE morada = '$morada'";
  $sql_fetch_num_fiscal = "SELECT num_fiscal FROM clientes WHERE num_fiscal   = '$num_fiscal'";
  $sql_fetch_num_telefone = "SELECT num_telefone FROM clientes WHERE num_telefone  = '$num_telefone'";
  $sql_fetch_email = "SELECT email FROM clientes WHERE email  = '$email'";

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
    <div class="container">
      <div class="alert alert-danger" role="alert">
        <strong>Nome Fiscal em uso!</strong> 
      </div>
    </div>
    <?php
    return;
  }
  if (mysqli_num_rows($query_nome_comercial)){
    ?>
    <div class="container">
      <div class="alert alert-danger" role="alert">
        <strong>Nome Comercial em uso!</strong> 
      </div>
    </div>
    <?php
    return;
  }
  if (mysqli_num_rows($query_morada)){
    ?>
    <div class="container">
      <div class="alert alert-danger" role="alert">
        <strong>Morada em uso!</strong> 
      </div>
    </div>
    <?php
    return;
  }
  if (mysqli_num_rows($query_num_fiscal)){
    ?>
    <div class="container">
      <div class="alert alert-danger" role="alert">
        <strong>Número Fiscal em uso!</strong> 
      </div>
    </div>
    <?php
    return;
  }
  if (mysqli_num_rows($query_num_telefone)){
    ?>
    <div class="container">
      <div class="alert alert-danger" role="alert">
        <strong>Número de Telefone em uso!</strong> 
      </div>
    </div>
    <?php
    return;
  }
  if (mysqli_num_rows($query_email)){
    ?>
    <div class="container">
      <div class="alert alert-danger" role="alert">
        <strong>Email em uso!</strong> 
      </div>
    </div>
    <?php
    return;
  }

  mysqli_query($connection,"INSERT INTO `clientes`(`id_utilizador`,`nome_fiscal`, `nome_comercial`, `tipo`, `morada`, `localidade`, `codigo_postal`, `num_fiscal`, `num_telefone`, `email`,`obs`,`data`) VALUES ('$id','$nome_fiscal','$nome_comercial','$tipo','$morada','$localidade','$codigo_postal','$num_fiscal','$num_telefone','$email','$comentario','$data')") or die(mysqli_error($connection));

  ?>
  <div class="container">
    <div class="alert alert-success" role="alert">
      <strong>Registo efetuado com sucesso!</strong>
    </div>
  </div>

  <?php  
  header('Refresh:1; url=index.php');
}
?>
