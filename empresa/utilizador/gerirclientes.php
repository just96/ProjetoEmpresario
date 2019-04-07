<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] == 'admin'){
  header( "Location:../admin/gerirclientes.php" );
}else{
  include("../conectar_bd.php");
// SELECT no SQL para selecionar os dados a serem imprimidos na tabela
  $sql = "SELECT nome_fiscal,nome_comercial,morada,localidade,codigo_postal,num_fiscal,num_telefone,email FROM `clientes`";
  $result = mysqli_query($connection, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gerir Clientes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php require('topfooter.php');?>
  <h1 align="center">Clientes</h1>
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
            <th>Nome Fiscal</th>
            <th>Nome Comercial</th>
            <th>Morada</th>
            <th>Localidade</th>
            <th>Código-Postal</th>
            <th>NIF</th>
            <th>Telefone</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <?php while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["nome_fiscal"]. "</td><td>" . $row["nome_comercial"]. "</td><td>" . $row["morada"]. "</td><td>" . $row["localidade"]. "</td><td>" . $row["codigo_postal"]. "</td><td>" . $row["num_fiscal"]. "</td><td>" . $row["num_telefone"]."</td><td>" . $row["email"]. "</tr></td>";
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