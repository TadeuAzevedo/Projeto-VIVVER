<?php

session_start();
$id = $_GET['id'];
$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$result = mysqli_query($con, "SELECT * FROM cadastrocolaborador WHERE id='$id'");
$row = mysqli_fetch_array($result);

//Foto de perfil

$msg = "";
if(isset($_POST['submit'])){
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];
    $imageType = $_FILES['image']['type'];
    $imageErro = $_FILES['image']['error'];

    $imageExt = explode('.', $imageName);
    $imageActExt = strtolower(end($imageExt));

    $permitido = array('jpg', 'jpeg', 'png');

    if(in_array($imageActExt, $permitido)){
        if($imageErro === 0){
            if($imageSize < 20000000){
                $novoNome = uniqid('',true).".".$imageActExt;
                $target = "uploads/".$novoNome;
                $sql = "UPDATE cadastrocolaborador SET imagem = '$novoNome' WHERE id = '$id'";
                mysqli_query($con,$sql);
                move_uploaded_file($imageTmpName, $target);
                echo "<script>onload = window.location='perfil.php?id=".$row['id']."';</script>";
            }else{
                echo "Arquivo muito grande";
            }
        }else{
            echo "Erro ao enviar a foto";
        }
    }else{
        echo "<script>alert('Tipo de arquivo inválido');onload = window.location='perfil.php?id=".$row['id']."';</script>";
    }
}
?>