<?php

$conn = mysqli_connect('localhost', 'root', '', 'programacaosemanalteste');

session_start();
$id = $_SESSION['id'];
$resultPermissao = mysqli_query($conn, "SELECT * FROM cadastrocolaborador WHERE id = $id");
$rowPermissao = mysqli_fetch_array($resultPermissao);
$setor = $rowPermissao['setor'];

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
    $query = mysqli_query($conn,"SELECT * FROM `cadastrovisita` WHERE ativo = 1 ORDER BY id LIMIT $page_limit OFFSET $page_offset ");
    
    if(mysqli_num_rows($query) > 0){

        while($row = mysqli_fetch_array($query)){
            $idVisita = $row['id'];
            echo '<script>
        window.localStorage.setItem("idv", "'.$idVisita.'")
    </script>';
                echo "<tr>";
                echo "<th scope='row' class='nome'>". $row['nomeColaborador'] ."</th>";
                echo "<td class='local'>". $row['local'] ."</td>";
                echo "<td class='data'>". date('d-m-Y', strtotime( $row['periodoInicial'])) ."</td>";
                echo "<td class='data'>". date('d-m-Y', strtotime( $row['periodoFinal'])) ."</td>";
                echo "<td class='atv'>". $row['atividade'] ."</td>";
                if($row['situação'] == 1){
                    echo "<td>Pendente</td>";
                }else if($row['situação'] == 2){
                    echo "<td style='color: #0B0;'>Aprovado</td>";
                }else if($row['situação'] == 3){
                    echo "<td style='color: #B00;'>Reprovado</td>";
                }
                echo "<td style='text-align: center; width: 10%'><a href='deletar.php?idv=".$idVisita."' class='delete'><img src='delete.png' style='width: 3vw;'></a>&ensp;&ensp;<a data-target='#exampleModal' data-toggle='modal' href='#exampleModal?idv=".$idVisita."' class='edit'><img src='edit.png' style='width: 3vw;'></a></td>";
            echo "</tr>";
        }

        $total_posts = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `cadastrovisita` WHERE ativo = 1"));

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
        echo "Sem visitas cadastradas";
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
    <title>Visitas cadastradas</title>
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
        .delete:hover{
            opacity: 0.5;
        }
        .edit:hover{
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
    <style>
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
        input[type=radio]{
            display: inline;
            width: auto;
        }
        p{
            text-align: center;
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar visita</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="editVisita.php" method="post">
                <label>Nome:</label>
                <br>
                <select name="txtNome">
                    <?php

                        if($setor == 1){
                            $resultB = mysqli_query($conn, "SELECT nomeCompleto FROM cadastrocolaborador WHERE id=$id");
                        }else if($setor == 4){
                            $resultB = mysqli_query($conn, "SELECT nomeCompleto FROM cadastrocolaborador WHERE setor = 1 OR setor = 4");
                        }
                        while($rows = mysqli_fetch_array($resultB)){
                            echo "<option>" .$rows['nomeCompleto'] . "</option>";
                        }

                    ?>
                </select>
                <br>
                <br>
                <label>Local:</label>
                <br>
                <input type="text" name="txtLocal">
                <br>
                <br>
                <label>Data inicial:</label>
                <br>
                <input type="date" name="dtInicial">
                <br>
                <br>
                <label>Data final:</label>
                <br>
                <input type="date" name="dtFinal">
                <br>
                <br>
                <label>Transporte:</label>
                <br>
                <select name="txtTransporte">
                    <option value="Veículo da Empresa">Veículo da Empresa</option>
                    <option value="Veículo Próprio">Veículo Próprio</option>
                    <option value="Veículo do Parceiro">Veículo do Parceiro</option>
                    <option value="Veículo Locado">Veículo Locado</option>
                    <option value="Ônibus">Ônibus</option>
                    <option value="Avião">Avião</option>
                    <option value="Moto Táxi">Moto Táxi</option>
                    <option value="Táxi/Uber">Táxi/Uber</option>
                    <option value="Acompanhante em outra AV">Acompanhante em outra AV</option>
                    <option value="A confirmar">A confirmar</option>
                    <option value="Não utilizado">Não utilizado</option>
                </select>
                <br>
                <br>
                <label>Município:</label>
                <br>
                <input type="text" name="txtMunicipio">
                <br>
                <br>
                <label>Atividade:</label>
                <br>
                <textarea name="txtAtv"></textarea>
                <br>
                <br>
                <label>Observações:</label>
                <br>
                <textarea name="txtObs"></textarea>
                <br>
                <br>
                <label>Ativo?</label>
                <br>
                <p>
                <input type="radio" name="ativo" value="1"> Sim
                <input type="radio" name="ativo" value="0"> Não
                </p>
                <br>
                <input type="submit" name="enviar" value="Editar" id="btn">
            </form>
          </div>
        </div>
      </div>
    </div>

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
                            <th scope="col">Situação</th>
                            <th scope="col">Ações</th>
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