<?php

$con = mysqli_connect('localhost', 'root', '', 'programacaosemanalteste');
$id = $_GET['id'];
$idv = $_GET['idv'];
$novaSituacao = $_GET['nsituacao'];
$prioridade = $_GET['prioridade'];

$sql = "UPDATE cadastrovisita SET situação='".$novaSituacao."',prioridade='".$prioridade."' WHERE id='".$idv."'";
$result = mysqli_query($con, $sql);

if($result && $novaSituacao == 2){
        echo "<script>setTimeout(function(){ alert('Visita aprovada com sucesso!'); window.location.href = 'visitaspendentes.php?id=$id'}, 1000);</script>";
}else if($result && $novaSituacao == 3){
        echo "<script>setTimeout(function(){ alert('Visita reprovada'); window.location.href = 'visitaspendentes.php?id=$id'}, 1000);</script>";
    }
?>