<?php

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$id = $_GET['id'];

$user = "SELECT nomeCompleto FROM cadastrocolaborador WHERE id=$id";
$resultUser = mysqli_query($con,$user);
$userName = mysqli_fetch_array($resultUser);

$getData = "SELECT * FROM cadastrovisita WHERE nomeColaborador = '".$userName['nomeCompleto']."'";
$resultData = mysqli_query($con,$getData);
while($rowData = mysqli_fetch_array($resultData)){
	echo $rowData['periodoInicial'];
	echo "<br>";
	echo $rowData['periodoFinal'];
	echo "<br>";
	echo "<br>";
}



//$dataI = new DateTime($rowData['periodoInicial']);
//$dataF = new DateTime($rowData['periodoFinal']);

//$periodo = $dataI->diff($dataF);
//$duracao = $periodo->d;

?>