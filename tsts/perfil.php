<?php

session_start();
$id = $_GET['id'];
$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$result = mysqli_query($con, "SELECT * FROM cadastrocolaborador WHERE id='$id'");
$row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script>
        function voltar(){
            window.history.back();
        }
    </script>
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
    <link rel="shortcut icon" type="image/x-icon" href="transparentVV.png">
    <style>
        label{
            color: grey;
            font-weight: bolder;
            font-size: 90%;
        }
        input[type=text] {
            border: none;
            border-bottom: 1px solid grey;
            outline: none;
        }
        input[type=text]:hover {
            border-bottom: 1px solid black;
        }
    </style>
    <title>Perfil</title>
</head>
<body>
<!-- Início modal foto -->
    <div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Trocar foto de perfil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="img.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
                <input type="file" name="image">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
        </div>
    </div>
    </div>
<!-- Fim modal foto -->
<!-- Início modal edição -->
    <div class="modal fade" id="modalEdicao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar cadastro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form name="cadastroColaborador" method="POST" action="edit2.php?id=<?php echo $id?>" autocomplete="off">
                <p>
                    <label for="nome">Nome completo:</label><br>
                    <input type="text" name="txtNomeC" id="txtNomeC" for="nome" style="width: 97%;" value="<?php echo $row['nomeCompleto'];?>" required>
                </p>
                <p>
                    <label for="local">Telefone:</label><br>
                    <input type="text" name="txtFone" id="txtFone" maxlength="15" style="width: 100%;" value="<?php echo $row['telefone'];?>" required>
                </p>
                <p>
                    <label for="dataInicial">Email:</label><br>
                    <input type="text" name="txtEmail" id="txtEmail" style="width: 97%;" value="<?php echo $row['email'];?>" required>
                </p>
                <br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <a href="edit2.php"><button type="submit" name="enviar" id="btn" value="Enviar" class="btn btn-primary">Salvar mudanças</button></a>
             </form>
          </div>
        </div>
      </div>
    </div>
<!-- Fim modal edição -->
<!-- Início nav -->
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
                <li class="nav-item active">
                    <a class="navbar-nav" href="perfil.php?id=<?php echo $id ?>"><img src="icone.png" width="40em"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.html">&ensp;Sair</a>
                </li>
            </ul>
        </div>
    </nav>
<!-- Fim nav -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 esquerda">
                <button type="button" data-toggle="modal" data-target="#modalFoto"><img src="uploads/<?php echo $row['imagem'];?>"></button><br>
                <h3><?php echo $row['nomeCompleto'];?></h3>
                <p style="text-align:center;font-size:110%;font-weight:bolder"><?php
                if($row['setor'] == 1){
                    echo "Implantador";
                }else if($row['setor'] == 2){
                    echo "Logística";
                }else if($row['setor'] == 3){
                    echo "Financeiro";
                }else if($row['setor'] == 4){
                    echo "Coordenador";
                }else if($row['setor'] == 0){
                    echo "Administrador";
                }
                ?></p>
                <style>
                    .esquerda{
                        height: fit-content;
                    }
                    .esquerda img{
                        border-radius: 50%;
                        width: 15em;
                        height: 15em;
                    }
                    .esquerda img:hover{
                        opacity: 0.5;
                        cursor: pointer;
                    }
                    .esquerda button{
                        margin-top: 30px;
                        margin-left: auto;
                        margin-right: auto;
                        display: block;
                        color: transparent;
                        background-color: transparent;
                        border-color: transparent;
                    }
                    h3{
                        text-align: center;
                    }
                </style>
            </div>
            <div class="col-9 direita">
                <p><span style="font-weight:bolder;font-size:90%">Nome completo: </span><?php echo $row['nomeCompleto']?><br>
                <span style="font-weight:bolder;font-size:90%">Email: </span><?php echo $row['email']?><br>
                <span style="font-weight:bolder;font-size:90%">Usuário: </span><?php echo $row['usuario']?><br>
                <span style="font-weight:bolder;font-size:90%">Telefone: </span><?php echo $row['telefone']?></p>
                <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#modalEdicao">Editar cadastro</button>
                <style>
                    .direita{
                        height: fit-content;
                    }
                    .direita p{
                        margin-top:30px;
                        font-size:130%;
                    }
                </style>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>