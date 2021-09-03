<?php

$conn = mysqli_connect('localhost', 'root', '', 'programacaosemanalteste');

session_start();
$id = $_SESSION['id'];
$resultPermissao = mysqli_query($conn, "SELECT * FROM cadastrocolaborador WHERE id = $id");
$rowPermissao = mysqli_fetch_array($resultPermissao);
if($rowPermissao['setor'] == 4){

if(isset($_GET['page'])){

    $page_num = filter_var($_GET['page'], FILTER_VALIDATE_INT,[
        'options' => [
            'default' => 1,
            'min_range' => 1
        ]
    ]); 
    
}else{

    $page_num = 1;
}

$page_limit = 6;

$page_offset = $page_limit * ($page_num - 1);

function mostrarVisitas($conn, $current_page_num, $page_limit, $page_offset){

    date_default_timezone_set('America/Sao_Paulo');
    $hoje = date("Y-m-d");

    $dataInicial = strtotime("Friday");
    $dataFinal = strtotime("+7 days", $dataInicial);
    $dataInicialS = date("Y-m-d", $dataInicial);
    $dataFinalS = date("Y-m-d", $dataFinal);

    $id = $_SESSION['id'];
    $query = mysqli_query($conn,"SELECT * FROM `cadastrovisita` WHERE ativo = 1 AND situação = 1 ORDER BY id LIMIT $page_limit OFFSET $page_offset");
    
    if(mysqli_num_rows($query) > 0){

        while($row = mysqli_fetch_array($query)){
            $idVisita = $row['id'];
               echo "<tr>";
                echo "<th scope='row' class='nome'>". $row['nomeColaborador'] ."</th>";
                echo "<td class='local'>". $row['local'] ."</td>";
                echo "<td class='data'>". date('d-m-Y', strtotime( $row['periodoInicial'])) ."</td>";
                echo "<td class='data'>". date('d-m-Y', strtotime( $row['periodoFinal'])) ."</td>";
                echo "<td class='atv'>". $row['atividade'] ."</td>";
                echo "<td class='transporte'>". $row['transporte'] ."</td>";
                echo "<td class='sit' style='text-align: center;margin: 0;'><a href='aprovacao.php?id=".$id."&idv=".$idVisita."&nsituacao=2&prioridade=1'><img src='prioritario.png' width='40vw' class='img'></a>&ensp;<a href='aprovacao.php?id=".$id."&idv=".$idVisita."&nsituacao=2&prioridade=0'><img src='aprovado_cheio.png' width='40vw' class='img'></a>&ensp;<a href='aprovacao.php?id=".$id."&idv=".$idVisita."&nsituacao=3&prioridade=3'><img src='reprovado_cheio.png' width='40vw' class='img'></a></td>";
            echo "</tr>"; 
        }

        $total_posts = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `cadastrovisita` WHERE ativo = 1 AND situação = 1"));

        $total_page = ceil($total_posts / $page_limit);

        $next_page = $current_page_num+1; 

        $prev_page = $current_page_num-1; 
        

        echo "<li class='paginas'>";
        if($current_page_num > 1){
           echo '<br><a href="?page='.$prev_page.'" class="page_link">Anterior</a>';
        }
        for($i = 1; $i <= $total_page; $i++){
            if($i == $current_page_num){
                echo '<a href="?page='.$i.'" class="page_link active_page">'.$i.'</a>';
            }else{
                echo '<a href="?page='.$i.'" class="page_link">'.$i.'</a>';
            }   
        }
        if($total_page+1 != $next_page){
           echo '<a href="?page='.$next_page.'" class="page_link">Próxima</a>';
        }
        echo "</li>";
    }else{
        echo "<script>window.onload = voltar;</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="transparentVV.png">
    <script>
        function voltar(){
            window.history.back();
        }
    </script>
    <title>Visitas pendentes</title>
    <style>
        .page_link{
            display: inline-block;
            color: #222;
            border: 1px solid #ddd;
            padding: 5px 10px;
            margin: 0 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .page_link:hover{
            background: #007bff;
            text-decoration: none;
            color: #fff
        }
        .active_page{
            background-color:#007bff;
            color: #FFF;
            outline: none;
            border: 1px solid rgba(0,0,0,.1);
        }
        .paginas{
            position: absolute;
            bottom: -5vh;
            list-style-type: none;: 
        }
        .data{
            width: 107px;
        }
        .nome{
            width: 242px;
        }
        .local{
            width: 140px;
        }
        .atv{
            width: 478px;
        }
        .transporte{
            width: 227px;
        }
        .arroz{
            height: 65vh;
        }
        .esquerda{
            bottom: -16vh;
        }
        .direita{
            bottom: -16vh;
        }
        .img:hover{
            opacity: 0.5;
        }
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
</head>

<body>
    <?php 

    $idn = $_SESSION['id'];

    ?>
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
                <table class="table table-bordered arroz">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Local</th>
                            <th scope="col">Data Inicial</th>
                            <th scope="col">Data Final</th>
                            <th scope="col">Atividade</th>
                            <th scope="col">Transporte</th>
                            <th scope="col">Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <ul class="posts">
                        <?php 
                            mostrarVisitas($conn, $page_num, $page_limit, $page_offset);
                        ?>
                        </ul>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br><br>
        <button type="button" class="btn btn-primary btn-lg btn-block baixo" onclick="location.href = 'cadastrovisita.php';">Cadastrar visita</button><br>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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