<?php
session_start();
include_once("../conection.php");
$btn_cadastrar = filter_input(INPUT_POST, 'btn_cadastrar', FILTER_SANITIZE_STRING);
if($btn_cadastrar){
	$medicamentoNome = "'".filter_input(INPUT_POST, 'medicamentoNome', FILTER_SANITIZE_STRING)."'";
	$medicamentoDesc = "'".filter_input(INPUT_POST, 'medicamentoDesc', FILTER_SANITIZE_STRING)."'";
	$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_STRING);
	$preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_STRING);
	
	if((!empty($medicamentoNome)) and (!empty($medicamentoDesc)) and (!empty($quantidade)) and (!empty($preco))){
		$con->query("INSERT INTO medicamento (medicamentoNome,medicamentoDesc,quantidade,preco) VALUES ($medicamentoNome,$medicamentoDesc,$quantidade,$preco)");
		//echo $con->errorCode();*/
		//echo '<br>';
		//var_dump($con->errorInfo());
	}
}

header("Location: admMain.php");
?>