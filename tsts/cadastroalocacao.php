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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/x-icon" href="transparentVV.png">
        <script>
            function voltar(){
                window.history.back();
            }
        </script>
        <title>Cadastro de alocação</title>
    </head>
    <body>

        <nav class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <a class="navbar-brand" href="home.php?id=<?php echo $id ?>">
                <img src="teste.png" width="150em" class="d-inline-block align-top" alt="">
            </a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
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

        <div class="container">
            <div class="row">
                <div class="col-12 fora">
                    <div class="dentro">
                        <h1>Cadastro de alocação</h1>
                        <br>
                        <form name="cadastroAlocacao" method="POST" action="alocacao.php?id=<?php echo $id ?>">
                            <label for="nome">Nome:</label>
                            <br>
                            <select id="txtNome" name="txtNome">
                                <?php
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<option>" .$row['nomeCompleto'] . "</option>";
                                    }
                                 ?>
                            </select>
                            <br>
                            <br>
                            <label for="local">Forma de transporte:</label>
                            <br>
                            <select name="txtTransporte" id="txtTransporte">
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
                            <br>
                            <br>
                            <label for="local">Finalidade:</label>
                            <br>
                            <select name="txtFinalidade" id="txtFinalidade">
                                <option value="Implantação">Implantação</option>
                                <option value="Comercial">Comercial</option>
                                <option value="Suporte Técnico">Suporte Técnico</option>
                                <option value="Projeto">Projeto</option>
                                <option value="Eventos Especiais">Eventos Especiais</option>
                            </select>
                            <br>
                            <br>
                            <input type="submit" name="enviar" id="btn" value="Enviar">
                        </form>
                        <style>
                            body{
                                background-color: #F1F1F1;
                            }
                            .fora{
                                display: flex;
                            }
                            .dentro{
                                margin: 40px auto auto auto;
                                border: 2px solid black;
                                padding: 3vh 5vw 7vh 5vw;
                                background-color: white;
                            }
                            label{
                                color: #686868;
                            }
                            select{
                                height: 30px;
                                width: 100%;
                                border: none;
                                border-bottom: 1px solid grey;
                                outline: none;
                            }
                            select:hover{
                                cursor: pointer;
                                border-bottom: 1px solid black;
                            }
                            #btn {
                                background-color: #01659e;
                                color: white;
                                border-radius: 2px;
                                width: 100%;
                                height: 80px;
                                font-size: 170%;
                                border: none;
                            }
                            #btn:hover {
                                background-color: #249820;
                                cursor: pointer;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>