<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] != 'admin'){
  header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
// SELECT no SQL para selecionar os dados a serem imprimidos na tabela
$sql = "SELECT id_cliente,nome_fiscal,nome_comercial,tipo,morada,localidade,codigo_postal,num_fiscal,num_telefone,email FROM `clientes`";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gestão</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php require('topfooterA.php');
if ($result->num_rows > 0) {?>
  <body>
    <h1 align="center">Clientes</h1>
    <hr>
    <div class="container-fluid">
      <input class="form-control" id="myInput" type="text" placeholder="Procurar...">
      <br>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nome Fiscal</th>
            <th>Nome Comercial</th>
            <th>Tipo</th>
            <th>Morada</th>
            <th>Localidade</th>
            <th>Código-Postal</th>
            <th>NIF</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Editar</th>
            <th>Apagar</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <?php while($row = $result->fetch_assoc()) {
            echo "<tr><td>". $row["nome_fiscal"]. "</td><td>" . $row["nome_comercial"]. "</td><td>" . $row["tipo"]. "</td><td>". $row["morada"]. "</td><td>" . $row["localidade"]. "</td><td>" . $row["codigo_postal"]. "</td><td>" . $row["num_fiscal"]. "</td><td>" . $row["num_telefone"]."</td><td>" . $row["email"] ."</td>"?><td><a href="#"><img border="0" src="../img/baseline_edit_black_18dp.png" href="#"></a></td>
              <td><a onclick="return confirm('Deseja apagar este cliente?')" href="funcoes.php?funcao=ApagarCliente&id_geral=<?php echo $row["id_cliente"]?>"><img border="0" src="../img/baseline_delete_black_18dp.png" href="#"></a></td></tr><?php
            };?>
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          <button type="button" class="btn btn-warning">Gerar PDF&nbsp<img src="../img/pdf.png" width="30" height="30"></img></button>
        </div>
      <?php }else{?>
        <div class="container">
          <div class="alert alert-danger" style="top:10px;" role="alert">
            <strong>Não há clientes registados!</strong>
          </div> 
        </div>
        <?php
      }
      ?>
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