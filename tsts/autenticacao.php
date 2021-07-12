<?php

$con = mysqli_connect('localhost', 'root', '', 'programacaosemanalteste');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$usuario = stripcslashes($usuario);
$senha = stripcslashes($senha);
$usuario = mysqli_real_escape_string($con, $usuario);
$senha = mysqli_real_escape_string($con, $senha);

$sql = "SELECT * FROM cadastrocolaborador WHERE usuario = '$usuario' AND senha = '$senha'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if($count == 1){
    echo "<script>onload = window.location='home.php?id=".$row['id']."';</script>";
}
else{
    echo "<script>setTimeout(function(){ alert('Falha no login'); window.location.href = 'index.html'}, 1000);</script>";
}
?>