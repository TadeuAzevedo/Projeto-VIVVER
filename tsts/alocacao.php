<?php 

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
session_start();
$id = $_GET['id'];

$txtTransporte = $_POST['txtTransporte'];
$txtFinalidade = $_POST['txtFinalidade'];

$sql = "INSERT INTO alocacao (`transporte`, `finalidade`) VALUES ('$txtTransporte','$txtFinalidade');";
$rs =  mysqli_query($con,$sql);
if($rs){
    echo "Alocação inserida com sucesso!";
}else{
    echo "Falha na inserção da alocação!";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alocação</title>
</head>
<body>
    <a href="cadastroalocacao.php?id=<?php echo $id;?>"><button type="button">Cadastrar outra visita</button></a>
    <a href="home.php?id=<?php echo $id ?>"><button type="button">Voltar ao menu</button></a>
</body>
</html>