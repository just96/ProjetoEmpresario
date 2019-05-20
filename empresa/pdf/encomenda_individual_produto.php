<?php
session_start();

require_once '../vendor/autoload.php';
include("../conectar_bd.php");

$id = $_GET["id_geral"]; 
$v_total_s_iva = $_GET['v_total'];
$v_iva_total = $_GET['v_iva_total'];
$v_tcheque = $_GET['v_tcheque'];
$v_tliquido = $_GET['v_tliquido'];
$v_iva_liquido = $_GET['v_iva_liquido'];
$v_total_geral = $_GET['v_total_geral'];
$autorizada = $_GET['autorizada'];

// SQL ENCOMENDA
$sql_encomenda = "SELECT * FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `produtos` ON encomendas.id_produto = produtos.id_produto WHERE id_encomenda='$id'"; // query inner join para ir buscar id do cliente com determinado id encomenda
$result_encomenda = mysqli_query($connection, $sql_encomenda);
// buscar cliente
$row_cliente= mysqli_fetch_array($result_encomenda);
$tipo_pagamento = $row_cliente['tipo_pagamento'];

// Criar novo PDF
$mpdf = new \Mpdf\Mpdf();


// Dados do PDF
// ADD DATA
$data = '';
if($autorizada == '0'){
	$data .='<strong>Encomenda não autorizada!</strong>';
}else{
	$data .='<strong>Encomenda autorizada!</strong>';
};
$data .='<h1>Encomenda nº'.$id.'</h1>';

// ADD DATA
$data .= '<strong>Cliente</strong><br><textarea>' . $row_cliente['nome_fiscal'] . '</textarea><br />';
$data .='<strong>Data</strong><br><textarea>' .$row_cliente['data_encomenda'] . '</textarea><br />';
$data .='<strong>Tipo de Pagamento</strong><br><textarea>' .$row_cliente['tipo_pagamento'] . '</textarea><br />';
$data.='
<h4>Produtos</h4>
<table id="minhaTabela" class="table table-bordered">
<thead class="thead-dark">
<tr>
<th>Id</th>
<th>Referência</th>
<th>Nome do Produto</th>
<th>Valor s/ IVA &euro;</th>
<th>Quantidade</th>
</tr>
<tr>
<td>'. $row_cliente["id_produto"]. '</td>
<td>'.$row_cliente["codigo_produto"].'</td>
<td>'.$row_cliente["nome_produto"].'</td>
<td>'.$row_cliente["valor_s_iva"].'&euro;</td>
<td>'.$row_cliente["quantidadeP"].'</td></tr>
</thead>';
while($row_encomenda = mysqli_fetch_array($result_encomenda)){
	$data .='
	<tbody>
	<tr>
	<td>'. $row_encomenda["id_produto"]. '</td>
	<td>'. $row_encomenda["codigo_produto"] .'</td>
	<td>'. $row_encomenda["nome_produto"] .'</td>
	<td>'. $row_encomenda["valor_s_iva"] .'&euro;</td>
	<td>'. $row_encomenda["quantidadeP"] .'</td></tr>';
}
$data .='
</tbody>
</table>';
$data .='
<div class="container form-group">';
if($tipo_pagamento == 'Cheque a 30 Dias - s/ Desconto'){
	$data.='<h4>Valor total da encomenda s/ IVA: </h4>'. $v_total_s_iva .'&euro;';
	$data.='<h4>IVA:</h4>'. $v_iva_total .'&euro;';
	$data.='<h4>Total Geral Cheque a 30 Dias:</h4>'. $v_tcheque .'&euro;';
}
if($tipo_pagamento == 'Pronto Pagamento Contra Entrega - c/ Desconto'){ 
	$data.=
	'<h4>Total Liquído a Pronto Pagamento(3% desconto):</h4>'. $v_tliquido .'&euro;';
	$data.='<h4>IVA:</h4>'. $v_iva_liquido .'&euro;';
	$data.='<h4>Total Geral a Pronto Pagamento:</h4>'. $v_total_geral .'&euro;';
	'</div>';
};

$data .='<br></br><strong>Observações</strong><br><textarea>' .$row_cliente['comentario'] . '</textarea><br />';

// escrever PDF
$mpdf->WRITEHTML($data);

// Output
ob_clean(); 
$mpdf->Output('mypdf.pdf','I');
?>