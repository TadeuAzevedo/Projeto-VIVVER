<?php

    $con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
    session_start();
    $id = $_SESSION['id'];
    $idv = "<script>
    window.localStorage.getItem('idv');
    </script>";
    
    $sqlUpdate = 
    "UPDATE cadastrovisita
    SET nomeColaborador = CASE WHEN '".$_POST['txtNome']."' IS NOT NULL,
    local = CASE WHEN '".$_POST['txtLocal']."' IS NOT NULL,
    periodoInicial = CASE WHEN '".$_POST['dtInicial']."' IS NOT NULL,
    periodoFinal = CASE WHEN '".$_POST['dtFinal']."' IS NOT NULL,
    transporte = CASE WHEN '".$_POST['txtTransporte']."' IS NOT NULL,
    municipio = CASE WHEN '".$_POST['txtMunicipio']."' IS NOT NULL,
    atividade = CASE WHEN '".$_POST['txtAtv']."' IS NOT NULL,
    observacoes = CASE WHEN '".$_POST['txtObs']."' IS NOT NULL,
    ativo = CASE WHEN '".$_POST['ativo']."' IS NOT NULL";

    $resultUpdate = mysqli_query($con,$sqlUpdate);

    if($resultUpdate){
        echo "<script>setTimeout(function(){ alert('Cadastro atualizado com sucesso!'); window.location.href = 'perfil.php?id=$id'}, 1000);</script>";
    }else{
    	echo $idv;
    }

?>