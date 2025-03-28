<?php 
session_start();
if ($_SESSION['role'] != 'Gestor'){
  header( "Location:../utilizador/log.php" );
}
require "../vendor/setasign/fpdf/fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=bd_empresa','root','');

class myPDF extends FPDF{
    function header(){
        $this->image('../img/white-logo.png',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'Utilizadores',0,0,'C');
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
        $this->Cell(25,10,'Nome',1,0,'C');
        $this->Cell(45,10,'Email',1,0,'C');
        $this->Cell(20,10,'Cargo',1,0,'C');
        $this->Cell(25,10,'NIF',1,0,'C');
        $this->Cell(25,10,'Telefone',1,0,'C');
        $this->Cell(50,10,'Obs',1,0,'C');
        $this->Ln();
    }
    function viewTable($db){
        $this->SetFont('Times','',10);
        $stmt = $db->query('select * from utilizadores ORDER BY nome ASC');
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(25,10,$data->nome,1,0,'L');
            $this->Cell(45,10,$data->email,1,0,'L');
            $this->Cell(20,10,$data->user_type,1,0,'L');
            $this->Cell(25,10,$data->num_fiscal,1,0,'L');
            $this->Cell(25,10,$data->num_telefone,1,0,'L');
            $this->Cell(50,10,iconv("UTF-8", "ISO-8859-1",$data->obs),1,0,'L');
            $this->Ln();
        }
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output('I','tabela_users.pdf');