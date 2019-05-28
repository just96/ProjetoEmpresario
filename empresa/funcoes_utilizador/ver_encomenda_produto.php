<?php
session_start();
if ($_SESSION['role'] != 'Utilizador'){
	header( "Location:../utilizador/log.php" );
}
include("../conectar_bd.php");
include("../utilizador/topfooterU.php"); 

$id = $_GET["id_geral"]; 
$id_user = $_SESSION['id'];


	// SQL ENCOMENDA
	$sql_encomenda = "SELECT * FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `produtos` ON encomendas.id_produto = produtos.id_produto WHERE id_encomenda='$id'"; // query inner join para ir buscar id do cliente com determinado id encomenda
	$result_encomenda = mysqli_query($connection, $sql_encomenda);
	// sql para ver se tem permissão na pagina, o utilizador
	$sql_check_admin = "SELECT * FROM `encomendas` INNER JOIN `utilizadores` ON encomendas.id_utilizador = utilizadores.id_user WHERE id_encomenda = '$id'";
	$result_check= mysqli_query($connection,$sql_check_admin);
	$row=mysqli_fetch_assoc($result_check);

	if(($row['user_type'] == 'Gestor') || ($row['id_user'] != $id_user)){
		?>
		<div class="container alert alert-danger" role="alert">
			Não tem permissão para ver esta encomenda!
		</div>
		<?php
		header("refresh:2;url=../utilizador/ver_encomendas_produtos.php");
		return;
	}
	$row_cliente= mysqli_fetch_array($result_encomenda);
	$id_cliente = $row_cliente['nome_fiscal'];
	$data = $row_cliente['data_encomenda'];
	$tipo_pagamento = $row_cliente['tipo_pagamento'];
	$autorizada = $row_cliente['autorizada'];
	$total = 0 ;
	$iva_total = 0;
	$total_cheque = 0;
	$total_liquido = 0;
	$iva_liquido = 0;
	$total_geral = 0;

	if($autorizada == '1'){?>
		<div class="container alert alert-primary" role="alert">
			Esta encomenda já foi aprovada pelo gestor!
		</div>
		<?php
	}else{
		?>
		<div class="container alert alert-info" role="alert">
			Encomenda em espera para ser aprovada pelo gestor!
		</div>
		<?php
	}
	if(mysqli_num_rows($result_encomenda) > 0 )
	{
		?>
		<hr>
		<br>
		<div class="container">
			<strong>Encomenda nº<?php echo $id;?></strong>
			<hr>
			<h5>Cliente a que foi feito a encomenda</h5>
			<div class="form-group row">
				<div class="col-4">	
					<input class="form-control" type="text" disabled="" value="<?php echo $id_cliente ?>">
				</div>
			</div>
			<hr>
			<h5>Data da encomenda</h5>
			<div class="form-group row">
				<div class="col-4">	
					<input class="form-control" type="text" disabled="" value="<?php echo $data ?>">
				</div>
			</div>
			<hr>
			<h5>Tipo de pagamento</h5>
			<div class="form-group row">
				<div class="col-5">		
					<input class="form-control" type="text" disabled="" value="<?php echo $tipo_pagamento ?>">
				</div>
			</div>
			<hr>
			<h4>Produtos</h4>	
			<table id="minhaTabela" class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Id</th>
						<th>Imagem</th>
						<th>Referência</th>
						<th>Nome do Produto</th>
						<th>Valor s/ IVA</th>
						<th>Quantidade</th>
					</tr>
					<tr>
						<td><?php echo $row_cliente["id_produto"];?></td>
						<td><img class="img-responsive" width="70" height="55" src="../img/<?php echo $row_cliente['imagem'];?>"></td>
						<td><?php echo $row_cliente["codigo_produto"]; ?></td>
						<td><?php echo $row_cliente["nome_produto"]; ?></td>
						<td><?php echo $row_cliente["valor_s_iva"];?>&euro;</td>
						<td><input size='1' disabled type="text" value="<?php echo $row_cliente["quantidadeP"]; ?>" min='0' name="qntP[]" max='10'></td></tr>
						<?php $total = ($row_cliente["valor_s_iva"] * $row_cliente["quantidadeP"]) +$total;?>
					</thead>
					<tbody>
						<?php 
						while($row_encomenda = mysqli_fetch_array($result_encomenda)){
							?>
							<tr>
								<td><?php echo $row_encomenda["id_produto"];?></td>
								<td><img class="img-responsive" width="70" height="55" src="../img/<?php echo $row_encomenda['imagem'];?>"></td>
								<td><?php echo $row_encomenda["codigo_produto"]; ?></td>
								<td><?php echo $row_encomenda["nome_produto"]; ?></td>
								<td><?php echo $row_encomenda["valor_s_iva"];?>&euro;</td>
								<td><input size='1' disabled type="text" value="<?php echo $row_encomenda["quantidadeP"]; ?>" min='0' name="qntP[]" max='10'></td></tr>
								<?php $total = ($row_encomenda["valor_s_iva"] * $row_encomenda["quantidadeP"]) +$total;
							}
						}?> 
					</tbody>
				</table>
			</div>
			<div class="container form-group">
				<?php 
				if($tipo_pagamento == 'Cheque a 30 Dias - s/ Desconto'){
					?>
					<h4>Valor total da encomenda s/ IVA: </h4><?php echo $total;?>&euro;
					<h4>IVA:</h4>
					<?php $iva_total = number_format((float)$total*0.23,2,'.','');
					echo $iva_total;?>&euro;
					<h4>Total Geral Cheque a 30 Dias:</h4>
					<?php $total_cheque = number_format((float)$total + $iva_total,2,'.','');
					echo $total_cheque;
					?>
					&euro;
					<?php 
				}
				if($tipo_pagamento == 'Pronto Pagamento Contra Entrega - c/ Desconto'){ 
					?>
					<h4>Total Liquído a Pronto Pagamento(3% desconto):</h4>
					<?php $total_liquido= number_format((float) $total*0.97,2,'.','');
					echo $total_liquido;?>&euro;
					<h4>IVA:</h4>
					<?php $iva_liquido = number_format((float) $total_liquido*0.23,2,'.','');
					echo $iva_liquido;?>&euro;
					<h4>Total Geral a Pronto Pagamento:	</h4>
					<?php $total_geral = number_format((float)$total_liquido + $iva_liquido,2,'.','');
					echo $total_geral;?>&euro;
				</div>
				<?php
			}
			mysqli_query($connection,"UPDATE `encomendas` SET total_s_iva = '$total' , total_geral_cheque = '$total_cheque' , total_liquido_pp = '$total_liquido' , total_geral_pp = '$total_geral' , iva_total = '$iva_total' , iva_liquido = '$iva_liquido'  WHERE id_encomenda = '$id'");?>
			<hr>
			<div class="container">
				<h3>Gerar PDF</h3>
				<a onclick="return confirm('Gerar pdf?')" href="../pdf/encomenda_individual_produto.php?&id_geral=<?php echo $id;?>"><img height="35" width="35" border="0" src="../img/pdf.png"></a>
				<div class="form-group row">
					<label for="text" class="col-4 col-form-label">Observações</label> 
					<textarea disabled class="form-control here" row="10" cols="60" name="comentario_encomenda" ><?php echo $row_cliente["comentario"]; ?></textarea>
				</div>
			</div>
