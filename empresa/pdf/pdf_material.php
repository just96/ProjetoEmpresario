<?php
	// SQL ENCOMENDA
$sql_encomenda = "SELECT * FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `material_apoio` ON encomendas.id_material = material_apoio.id_material WHERE id_encomenda='$id'"; 
$result_encomenda = mysqli_query($connection, $sql_encomenda);
$row_cliente= mysqli_fetch_array($result_encomenda);
$autorizada = $row_cliente['autorizada'];

// Criar novo PDF
$mpdf = new \Mpdf\Mpdf();


// Dados do PDF
// ADD DATA
$data = '';
if($autorizada == '0'){
	$data .='<strong>Encomenda não autorizada!</strong><br>';
}else{
	$data .='<strong>Encomenda autorizada!</strong><br>';
};
$data .='<br><strong>Empresa:</strong>Manzoni & Vasconcelos - Representações Lda';
$data .='<br><strong>Endereço:</strong> R. Conde Moser 312, 2765-392 Estoril<br>';
$data .='<strong>Telefone:</strong>21 467 2125';
$data .='<h1>Encomenda nº'.$id.'</h1>';
$data .= '<strong>Cliente</strong><br><textarea>' . $row_cliente['nome_fiscal'] . '</textarea><br />';
$data .='<strong>Data</strong><br><textarea>' .$row_cliente['data_encomenda'] . '</textarea><br />';

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
$data .='<br></br><strong>Observações</strong><br><textarea>' .$row_cliente['comentario'] . '</textarea><br />';
// escrever PDF
$mpdf->WRITEHTML($data);

// Output
ob_clean(); 
$mpdf->Output('mypdf.pdf','I');

?>