<?php

$con = mysqli_connect("localhost","root","","programacaosemanalteste");

//$getID = "SELECT id FROM cadastrocolaborador;";
//$resultID = mysqli_query($con,$getID);
//$id = mysqli_fetch_array($resultID);

$sql = "SELECT * FROM cadastrocolaborador;";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);

session_start();
$id = $_GET['id'];

?>

<body>

<table width="1200" border="1" cellspacing="1" cellpadding="0">
<tr>
<td>
<table width="1200" border="1" cellspacing="1" cellpadding="3">
<tr>
<td colspan="50"><strong>Colaboradores Cadastrados</strong> </td>
</tr>

<tr>
<td align="center"><strong>Colaborador</strong></td>
<td align="center"><strong>Usuário</strong></td>
<td align="center"><strong>Telefone</strong></td>
<td align="center"><strong>Email</strong></td>
<td align="center"><strong>Editar</strong></td>
</tr>

<?php
while($row=mysqli_fetch_array($result)){
?>
<tr>
<td><?php echo $row['nomeCompleto']; ?></td>
<td><?php echo $row['usuario']; ?></td>
<td><?php echo $row['telefone']; ?></td>
<td><?php echo $row['email']; ?></td> 
<td align="center"><a href="formEdicao.php?id=<?php echo $row['id']; ?>">Editar</a></td>
</tr>

<?php
}
?>

</table>
</td>
</tr>
</table>
<a href="home.php?id=<?php echo $id?>"><button>Voltar ao menu</button></a>
</body>