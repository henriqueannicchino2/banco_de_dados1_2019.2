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
	$usuario = "'".filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING)."'";
	$senha = "'".filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING)."'";
	$dataContratacao = "'".filter_input(INPUT_POST, 'dataContratacao', FILTER_SANITIZE_STRING)."'";
	$anosExperiencia = "'".filter_input(INPUT_POST, 'anosExperiencia', FILTER_SANITIZE_STRING)."'";
	$descAbilidade = "'".filter_input(INPUT_POST, 'descAbilidade', FILTER_SANITIZE_STRING)."'";
	$setor = "'".filter_input(INPUT_POST, 'setor', FILTER_SANITIZE_STRING)."'";
	$dept = "'".filter_input(INPUT_POST, 'departamento', FILTER_SANITIZE_STRING)."'";
	$tipo = $_POST['tipo'];
	if($tipo == "admin"){
		//colocar o resto no if ainda
		if((!empty($primeiroNome))){
			$con->query("INSERT INTO pessoa (primeiroNome,ultimoNome,endereco,cidade,estado,cep,
			data_nasc,cpf,telefone) VALUES ($primeiroNome,$ultimoNome,$endereco,$cidade,$estado,
			$cep,$data_nasc,$cpf,$telefone)");
			//echo $con->errorCode();*/
			//echo '<br>';
			//var_dump($con->errorInfo());
			$sql = "SELECT * FROM pessoa ORDER BY pessoaId desc limit 1";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$pessoaId = $linha[0]['pessoaid'];			
			$con->query("INSERT INTO admin (usuario,senha,pessoaId) VALUES ($usuario,$senha,$pessoaId)");
		}
	}
	else if($tipo == "enfermeiro"){
		if((!empty($primeiroNome))){
			$con->query("INSERT INTO pessoa (primeiroNome,ultimoNome,endereco,cidade,estado,cep,
			data_nasc,cpf,telefone) VALUES ($primeiroNome,$ultimoNome,$endereco,$cidade,$estado,
			$cep,$data_nasc,$cpf,$telefone)");
			
			$sql = "SELECT * FROM pessoa ORDER BY pessoaId desc limit 1";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$pessoaId = $linha[0]['pessoaid'];			
			
			$con->query("INSERT INTO funcionario (dataContratacao,anosDeExperiencia,pessoaId) VALUES ($dataContratacao,$anosExperiencia,$pessoaId)");
			/*echo $con->errorCode();
			echo '<br>';
			var_dump($con->errorInfo());*/
			
			$sql = "SELECT * FROM funcionario ORDER BY funcid desc limit 1";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$funcId = $linha[0]['funcid'];

			$sql = "SELECT setorid FROM setor WHERE setorNome=$setor limit 1";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$setorId = $linha[0]['setorid'];	
			
			$sql = "SELECT departamentoid FROM departamento WHERE departamentonome=$dept limit 1";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$dptId = $linha[0]['departamentoid'];
			
			$con->query("INSERT INTO enfermeiro (descAbilidade,usuario,senha,funcId,setorId,departamentoId) VALUES ($descAbilidade,$usuario,$senha,$funcId,$setorId,$dptId)");
			
		}
	}
	
	else if($tipo == "medico"){
		if((!empty($primeiroNome))){
			$con->query("INSERT INTO pessoa (primeiroNome,ultimoNome,endereco,cidade,estado,cep,
			data_nasc,cpf,telefone) VALUES ($primeiroNome,$ultimoNome,$endereco,$cidade,$estado,
			$cep,$data_nasc,$cpf,$telefone)");
			
			$sql = "SELECT * FROM pessoa ORDER BY pessoaId desc limit 1";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$pessoaId = $linha[0]['pessoaid'];			
			
			$con->query("INSERT INTO funcionario (dataContratacao,anosDeExperiencia,pessoaId) VALUES ($dataContratacao,$anosExperiencia,$pessoaId)");
			/*echo $con->errorCode();
			echo '<br>';
			var_dump($con->errorInfo());*/
			
			$sql = "SELECT * FROM funcionario ORDER BY funcid desc limit 1";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$funcId = $linha[0]['funcid'];

			$sql = "SELECT setorid FROM setor WHERE setorNome=$setor limit 1";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$setorId = $linha[0]['setorid'];	
			
			$sql = "SELECT departamentoid FROM departamento WHERE departamentonome=$dept limit 1";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$dptId = $linha[0]['departamentoid'];
			
			$con->query("INSERT INTO medico (descAbilidade,usuario,senha,funcId,setorId,departamentoId) VALUES ($descAbilidade,$usuario,$senha,$funcId,$setorId,$dptId)");
		}
	}
	
	else if($tipo == "recepcionista"){
		if((!empty($primeiroNome))){
			$con->query("INSERT INTO pessoa (primeiroNome,ultimoNome,endereco,cidade,estado,cep,
			data_nasc,cpf,telefone) VALUES ($primeiroNome,$ultimoNome,$endereco,$cidade,$estado,
			$cep,$data_nasc,$cpf,$telefone)");
			
			$sql = "SELECT * FROM pessoa ORDER BY pessoaId desc limit 1";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$pessoaId = $linha[0]['pessoaid'];			
			
			$con->query("INSERT INTO funcionario (dataContratacao,anosDeExperiencia,pessoaId) VALUES ($dataContratacao,$anosExperiencia,$pessoaId)");
			/*echo $con->errorCode();
			echo '<br>';
			var_dump($con->errorInfo());*/
			
			$sql = "SELECT * FROM funcionario ORDER BY funcid desc limit 1";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$funcId = $linha[0]['funcid'];
			
			$con->query("INSERT INTO recepcionista (descAbilidade,usuario,senha,funcId) VALUES ($descAbilidade,$usuario,$senha,$funcId)");
		}
	}
}
header("Location: admMain.php");
?>