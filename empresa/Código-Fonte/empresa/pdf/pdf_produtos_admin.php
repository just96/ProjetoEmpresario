<?php 
session_start();
if ($_SESSION['role'] != 'Gestor'){
  header( "Location:../utilizador/log.php" );
}
require "../vendor/setasign/fpdf/fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=bd_empresa','root','');

define('EURO',chr(128));

class myPDF extends FPDF{
    function header(){
        $this->image('../img/white-logo.png',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'Produtos',0,0,'C');
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
        $this->Cell(20,10,'Referencia',1,0,'C');
        $this->Cell(65,10,'Nome do Produto',1,0,'C');
        $this->Cell(65,10,'Descricao do Produto',1,0,'C');
        $this->Cell(30,10,'Valor s/ IVA'.EURO,1,0,'C');
        $this->Ln();
    }
    function viewTable($db){
        $this->SetFont('Times','',10);
        $stmt = $db->query('select * from produtos ORDER BY codigo_produto ASC');
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(20,10,$data->codigo_produto,1,0,'L');
            $this->Cell(65,10,iconv("UTF-8", "ISO-8859-1",$data->nome_produto),1,0,'L');
            $this->Cell(65,10,iconv("UTF-8", "ISO-8859-1",$data->descricao),1,0,'L');
            $this->Cell(30,10,$data->valor_s_iva.EURO,1,0,'L');
            $this->Ln();
        }
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output('I','tabela_produtos.pdf');