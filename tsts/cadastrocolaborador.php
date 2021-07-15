<?php

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Cadastro de colaborador</title>
</head>

<body>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-5 esquerda" align="center">
                <div class="dentro">
                    
                    <h1 style="width: 100%; text-align: left;">Cadastro de colaborador</h1>
                    <a href="index.html" style="float: left;"><img src="voltar.png" width="40em"></a>
                    <form name="cadastroColaborador" method="POST" action="colaborador.php" autocomplete="off">
                        <label for="nome" style="font-weight: bolder; color: grey;width: 100%;text-align: left;">Nome completo:</label>
                        <br>
                        <input type="text" name="txtNomeC" id="txtNomeC" for="nome" style="width: 100%;" placeholder="Digite seu nome completo" required>
                        <br>
                        <label for="nome" style="font-weight: bolder; color: grey;width: 100%;text-align: left;">Usuário:</label>
                        <br>
                        <input type="text" name="txtUsuario" id="txtUsuario" style="width: 100%;" placeholder="Digite seu usuário" required>
                        <br>
                        <label for="nome" style="font-weight: bolder; color: grey;width: 100%;text-align: left;">Senha:</label>
                        <br>
                        <input type="password" name="txtSenha" id="txtSenha" style="width: 100%;" placeholder="Digite sua senha" required>
                        <br>
                        <label for="nome" style="font-weight: bolder; color: grey;width: 100%;text-align: left;">Confirmar senha:</label>
                        <br>
                        <input type="password" name="txtCSenha" id="txtCSenha" style="width: 100%;" placeholder="Confirme sua senha" required>
                        <br>
                        <label for="local" style="font-weight: bolder; color: grey;width: 100%;text-align: left;">Telefone:</label>
                        <br>
                        <input type="text" name="txtFone" id="txtFone" maxlength="15" style="width: 100%;" placeholder="Digite seu telefone com DDD" required>
                        <label for="dataInicial" style="font-weight: bolder; color: grey;width: 100%;text-align: left;">Email:</label>
                        <br>
                        <input type="text" name="txtEmail" id="txtEmail" style="width: 100%;" placeholder="Digite seu email" required>
                        <label for="setor" style="font-weight: bolder; color: grey;width: 100%;text-align: left;">Área:</label>
                        <br>
                        <select name="txtSetor" id="txtSetor" style="width: 100%;" required>
                            <option value="1">Implantação</option>
                            <option value="2">Logística</option>
                            <option value="3">Financeiro</option>
                            <option value="4">Coordenador</option>
                        </select>
                        <br>
                        <script>
                            function saveData(){
                                var input = document.getElementById("nome");
                                sessionStorage.setItem("nome", input.value);
                                return true;
                            }
                            function mascara(o,f){
                                v_obj=o
                                v_fun=f
                                setTimeout("execmascara()",1)
                            }
                            function execmascara(){
                                v_obj.value=v_fun(v_obj.value)
                            }
                            function mtel(v){
                                v=v.replace(/\D/g,""); 
                                v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); 
                                v=v.replace(/(\d)(\d{4})$/,"$1-$2"); 
                                return v;
                            }
                            function id( el ){
                                return document.getElementById( el );
                            }
                            window.onload = function(){
                                id('txtFone').onkeyup = function(){
                                    mascara( this, mtel );
                                }
                            }
                        </script>
                        <br>
                        <input type="submit" name="enviar" id="btn" value="Enviar" onclick="return saveData();">
                    </form>
                    <style>
                        .esquerda{
                            display: flex;
                            height: 100vh;
                        }
                        .dentro{
                            margin: auto;
                        }
                        input[type=text] {
                            border: none;
                            border-bottom: 1px solid grey;
                            outline: none;
                        }
                        input[type=password] {
                            border: none;
                            border-bottom: 1px solid grey;
                            outline: none;
                        }
                        input[type=text]:hover {
                            border-bottom: 1px solid black;
                        }
                        input[type=password]:hover {
                            border-bottom: 1px solid black;
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
                            height: 50px;
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
            <div class="col-7 direita">
                <img src="loginImg.png">
                <style>
                    .direita{
                        padding: 0;
                    }
                    .direita img{
                        height: 100vh;
                        width: 100%;
                    }
                </style>
            </div>
        </div>
    </div>





        
        
    


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>