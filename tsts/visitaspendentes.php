<?php

$conn = mysqli_connect('localhost', 'root', '', 'programacaosemanalteste');

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
    
    $id = $_GET['id'];
    $query = mysqli_query($conn,"SELECT * FROM `cadastrovisita` WHERE ativo = 1 AND situação = 1 ORDER BY id LIMIT $page_limit OFFSET $page_offset");
    
    if(mysqli_num_rows($query) > 0){

        while($row = mysqli_fetch_array($query)){
            $idVisita = $row['id'];
            $query1 = $row['periodoInicial'] >= $dataInicialS && $row['periodoFinal'] <= $dataFinalS;
            $query2 = $row['periodoInicial'] >= $dataInicialS && $row['periodoFinal'] > $dataFinalS;
            if($query1 || $query2){
               echo "<tr>";
                echo "<th scope='row' class='nome'>". $row['nomeColaborador'] ."</th>";
                echo "<td class='local'>". $row['local'] ."</td>";
                echo "<td class='data'>". date('d-m-Y', strtotime( $row['periodoInicial'])) ."</td>";
                echo "<td class='data'>". date('d-m-Y', strtotime( $row['periodoFinal'])) ."</td>";
                echo "<td class='atv'>". $row['atividade'] ."</td>";
                echo "<td class='transporte'>". $row['transporte'] ."</td>";
                echo "<td class='sit' style='text-align: center;margin: 0;'><a href='aprovacao.php?id=".$id."&idv=".$idVisita."&nsituacao=2&prioridade=1'><img src='prioritario.png' width='40vw' class='img'></a>&ensp;<a href='aprovacao.php?id=".$id."&idv=".$idVisita."&nsituacao=2&prioridade=0'><img src='aprovado_cheio.png' width='40vw' class='img'></a>&ensp;<a href='aprovacao.php?id=".$id."&idv=".$idVisita."&nsituacao=3&prioridade=3'><img src='reprovado_cheio.png' width='40vw' class='img'></a></td>";
            echo "</tr>"; 
            }else{
                echo "<script>window.onload = voltar;</script>";
                echo "<script>alert('Sem visitas programadas');</script>";
                break;
            }
        }

        $total_posts = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `cadastrovisita` WHERE situação = 1"));

        $total_page = ceil($total_posts / $page_limit);

        $next_page = $current_page_num+1; 

        $prev_page = $current_page_num-1; 
        

        echo "<li class='paginas'>";
        if($current_page_num > 1){
           echo '<br><a href="?id='.$id.'&page='.$prev_page.'" class="page_link">Anterior</a>';
        }
        for($i = 1; $i <= $total_page; $i++){
            if($i == $current_page_num){
                echo '<a href="?id='.$id.'&page='.$i.'" class="page_link active_page">'.$i.'</a>';
            }else{
                echo '<a href="?id='.$id.'&page='.$i.'" class="page_link">'.$i.'</a>';
            }   
        }
        if($total_page+1 != $next_page){
           echo '<a href="?id='.$id.'&page='.$next_page.'" class="page_link">Próxima</a>';
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
    </style>
</head>

<body>
    <?php 

    $idn = $_GET['id'];

    ?>
   <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <a class="navbar-brand" href="home.php?id=<?php echo $idn ?>">
            <img src="teste.png" width="150em" class="d-inline-block align-top" alt="">
        </a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="home.php?id=<?php echo $idn ?>">Início</a>
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
                    <a class="navbar-nav" href="perfil.php?id=<?php echo $idn ?>"><img src="icone.png" width="40em"></a>
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
        <button type="button" class="btn btn-primary btn-lg btn-block baixo" onclick="location.href = 'cadastrovisita.php?id=<?php echo $id?>';">Cadastrar visita</button><br>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>