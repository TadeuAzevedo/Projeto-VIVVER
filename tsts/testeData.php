<?php

$id = $_GET['id'];
$con = mysqli_connect("localhost", "root", '', 'programacaosemanalteste');

date_default_timezone_set('America/Sao_Paulo');
$hoje = date("Y-m-d");

$dataInicial = strtotime("Friday");
$dataFinal = strtotime("+7 days", $dataInicial);
$dataInicialS = date("Y-m-d", $dataInicial);
$dataFinalS = date("Y-m-d", $dataFinal);

echo $hoje. "<br>";
echo $dataInicialS. "<br>";
echo $dataFinalS. "<br><br>";

$sql = "SELECT * FROM cadastrovisita";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
	if($row['periodoInicial'] >= $dataInicialS && $row['periodoFinal'] <= $dataFinalS){
		echo $row['periodoInicial']. "<br>";
		echo $row['periodoFinal']. "<br><br>";
	}
}
?>