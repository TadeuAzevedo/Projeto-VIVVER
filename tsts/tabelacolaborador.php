<?php
$con=mysqli_connect("localhost","root","","programacaosemanalteste");

$result = mysqli_query($con,"SELECT * FROM cadastrocolaborador");

echo "<table border='1'>
<tr>
<th>Nome</th>
<th>Usuário</th>
<th>Telefone</th>
<th>Email</th>
<th>Setor</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['nomeCompleto'] . "</td>";
echo "<td>" . $row['usuario'] . "</td>";
echo "<td>" . $row['telefone'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['setor'] . "</td>";
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