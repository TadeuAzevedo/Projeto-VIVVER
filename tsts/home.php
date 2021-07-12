<?php

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
session_start();
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT nomeCompleto FROM cadastrocolaborador WHERE id='$id'");
$row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Home</title>
</head>
<body>

    <script>
        window.localStorage.setItem("id", "<?php echo $id ?>")
    </script>
    <?php 
    $variavelLocal = "<script>document.write(localStorage.getItem('id'))</script>";
    ?>

    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <a class="navbar-brand" href="home.php?id=<?php echo $id ?>">
            <img src="teste.png" width="150em" class="d-inline-block align-top" alt="">
        </a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php?id=<?php echo $id ?>">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="https://www.vivver.com.br/">Site oficial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
        </ul>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="navbar-nav" href="perfil.php?id=<?php echo $id ?>"><img src="icone.png" width="40em"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.html">&ensp;Sair</a>
                </li>
            </ul>
        </div>
    </nav>

    <br>
    <h1 style="text-align: center;">Bem vindo, <?php echo $row['nomeCompleto'] ?></h1>
    <h2 style="text-align: center;">O que deseja fazer?</h2><br>
    <div style="margin:0 50px 0 50px;">
        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'cadastrovisita.php?id=<?php echo $id?>';">Cadastrar visita</button>
        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'cadastroalocacao.php?id=<?php echo $id?>';">Cadastrar alocação</button>
        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'visitasusuario.php?id=<?php echo $id?>';">Visistas cadastradas</button>
        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'tabelacolaborador.php?id=<?php echo $id?>';">Colaboradores cadastrados</button>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>