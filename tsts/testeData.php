<?php

$id = $_GET['id'];
$con = mysqli_connect("localhost", "root", '', 'programacaosemanalteste');

date_default_timezone_set('America/Sao_Paulo');
$hoje = date("d-m-Y");

$dataInicial = strtotime("Friday");
$dataFinal = strtotime("+7 days", $dataInicial);
$dataInicialS = date("d-m-Y", $dataInicial);
$dataFinalS = date("d-m-Y", $dataFinal);

echo $hoje. "<br>";
echo $dataInicialS. "<br>";
echo $dataFinalS. "<br>";

//$getNome = "SELECT nomeCompleto FROM cadastrocolaborador WHERE id=$id";
//$resultNome = mysqli_query($con, $getNome);
//$rowNome = mysqli_fetch_array($resultNome);
//$nome = $rowNome['nomeCompleto'];
//echo $nome;

$sql = "SELECT * FROM cadastrovisita WHERE periodoInicial > $dataInicialS";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
	echo $row['local']. "<br>";
}


?>