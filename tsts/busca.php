<?php

session_start();
$id = $_SESSION['id'];

$search = $_GET['busca'];

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$sql = "SELECT * FROM cadastrocolaborador WHERE nomeCompleto LIKE '%$search%'";
$run = mysqli_query($con,$sql);
$foundnum = mysqli_num_rows($run);

?>

<!DOCTYPE html>
<html>
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
        .nome{
            color: black;
        }
        .nome:hover{
            text-decoration: none;
            color: #007afe;
        }
    </style>
	<title>Busca</title>
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
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-12">
    			<br>
    			<table class="table table-bordered">
    				<thead class="thead-dark">
    					<tr>
    						<th scope="col">Nome</th>
    						<th scope="col">Email</th>
    						<th scope="col">Telefone</th>
    						<th scope="col">Setor</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php

    						if($foundnum == 0){
								echo "<script>setTimeout(function(){alert('Sem dados encontrados');voltar();}, 1000);</script>";
							}else{
								echo "<br><h1 style='text-align: center'>$foundnum Resultados encontrados para \"".$search."\"</h1><br>";
								$sql = "SELECT * FROM cadastrocolaborador WHERE nomeCompleto LIKE '%$search%'";
								$getQuery = mysqli_query($con,$sql);

								while($runrows = mysqli_fetch_array($getQuery)){
									echo "<tr>";
			                            echo "<th scope='row'><a href='paginaPessoa.php?pessoa=".$runrows['id']."' class='nome'>". $runrows['nomeCompleto'] ."</a></th>";
			                            echo "<td>". $runrows['email'] ."</td>";
			                            echo "<td>". $runrows['telefone'] ."</td>";
			                            if($runrows['setor'] == 1){
                                            echo "<td>Implantador</td>";
                                        }else if($runrows['setor'] == 2){
                                            echo "<td>Logística</td>";
                                        }else if($runrows['setor'] == 3){
                                            echo "<td>Financeiro</td>";
                                        }else if($runrows['setor'] == 4){
                                            echo "<td>Coordenador</td>";
                                        }
			                            echo "</tr>";
								}
							}

    					?>
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
</body>
</html>

