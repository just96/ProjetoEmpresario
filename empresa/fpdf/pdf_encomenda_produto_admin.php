<?php 
require "fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=bd_empresa','root','');

$id = $_GET["id_geral"]; 


class myPDF extends FPDF{
    function header(){
        $this->image('../img/white-logo.png',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'Encomenda-Produto',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Ln(20);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    function headerTable(){
        $this->SetFont('Times','B',10);
        $this->Cell(40,10,'Numero da Encomenda',1,0,'C');
        $this->Cell(40,10,'Data',1,0,'C');
        $this->Cell(40,10,'Nome do Material',1,0,'C');
        $this->Cell(40,10,'Quantidade',1,0,'C');
        $this->Cell(40,10,'Cliente',1,0,'C');
        $this->Cell(40,10,'Comentario',1,0,'C');
        $this->Ln();
    }
    function viewTable($db){
        $this->SetFont('Times','',10);
        $stmt = $db->query('SELECT * FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `material_apoio` ON encomendas.id_material = material_apoio.id_material WHERE id_encomenda="$id"');
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(40,10,$data->id_encomenda,1,0,'L');
            $this->Cell(40,10,$data->data_encomenda,1,0,'L');
            $this->Cell(40,10,$data->nome_material,1,0,'L');
            $this->Cell(40,10,$data->quantidadeP,1,0,'L');
            $this->Cell(40,10,$data->nome_fiscal,1,0,'L');
            $this->Cell(40,10,$data->comentario,1,0,'L');
            $this->Ln();
        }
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output('I','tabela_enc_produto.pdf');