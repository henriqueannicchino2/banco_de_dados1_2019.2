<?php
session_start();
include_once("../conection.php");
$btn_deletar = filter_input(INPUT_POST, 'btn_deletar', FILTER_SANITIZE_STRING);
if($btn_deletar){
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
	if((!empty($id))){
		$sql = 'DELETE FROM departamento WHERE departamentoId=:id';
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
	}
	
}

header("Location: admMain.php");
?>