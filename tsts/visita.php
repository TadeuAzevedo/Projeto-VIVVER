<?php

    session_start();
    $id = $_GET['id'];

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
        echo '
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
        
        <br><br>
        <div class="container">
            <div class="row">
                <div class="col-12 fora">
                    <div class="dentro">
                        <h1>Visita inserida com sucesso!</h1>
                        <br>
                        <a href="cadastrovisita.php?id='.$id.'"><button type="button"  id="btn">Cadastrar outra visita</button></a><br><br>
                        <a href="visitasusuario.php?id='.$id.'"><button type="button"  id="btn">Visitas cadastradas</button></a>
                        <style>
                            .fora{
                                display: flex;
                                height: 10vh;
                            }
                            .dentro{
                                margin: auto;
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
        ';
    }else{
        echo "deu ruim";
    }

    $result = mysqli_query($con, "SELECT id FROM cadastrocolaborador2");
    
?>
<html>
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
        <title>Visitas do Usuário</title>
        </script>
    </head>
    
</html>