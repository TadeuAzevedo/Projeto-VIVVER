<?php

$button = $_GET['enviar'];
$search = $_GET['busca'];

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$sql = "SELECT * FROM cadastrovisita WHERE nomeColaborador LIKE '%$search%'";
$run = mysqli_query($con,$sql);
$foundnum = mysqli_num_rows($run);

if($foundnum == 0){
	echo "Sem dados encontrados";
}else{
	echo "<h1>$foundnum Resultados encontrados para \"".$search."\"</h1>";
	$sql = "SELECT * FROM cadastrovisita WHERE nomeColaborador LIKE '%$search%'";
	$getQuery = mysqli_query($con,$sql);

	while($runrows = mysqli_fetch_array($getQuery)){
		echo "<h5>".$runrows['nomeColaborador']."</h5>";
		echo "<h5>".$runrows['local']."</h5>";
		echo "<h5>".$runrows['transporte']."</h5>";
		echo "<h5>".$runrows['atividade']."</h5>";
		echo "-----------------------------";
	}
}

?>