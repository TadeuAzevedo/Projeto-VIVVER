<?php

session_start();
$id = $_GET['id'];

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$pessoas = "SELECT * FROM cadastrocolaborador WHERE setor = 1";
$resultPessoas = mysqli_query($con, $pessoas);

while($userName = mysqli_fetch_array($resultPessoas)){
	$sql = "SELECT * FROM cadastrovisita WHERE nomeColaborador = '".$userName['nomeCompleto']."'";
	$result = mysqli_query($con, $sql);
	while($row = mysqli_fetch_array($result)){
		$paraEmail = $userName['email'];
		$assunto = "Programação Semanal";
		$body = "Boa tarde, ". $row['nomeColaborador'] . 
		" você vai para ". $row['local'] ." no dia ". $row['periodoInicial'] ." e voltará no dia ". $row['periodoFinal'].
		" para exercer a atividade de ". $row['atividade'] ." com o contato local de ". $row['contatoLocal'];
		if (mail($paraEmail, $assunto, $body)) {
    		echo "<script>setTimeout(function(){ alert('Email enviado com sucesso!'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
		} else {
    		echo "Falha no envio do email.";
		}
	}
}
?>
