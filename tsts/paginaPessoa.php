<?php

session_start();
$id = $_SESSION['id'];
$con = mysqli_connect('localhost', 'root', '', 'programacaosemanalteste');
$idPessoa = $_GET['pessoa'];
$result = mysqli_query($con, "SELECT * FROM cadastrocolaborador WHERE id = $idPessoa");
$resultPermissao = mysqli_query($con, "SELECT * FROM cadastrocolaborador WHERE id = $id");
$row = mysqli_fetch_array($result);
$rowPermissao = mysqli_fetch_array($resultPermissao);
$nomeColaborador = $row['nomeCompleto'];
if($rowPermissao['setor'] == 4){
?>

<!DOCTYPE html>
<html>
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
	<title>Pagina de colaborador</title>
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
            <div class="col-3 esquerda">
                <img src="uploads/<?php echo $row['imagem'];?>" class="img"><br>
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
                <?php

                	//Botão 1 - Cadastrar Visita
                    echo '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = ';
                    echo "'cadastrovisita.php'";
                    echo ';">Cadastrar visita</button>';
                    //Botão 4 - Ver todas visitas cadastradas
                    echo '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = ';
                    echo "'tabelavisita.php'";
                    echo ';">Visitas referentes à semana seguinte</button>';
                    //Botão 7 - Aprovar visitas
                    echo '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = ';
                    echo "'visitaspendentes.php'";
                    echo ';">Visitas pendentes</button>';
                    //Botão 8 - Editar visitas
                    echo '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = ';
                    echo "'deleteVisita.php'";
                    echo ';">Editar visitas</button>';

                ?>
                <style>
                    .esquerda{
                        height: fit-content;
                    }
                    .img{
                    	margin-top: 2em;
                        border-radius: 50%;
                        width: 15em;
                        height: 15em;
                        display: block;
                        margin-left: auto;
                        margin-right: auto;
                    }
                    h3{
                        text-align: center;
                    }
                </style>
            </div>
            <div class="col-9 direita">
            	<table class="table table-bordered">
            		<thead class="thead-dark">
            			<th scope="col">Local</th>
            			<th scope="col">Data Inicial</th>
            			<th scope="col">Data Final</th>
            			<th scope="col">Atividade</th>
            			<th scope="col">Situação</th>
            			<th scope="col">Enviado</th>
            			<th scope="col">Ativo</th>
            		</thead>
            		<tbody>
            			<?php
            				$resultVisitas = mysqli_query($con, "SELECT * FROM cadastrovisita WHERE nomeColaborador = '$nomeColaborador'");
            				$foundnum = mysqli_num_rows($resultVisitas);
            				if($foundnum == 0){
            					echo "<script>setTimeout(function(){alert('Sem visitas encontrados');voltar();}, 1000);</script>";
            				}else{
            					while($rowVisitas = mysqli_fetch_array($resultVisitas)){
		            				echo "<tr>";
		            					echo "<td>".$rowVisitas['local']."</td>";
		            					echo "<td class='data'>". date('d-m-Y', strtotime( $rowVisitas['periodoInicial'])) ."</td>";
		                				echo "<td class='data'>". date('d-m-Y', strtotime( $rowVisitas['periodoFinal'])) ."</td>";
		               					echo "<td>".$rowVisitas['atividade']."</td>";
		               					if($rowVisitas['situação'] == 1){
						                    echo "<td>Pendente</td>";
						                }else if($rowVisitas['situação'] == 2){
						                    echo "<td style='color: #0B0;'>Aprovado</td>";
						                }else if($rowVisitas['situação'] == 3){
							                echo "<td style='color: #B00;'>Reprovado</td>";
							            }
							            if($rowVisitas['enviado'] == 0){
						                    echo "<td style='color: #B00'>Não</td>";
						                }else if($rowVisitas['enviado'] == 1){
						                    echo "<td style='color: #0B0'>Sim</td>";
						                }
						                if($rowVisitas['ativo'] == 0){
						                    echo "<td style='color: #B00'>Não</td>";
							            }else if($rowVisitas['ativo'] == 1){
							                echo "<td style='color: #0B0'>Sim</td>";
							            }
		            				echo "</tr>";
            					}
            				}
            				
            			?>
            		</tbody>
            	</table>
            	<style>
            		table{
            			margin-top: 2em;
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
<?php
}else{ ?>
    
<!DOCTYPE html>
<html>
<head>
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
    <title>Visitas do Usuário</title>
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
    <div style="display: flex;height: 70vh;">
        <h1 style="margin: auto;font-size: 100px">ACESSO NEGADO</h1>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php
}
?>