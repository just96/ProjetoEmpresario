<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] != 'Gestor'){
  header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
// SELECT no SQL para selecionar os dados a serem imprimidos na tabela
$sql = "SELECT id_user,nome,email,user_type,num_fiscal,num_telefone FROM `utilizadores`";
$result = mysqli_query($connection, $sql);
?>

<title>Gerir Utilizadores</title>


<?php require('topfooterA.php');
require('filtros.php');
if ($result->num_rows > 0) {?>
  <body>
    <h1 align="center">Utilizadores</h1>
    <hr>
    <br>
    <div class="container-fluid">
      <table id ="minhaTabela" class="table table-bordered">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Cargo</th>
            <th>NIF</th>
            <th>Telefone</th>
            <th>Editar</th>
            <th>Apagar</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <?php while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["nome"]. "</td><td>" . $row["email"]. "</td><td>" . $row["user_type"]. "</td><td>" . $row["num_fiscal"]. "</td><td>" . $row["num_telefone"]. "</td>"?><td><a onclick="return confirm('Deseja editar este utilizador?')" href="funcoes.php?funcao=EditarUtilizador&id_geral=<?php echo $row["id_user"] ?>"><img border="0" src="../img/baseline_edit_black_18dp.png" href="#"></a></td>
              <td><a onclick="return confirm('Deseja apagar este utilizador?')" href="funcoes.php?funcao=ApagarUtilizador&id_geral=<?php echo $row["id_user"] ?>"><img border="0" src="../img/baseline_delete_black_18dp.png" href="#"></a></td></tr><?php
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
  </body>
  </html>