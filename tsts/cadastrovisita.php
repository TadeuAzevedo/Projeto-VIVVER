<?php

session_start();
$id = $_GET['id'];

$con = mysqli_connect('localhost', 'root', '', 'programacaosemanalteste');
$result = mysqli_query($con, "SELECT * FROM cadastrocolaborador WHERE id=$id");
$row = mysqli_fetch_array($result);
$setor = $row['setor'];

if($setor == 2 || $setor == 3){
    echo "<script>setTimeout(function(){ alert('Acesso restrito'); location.href = 'home.php?id=".$id."';}, 1000);</script>";
}else {
    echo '<!DOCTYPE html>
    <html lang="pt-br">

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
        <title>Cadastro de visita</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <a class="navbar-brand" href="home.php?id='.$id.'">
                <img src="teste.png" width="150em" class="d-inline-block align-top" alt="">
            </a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php?id='.$id.'">Início</a>
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
                        <a class="navbar-nav" href="perfil.php?id='.$id.'"><img src="icone.png" width="40em"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">&ensp;Sair</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-12 frm">
                    <div class="meio">
                        <h1>Cadastro de Visitas</h1>
                        <br>
                        <form name="cadastroVisita" method="POST" action="visita.php?id='.$id.'">
                            <label for="nome">Nome:</label>
                            <br>
                            <select name="txtNome" id="txtNome" required>';
                            if($setor == 1){
                                $resultB = mysqli_query($con, "SELECT nomeCompleto FROM cadastrocolaborador WHERE id=$id");
                            }else if($setor == 4){
                                $resultB = mysqli_query($con, "SELECT nomeCompleto FROM cadastrocolaborador WHERE setor = 1 OR setor = 4");
                            }
                            while($rows = mysqli_fetch_array($resultB)){
                            echo "<option>" .$rows['nomeCompleto'] . "</option>";
                            }
                            echo '
                            </select>
                            <br><br>
                            <label for="local">Local:</label>
                            <br>
                            <input type="text" name="txtLocal" id="txtLocal" autocomplete="off" required>
                            <br><br>
                            <label for="dataInicial">Data inicial:</label>
                            <br>
                            <input type="date" name="dtInicial" id="dtInicial" required>
                            <br><br>
                            <label for="dtFinal">Data final:</label>
                            <br>
                            <input type="date" name="dtFinal" id="dtFinal" required>
                            <br><br>
                            <label for="cttLocal">Contato local:</label>
                            <br>
                            <input type="text" name="cttLocal" id="cttLocal" autocomplete="off" required>
                            <br><br>
                            <label for="atividade">Atividade:</label>
                            <textarea name="txtAtv" id="txtAtv" maxlength="255"></textarea>
                            <br>
                            <br>
                            <input type="submit" name="enviar" id="btn" value="Cadastrar" required>
                            <br>
                        </form>

                        <style>
                            body{
                                background-color: #F1F1F1;
                            }
                            .frm{
                                display: flex;
                                margin: 40px 0 30px 0;
                            }
                            .meio{
                                margin: auto;
                                padding: 3vh 6vw 7vh 6vw;
                                border: 2px solid black;
                                background-color: white;
                            }
                            textarea{
                                width: 100%;
                                font-size: 90%;
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
                            input{
                                width: 100%;
                            }
                            input[type=text]{
                                border: none;
                                border-bottom: 1px solid grey;
                                outline: none;
                            }
                            input[type=text]:hover{
                                border-bottom: 1px solid black;
                            }
                            input[type=date]{
                                border: none;
                                border-bottom: 1px solid grey;
                                outline: none;
                            }
                            input[type=date]:hover{
                                cursor: text;
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

    </html>';
    
    }

?>

