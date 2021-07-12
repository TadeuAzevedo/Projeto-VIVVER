<?php

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$message = "banana";
mail("tadeu.cruz@vivver.com.br", "teste", $message);
?>