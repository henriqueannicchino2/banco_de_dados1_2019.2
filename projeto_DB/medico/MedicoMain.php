<?php
session_start();
include_once("../conection.php");
$idmed=$_SESSION['id'];
$sql = "SELECT logado FROM medico WHERE medicoid=$idmed";
$stmt = $con->prepare($sql);
$stmt->execute();
$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
if($linha[0]['logado']==0){
	header("Location: ../login.php");
}

$sql = "SELECT medicoid,primeironome FROM medico
		INNER JOIN funcionario ON funcionario.funcid=medico.funcid
		INNER JOIN pessoa ON pessoa.pessoaid=funcionario.pessoaid WHERE medico.medicoid=$idmed";
$stmt = $con->prepare($sql);
$stmt->execute();
$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
$temp=$linha[0]['primeironome'];
$medicoID = $linha[0]['medicoid'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="styleMedicoMain">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="medicoMain.js"></script>
</head>
<body>
	<nav>
		<ul id="ul-principal">
			<?php //echo"<p class='cardValor fl-right' style='font-size:30px; color:#e53935'> $date_last </p>"?>
			<?php echo"<p class='login_d'> $temp<br>medico </p>";?>
			<li class="li-p"><a href="">HOME</a></li>
			<li class="li-p">
				<button id="btn_pres" class="btn_menu">passar prescrição</button>
			</li>
			<li class="li-p">
				<button id="btn_paci" class="btn_menu">visualizar meus pacientes</button>
			</li>
			<li class="li-p">
				<button id="btn_tpaci" class="btn_menuM">visualizar todos os pacientes</button>
			</li>
			<li class="li-p">
				<button id="btn_medi" class="btn_menuM">visualizar medicamentos</button>
			</li>
			<li class="li-p">
				<button id="btn_Vpres" class="btn_menuM">visualizar prescricao</button>
			</li>
			<li class="li-p"><a href="../sair.php">SAIR</a></li>
		</ul>
	</nav>
	
	<div id="prescricao" class="opt_screen inputt">
		<?php
			$sql = "SELECT * FROM medicamento";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$row_count = $stmt->rowCount();
			$count=0;
			
			$sql = "SELECT paciente.pacienteid,pessoa.primeiroNome,pessoa.ultimonome FROM paciente 
				INNER JOIN pessoa ON pessoa.pessoaid=paciente.pessoaid";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha2=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$row_count2 = $stmt->rowCount();
			$count2=0;
						
		?>
		<form method="POST" action="cadastrar_prescricao.php">
			<div class="container">
				<label for="">prescricao</label>
				<div class="selectBox">
					<select name="nome_medi">
						<?php while($count<$row_count):;?> 
						<option><?php echo $linha[$count]['medicamentonome'];?></option>
						<?php $count++; endwhile;?>
					</select>	
				</div>
				<div class="selectBox">
					<p>nome do paciente paciente</p>
					<select name="paci">
						<?php while($count2<$row_count2):;?> 
						<option><?php echo $linha2[$count2]['pacienteid']." ".$linha2[$count2]['primeironome']." ".$linha2[$count2]['ultimonome']?></option>
						<?php $count2++; endwhile;?>
					</select>	
				</div>
				<input type="submit" class="btn_menu" name="btn_cadastrar" value="cadastrar">
			</div>
		</form>
	</div>
	
	<div id="visualizar_paci" class="opt_screen" style="display:none; border-style:solid; background-color:white">
		<table>
      <tr>
				<th>ID|</th>
        <th>primeiroNome|</th>
        <th>ultimoNome|</th>
				<th>data_nasc|</th>
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
				INNER JOIN setor ON setor.setorid=quarto.setorid WHERE tratamento.medicoid=$medicoID";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$row_count = $stmt->rowCount();
      if($row_count>0){
        $count=0;
        while($count<$row_count){
          echo "<tr><td>". $linha[$count]['pacienteid']. "</td><td>".'|'. $linha[$count]['primeironome']. "</td><td>".'|'. $linha[$count]['ultimonome'].
					  "</td><td>".'|'. $linha[$count]['data_nasc']. "</td><td>".'|'. $linha[$count]['datareg']. "</td><td>".'|'. $linha[$count]['tratamentodesc'].
						"</td><td>".'|'. $linha[$count]['setornome']. "</td><td>".'|'. $linha[$count]['quartonum']. "</td><td>".'|'. $linha[$count]['camanum'].
          "</td></tr>";
          $count++;
        }
        //echo "</table>";
      }
				
    ?>                                      
    </table>
	</div>
	
	<div id="visualizar_tpaci" class="opt_screen" style="display:none; border-style:solid; background-color:white">
		<table>
      <tr>
				<th>ID|</th>
        <th>primeiroNome|</th>
        <th>ultimoNome|</th>
				<th>data_nasc|</th>
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
				INNER JOIN setor ON setor.setorid=quarto.setorid";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$row_count = $stmt->rowCount();
      if($row_count>0){
        $count=0;
        while($count<$row_count){
          echo "<tr><td>". $linha[$count]['pacienteid']. "</td><td>".'|'. $linha[$count]['primeironome']. "</td><td>".'|'. $linha[$count]['ultimonome'].
					  "</td><td>".'|'. $linha[$count]['data_nasc']. "</td><td>".'|'. $linha[$count]['datareg']. "</td><td>".'|'. $linha[$count]['tratamentodesc'].
						"</td><td>".'|'. $linha[$count]['setornome']. "</td><td>".'|'. $linha[$count]['quartonum']. "</td><td>".'|'. $linha[$count]['camanum'].
          "</td></tr>";
          $count++;
        }
        //echo "</table>";
      }
				
    ?>                                      
    </table>
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
	
	<div id="visualizar_pres" class="opt_screen" style="display:none; border-style:solid; background-color:white">
		<table>
      <tr>
				<th>ID|</th>
        <th>prescricaoData|</th>
        <th>tratamentoDesc|</th>
        <th>medicamentoNome|</th>
      </tr>
                                        
    <?php
			$sql = "SELECT prescricao.prescricaoId,prescricao.prescricaoData,medicamento.medicamentoNome,tratamento.tratamentoDesc FROM prescricao 
				INNER JOIN medicamento ON medicamento.medicamentoid=prescricao.medicamentoid
				INNER JOIN tratamento ON tratamento.tratamentoid=prescricao.tratamentoid WHERE tratamento.medicoId=$medicoID";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$row_count = $stmt->rowCount();
      if($row_count>0){
        $count=0;
        while($count<$row_count){
          echo "<tr><td>". $linha[$count]['prescricaoid']. "</td><td>".'|'. $linha[$count]['prescricaodata']. "</td><td>".'|'. $linha[$count]['tratamentodesc'].
					"</td><td>".'|'. $linha[$count]['medicamentonome']. "</td></tr>";
          $count++;
        }
        //echo "</table>";
      }
				
    ?>                                      
    </table>
	</div>
	
</body>
</html>