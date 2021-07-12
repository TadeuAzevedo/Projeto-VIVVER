<?php

$con = mysqli_connect('localhost', 'root', '', 'programacaosemanalteste');
$result = mysqli_query($con, "SELECT nomeCompleto FROM cadastrocolaborador");
session_start();
$id = $_GET['id'];
//$resultID = mysqli_query($con, "SELECT nomeCompleto FROM cadastrocolaborador WHERE id=$id");
//$rowID = mysqli_fetch_array($resultID);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de visita</title>
</head>
<body>
    <div id="frm">
        <h1>Cadastro de visita</h1>
    <form name="cadastroVisita" method="POST" action="visita.php?id=<?php echo $id ?>">
        <p>
            <label for="nome">Nome:</label><br>
            <select id="txtNome" name="txtNome" style="width: 100%;">

            <?php
                while($row = mysqli_fetch_array($result)){
                    echo "<option>" .$row['nomeCompleto'] . "</option>";
                }
            ?>
                
            </select>
        </p>
        <p>
            <label for="local">Local:</label><br>
            <input type="text" name="txtLocal" id="txtLocal" style="width: 97%;"required>
        </p>
        <p>
            <label for="dataInicial">Data inicial:</label><br>
            <input type="date" name="dtInicial" id="dtInicial" style="width: 97%;"required>
        </p>
        <p>
            <label for="dataFinal">Data final:</label><br>
            <input type="date" name="dtFinal" id="dtFinal" style="width: 97%;"required>
        </p>
        <p>
            <label for="atividade">Atividade:</label><br>
            <input type="text" name="txtAtv" id="txtAtv" style="width: 97%;"required>
        </p>
        <p>
            <label for="cttLocal">Contato local:</label><br>
            <input type="text" name="cttLocal" id="cttLocal"style="width: 97%;">
        </p>
        <p>
           <br> <input type="submit" name="enviar" id="btn" value="Enviar">
        </p>
    </form>
</div>
</body>
</html>