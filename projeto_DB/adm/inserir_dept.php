<?php
session_start();
include_once("../conection.php");
$btn_cadastrar = filter_input(INPUT_POST, 'btn_cadastrar', FILTER_SANITIZE_STRING);
if($btn_cadastrar){
	$dept = "'".filter_input(INPUT_POST, 'departamento', FILTER_SANITIZE_STRING)."'";
	$clinica = "'".filter_input(INPUT_POST, 'clinica', FILTER_SANITIZE_STRING)."'";
	
	if((!empty($dept)) and (!empty($clinica))){
		
		$sql = "SELECT clinicaid FROM clinica WHERE clinicanome=$clinica limit 1";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$clinicaId = $linha[0]['clinicaid'];
		
		$con->query("INSERT INTO departamento (departamentoNome,clinicaId) VALUES ($dept,$clinicaId)");
		//echo $con->errorCode();*/
		//echo '<br>';
		//var_dump($con->errorInfo());
	}
	header("Location: admMain.php");
}
	