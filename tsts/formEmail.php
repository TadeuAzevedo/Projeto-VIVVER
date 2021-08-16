<?php

session_start();
$id = $_GET['id'];

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$pessoas = "SELECT * FROM cadastrocolaborador WHERE setor = 1 OR setor = 4";
$resultPessoas = mysqli_query($con, $pessoas);

date_default_timezone_set('America/Sao_Paulo');
$hoje = date("Y-m-d");

$dataInicial = strtotime("Friday");
$dataFinal = strtotime("+7 days", $dataInicial);
$dataInicialS = date("Y-m-d", $dataInicial);
$dataFinalS = date("Y-m-d", $dataFinal);

while($userName = mysqli_fetch_array($resultPessoas)){
	$sql = "SELECT * FROM cadastrovisita WHERE nomeColaborador = '".$userName['nomeCompleto']."'";
	$result = mysqli_query($con, $sql);
	while($row = mysqli_fetch_array($result)){
		$idv = $row['id'];
		if($row['ativo'] == 1){
			if($row['periodoInicial'] >= $dataInicialS && $row['periodoFinal'] <= $dataFinalS){
				if($row['enviado'] == 0 && $row['situação'] == 2){
					$i = 0;

					$stringI = $row['periodoInicial'];
					$timestampI = strtotime($stringI);
					$stringF = $row['periodoFinal'];
					$timestampF = strtotime($stringF);

					$paraEmail = $userName['email'];
					$assunto = "Programação Semanal";

					$headers = "From: Suporte \r\n";
					$headers .= 'Content-type: text/html;' . "\r\n";

					//Início email

					$body = "
<html>
<head>
	<title>teste</title>
	<meta charset='utf-8'>
	<style>
		*{
			font-family: arial;
		}
	</style>
</head>
<body>
<h2>Boa tarde!</h2>

<p>Segue abaixo a programação dos dias ".date('d/m',$timestampI)." a ".date('d/m',$timestampF)."</p>

<p><b><mark> SÓ INICIEM A VIAGEM APÓS O DEPÓSITO DA AV.</mark></b></p>

<p><b>Qualquer incoerência na programação, entre em contato o mais rápido possível!</b></p>

<h3><b>PROGRAMAÇÃO:</b></h3>
<p><b>Período:</b> ".date('d/m',$timestampI)." a ".date('d/m',$timestampF)." <br>
<b>Atividade:</b> ".$row['atividade']." <br>
<b>Implantador:</b> ".$row['nomeColaborador']." <br>
<b>Local da Atividade:</b> ".$row['local']." <br>
<b>Contato local:</b> ".$row['contatoLocal']." <br>
<b>Transporte:</b> ".$row['transporte']." <br>
<b>Observações:</b>".$row['observacoes']."
</p>

<p>Recomendações e solicitações: <br>
0) Todas as solicitações devem ser direcionadas ao suporte. No caso de urgência (envolvendo produção ou processos de implantação) deve-se mencionar a situação.</p>

<p>1) Existem diversas Demandas semanais sem o correto preenchimento e finalização. Por favor, é uma obrigação de todos informar o que foi executado no cliente.</p>

<p>2) Segue abaixo o modelo para abertura de demandas. Por favor sigam este modelo.</p>

<p>2.1) Devem seguir o padrão abaixo:</p>

<p>Título: [Município-UF] [Módulo] Breve relato da solicitação (Colchetes devem ser utilizados para facilitar a busca)</p>

<p><b>Município:</b> Nome do município <br>
<b>Modulo:</b> Módulo que apresenta o incidente <br>
<b>Versão:</b> Versão disponível na tela de login do acesso web e na opção 'Sobre' dentro dos módulos Delphi. Ex: prd_7724 <br>
<b>Caminho:</b> Caminho para executar os dados inseridos para teste</p>

<p><b>Tipo:</b> Escolha uma das relacionadas a seguir: <br>
Incidente (Erro/Impedimento de executar operação) <br>
Melhoria (Customização de tela/Alteração de funcionalidade já em funcionamento) <br> 
Pedido de Serviço (Atividade executada via banco de dados para remoção/inserção/alteração devido a erro humano ou incidentes ocorridos) <br>
<b>Descrição:</b> Relato do ocorrido, testes realizados, soluções propostas e possíveis diagnósticos</p>

<p><b>Dados para teste:</b> <br>
Todos os dados necessários para que seja realizado a execução do erro/problema relatado <br>
Ex: Unidade, setor, prontuário, registro de atendimento/recepção, entre outros.</p>

<p><b>Contato:</b> Nome do responsável <br>
<b>Telefone:</b> Número de telefone escrito no seguinte padrão: (XX) X XXXX-XXXX</p>

<p>2.2) Demandas de melhoria sem o correto preenchimento de solicitação de orçamento de melhoria com assinatura do gestor do contrato/ secretário de saúde serão devolvidas pelo suporte. Será preciso formalizar tal demanda.</p>

<p><b><mark>3) Relembro que qualquer modificação desta programação deve ser comunicada imediatamente (preferencialmente antes de acontecer).</mark></b></p>

<p>Qualquer dúvida estamos à disposição</p>

</body>
</html>
					";

					//Fim email

					if (mail($paraEmail, $assunto, $body, $headers)) {
						$i = $i + 1;
			    		echo "<script>setTimeout(function(){ alert('Email enviado com sucesso!'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
			    		$update = mysqli_query($con, "UPDATE cadastrovisita SET enviado='1' WHERE id=$idv");
					}else {
			    		echo "<script>setTimeout(function(){ alert('Falha ao enviar!'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
					}
				}else{
					echo "<script>setTimeout(function(){ alert('Todos emails já foram enviados!'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
				}
			}else{
				echo "<script>setTimeout(function(){ alert('Visita fora do período!'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
			}
		}else{
			echo "<script>setTimeout(function(){ alert('Visita inativa'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
		}
	}
}
?>
