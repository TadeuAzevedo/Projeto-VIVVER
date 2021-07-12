<?php

session_start();
$id = $_GET['id'];
$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$result = mysqli_query($con, "SELECT * FROM cadastrocolaborador WHERE id='$id'");
$row = mysqli_fetch_array($result);

//Foto de perfil

$msg = "";
if(isset($_POST['submit'])){
    $image = $_FILES['image']['name'];
    $target = "uploads/".basename($image);

    $sql = "UPDATE cadastrocolaborador SET imagem = '$image' WHERE id = '$id'";
    mysqli_query($con,$sql);
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        $msg = "Imagem enviada com sucesso!";
        echo "<script>onload = window.location='perfil.php?id=".$row['id']."';</script>";
    }else{
        $msg = "Falha ao enviar imagem";
    }
}

?>