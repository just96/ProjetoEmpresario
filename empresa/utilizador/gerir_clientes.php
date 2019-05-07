<?php
session_start();
// VERIFICA SESSÃO
if ($_SESSION['role'] != 'Utilizador'){
  header( "Location:../utilizador/log.php" );
}
$id_utilizador = $_SESSION['id'];
include("../conectar_bd.php");
// SELECT no SQL para selecionar os dados a serem imprimidos na tabela
$sql = "SELECT * FROM `clientes` INNER JOIN `utilizadores` ON clientes.id_utilizador = utilizadores.id_user WHERE utilizadores.user_type = 'Gestor' OR id_utilizador='$id_utilizador'";
$result = mysqli_query($connection, $sql);
?>

<title>Menu Utilizador - Gestão de Clientes</title>

<?php require('topfooterU.php');
require('filtros.php');
if ($result->num_rows > 0) {?>
  <body>
    <h1 align="center">Gestão de Clientes</h1>
    <hr>
    <div class="d-flex justify-content-center">
      <button onclick="window.location.href='../fpdf/pdf_clientes_utilizador.php'" type="submit" class="btn btn-warning">Gerar PDF&nbsp<img src="../img/pdf.png" width="30" height="30"></img></button>
    </div>
    <div class="container-fluid">
      <br>
      <table id="minhaTabela" class="table table-bordered">
        <thead class="thead-dark">
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
        <tbody>
          <?php while($row = $result->fetch_assoc()) {
            echo "<tr><td>". $row["nome_fiscal"]. "</td><td>" . $row["nome_comercial"]. "</td><td>" . $row["tipo"]. "</td><td>". $row["morada"]. "</td><td>" . $row["localidade"]. "</td><td>" . $row["codigo_postal"]. "</td><td>" . $row["num_fiscal"]. "</td><td>" . $row["num_telefone"]."</td><td>" . $row["email"] ."</td>"?><td><a onclick="return confirm('Editar este cliente?')" href="../funcoes_utilizador/editar_cliente.php?&id_geral=<?php echo $row["id_cliente"] ?>"><img border="0" src="../img/baseline_edit_black_18dp.png" href="#"></a></td>
              <td><a onclick="return confirm('Deseja apagar este cliente?')" href="../funcoes_utilizador/apagar_cliente.php&id_geral=<?php echo $row["id_cliente"]?>"><img border="0" src="../img/baseline_delete_black_18dp.png" href="#"></a></td></tr><?php
            };?>
          </tbody>
        </table>
      <?php }else{?>
        <div class="container alert alert-danger" style="top:10px;" role="alert">
          <strong>Não há clientes registados!</strong>
        </div> 
        <?php
      }
      ?>
    </div>

  </body>
  </html>