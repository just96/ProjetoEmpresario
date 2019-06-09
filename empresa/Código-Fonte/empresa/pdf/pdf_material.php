<?php
	// SQL ENCOMENDA
$sql_encomenda = "SELECT * FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `material_apoio` ON encomendas.id_material = material_apoio.id_material WHERE id_encomenda='$id'"; 
$result_encomenda = mysqli_query($connection, $sql_encomenda);
$row_cliente= mysqli_fetch_array($result_encomenda);
$nif_cliente = $row_cliente['num_fiscal'];
$morada = $row_cliente['morada'];
$localidade = $row_cliente['localidade'];
$autorizada = $row_cliente['autorizada'];

// Criar novo PDF
$mpdf = new \Mpdf\Mpdf();


// Dados do PDF
// ADD DATA
$data = '';
$data .='<h1>Encomenda de Material de Apoio nº'.$id.'</h1>';
if($autorizada == '0'){
	$data .='<strong>Não autorizada!</strong><br>';
}else{
	$data .='<strong>Autorizada!</strong><br>';
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

$data .='<br><strong>Data</strong><br><textarea rows="1" cols="30">' .$row_cliente['data_encomenda'] . '</textarea><br />';

$data.='
<h4>Material de Apoio</h4>
<table id="minhaTabela" class="table table-bordered">
<thead class="thead-dark">
<tr>
<th>Id</th>
<th>Nome do Material</th>
<th>Tipo</th>
<th>Quantidade</th>
</tr>
<tr>
<td>'. $row_cliente["id_material"]. '</td>
<td>'.$row_cliente["nome_material"].'</td>
<td>'.$row_cliente["tipo"].'</td>
<td>'.$row_cliente["quantidadeP"].'</td></tr>
</thead>';
while($row_encomenda = mysqli_fetch_array($result_encomenda)){
	$data .='
	<tbody>
	<tr>
	<td>'. $row_encomenda["id_material"]. '</td>
	<td>'.$row_encomenda["nome_material"].'</td>
	<td>'.$row_encomenda["tipo"].'</td>
	<td>'.$row_encomenda["quantidadeP"].'</td></tr>';
}
$data .='
</tbody>
</table>';
$data .='<br></br><strong>Observações</strong><br><textarea rows="5" cols="50">' .$row_cliente['comentario'] . '</textarea><br />';
// escrever PDF
$mpdf->WRITEHTML($data);

// Output
ob_clean(); 
$mpdf->Output('mypdf.pdf','I');

?>