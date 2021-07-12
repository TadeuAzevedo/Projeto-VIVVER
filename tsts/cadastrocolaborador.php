<?php

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de colaborador</title>
</head>

<body>
    <div id="frm">
        <h1>Cadastro de colaborador</h1>
        <form name="cadastroColaborador" method="POST" action="colaborador.php" autocomplete="off">
            <p>
                <label for="nome">Nome completo:</label><br>
                <input type="text" name="txtNomeC" id="txtNomeC" for="nome" style="width: 97%;" required>
            </p>
            <p>
                <label for="nome">Usuário:</label><br>
                <input type="text" name="txtUsuario" id="txtUsuario" style="width: 97%;" required>
            </p>
            <p>
                <label for="nome">Senha:</label><br>
                <input type="password" name="txtSenha" id="txtSenha" style="width: 97%;" required>
            </p>
            <p>
                <label for="nome">Confirmar senha:</label><br>
                <input type="password" name="txtCSenha" id="txtCSenha" style="width: 97%;" required>
            </p>
            <p>
                <label for="local">Telefone:</label><br>
                <input type="text" name="txtFone" id="txtFone" style="width: 97%;" required>
            </p>
            <p>
                <label for="dataInicial">Email:</label><br>
                <input type="text" name="txtEmail" id="txtEmail" style="width: 97%;" required>
            </p>
            <p>
                <label for="setor">Área:</label><br>
                <select name="txtSetor" id="txtSetor" style="width: 100%;" required>
                    <option value="1">Implantação</option>
                    <option value="2">Logística</option>
                    <option value="3">Financeiro</option>
                    <option value="4">Aprovador</option>
                </select>
            </p>
            <br>
            <script>
                function saveData(){
                    var input = document.getElementById("nome");
                    sessionStorage.setItem("nome", input.value);
                    return true;
                }
            </script>
            <p>
                <input type="submit" name="enviar" id="btn" value="Enviar" onclick="return saveData();">
            </p>
            
        </form>
    </div>
</body>

</html>