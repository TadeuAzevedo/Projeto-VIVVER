<?php

$id = $_GET['id'];

$search = $_POST['busca'];

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$sql = "SELECT * FROM cadastrovisita WHERE nomeColaborador LIKE '%$search%'";
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
    <script>
        function voltar(){
            window.history.back();
        }
    </script>
	<title>Busca</title>
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
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-12">
    			<br>
    			<table class="table table-bordered">
    				<thead class="thead-dark">
    					<tr>
    						<th scope="col">Nome</th>
    						<th scope="col">Local</th>
    						<th scope="col">Data Inicial</th>
    						<th scope="col">Data Final</th>
    						<th scope="col">Atividade</th>
    						<th scope="col">Transporte</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php

    						if($foundnum == 0){
								echo "<script>setTimeout(function(){alert('Sem dados encontrados');voltar();}, 1000);</script>";
							}else{
								echo "<br><h1 style='text-align: center'>$foundnum Resultados encontrados para \"".$search."\"</h1><br>";
								$sql = "SELECT * FROM cadastrovisita WHERE nomeColaborador LIKE '%$search%'";
								$getQuery = mysqli_query($con,$sql);

								while($runrows = mysqli_fetch_array($getQuery)){
									echo "<tr>";
			                            echo "<th scope='row'>". $runrows['nomeColaborador'] ."</th>";
			                            echo "<td>". $runrows['local'] ."</td>";
			                            echo "<td>". date('d-m-Y', strtotime( $runrows['periodoInicial'])) ."</td>";
			                            echo "<td>". date('d-m-Y', strtotime( $runrows['periodoFinal'])) ."</td>";
			                            echo "<td>". $runrows['atividade'] ."</td>";
			                            echo "<td>". $runrows['transporte'] ."</td>";
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

