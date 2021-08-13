<?php

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
session_start();
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM cadastrocolaborador WHERE id='$id'");
$row = mysqli_fetch_array($result);
$setor = $row['setor'];

include('calendario.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="transparentVV.png">
    <script>
        function voltar(){
            window.history.back();
        }
    </script>
    <style>
            .container {
                font-family: 'Noto Sans', sans-serif;
                margin-top: 80px;
            }
            h3 {
                margin-bottom: 30px;
            }
            th {
                height: 30px;
                text-align: center;
            }
            th:hover{
                background: #dddddd;
                cursor: default;
            }
            td {
                height: 60px;
            }
            td:hover{
                background: #eeeeee;
                cursor: default;
            }
            .today {
                background: #56acff;
            }
            .today:hover{
                background: #348add;
            }
            .visita{
                background: green;
            }
            th:nth-of-type(1), td:nth-of-type(1) {
                color: red;
            }
            th:nth-of-type(7), td:nth-of-type(7) {
                color: blue;
            }
        </style>
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
                    <a class="nav-link" href="#" onclick="voltar()">Voltar</a>
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-6 esquerda">
                <table class="table table-bordered">
                    <tr>
                        <th>D</th>
                        <th>S</th>
                        <th>T</th>
                        <th>Q</th>
                        <th>Q</th>
                        <th>S</th>
                        <th>S</th>
                    </tr>
                    <?php
                        foreach ($weeks as $week) {
                            echo $week;
                        }
                    ?>
                </table>
                <h3 style="text-align: center;"><a href="?id=<?php echo $id ?>&ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?id=<?php echo $id ?>&ym=<?php echo $next; ?>">&gt;</a></h3>
            </div>
            <div class="col-6 direita">

                <?php 

                    if($row['setor'] == 0 || $row['setor'] == 1 || $row['setor'] == 4 ){
                        //Botão 1 - Cadastrar Visita
                        echo '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = ';
                        echo "'cadastrovisita.php?id=".$id."'";
                        echo ';">Cadastrar visita</button>';
                        //Botão 2 - Ver visitas cadastradas no usuário
                        echo '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = ';
                        echo "'visitasusuario.php?id=".$id."'";
                        echo ';">Minhas visitas cadastradas</button>';
                    }
                    //if($row['setor'] == 0 || $row['setor'] == 2 || $row['setor'] == 3 || $row['setor'] == 4){
                        //Botão 3 - Cadastrar Alocação
                        //echo '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = ';
                        //echo "'cadastroalocacao.php?id=".$id."'";
                        //echo ';">Cadastrar alocação</button>';
                    //}
                    if($row['setor'] == 4 || $row['setor'] == 0){
                        //Botão 4 - Ver todas visitas cadastradas
                        echo '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = ';
                        echo "'tabelavisita.php?id=".$id."'";
                        echo ';">Visitas referentes à semana seguinte</button>';
                        //Botão 5 - Ver todos colaboradores cadastrados
                        echo '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = ';
                        echo "'tabelacolaborador.php?id=".$id."'";
                        echo ';">Colaboradores cadastrados</button>';
                        //Botão 6 - Enviar email de visita para implantadores
                        echo '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = ';
                        echo "'formEmail.php?id=".$id."'";
                        echo ';">Enviar emails para implantadores</button>';
                        //Botão 7 - Aprovar visitas
                        echo '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = ';
                        echo "'visitaspendentes.php?id=".$id."'";
                        echo ';">Visitas pendentes</button>';
                        //Botão 8 - Editar visitas
                        echo '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = ';
                        echo "'deleteVisita.php?id=".$id."'";
                        echo ';">Editar visitas</button>';
                        //Botão 9 - Histórico visitas
                        echo '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = ';
                        echo "'historicovisitas.php?id=".$id."'";
                        echo ';">Histórico de visitas</button>';
                    
                    }

                ?>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>