<?php

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
session_start();
$id = $_SESSION['id'];

$user = "SELECT nomeCompleto FROM cadastrocolaborador WHERE id=$id";
$resultUser = mysqli_query($con,$user);
$userName = mysqli_fetch_array($resultUser);

$sql = "SELECT * FROM cadastrovisita WHERE nomeColaborador = '".$userName['nomeCompleto']."' AND ativo = 1";
$result = mysqli_query($con,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script>
        function voltar(){
            window.history.back();
        }
    </script>
    <link rel="shortcut icon" type="image/x-icon" href="transparentVV.png">
    <title>Visitas do Usuário</title>
    <style>
        input{
            outline: none;
        }
        input[type=search] {
            -webkit-appearance: textfield;
            -webkit-box-sizing: content-box;
            font-family: inherit;
            font-size: 90%;
        }
        input::-webkit-search-decoration,
        input::-webkit-search-cancel-button {
            display: none; 
        }
        input[type=search] {
            background: #007bff url(https://static.tumblr.com/ftv85bp/MIXmud4tx/search-icon.png) no-repeat 9px center;
            border: 0;
            width: 55px;
            height: 40px;
            
            -webkit-border-radius: 10em;
            -moz-border-radius: 10em;
            border-radius: 10em;
            
            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            transition: all .5s;
        }
        input[type=search]:focus {
            width: 150px;
            background-color: #fff;
            border-color: #66CC75;
            
            -webkit-box-shadow: 0 0 5px rgba(109,207,246,.5);
            -moz-box-shadow: 0 0 5px rgba(109,207,246,.5);
            box-shadow: 0 0 5px rgba(109,207,246,.5);
        }
        input:-moz-placeholder {
            color: #999;
        }
        input::-webkit-input-placeholder {
            color: #999;
        }
        #demo-2 input[type=search] {
            width: 30px;
            padding-left: 10px;
            color: transparent;
            cursor: pointer;
        }
        #demo-2 input[type=search]:hover {
            background-color: #fff;
        }
        #demo-2 input[type=search]:focus {
            width: 200px;
            padding-left: 32px;
            color: #000;
            background-color: #fff;
            cursor: auto;
        }
        #demo-2 input:-moz-placeholder {
            color: transparent;
        }
        #demo-2 input::-webkit-input-placeholder {
            color: transparent;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <a class="navbar-brand" href="home.php">
            <img src="teste.png" width="150em" class="d-inline-block align-top" alt="">
        </a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Início</a>
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
                    <form id="demo-2" method="get" action="busca.php">
                        <input type="search" name="busca" autocomplete="off">
                    </form>
                </li>&ensp;
                <li class="nav-item">
                    <a class="navbar-nav" href="perfil.php"><img src="icone.png" width="40em"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.html">&ensp;Sair</a>
                </li>
            </ul>
        </div>
    </nav>
<br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Local</th>
                        <th scope="col">Data Inicial</th>
                        <th scope="col">Data Final</th>
                        <th scope="col">Atividade</th>
                        <th scope="col">Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            echo "<th scope='row'>". $row['nomeColaborador'] ."</th>";
                            echo "<td>". $row['local'] ."</td>";
                            echo "<td>". date('d-m-Y', strtotime( $row['periodoInicial'])) ."</td>";
                            echo "<td>". date('d-m-Y', strtotime( $row['periodoFinal'])) ."</td>";
                            echo "<td>". $row['atividade'] ."</td>";
                            if($row['situação'] == 1){
                                echo "<td>Pendente</td>";
                            }else if($row['situação'] == 2){
                                echo "<td style='color: #0B0;'>Aprovado</td>";
                            }else if($row['situação'] == 3){
                                echo "<td style='color: #f00;'>Reprovado</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'cadastrovisita.php';">Cadastrar visita</button>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>