<?php
session_start();
include_once("../conection.php");
$btn_deletar = filter_input(INPUT_POST, 'btn_deletar', FILTER_SANITIZE_STRING);
if($btn_deletar){
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
	if((!empty($id))){
		$sql = "SELECT * FROM pessoa INNER JOIN paciente ON paciente.pessoaid=pessoa.pessoaid WHERE paciente.pacienteid=$id";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$pessoaId = $linha[0]['pessoaid'];
		
		$sql = 'DELETE FROM paciente WHERE pacienteId=:id';
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		
		$sql = 'DELETE FROM pessoa WHERE pessoaid=:id';
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':id', $pessoaId);
		$stmt->execute();
	}
}

header("Location: admMain.php");
?>