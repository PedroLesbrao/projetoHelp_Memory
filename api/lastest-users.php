
<?php 

define('FDPF_FONTPATH','font/');
header('Content-Type: text/html; charset=ISO-8859-1');

require_once("fpdf/fpdf.php");

$pdf = new FPDF('P','cm','A4');

$pdf -> Open();
$pdf -> AddPage();

$pdf -> AddFont('times','','times.php');
$pdf -> SetFont('times','BI',20);

$pdf -> setLeftMargin(2.5);
$pdf -> setTopMargin(2.5);

$pdf -> SetFillColor(255, 255, 224);
$pdf -> Cell(16, 3, "Pacientes mais recentes", 1, 1, "C", TRUE);

$pdf -> Ln(1);

$pdf -> SetTextColor(0,0,128);
$pdf -> SetFillColor(220,220,220);
$pdf -> SetDrawColor(112,128,144);

$pdf -> Cell(4,1,'Nome',1,0,'C',TRUE);
$pdf -> Cell(8,1,'Email',1,0,'C',TRUE);
$pdf -> Cell(4,1,'Data',1,1,'C',TRUE);

//Conexão e pesquisa no Banco de dados
include __DIR__ . '/conexao.php';

$sql = "SELECT nome, create_date, email FROM usuario ORDER BY create_date DESC";
$select = mysqli_query($conexao, $sql) or die(mysqli_error());

$pdf->SetFont('times','',12);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(245,245,220);

foreach($select as $line){
    $pdf -> Cell(4, 1, $line["nome"], 1, 0, "C", TRUE);
    $pdf -> Cell(8, 1, $line["email"], 1, 0, "C", TRUE);
    $pdf -> Cell(4, 1, $line["create_date"], 1, 1, "C", TRUE);
}

$pdf -> Output();
$pdf -> Close();

?>