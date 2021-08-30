<?php

    $con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
    session_start();
    $id = $_SESSION['id'];
    
    $sqlUpdate = "UPDATE cadastrocolaborador SET nomeCompleto='".$_POST['txtNomeC']."', telefone='".$_POST['txtFone']."', email='".$_POST['txtEmail']."' WHERE id='".$id."'";
    $resultUpdate = mysqli_query($con,$sqlUpdate);

    if($resultUpdate){
        echo "<script>setTimeout(function(){ alert('Cadastro atualizado com sucesso!'); window.location.href = 'perfil.php'}, 1000);</script>";
    }

?>