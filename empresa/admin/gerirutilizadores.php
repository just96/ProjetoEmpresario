<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] != 'admin'){
  header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
// SELECT no SQL para selecionar os dados a serem imprimidos na tabela
$sql = "SELECT nome,email,user_type,num_fiscal,num_telefone FROM `utilizadores`";
$result = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gestão</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php require('topfooterA.php');?>
  <h1 align="center">Utilizadores</h1>
  <hr>
  <div class="container mt-3">
    <h2>Gestão</h2>
    <p></p>
    <input class="form-control" id="myInput" type="text" placeholder="Procurar...">
    <br>
    <?php if ($result->num_rows > 0) {?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Cargo</th>
            <th>NIF</th>
            <th>Telefone</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <?php while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["nome"]. "</td><td>" . $row["email"]. "</td><td>" . $row["user_type"]. "</td><td>" . $row["num_fiscal"]. "</td><td>" . $row["num_telefone"]. "</td></tr>";
          }?>
        </tbody>
      </table>
    <?php }?>
  </div>
  <script> // Script para método Search , procurar dados na tabela.
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

</body>
</html>