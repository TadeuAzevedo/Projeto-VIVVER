<?php
$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM cadastrocolaborador WHERE id='$id'");
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edição de cadastro de colaborador</title>
</head>

<body>
    <div id="frm">
        <h1>Editor</h1>
        <form name="cadastroColaborador" method="POST" action="edit2.php?id=<?php echo $id?>" autocomplete="off">
            <p>
                <label for="nome">Nome completo:</label><br>
                <input type="text" name="txtNomeC" id="txtNomeC" for="nome" style="width: 97%;" placeholder="<?php echo $row['nomeCompleto'];?>" required>
            </p>
            <p>
                <label for="local">Telefone:</label><br>
                <input type="text" name="txtFone" id="txtFone" style="width: 97%;" placeholder="<?php echo $row['telefone'];?>" required>
            </p>
            <p>
                <label for="dataInicial">Email:</label><br>
                <input type="text" name="txtEmail" id="txtEmail" style="width: 97%;" placeholder="<?php echo $row['email'];?>" required>
            </p>
            <br>
            <p>
                <a href="edit2.php"><button type="submit" name="enviar" id="btn" value="Enviar">Enivar</button></a>
            </p>
            
        </form>
    </div>
</body>
</html>
