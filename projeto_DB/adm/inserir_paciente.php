<?php
session_start();
include_once("../conection.php");
$btn_cadastrar = filter_input(INPUT_POST, 'btn_cadastrar', FILTER_SANITIZE_STRING);
if($btn_cadastrar){
	$primeiroNome = "'".filter_input(INPUT_POST, 'primeiroNome', FILTER_SANITIZE_STRING)."'";
	$ultimoNome = "'".filter_input(INPUT_POST, 'ultimoNome', FILTER_SANITIZE_STRING)."'";
	$endereco = "'".filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING)."'";
	$cidade = "'".filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING)."'";
	$estado = "'".filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING)."'";
	$cep = "'".filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING)."'";
	$data_nasc = "'".filter_input(INPUT_POST, 'data_nasc', FILTER_SANITIZE_STRING)."'";
	$cpf= "'".filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING)."'";
	$telefone = "'".filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING)."'";
	$data_reg = "'".filter_input(INPUT_POST, 'dataReg', FILTER_SANITIZE_STRING)."'";
	$medicoNome = "'".filter_input(INPUT_POST, 'medico', FILTER_SANITIZE_STRING)."'";
	$tratamentoDesc = "'".filter_input(INPUT_POST, 'tratamentoDesc', FILTER_SANITIZE_STRING)."'";
	$tratamentoData = "'".filter_input(INPUT_POST, 'tratamentoData', FILTER_SANITIZE_STRING)."'";
	$tratamentoValor = "'".filter_input(INPUT_POST, 'tratamentoValor', FILTER_SANITIZE_STRING)."'";
	$quartoNum = filter_input(INPUT_POST, 'quartoNum', FILTER_SANITIZE_STRING);
	$camaNum = filter_input(INPUT_POST, 'camaNum', FILTER_SANITIZE_STRING);
		
	//colocar o resto no if ainda
	if((!empty($primeiroNome))){
		$sql = "SELECT * FROM quarto WHERE quartoNum=$quartoNum";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$capacidade = $linha[0]['capacidade'];
		$disponivel = $linha[0]['disponivel'];
		$quartoId = $linha[0]['quartoid'];
		if($disponivel==1){
			$con->query("INSERT INTO pessoa (primeiroNome,ultimoNome,endereco,cidade,estado,cep,
			data_nasc,cpf,telefone) VALUES ($primeiroNome,$ultimoNome,$endereco,$cidade,$estado,
			$cep,$data_nasc,$cpf,$telefone)");
			//echo $con->errorCode();
			//echo '<br>';
			//var_dump($con->errorInfo());
			$sql = "SELECT pessoaId FROM pessoa ORDER BY pessoaId desc limit 1";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$pessoaId = $linha[0]['pessoaid'];			
			$con->query("INSERT INTO paciente (dataReg,pessoaId) VALUES ($data_reg,$pessoaId)");
			
			$sql = "SELECT pacienteId FROM paciente ORDER BY pacienteId desc limit 1";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$pacienteId = $linha[0]['pacienteid'];
			
			$sql = "SELECT medicoId FROM medico 
				INNER JOIN funcionario ON funcionario.funcid=medico.funcid
				INNER JOIN pessoa ON pessoa.pessoaid=funcionario.pessoaid WHERE primeiroNome=$medicoNome";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$medicoId = $linha[0]['medicoid'];
			
			$con->query("INSERT INTO tratamento (tratamentoDesc,tratamentodata,tratamentoValor,pacienteId,
			medicoId) VALUES ($tratamentoDesc,$tratamentoData,$tratamentoValor,$pacienteId,$medicoId)");
					
			$con->query("INSERT INTO cama (quartoId,pacienteId,camaNUM) 
				VALUES ($quartoId,$pacienteId,$camaNum)");
			echo $con->errorCode();
			echo '<br>';
			var_dump($con->errorInfo());
			
			$sql = "SELECT * FROM cama WHERE quartoId=$quartoId";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$row_count = $stmt->rowCount();
			
			if($row_count==$capacidade){
				$sql = "UPDATE quarto SET disponivel = 0 WHERE quartoid = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindParam(':id', $quartoId);
				$stmt->execute();
			}
		}
	}
}

header("Location: admMain.php");
?>