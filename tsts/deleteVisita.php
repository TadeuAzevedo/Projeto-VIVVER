<?php
session_start();
$id = $_GET['id'];

$con=mysqli_connect("localhost","root","","programacaosemanalteste");
$result = mysqli_query($con,"SELECT * FROM cadastrovisita");

if (isset($_GET['pageno'])){
	$pageno = $_GET['pageno'];
} else {
	$pageno = 1;
}
$numVisitasPag = 6;
$offset = ($pageno-1) * $numVisitasPag;

$totalPagSql = "SELECT * FROM cadastrovisita";
$resultPag = mysqli_query($con, $totalPagSql);
$totalRows = mysqli_fetch_array($resultPag)[0];
$totalPag = ceil($totalRows / $numVisitasPag);

$sql = "SELECT * FROM cadastrovisita LIMIT $offset, $numVisitasPag";
$resData = mysqli_query($con, $sql);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar visitas</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/x-icon" href="transparentVV.png">
        <style>
            .delete:hover{
                opacity: 0.5;
            }
            .edit:hover{
                opacity: 0.5;
            }
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
        </style>
    </head>
    <body>
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
                <form name="editVisita" method="POST" action="editVisita.php?id=<?php echo $id?>&idv=<?php echo $idv ?>" autocomplete="off">
                    <p>
                        <label>Nome:</label>
                        <br>
                        <select name="txtNome">
                            <?php

                                $resultNome = mysqli_query($con, "SELECT * FROM cadastrocolaborador");
                                $rowNome = mysqli_fetch_array($resultNome);
                                $resultB = mysqli_query($con, "SELECT nomeCompleto FROM cadastrocolaborador WHERE setor = 1 OR setor = 4");
                                while($rows = mysqli_fetch_array($resultB)){
                                    echo "<option>" .$rows['nomeCompleto'] . "</option>";
                                }

                            ?>
                        </select>
                    </p>
                    <p>
                        <label>Local:</label>
                        <br>
                        <?php
                        $resultIDV = mysqli_query($con, "SELECT id FROM cadastrovisita");
                        $rowIDV = mysqli_fetch_array($resultIDV);
                        $idv = $rowIDV['id'];
                        ?>
                        <input type="text" name="txtLocal" autocomplete="off" required>
                    </p>
                    <p>
                        <label>Data inicial:</label>
                        <br>
                        <input type="date" name="dataInicial" autocomplete="off" required="">
                    </p>
                    <p>
                        <label>Data final:</label>
                        <br>
                        <input type="date" name="dataFinal" autocomplete="off" required="">
                    </p>
                    <p>
                        <label>Contato local:</label>
                        <br>
                        <input type="text" name="txtContato" autocomplete="off" required>
                    </p>
                    <p>
                        <label>Atividade:</label>
                        <br>
                        <textarea name="txtAtv" id="txtAtv" maxlength="255"></textarea>
                    </p>
                    <br>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <a href="editVisita.php"><button type="submit" name="enviar" id="btn" value="Enviar" class="btn btn-primary">Salvar mudanças</button></a>
                 </form>
              </div>
            </div>
          </div>
        </div>
    <!-- Fim modal edição -->
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
                        <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_array($resData)){
                            $idv = $row['id'];
                            echo "<tr>";
                            echo "<th scope='row'>". $row['nomeColaborador'] ."</th>";
                            echo "<td>". $row['local'] ."</td>";
                            echo "<td>". date('d-m-Y', strtotime( $row['periodoInicial'])) ."</td>";
                            echo "<td>". date('d-m-Y', strtotime( $row['periodoFinal'])) ."</td>";
                            echo "<td>". $row['atividade'] ."</td>";
                            echo "<td>". $row['contatoLocal'] ."</td>";
                            echo "<td style='text-align: center; width: 10%'><a href='#' class='delete' onclick='teste()'><img src='delete.png' style='width: 3vw;'></a>&ensp;&ensp;<a data-target='#modalEdicao' data-toggle='modal' href='#modalEdicao' class='edit'><img src='edit.png' style='width: 3vw;'></a></td>";   
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                    <script>
                        function teste(){
                            var x;
                            var r=confirm("Tem certeza que deseja excluir?");
                            if (r==true)
                              {
                              window.location.href = 'deletar.php?id=<?php echo $id?>&idv=<?php echo $idv ?>';
                              }
                            else
                              {
                              x="Você pressionou Cancelar!";
                              }
                            document.getElementById("demo").innerHTML=x;
                        }
        </script>
                </table>
                <ul class="pagination">
                	
       			 	<li>
            			<a href="?id=<?php echo $id?><?php if($pageno <= 1){ echo '#'; } else { echo "&pageno=".($pageno - 1); } ?>">Anterior</a>&ensp;&ensp;
        			</li>

        			<li>
            			<a href="?id=<?php echo $id?><?php echo "&pageno=".($pageno + 1); ?>">Próxima</a>
        			</li>
        			
                </ul>
                <button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'cadastrovisita.php?id=<?php echo $id?>';">Cadastrar visita</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>