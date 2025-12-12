<?php
session_start();
include_once("../conection.php");
$btn_retirar = filter_input(INPUT_POST, 'btn_retirar', FILTER_SANITIZE_STRING);
if($btn_retirar){
	$medicamentoNome = "'".filter_input(INPUT_POST, 'nome_medi', FILTER_SANITIZE_STRING)."'";
	$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_STRING);
	if((!empty($medicamentoNome)) and (!empty($quantidade))){
		if($quantidade>0){
			$sql = "SELECT medicamentoid,quantidade FROM medicamento WHERE medicamentoNome=$medicamentoNome";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$quantidadeAnt = $linha[0]['quantidade'];
			$medicamentoid = $linha[0]['medicamentoid'];
			$quantidade = $quantidadeAnt-$quantidade;
			if($quantidade>=0){
				$sql = "UPDATE medicamento SET quantidade = :quantidade WHERE medicamentoid = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindParam(':quantidade', $quantidade);
				$stmt->bindParam(':id', $medicamentoid);
				$stmt->execute();
			}
		}
	}
}

header("Location: enfermeiroMain.php");
?>