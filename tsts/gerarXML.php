<?php
session_start();
$id = $_GET['id'];

$dataInicial = strtotime("Friday");
$dataFinal = strtotime("+7 days", $dataInicial);
$dataInicialS = date("Y-m-d", $dataInicial);
$dataFinalS = date("Y-m-d", $dataFinal);
$dataIXML = date("d-m", $dataInicial);
$dataFXML = date("d-m", $dataFinal);

$con=mysqli_connect("localhost","root","","programacaosemanalteste");
$sql = "SELECT * FROM cadastrovisita WHERE ativo=1 AND prioridade = 0";
$array = array();

if($result = mysqli_query($con, $sql)){
	while($row = mysqli_fetch_assoc($result)){
		$query1 = $row['periodoInicial'] >= $dataInicialS && $row['periodoFinal'] <= $dataFinalS;
		$query2 = $row['periodoInicial'] >= $dataInicialS && $row['periodoFinal'] > $dataFinalS;
		if($query1 || $query2){
			array_push($array, $row);
		}
	}
	if(count($array)){
		createXMLfile($array);
	}
	$result->free();
}

function createXMLfile($array){
	$dataInicial = strtotime("Friday");
	$dataFinal = strtotime("+7 days", $dataInicial);
	$dataIXML = date("d-m", $dataInicial);
	$dataFXML = date("d-m", $dataFinal);

	$caminho = "arquivosXML/visitas_semanais_".$dataIXML."_".$dataFXML.".xml";
	$dom = new DOMDocument('1.0','utf-8');
	$root = $dom->createElement('visitas');
	for($i = 0; $i < count($array); $i++){
		$idv = $array [$i]['id'];
		$nome = $array [$i]['nomeColaborador'];
		$local = $array [$i]['local'];
		$dataI = $array [$i]['periodoInicial'];
		$dataF = $array [$i]['periodoFinal'];
		$transporte = $array [$i]['transporte'];
		$atividade = $array [$i]['atividade'];
		$observacoes = $array [$i]['observacoes'];

		$visita = $dom->createElement('visita');
		$visita->setAttribute('id', $idv);
		$nomeV = $dom->createElement('Nome', $nome);
		$visita->appendChild($nomeV);
		$localV = $dom->createElement('Local', $local);
		$visita->appendChild($localV);
		$dataIV = $dom->createElement('DataInicial', $dataI);
		$visita->appendChild($dataIV);
		$dataFV = $dom->createElement('DataFinal', $dataF);
		$visita->appendChild($dataFV);
		$transporteV = $dom->createElement('Transporte', $transporte);
		$visita->appendChild($transporteV);
		$atividadeV = $dom->createElement('Atividade', $atividade);
		$visita->appendChild($atividadeV);
		$observacoesV = $dom->createElement('Observacoes', $observacoes);
		$visita->appendChild($observacoesV);
		$root->appendChild($visita);
	}
	$dom->appendChild($root);
	$dom->save($caminho);

}

echo "<script>setTimeout(function(){ alert('Arquivo XML Gerado!'); window.location.href = 'tabelavisita.php?id=".$id."'}, 1000);</script>";
?>
