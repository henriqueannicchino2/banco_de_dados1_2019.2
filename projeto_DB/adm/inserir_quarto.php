<?php
session_start();
include_once("../conection.php");
$btn_cadastrar = filter_input(INPUT_POST, 'btn_cadastrar', FILTER_SANITIZE_STRING);
if($btn_cadastrar){	
	$quartoDesc = "'".filter_input(INPUT_POST, 'quartoDesc', FILTER_SANITIZE_STRING)."'";
	$capacidade = filter_input(INPUT_POST, 'capacidade', FILTER_SANITIZE_STRING);
	$quartoNum = filter_input(INPUT_POST, 'quartoNum', FILTER_SANITIZE_STRING);
	$setor = "'".filter_input(INPUT_POST, 'nome_setor', FILTER_SANITIZE_STRING)."'";
	if((!empty($quartoDesc)) and (!empty($capacidade)) and (!empty($quartoNum)) and (!empty($setor))){
		$sql = "SELECT * FROM setor WHERE setornome=$setor";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$setorId = $linha[0]['setorid'];	
		
		
		$con->query("INSERT INTO quarto (quartoDesc,capacidade,quartoNum,setorId) VALUES ($quartoDesc,$capacidade,$quartoNum,$setorId)");
		/*echo $con->errorCode();
		echo '<br>';
		var_dump($con->errorInfo());*/
	}
}

header("Location: admMain.php");
?>