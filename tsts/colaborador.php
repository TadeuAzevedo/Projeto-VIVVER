<?php
    $con = mysqli_connect('localhost', 'root', '', 'programacaosemanalteste');
    $txtNomeC = $_POST['txtNomeC'];
    $txtUsuario = $_POST['txtUsuario'];
    $txtSenha = $_POST['txtSenha'];
    $txtCSenha = $_POST['txtCSenha'];
    $txtFone = $_POST['txtFone'];
    $txtEmail = $_POST['txtEmail'];
    $txtSetor = $_POST['txtSetor'];

    if($txtSenha!=$txtCSenha){
        echo "<script>setTimeout(function(){ alert('Senhas não coincidem'); window.location.href = 'cadastrocolaborador.php}, 1000);</script>";
    }else{
        $sql = "INSERT INTO `cadastrocolaborador` (`nomeCompleto`,`usuario`,`senha`,`telefone`,`email`,`setor`,`imagem`) VALUES ('$txtNomeC','$txtUsuario','$txtSenha','$txtFone','$txtEmail','$txtSetor','default.jpg');";
        $rs = mysqli_query($con, $sql);
        if($rs){
            echo "<script>setTimeout(function(){ alert('Cadastro inserido com sucesso!'); window.location.href = 'index.html'}, 1000);</script>";
        }else{
            echo "Deu ruim";
        }
    }
?>