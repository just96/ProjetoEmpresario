<?php
session_start();
if ($_SESSION['role'] != 'Gestor'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../admin/topfooterA.php"); 

$id = $_GET["id_geral"];   

$sql = "SELECT nome_material,imagem,tipo FROM material_apoio WHERE id_material='$id'";
$result= mysqli_query($connection,$sql);
$row=mysqli_fetch_assoc($result);

if(isset($_POST['edit_material'])) { 

	$nome_material = $_POST['nome_material']; 
	$tipo = $_POST['tipo'];
	date_default_timezone_set('Europe/Lisbon');
	$editado = date('Y-m-d H:i:s');

	// COMPARAR DADOS NA EDIÇÃO
	//Instrução SQL para selecionar diferentes dados

	$sql_fetch_nome_material = "SELECT nome_material FROM material_apoio WHERE id_material NOT IN ('$id') AND nome_material = '$nome_material'";

	//usado para comparar os dados introduzidos com os da base de dados.

	$query_nome_material = mysqli_query($connection,$sql_fetch_nome_material) or die(mysql_error());

	if (mysqli_num_rows($query_nome_material)){
		?>
		<div class="container alert alert-danger" role="alert">
			<strong>Nome de material já em uso!</strong> 
		</div>
		<?php
		header("Refresh:2");
		return;
	}

	mysqli_query($connection,"UPDATE `material_apoio` SET nome_material = '$nome_material' ,tipo = '$tipo' , editado ='$editado' WHERE id_material='$id'");
	?>
	<div class="container alert alert-success" role="alert">
		<strong>Material editado com sucesso!</strong>
	</div>
	<?php  
	header("Refresh:2;url=../admin/gerir_material.php");
}
if(isset($_POST['btnAIM'])){

	$filename = $_FILES['uploadfile']['name'];
	$filetmpname = $_FILES['uploadfile']['tmp_name'];
	date_default_timezone_set('Europe/Lisbon');
	$editado = date('Y-m-d H:i:s');

				//folder where images will be uploaded
	$folder = '/xampp/htdocs/empresa/img/';
	//function for saving the uploaded images in a specific folder
	move_uploaded_file($filetmpname, $folder.$filename);

	mysqli_query($connection,"UPDATE `material_apoio` SET imagem = '$filename' , editado = '$editado' WHERE id_material='$id' ") or die(mysqli_error($connection));
	?>
	<div class="container alert alert-success" role="alert">
		<strong>Imagem editada com sucesso!</strong>
	</div>
	<?php  
	header("Refresh:2; url=../admin/gerir_material.php");

}

?>
<h1 align="center">Material de Apoio</h1>
<hr>
<div class="container-fluid">
	<a href="#" data-target="#exampleModAvatar" data-toggle="modal">Alterar imagem do material</a>
	<form method="POST" action="#" enctype="multipart/form-data">
		<div class="modal fade" id="exampleModAvatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Alterar imagem do material</h5>
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
						<button onclick="return confirm('Alterar imagem do material?')" type="submit" class="btn btn-primary" id="btnAIM" name="btnAIM">Alterar imagem do material</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<form align="center" class ="form-inline" method="POST" action="#" enctype="multipart/form-data">
		<div class="form-group mx-sm-3 mb-2">
			<div class="form-group mx-sm-3 mb-2">
				<img class="rounded" height='150' width='200' src='../img/<?php echo $row["imagem"]?>'>
			</div>
		</div>
		<div class="form-group mx-sm-3 mb-2">
			<h6 align="center" for="imagem">Nome do Material</h6><br>
			<div class="form-group mx-sm-3 mb-2">
				<input size="50" name ="nome_material" type="text" class="form-control" value="<?php echo $row["nome_material"]; ?>" required>
			</div>
			<div class="form-group mx-sm-3 mb-2">
				<h6 align="center" for="imagem">Tipo</h6><br>
				<div class="col-8">
					<select id="tipo" name="tipo" class="custom-select" required="required">
						<option value="Mostruarios" <?php if($row["tipo"]=="Mostruarios") echo 'selected="selected"';?>>Mostruarios</option>
						<option value="Expositores" <?php if($row["tipo"]=="Expositores") echo 'selected="selected"';?>>Expositores</option>
						<option value="Folhetos" <?php if($row["tipo"]=="Folhetos") echo 'selected="selected"';?>>Folhetos</option>
						<option value="Material Técnico" <?php if($row["tipo"]=="Material Técnico") echo 'selected="selected"';?>>Material Técnico</option>
					</select>
				</div>
			</div>
			<button onclick="return confirm('Tem a certeza que quer editar?')" name ="edit_material" type="submit" class="btn btn-primary mb-2">Submeter Alterações</button>
		</form>
	</div>
</div>
</div>