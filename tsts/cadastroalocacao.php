<?php

$con = mysqli_connect('localhost', 'root', '', 'programacaosemanalteste');
$result = mysqli_query($con, "SELECT * FROM cadastrocolaborador");
session_start();
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de alocação</title>
</head>
<body>
    <div id="frm">
        <h1>Cadastro de alocação</h1>
    <form name="cadastroAlocacao" method="POST" action="alocacao.php?id=<?php echo $id ?>">
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
            <label for="local">Forma de transporte:</label><br>
            <select name="txtTransporte" id="txtTransporte" style="width: 100%;">
                <option value="Veículo da Empresa">Veículo da Empresa</option>
                <option value="Veículo Próprio">Veículo Próprio</option>
                <option value="Veículo do Parceiro">Veículo do Parceiro</option>
                <option value="Veículo Locado">Veículo Locado</option>
                <option value="Ônibus">Ônibus</option>
                <option value="Avião">Avião</option>
                <option value="Moto Táxi">Moto Táxi</option>
                <option value="Táxi/Uber">Táxi/Uber</option>
                <option value="Acompanhante em outra AV">Acompanhante em outra AV</option>
                <option value="Não utilizado">Não utilizado</option>
            </select>
        </p>
        <p>
            <label for="local">Finalidade:</label><br>
            <select name="txtFinalidade" id="txtFinalidade" style="width: 100%;">
                <option value="Implantação">Implantação</option>
                <option value="Comercial">Comercial</option>
                <option value="Suporte Técnico">Suporte Técnico</option>
                <option value="Projeto">Projeto</option>
                <option value="Eventos Especiais">Eventos Especiais</option>
            </select>
        </p>
        <p>
           <br> <input type="submit" name="enviar" id="btn" value="Enviar">
        </p>
    </form>
</div>
</body>
</html>