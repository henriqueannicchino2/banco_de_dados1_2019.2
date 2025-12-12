<?php
session_start();
include_once("../conection.php");
$btn_deletar = filter_input(INPUT_POST, 'btn_deletar', FILTER_SANITIZE_STRING);
if($btn_deletar){
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
	$tipo= filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
	if($tipo == "ADMIN"){
		if((!empty($id))){
			$sql = "SELECT * FROM pessoa INNER JOIN admin ON admin.pessoaid=pessoa.pessoaid WHERE admin.adminid=$id";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$pessoaId = $linha[0]['pessoaid'];
			
			$sql = 'DELETE FROM admin WHERE adminId=:id';
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			
			$sql = 'DELETE FROM pessoa WHERE pessoaid=:id';
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':id', $pessoaId);
			$stmt->execute();	
		}
	}
	else if($tipo == "ENFERMEIRO"){
		if((!empty($id))){
			$sql = "SELECT * FROM pessoa INNER JOIN funcionario ON funcionario.pessoaid=pessoa.pessoaid
				INNER JOIN enfermeiro ON enfermeiro.funcid=funcionario.funcid WHERE enfermeiroid=$id";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$pessoaId = $linha[0]['pessoaid'];
			
			$sql = 'DELETE FROM enfermeiro WHERE enfermeiroId=:id';
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			
			$sql = 'DELETE FROM pessoa WHERE pessoaidid=:id';
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':id', $pessoaId);
			$stmt->execute();	
		}
	}
	else if($tipo == "MEDICO"){
		if((!empty($id))){
			$sql = "SELECT * FROM pessoa INNER JOIN funcionario ON funcionario.pessoaid=pessoa.pessoaid
				INNER JOIN medico ON medico.funcid=funcionario.funcid WHERE medicoid=$id";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$pessoaId = $linha[0]['pessoaid'];
			
			$sql = 'DELETE FROM medico WHERE medicoId=:id';
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			
			$sql = 'DELETE FROM pessoa WHERE pessoaidid=:id';
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':id', $pessoaId);
			$stmt->execute();	
		}
	}
	else if($tipo == "RECEPCIONISTA"){
		if((!empty($id))){
			$sql = "SELECT * FROM pessoa INNER JOIN funcionario ON funcionario.pessoaid=pessoa.pessoaid
				INNER JOIN recepcionista ON recepcionista.funcid=funcionario.funcid WHERE recepcionistaid=$id";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$pessoaId = $linha[0]['pessoaid'];
			
			$sql = 'DELETE FROM medico WHERE recepcionistaId=:id';
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			
			$sql = 'DELETE FROM pessoa WHERE pessoaidid=:id';
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':id', $pessoaId);
			$stmt->execute();	
		}
	}
}

header("Location: admMain.php");
?>