<?php

session_start();
$id = $_GET['id'];

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$pessoas = "SELECT * FROM cadastrocolaborador WHERE setor = 1";
$resultPessoas = mysqli_query($con, $pessoas);

date_default_timezone_set('America/Sao_Paulo');
$hoje = date("Y-m-d");

$dataInicial = strtotime("Friday");
$dataFinal = strtotime("+7 days", $dataInicial);
$dataInicialS = date("Y-m-d", $dataInicial);
$dataFinalS = date("Y-m-d", $dataFinal);

while($userName = mysqli_fetch_array($resultPessoas)){
	$sql = "SELECT * FROM cadastrovisita WHERE nomeColaborador = '".$userName['nomeCompleto']."'";
	$result = mysqli_query($con, $sql);
	while($row = mysqli_fetch_array($result)){
		$idv = $row['id'];
		if($row['periodoInicial'] >= $dataInicialS && $row['periodoFinal'] <= $dataFinalS){
			if($row['enviado'] == 0 && $row['situação'] == 2){
				$paraEmail = $userName['email'];
				$assunto = "Programação Semanal";
				$body = "Boa tarde, ". $row['nomeColaborador'] . 
				" você vai para ". $row['local'] ." no dia ". $row['periodoInicial'] ." e voltará no dia ". $row['periodoFinal'].
				" para exercer a atividade de ". $row['atividade'] ." com o contato local de ". $row['contatoLocal'];
				if (mail($paraEmail, $assunto, $body)) {
		    		echo "<script>setTimeout(function(){ alert('Email enviado com sucesso!'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
		    		$update = mysqli_query($con, "UPDATE cadastrovisita SET enviado='1' WHERE id=$idv");
				} else {
		    		echo "<script>setTimeout(function(){ alert('Falha ao enviar!'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
				}
			}else{
				echo "<script>setTimeout(function(){ alert('Todos emails já foram enviados!'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
			}
		}else{
			echo "<script>setTimeout(function(){ alert('Todos emails já foram enviados!'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
		}
	}
}
?>
