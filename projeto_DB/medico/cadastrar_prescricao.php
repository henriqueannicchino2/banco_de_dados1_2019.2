<?php
session_start();
include_once("../conection.php");
$btn_cadastrar = filter_input(INPUT_POST, 'btn_cadastrar', FILTER_SANITIZE_STRING);
if($btn_cadastrar){
	$nomeMedi = "'".filter_input(INPUT_POST, 'nome_medi', FILTER_SANITIZE_STRING)."'";
	$Paci = filter_input(INPUT_POST, 'paci', FILTER_SANITIZE_STRING);
	if((!empty($nomeMedi)) and (!empty($Paci))){
		$cont=0;
		$PaciId = '';
		while($Paci[$cont]!=" "){
			$PaciId .= $Paci[$cont];
			$cont++;
		}
		
		$sql = "SELECT tratamentoid FROM paciente INNER JOIN tratamento ON tratamento.pacienteid=paciente.pacienteid WHERE paciente.pacienteid=$PaciId";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$tratamentoId = $linha[0]['tratamentoid'];
		
		$sql = "SELECT medicamentoid FROM medicamento WHERE medicamentonome=$nomeMedi";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$medicamentoId = $linha[0]['medicamentoid'];
		
		$con->query("INSERT INTO prescricao (prescricaoData,medicamentoId,tratamentoId) VALUES (now(),$medicamentoId,$tratamentoId)");
		/*echo $con->errorCode();
		echo '<br>';
		var_dump($con->errorInfo());*/
	}
}

header("Location: medicoMain.php");
?>