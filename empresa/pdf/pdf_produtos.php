<?php
// SQL ENCOMENDA
$sql_encomenda = "SELECT * FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `produtos` ON encomendas.id_produto = produtos.id_produto WHERE id_encomenda='$id'"; // query inner join para ir buscar id do cliente com determinado id encomenda
$result_encomenda = mysqli_query($connection, $sql_encomenda);


// buscar cliente
$row_cliente= mysqli_fetch_array($result_encomenda);
$tipo_pagamento = $row_cliente['tipo_pagamento'];
$v_total_s_iva = $row_cliente['total_s_iva'];
$v_iva_total = $row_cliente['iva_total'];
$v_tcheque = $row_cliente['total_geral_cheque'];
$v_tliquido = $row_cliente['total_liquido_pp'];
$v_iva_liquido = $row_cliente['iva_liquido'];
$v_total_geral = $row_cliente['total_geral_pp'];
$autorizada = $row_cliente['autorizada'];
$nif_cliente = $row_cliente['num_fiscal'];
$morada = $row_cliente['morada'];
$localidade = $row_cliente['localidade'];

// Criar novo PDF
$mpdf = new \Mpdf\Mpdf();


// Dados do PDF
// ADD DATA
$data = '';
$data .='<h1>Nota de Encomenda nº'.$id.'</h1>';
if($autorizada == '0'){
	$data .='<strong>Nota de Encomenda não autorizada!</strong><br>';
}else{
	$data .='<strong>Nota Encomenda autorizada!</strong><br>';
};
$data .='<br><strong>Dados da Empresa</strong>';
$data .='<br><strong>Empresa:</strong>Manzoni & Vasconcelos - Representações Lda';
$data .='<br><strong>Morada:</strong> R. Conde Moser 312, 2765-392 Estoril<br>';
$data .='<strong>Telefone:</strong>21 467 2125<br>';

$data .='<br><strong>Dados do Cliente</strong>';
$data .='<br><strong>Nome Fiscal:</strong>' .$row_cliente['nome_fiscal']. '';
$data .='<br><strong>NIF:</strong>'.$nif_cliente. '';
$data .='<br><strong>Morada:</strong>'.$morada. '<br>';
$data .='<strong>Localidade:</strong>'.$localidade. '<br>';

$data .='<br><strong>Data</strong><br><textarea>' .$row_cliente['data_encomenda'] . '</textarea><br />';
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
	$data.='<h6>Valor total da encomenda s/ IVA: </h6>'. $v_total_s_iva .'&euro;';
	$data.='<h6>IVA:</h6>'. $v_iva_total .'&euro;';
	$data.='<h6>Total Geral Cheque a 30 Dias:</h6>'. $v_tcheque .'&euro;';
}
if($tipo_pagamento == 'Pronto Pagamento Contra Entrega - c/ Desconto'){ 
	$data.='<h6>Valor total sem IVA:</h6>'. $v_total_s_iva . '&euro;';
	$data.='<h6>Desconto(3%):</h6>'. number_format((float) $v_total_s_iva*0.03,2,'.','') . '&euro;';
	$data.=
	'<h6>Total Liquído a Pronto Pagamento:</h6>'. $v_tliquido .'&euro;';
	$data.='<h6>IVA:</h6>'. $v_iva_liquido .'&euro;';
	$data.='<h6>Total Geral a Pronto Pagamento:</h6>'. $v_total_geral .'&euro;';
	'</div>';
};

$data .='<br></br><strong>Observações</strong><br><textarea rows="5" cols="50">' .$row_cliente['comentario'] . '</textarea><br />';

// escrever PDF
$mpdf->WRITEHTML($data);

// Output
ob_clean(); 
$mpdf->Output('mypdf.pdf','I');
?>