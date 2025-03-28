<?php 
session_start();
if ($_SESSION['role'] != 'Utilizador'){
  header( "Location:../utilizador/log.php" );
}
require "../vendor/setasign/fpdf/fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=bd_empresa','root','');
$id_utilizador = $_SESSION['id'];

if($_SESSION['id'] != $id_utilizador){
    echo "ERRO";
    header("refresh:1;url=../utilizador/hist_encomendas_material.php");
}

class myPDF extends FPDF{
    function header(){
        $this->image('../img/white-logo.png',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'Historico de Encomendas-Material',0,0,'C');
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
        $this->Cell(32,10,'Data',1,0,'C');
        $this->Cell(60,10,'Comentario',1,0,'C');
        $this->Cell(60,10,'Cliente',1,0,'C');
        $this->Ln();
    }
    function viewTable($db){
        $this->SetFont('Times','',10);
        $stmt = $db->query('SELECT id_encomenda,id_material,nome_fiscal,data_encomenda,comentario,autorizada FROM `encomendas` INNER JOIN `clientes` ON encomendas.id_cliente = clientes.id_cliente INNER JOIN `utilizadores` ON encomendas.id_utilizador = utilizadores.id_user WHERE autorizada LIKE 1 AND encomendas.id_utilizador = "$id_utilizador" AND "id_material" IS NOT NULL GROUP BY id_encomenda ASC;');
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(40,10,$data->id_encomenda,1,0,'L');
            $this->Cell(32,10,$data->data_encomenda,1,0,'L');
            $this->Cell(60,10,iconv("UTF-8", "ISO-8859-1",$data->comentario),1,0,'L');
            $this->Cell(60,10,iconv("UTF-8", "ISO-8859-1",$data->nome_fiscal),1,0,'L');
            $this->Ln();
        }
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output('I','tabela_hist_enc_material.pdf');