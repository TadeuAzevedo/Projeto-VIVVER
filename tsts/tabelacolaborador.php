<?php

session_start();
$id = $_GET['id'];
$con=mysqli_connect("localhost","root","","programacaosemanalteste");
$result = mysqli_query($con,"SELECT * FROM cadastrocolaborador");
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
    <link rel="shortcut icon" type="image/x-icon" href="transparentVV.png">
    <title>Visitas do Usuário</title>
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
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Setor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            echo "<th scope='row'>". $row['nomeCompleto'] ."</th>";
                            echo "<td>". $row['usuario'] ."</td>";
                            echo "<td>". $row['telefone'] ."</td>";
                            echo "<td>". $row['email'] ."</td>";
                            if($row['setor'] == 1){
                            	echo "<td>Implantação</td>";
                            }else if($row['setor'] == 2){
                            	echo "<td>Logística</td>";
                            }else if($row['setor'] == 3){
                            	echo "<td>Financeiro</td>";
                            }else if($row['setor'] == 4){
                            	echo "<td>Coordenador</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>