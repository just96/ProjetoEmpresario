<?php 
require "fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=bd_empresa','root','');


class myPDF extends FPDF{
    function header(){
        $this->image('../img/white-logo.png',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'Clientes',0,0,'C');
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
        $this->Cell(50,10,'Nome Fiscal',1,0,'C');
        $this->Cell(50,10,'Nome Comercial',1,0,'C');
        $this->Cell(60,10,'Morada',1,0,'C');
        $this->Cell(30,10,'Codigo-Postal',1,0,'C');
        $this->Cell(30,10,'NIF',1,0,'C');
        $this->Cell(30,10,'Telefone',1,0,'C');
        $this->Cell(35,10,'Email',1,0,'C');
        $this->Ln();
    }
    function viewTable($db){
        $this->SetFont('Times','',10);
        $stmt = $db->query('select * from clientes ORDER BY nome_fiscal ASC');
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(50,10,$data->nome_fiscal,1,0,'L');
            $this->Cell(50,10,$data->nome_comercial,1,0,'L');
            $this->Cell(60,10,$data->morada,1,0,'L');
            $this->Cell(30,10,$data->codigo_postal,1,0,'L');
            $this->Cell(30,10,$data->num_fiscal,1,0,'L');
            $this->Cell(30,10,$data->num_telefone,1,0,'L');
            $this->Cell(35,10,$data->email,1,0,'L');
            $this->Ln();
        }
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output('I','tabela_clientes.pdf');