<?php

    $con = mysqli_connect("localhost","root","","programacaosemanalteste");
    $txtNome = $_POST['txtNome'];
    $txtLocal = $_POST['txtLocal'];
    $dtInicial = $_POST['dtInicial'];
    $dtFinal = $_POST['dtFinal'];
    $txtAtv = $_POST['txtAtv'];
    $cttLocal = $_POST['cttLocal'];

    $sql = "INSERT INTO `cadastrovisita` (`nomeColaborador`,`local`,`periodoInicial`,`periodoFinal`,`atividade`,`contatoLocal`)VALUES ('$txtNome','$txtLocal','$dtInicial','$dtFinal','$txtAtv','$cttLocal');";
    
    $rs = mysqli_query($con, $sql);

    if($rs){
        echo "Visita inserida com sucesso!";
    }else{
        echo "deu ruim";
    }

    $result = mysqli_query($con, "SELECT id FROM cadastrocolaborador");
    session_start();
    $id = $_GET['id'];
?>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <a href="cadastrovisita.html"><button type="button">Cadastrar outra visita</button></a>
        <a href="visitasusuario.php?id=<?php echo $id ?>"><button type="button">Voltar as visitas cadastradas</button></a>
    </body>
</html>