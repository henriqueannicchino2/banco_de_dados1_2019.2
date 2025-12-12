<?php
session_start();
include_once("../conection.php");
$idrecp=$_SESSION['id'];
$sql = "SELECT logado FROM recepcionista WHERE recepcionistaid=$idrecp";
$stmt = $con->prepare($sql);
$stmt->execute();
$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
if($linha[0]['logado']==0){
	header("Location: ../login.php");
}

$sql = "SELECT primeironome FROM recepcionista 
		INNER JOIN funcionario ON funcionario.funcid=recepcionista.funcid
		INNER JOIN pessoa ON pessoa.pessoaid=funcionario.pessoaid WHERE recepcionista.recepcionistaid=$idrecp";
$stmt = $con->prepare($sql);
$stmt->execute();
$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
$temp=$linha[0]['primeironome'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="styleRecepcionistaMain">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="recepMain.js"></script>
</head>
<body>
	<nav>
		<ul id="ul-principal">
			<?php //echo"<p class='cardValor fl-right' style='font-size:30px; color:#e53935'> $date_last </p>"?>
			<?php echo"<p class='login_d'> $temp<br>recepcionista </p>";?>
			<li class="li-p"><a href="">HOME</a></li>
			<li class="li-p">
				<button id="btn_vender" class="btn_menu">vender medicamento</button>
			</li>
			<li class="li-p">
				<button id="btn_medi" class="btn_menuM">estoque medicamento</button>
			</li>
			<li class="li-p">
				<button id="btn_Npaci" class="btn_menu">cadastrar paciente</button>
			</li>
			<li class="li-p">
				<button id="btn_Vpaci" class="btn_menu">visualizar pacientes</button>
			</li>
			<li class="li-p">
				<button id="btn_Vquarto" class="btn_menu">visualizar quartos</button>
			</li>
			<li class="li-p"><a href="../sair.php">SAIR</a></li>
		</ul>
	</nav>
	
	<!--vender medicamento-->
	<div id="medicamento_venda" class="opt_screen inputt">
		<?php
			$sql = "SELECT * FROM medicamento";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$row_count = $stmt->rowCount();
			$count=0;
		?>
		
		<form method="POST" action="vender_medi.php">
			<div class="container">
				<label for="">medicamento a ser vendido</label>
				<div class="selectBox">
					<select name="nome_medi" >
						<?php while($count<$row_count):;?> 
						<option><?php echo $linha[$count]['medicamentonome'];?></option>
						<?php $count++; endwhile;?>
					</select>	
				</div>
				<input type="text" name="quantidade" placeholder="quantidade" value="">
				<input type="submit" class="btn_menu" name="btn_vender" value="vender">
			</div>
		</form>
	</div>
	
	<div id="visualizar_medi" class="opt_screen" style="display:none; border-style:solid; background-color:white">
		<table>
      <tr>
				<th>ID|</th>
        <th>medicamentoNome|</th>
        <th>medicamentoDesc|</th>
        <th>quantidade|</th>
        <th>preco|</th>
      </tr>
                                        
    <?php
			$sql = "SELECT * FROM medicamento";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$row_count = $stmt->rowCount();
      if($row_count>0){
        $count=0;
        while($count<$row_count){
          echo "<tr><td>". $linha[$count]['medicamentoid']. "</td><td>".'|'. $linha[$count]['medicamentonome']. "</td><td>".'|'. $linha[$count]['medicamentodesc'].
					"</td><td>".'|'. $linha[$count]['quantidade']. "</td><td>".'|'. $linha[$count]['preco']. "</td></tr>";
          $count++;
        }
        //echo "</table>";
      }
				
    ?>                                      
    </table>
	</div>
	
	<div id="cadastrar_paci" class="opt_screen" style="display:none; border-style:solid">
		<form method="POST" action="inserir_paciente.php">
			<div class="container">
				<label for="">novo paciente</label>
				<div style="margin-left: 50px;">
					<input type="text" name="primeiroNome" placeholder="primeiroNome" value="">
					<input type="text" name="ultimoNome" placeholder="ultimoNome" value="">
					<input type="text" name="endereco" placeholder="endereco" value="">
					<input type="text" name="cidade" placeholder="cidade" value="">
					<input type="text" name="estado" placeholder="estado" value="">
					<input type="text" name="cep" placeholder="cep" value="">
					<input type="text" name="data_nasc" placeholder="data_nasc ano-mês-dia" value="">
					<input type="text" name="cpf" placeholder="cpf" value="">
					<input type="text" name="telefone" placeholder="telefone" value="">
					<input type="text" name="dataReg" placeholder="data Registro ano-mês-dia" value="">
					<input type="text" name="medico" placeholder="medico" value="">
					<input type="text" name="tratamentoDesc" placeholder="tratamentoDesc" value="">
					<input type="text" name="tratamentoData" placeholder="tratamentoData ano-mês-dia" value="">
					<input type="text" name="tratamentoValor" placeholder="tratamentoValor" value="">
					<input type="text" name="quartoNum" placeholder="quartoNum" value="">
					<input type="text" name="camaNum" placeholder="camaNum" value="">
				</div>
				<input type="submit" class="btn_menu" name="btn_cadastrar" value="cadastrar" style="margin-left: 60px;">
			</div>
		</form>
	</div>
	
	<div id="visualizar_paci" class="opt_screen" style="display:none; border-style:solid; background-color:white">
		<table>
      <tr>
				<th>ID|</th>
        <th>primeiroNome|</th>
        <th>ultimoNome|</th>
        <th>endereco|</th>
        <th>cidade|</th>
				<th>estado|</th>
				<th>cep|</th>
				<th>data_nasc|</th>
				<th>cpf|</th>
				<th>telefone|</th>
				<th>data_regs</th>
				<th>tratamento</th>
				<th>setor</th>
				<th>quarto</th>
				<th>cama</th>
      </tr>
                                        
    <?php
			$sql = "SELECT * FROM paciente 
				INNER JOIN pessoa ON pessoa.pessoaid=paciente.pessoaid
				INNER JOIN tratamento ON tratamento.pacienteid=paciente.pacienteid
				INNER JOIN cama ON cama.pacienteid=paciente.pacienteid
				INNER JOIN quarto ON quarto.quartoid=cama.quartoid
				INNER JOIN setor ON setor.setorid=quarto.setorid;";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$row_count = $stmt->rowCount();
      if($row_count>0){
        $count=0;
        while($count<$row_count){
          echo "<tr><td>". $linha[$count]['pacienteid']. "</td><td>".'|'. $linha[$count]['primeironome']. "</td><td>".'|'. $linha[$count]['ultimonome'].
						"</td><td>".'|'. $linha[$count]['endereco']. "</td><td>".'|'. $linha[$count]['cidade']. "</td><td>".'|'. $linha[$count]['estado'].
						"</td><td>".'|'. $linha[$count]['cep']. "</td><td>".'|'. $linha[$count]['data_nasc']. "</td><td>".'|'. $linha[$count]['cpf'].
						"</td><td>".'|'. $linha[$count]['telefone']. "</td><td>".'|'. $linha[$count]['datareg']. "</td><td>".'|'. $linha[$count]['tratamentodesc'].
						"</td><td>".'|'. $linha[$count]['setornome']. "</td><td>".'|'. $linha[$count]['quartonum']. "</td><td>".'|'. $linha[$count]['camanum'].
          "</td></tr>";
          $count++;
        }
        //echo "</table>";
      }
				
    ?>                                      
    </table>
	</div>
	
	<div id="visualizar_quarto" class="opt_screen" style="display:none; border-style:solid; background-color:white">
		<table>
      <tr>
				<th>ID|</th>
        <th>quartoDesc|</th>
        <th>capacidade|</th>
        <th>quartoNum|</th>
        <th>setor|</th>
				<th>disponivel|</th>
      </tr>
                                        
    <?php
			$sql = "SELECT quartoid,quartodesc,capacidade,quartonum,disponivel,setornome FROM quarto INNER JOIN setor ON quarto.setorid=setor.setorid;";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$row_count = $stmt->rowCount();
      if($row_count>0){
        $count=0;
        while($count<$row_count){
          echo "<tr><td>". $linha[$count]['quartoid']. "</td><td>".'|'. $linha[$count]['quartodesc']. "</td><td>".'|'. $linha[$count]['capacidade'].
					"</td><td>".'|'. $linha[$count]['quartonum']. "</td><td>".'|'. $linha[$count]['setornome']. "</td><td>".'|'. $linha[$count]['disponivel']. "</td></tr>";
          $count++;
        }
        //echo "</table>";
      }
				
    ?>                                      
    </table>
	</div>
	
</body>
</html>