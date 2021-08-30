<?php

$id = $_SESSION['id'];

$con = mysqli_connect("localhost", "root", "", "programacaosemanalteste");
$getUser = "SELECT nomeCompleto FROM cadastrocolaborador WHERE id='$id'";
$userResult = mysqli_query($con, $getUser);
$user = mysqli_fetch_array($userResult);

$getData = "SELECT periodoInicial , periodoFinal FROM cadastrovisita WHERE nomeColaborador = '".$user['nomeCompleto']."'";
$resultData = mysqli_query($con,$getData);
$rowData = mysqli_fetch_array($resultData);

//$dataI = new DateTime($rowData['periodoInicial']);
//$dataF = new DateTime($rowData['periodoFinal']);

//$periodo = $dataI->diff($dataF);
//$duracao = $periodo->d;

//while($rowData = mysqli_fetch_array($resultData)){
//	$dataI = strtotime($rowData['periodoInicial']);
//	$novoFormato = date('Y-m-j', $dataI);
//}

date_default_timezone_set('America/Sao_Paulo');

if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    $ym = date('Y-m');
}

$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

$today = date('Y-m-j', time());

$html_title = date('Y / m', $timestamp);

$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

$day_count = date('t', $timestamp);
 
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

$weeks = array();
$week = '';

$week .= str_repeat('<td></td>', $str);

	for ( $day = 1; $day <= $day_count; $day++, $str++) {
	     
	    $date = $ym . '-' . $day;
	    
	    //if($rowData['periodoInicial'] == $date){
	    	//$week .= '<td class="visita">' . $day;
	    //}else if($rowData['periodoFinal'] == $date){
	    //	$week .= '<td class="visita">' . $day;
	    //}
	     
	    if ($today == $date) {

	        $week .= '<td class="today">' . $day;
			
		} else{

			$week .= '<td>' . $day;

		}
		
	    $week .= '</td>';
	     
	    if ($str % 7 == 6 || $day == $day_count) {

	        if ($day == $day_count) {
	            $week .= str_repeat('<td></td>', 6 - ($str % 7));
	        }

	        $weeks[] = '<tr>' . $week . '</tr>';

	        $week = '';
	    }

	}


?>
