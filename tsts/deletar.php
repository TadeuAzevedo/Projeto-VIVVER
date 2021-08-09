<?php

    $con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
    session_start();
    $id = $_GET['id'];
    $idv = $_GET['idv'];
    
    $sql = "UPDATE cadastrovisita SET ativo = 0 WHERE id=$idv";
    $result = mysqli_query($con,$sql);

    if($result){
        echo "<script>setTimeout(function(){ alert('Visita deletada com sucesso!'); window.location.href = 'deleteVisita.php?id=$id'}, 1000);</script>";
    }

?>