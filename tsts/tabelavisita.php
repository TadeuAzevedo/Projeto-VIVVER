<?php
session_start();
$id = $_GET['id'];

$con=mysqli_connect("localhost","root","","programacaosemanalteste");
$result = mysqli_query($con,"SELECT * FROM cadastrovisita WHERE ativo=1 AND prioridade = 0");

date_default_timezone_set('America/Sao_Paulo');
$hoje = date("Y-m-d");

$dataInicial = strtotime("Friday");
$dataFinal = strtotime("+7 days", $dataInicial);
$dataInicialS = date("Y-m-d", $dataInicial);
$dataFinalS = date("Y-m-d", $dataFinal);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Visitas cadastradas</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/x-icon" href="transparentVV.png">
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
    <br>
    <br>
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
                        <th scope="col">Contato Local</th>
                        <th scope="col">Transporte</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Enviado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result)){
                            if($row['periodoInicial'] >= $dataInicialS && $row['periodoFinal'] <= $dataFinalS){
                                echo "<tr>";
                                echo "<th scope='row'>". $row['nomeColaborador'] ."</th>";
                                echo "<td>". $row['local'] ."</td>";
                                echo "<td>". date('d-m-Y', strtotime( $row['periodoInicial'])) ."</td>";
                                echo "<td>". date('d-m-Y', strtotime( $row['periodoFinal'])) ."</td>";
                                echo "<td>". $row['atividade'] ."</td>";
                                echo "<td>". $row['contatoLocal'] ."</td>";
                                echo "<td>". $row['transporte'] ."</td>";
                                if($row['situação'] == 1){
                                    echo "<td>Pendente</td>";
                                }else if($row['situação'] == 2){
                                    echo "<td style='color: #0B0;'>Aprovado</td>";
                                }else if($row['situação'] == 3){
                                    echo "<td style='color: #B00;'>Reprovado</td>";
                                }
                                if($row['enviado'] == 0){
                                    echo "<td style='color: #B00'>Não</td>";
                                }else if($row['enviado'] == 1){
                                    echo "<td style='color: #0B0'>Sim</td>";
                                }
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'cadastrovisita.php?id=<?php echo $id?>';">Cadastrar visita</button><br>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'gerarXML.php?id=<?php echo $id?>';">Gerar arquivo XML</button>
            </div>
            <div class="col-6">
                <?php
                    $dataIXML = date("d-m", $dataInicial);
                    $dataFXML = date("d-m", $dataFinal);
                    $arquivo = "arquivosXML/visitas_semanais_".$dataIXML."_".$dataFXML.".xml";
                    if(file_exists($arquivo)){
                        echo '<a href="arquivosXML/visitas_semanais_'.$dataIXML.'_'.$dataFXML.'.xml" download><button class="btn btn-primary btn-lg btn-block">Baixar arquivo XML</button></a>';
                    }else{
                        echo '<a href="visitas_semanais.xml" download><button class="btn btn-primary btn-lg btn-block" disabled>Baixar arquivo XML</button></a>';
                    }
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>