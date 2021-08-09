<?php

session_start();
$id = $_GET['id'];

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$pessoas = "SELECT * FROM cadastrocolaborador WHERE setor = 1";
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
					$stringI = $row['periodoInicial'];
					$timestampI = strtotime($stringI);
					$stringF = $row['periodoFinal'];
					$timestampF = strtotime($stringF);

					$paraEmail = $userName['email'];
					$assunto = "Programação Semanal";

					//Início email

					$body = "
Boa tarde!

Segue em anexo a programação dia ".date('d/m',$timestampI)." a ".date('d/m',$timestampF)."

Obs: SÓ INICIEM A VIAGEM APÓS O DEPÓSITO DA AV.

Em amarelo são programações não confirmadas.

As viagens em branco estão confirmadas, mas poderemos ter alterações na segunda. Fiquem atentos.

Qualquer incoerência na programação, entre em contato o mais rápido possível!

Recomendações e solicitações:
0) Todas as solicitações devem ser direcionadas ao suporte. No caso de urgência (envolvendo produção ou processos de implantação) deve-se mencionar a situação.

1) Existem diversas Demandas semanais sem o correto preenchimento e finalização. Por favor, é uma obrigação de todos informar o que foi executado no cliente.

2) Segue abaixo o modelo para abertura de demandas. Por favor sigam este modelo.

2.1) Devem seguir o padrão abaixo:

Título: [Município-UF] [Módulo] Breve relato da solicitação (Colchetes devem ser utilizados para facilitar a busca)

*Município:* Nome do município
*Modulo:* Módulo que apresenta o incidente
*Versão:* Versão disponível na tela de login do acesso web e na opção 'Sobre' dentro dos módulos Delphi. Ex: prd_7724
*Caminho:* Caminho para executar os dados inseridos para teste

*Tipo:* Escolha uma das relacionadas a seguir:
Incidente (Erro/Impedimento de executar operação)
Melhoria (Customização de tela/Alteração de funcionalidade já em funcionamento)
Pedido de Serviço (Atividade executada via banco de dados para remoção/inserção/alteração devido a erro humano ou incidentes ocorridos)
*Descrição:* Relato do ocorrido, testes realizados, soluções propostas e possíveis diagnósticos

*Dados para teste:*
Todos os dados necessários para que seja realizado a execução do erro/problema relatado
Ex: Unidade, setor, prontuário, registro de atendimento/recepção, entre outros.

*Contato:* Nome do responsável
*Telefone:* Número de telefone escrito no seguinte padrão: (XX) X XXXX-XXXX

2.2) Demandas de melhoria sem o correto preenchimento de solicitação de orçamento de melhoria com assinatura do gestor do contrato/ secretário de saúde serão devolvidas pelo suporte. Será preciso formalizar tal demanda.

3) Relembro que qualquer modificação desta programação deve ser comunicada imediatamente (preferencialmente antes de acontecer).

Qualquer dúvida estamos à disposição

PROGRAMAÇÃO:
Período: ".date('d/m',$timestampI)." a ".date('d/m',$timestampF)."
Atividade: ".$row['atividade']."
Implantador: ".$row['nomeColaborador']."
Local da Atividade: ".$row['local']."
Contato local: ".$row['contatoLocal']."
					";

					//Fim email

					if (mail($paraEmail, $assunto, $body)) {
			    		echo "<script>setTimeout(function(){ alert('Email enviado com sucesso!'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
			    		$update = mysqli_query($con, "UPDATE cadastrovisita SET enviado='1' WHERE id=$idv");
					} else {
			    		echo "<script>setTimeout(function(){ alert('Falha ao enviar!'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
					}
				}else{
					echo "<script>setTimeout(function(){ alert('Todos emails já foram enviados!'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
				}
			}else{
				echo "<script>setTimeout(function(){ alert('Todos emails já foram enviados!'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
			}
		}else{
			echo "<script>setTimeout(function(){ alert('Visita inativa'); window.location.href = 'home.php?id=".$id."'}, 1000);</script>";
		}
	}
}
?>
