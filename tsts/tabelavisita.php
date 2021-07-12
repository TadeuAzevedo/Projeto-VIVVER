<?php
$con=mysqli_connect("localhost","root","","programacaosemanalteste");

$result = mysqli_query($con,"SELECT * FROM cadastrovisita");

echo "<table border='1'>
<tr>
<th>Nome</th>
<th>Local</th>
<th>Periodo Inicial</th>
<th>Periodo Final</th>
<th>Atividade</th>
<th>Contato Local</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['nomeColaborador'] . "</td>";
echo "<td>" . $row['local'] . "</td>";
echo "<td>" . $row['periodoInicial'] . "</td>";
echo "<td>" . $row['periodoFinal'] . "</td>";
echo "<td>" . $row['atividade'] . "</td>";
echo "<td>" . $row['contatoLocal'] . "</td>";
echo "</tr>";
}
echo "</table>";

session_start();
$id = $_GET['id'];

mysqli_close($con);
?>

<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <a href="home.php?id=<?php echo $id?>"><button type="button">Voltar ao menu</button></a>
    </body>
</html>