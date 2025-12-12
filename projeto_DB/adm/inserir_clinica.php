<?php
session_start();
include_once("../conection.php");
$btn_cadastrar = filter_input(INPUT_POST, 'btn_cadastrar', FILTER_SANITIZE_STRING);
if($btn_cadastrar){
	$clinica = "'".filter_input(INPUT_POST, 'clinica', FILTER_SANITIZE_STRING)."'";
	
	if((!empty($clinica))){
		$con->query("INSERT INTO clinica (clinicaNome) VALUES ($clinica)");
		/*echo $con->errorCode();
		echo '<br>';
		var_dump($con->errorInfo());*/
	}
	header("Location: admMain.php");
}
?>