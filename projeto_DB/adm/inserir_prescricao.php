<?php
session_start();
include_once("../conection.php");
$btn_cadastrar = filter_input(INPUT_POST, 'btn_cadastrar', FILTER_SANITIZE_STRING);
if($btn_cadastrar){

	$prescricaoData = date('Y-m-d');
	$medicamentoId = "'".filter_input(INPUT_POST, 'medicamentoid', FILTER_SANITIZE_STRING)."'";
	$tratamentoId = "'".filter_input(INPUT_POST, 'tratamentoid', FILTER_SANITIZE_STRING)."'";
  $con->query("INSERT INTO prescricao 
    (prescricaodata,medicamentoid,tratamentoid) 
    VALUES ($prescricaoData,$medicamentoId,$tratamentoId)");
}
header("Location: ../medico/MedicoMain.php");
?>