<?php

    $con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
    session_start();
    $id = $_GET['id'];
    $idv = $_GET['idv'];
    
    $sqlUpdate = "UPDATE cadastrovisita SET nomeColaborador = '".$_POST['txtNome']."', local= '".$_POST['txtLocal']."', periodoInicial = '".$_POST['dataInicial']."', periodoFinal= '".$_POST['dataFinal']."', contatoLocal = '".$_POST['txtContato']."', atividade = '".$_POST['txtAtv']."'";
    $resultUpdate = mysqli_query($con,$sqlUpdate);

    if($resultUpdate){
        echo "<script>setTimeout(function(){ alert('Cadastro atualizado com sucesso!'); window.location.href = 'perfil.php?id=$id'}, 1000);</script>";
    }

?>