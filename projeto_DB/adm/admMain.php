<?php
session_start();
include_once("../conection.php");
$idAdm=$_SESSION['id'];
$sql = "SELECT logado FROM admin WHERE adminid=$idAdm";
$stmt = $con->prepare($sql);
$stmt->execute();
$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
if($linha[0]['logado']==0){
	header("Location: ../login.php");
}

?>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>ADMIN</title>
	<link rel="stylesheet" href="styleAdmMain.css">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="admMain.js"></script>
</head>
<body>
	<input type="checkbox" id="lateralMenu">
	<label for="lateralMenu">
		<img src="../image/menu_bars.png">
	</label>
	<nav>
		<ul>
			<li><a href="admMain.php"><p style="margin-left:150px">HOME</p></a></li>
			<button id="btn_usu" class="btn_menu">usuario </button>
			<button id="btn_dpt" class="btn_menu">departamento</button>
			<button id="btn_setor" class="btn_menu">setor</button>
			<button id="btn_clini" class="btn_menu">clinica</button>
			<button id="btn_paci" class="btn_menu">pacientes</button>
			<button id="btn_medicamento" class="btn_menu">medicamentos</button>
			<button id="btn_quarto" class="btn_menu">quartos</button>
			<li><a href='../sair.php'><p style="margin-left:150px">SAIR</p></a></li>
		</ul>
	</nav>
	
	<!--usuario-->
	<div id="usuario_opt" class="opt_screen">
		<div class="container">
			<label for="">Opções usuario</label>
			<div style="margin-top: 100px;">
				<button id="N_usu" class="btn_menu">cadastrar usuario</button>
				<button id="V_usu" class="btn_menu">visualizar usuarios</button>
				<button id="D_usu" class="btn_menu">deletar usuario</button>
			</div>
		</div>
	</div>
	
	<div id="cadastrar_usu" class="opt_screen" style="display:none; border-style:solid">
		<form method="POST" action="inserir_usuario.php">
			<div class="container">
				<label for="">novo usuario</label>
				<div style="margin-top: 100px;">
					<input type="text" name="primeiroNome" placeholder="primeiroNome" value="">
					<input type="text" name="ultimoNome" placeholder="ultimoNome" value="">
					<input type="text" name="endereco" placeholder="endereco" value="">
					<input type="text" name="cidade" placeholder="cidade" value="">
					<input type="text" name="estado" placeholder="estado" value="">
					<input type="text" name="cep" placeholder="cep" value="">
					<input type="text" name="data_nasc" placeholder="data_nasc ano-mês-dia" value="">
					<input type="text" name="cpf" placeholder="cpf" value="">
					<input type="text" name="telefone" placeholder="telefone" value="">
					<input id="dataCon"type="text" name="dataContratacao" placeholder="dataContratacao ano-mês-dia" value=""><br>
					<input id="rd1" type="radio" name="tipo" onclick="show_input(0)" value="admin">ADMIN</input><br>
					<input id="rd2" type="radio" name="tipo" onclick="show_input(1)" value="enfermeiro">ENFERMEIRO</input><br>
					<input id="rd3" type="radio" name="tipo" onclick="show_input(2)" value="medico" checked>MEDICO</input><br>
					<input id="rd4" type="radio" name="tipo" onclick="show_input(3)" value="recepcionista">RECEPCIONISTA</input><br>
					<input id="anosXp" type="text" name="anosExperiencia" placeholder="anosExperiencia" value="">
					<input id="descAb" type="text" name="descAbilidade" placeholder="descAbilidade" value="">
					<input type="text" name="usuario" placeholder="usuario" value="">
					<input type="password" name="senha" placeholder="senha" value="">
					<input id="setor" type="text" name="setor" placeholder="setor" value="">
					<input id="dept" type="text" name="departamento" placeholder="departamento" value="">
				</div>
				<input type="submit" class="btn_menu" name="btn_cadastrar" value="cadastrar">
			</div>
		</form>
	</div>
	
	<div id="visualizar_usu" class="opt_screen" style="display:none; border-style:solid; background-color:white ">
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
				<th>tipo_acesso|</th>
				<th>dataContratacao|</th>
				<th>anosExperiencia|</th>
				<th>descAbilidade|</th>
				<th>usuario|</th>
				<th>setor|</th>
				<th>departamento</th>
      </tr>
                                        
      <?php
				$sql = "SELECT * FROM pessoa INNER JOIN admin ON admin.pessoaId=pessoa.pessoaId";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
				$row_count = $stmt->rowCount();
                if($row_count>0){
                    $count=0;
                    while($count<$row_count){
                        echo "<tr><td>". $linha[$count]['adminid']. "</td><td>".'|'. $linha[$count]['primeironome']. "</td><td>". '|'. $linha[$count]['ultimonome'].
                            "</td><td>". '|'. $linha[$count]['endereco']. "</td><td>". '|'. $linha[$count]['cidade']. "</td><td>". '|'. $linha[$count]['estado'].
							"</td><td>". '|'. $linha[$count]['cep']. "</td><td>". '|'. $linha[$count]['data_nasc']. "</td><td>". '|'. $linha[$count]['cpf'].
							"</td><td>". '|'. $linha[$count]['telefone']. "</td><td>". '|'. "ADMIN". "</td><td>". "</td><td>". "</td><td>". "</td><td>". '|'. $linha[$count]['usuario'].
                            "</td></tr>";
                        $count++;
                    }
                    //echo "</table>";
                }
                
				$sql = "SELECT * FROM pessoa INNER JOIN funcionario ON funcionario.pessoaId=pessoa.pessoaId
					INNER JOIN enfermeiro ON enfermeiro.funcid=funcionario.funcid
					INNER JOIN setor ON enfermeiro.setorid=setor.setorid
					INNER JOIN departamento ON departamento.departamentoid=enfermeiro.departamentoid";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
				$row_count = $stmt->rowCount();
                if($row_count>0){
                    $count=0;
                    while($count<$row_count){
                        echo "<tr><td>". $linha[$count]['enfermeiroid']. "</td><td>".'|'. $linha[$count]['primeironome']. "</td><td>". '|'. $linha[$count]['ultimonome'].
                            "</td><td>". '|'. $linha[$count]['endereco']. "</td><td>". '|'. $linha[$count]['cidade']. "</td><td>". '|'. $linha[$count]['estado'].
							"</td><td>". '|'. $linha[$count]['cep']. "</td><td>". '|'. $linha[$count]['data_nasc']. "</td><td>". '|'. $linha[$count]['cpf'].
							"</td><td>". '|'. $linha[$count]['telefone']. "</td><td>". '|'. "ENFERMEIRO". "</td><td>". '|'. $linha[$count]['datacontratacao'].
							"</td><td>". '|'. $linha[$count]['anosdeexperiencia']. "</td><td>". '|'. $linha[$count]['descabilidade']. "</td><td>". '|'. $linha[$count]['usuario'].
							"</td><td>". '|'. $linha[$count]['setornome']. "</td><td>". '|'. $linha[$count]['departamentonome'].
                            "</td></tr>";
                        $count++;
                    }
                    //echo "</table>";
                }
				
				$sql = "SELECT * FROM pessoa INNER JOIN funcionario ON funcionario.pessoaId=pessoa.pessoaId
					INNER JOIN medico ON medico.funcid=funcionario.funcid
					INNER JOIN setor ON medico.setorid=setor.setorid
					INNER JOIN departamento ON departamento.departamentoid=medico.departamentoid";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
				$row_count = $stmt->rowCount();
                if($row_count>0){
                    $count=0;
                    while($count<$row_count){
                        echo "<tr><td>". $linha[$count]['medicoid']. "</td><td>".'|'. $linha[$count]['primeironome']. "</td><td>". '|'. $linha[$count]['ultimonome'].
                            "</td><td>". '|'. $linha[$count]['endereco']. "</td><td>". '|'. $linha[$count]['cidade']. "</td><td>". '|'. $linha[$count]['estado'].
							"</td><td>". '|'. $linha[$count]['cep']. "</td><td>". '|'. $linha[$count]['data_nasc']. "</td><td>". '|'. $linha[$count]['cpf'].
							"</td><td>". '|'. $linha[$count]['telefone']. "</td><td>". '|'. "MEDICO". "</td><td>". '|'. $linha[$count]['datacontratacao'].
							"</td><td>". '|'. $linha[$count]['anosdeexperiencia']. "</td><td>". '|'. $linha[$count]['descabilidade']. "</td><td>". '|'. $linha[$count]['usuario'].
							"</td><td>". '|'. $linha[$count]['setornome']. "</td><td>". '|'. $linha[$count]['departamentonome'].
                            "</td></tr>";
                        $count++;
                    }
                    //echo "</table>";
                }
				
				$sql = "SELECT * FROM pessoa INNER JOIN funcionario ON funcionario.pessoaId=pessoa.pessoaId
					INNER JOIN recepcionista ON recepcionista.funcid=funcionario.funcid";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
				$row_count = $stmt->rowCount();
                if($row_count>0){
                    $count=0;
                    while($count<$row_count){
                        echo "<tr><td>". $linha[$count]['recepcionistaid']. "</td><td>".'|'. $linha[$count]['primeironome']. "</td><td>". '|'. $linha[$count]['ultimonome'].
                            "</td><td>". '|'. $linha[$count]['endereco']. "</td><td>". '|'. $linha[$count]['cidade']. "</td><td>". '|'. $linha[$count]['estado'].
							"</td><td>". '|'. $linha[$count]['cep']. "</td><td>". '|'. $linha[$count]['data_nasc']. "</td><td>". '|'. $linha[$count]['cpf'].
							"</td><td>". '|'. $linha[$count]['telefone']. "</td><td>". '|'. "RECEPCIONISTA". "</td><td>". '|'. $linha[$count]['datacontratacao'].
							"</td><td>". '|'. $linha[$count]['anosdeexperiencia']. "</td><td>". '|'. $linha[$count]['descabilidade']. "</td><td>". '|'. $linha[$count]['usuario'].
                            "</td></tr>";
                        $count++;
                    }
                    //echo "</table>";
                }
				
            ?>                                      
        </table>
	</div>
	
	
	<div id="deletar_usu" class="opt_screen inputt">
		<form method="POST" action="deletar_usuario.php">
			<div class="container">
				<label for="">DELETAR usuario</label>
				<div style="margin-top: 100px;">
					<input type="text" name="id" placeholder="digite o id do usuario a ser deletado" value="">
					<div class="selectBox">
						<select name="tipo">
						<option>ADMIN</option>
						<option>ENFERMEIRO</option>
						<option>MEDICO</option>
						<option>RECEPCIONISTA</option>
						</select>	
					</div>
				</div>
				<input type="submit" class="btn_menuD" name="btn_deletar" value="deletar">
			</div>
		</form>
	</div>
	
	<!--departamento-->
	<div id="departamento_opt" class="opt_screen">
		<div class="container">
			<label for="">Opções Departamento</label>
			<div style="margin-top: 100px;">
				<button id="N_dpt" class="btn_menu">cadastrar departamento</button>
				<button id="V_dpt" class="btn_menu">visualizar departamento</button>
				<button id="D_dpt" class="btn_menu">deletar departamento</button>
			</div>
		</div>
	</div>
	
	
	<div id="cadastrar_dept" class="opt_screen" style="display:none; border-style:solid">
		<form method="POST" action="inserir_dept.php">
			<div class="container">
				<label for="">novo departamento</label>
				<div style="margin-top: 100px;">
					<input type="text" name="departamento" placeholder="departamentoNome" value="">
					<input type="text" name="clinica" placeholder="clinicaNome" value="">
				</div>
				<input type="submit" class="btn_menu" name="btn_cadastrar" value="cadastrar">
			</div>
		</form>
	</div>
	
	<div id="visualizar_dpt" class="opt_screen" style="display:none; border-style:solid; background-color:white ">
		<table>
            <tr>
							<th>ID|</th>
              <th>departamentoNome|</th>
              <th>clinicaNome|</th>
            </tr>
                                        
            <?php
				$sql = "SELECT * FROM departamento INNER JOIN clinica ON clinica.clinicaid=departamento.clinicaid;";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
				$row_count = $stmt->rowCount();
                if($row_count>0){
                    $count=0;
                    while($count<$row_count){
                        echo "<tr><td>". $linha[$count]['departamentoid']. "</td><td>".'|'. $linha[$count]['departamentonome']. "</td><td>". '|'. $linha[$count]['clinicanome']. 
                            "</td></tr>";
                        $count++;
                    }
                    //echo "</table>";
                }
				
            ?>                                      
        </table>
	</div>
	
	<div id="deletar_dpt" class="opt_screen inputt">
		<form method="POST" action="deletar_departamento.php">
			<div class="container">
				<label for="">DELETAR departamento</label>
				<div style="margin-top: 100px;">
					<input type="text" name="id" placeholder="digite o id do departamento a ser deletado" value="">
				</div>
				<input type="submit" class="btn_menuD" name="btn_deletar" value="deletar">
			</div>
		</form>
	</div>
	
	<!--setor-->
	<div id="setor_opt" class="opt_screen">
		<div class="container">
			<label for="">Opções setor</label>
			<div style="margin-top: 100px;">
				<button id="N_setor" class="btn_menu">cadastrar setor</button>
				<button id="V_setor" class="btn_menu">visualizar setores</button>
				<button id="D_setor" class="btn_menu">deletar setor</button>
			</div>
		</div>
	</div>
	
	<div id="cadastrar_setor" class="opt_screen" style="display:none; border-style:solid">
		<form method="POST" action="inserir_setor.php">
			<div class="container">
				<label for="">novo setor</label>
				<div style="margin-top: 100px;">
					<input type="text" name="setor" placeholder="setorNome" value="">
					<input type="text" name="clinica" placeholder="clinicaNome" value="">
				</div>
				<input type="submit" class="btn_menu" name="btn_cadastrar" value="cadastrar">
			</div>
		</form>
	</div>
	
	<div id="visualizar_setor" class="opt_screen" style="display:none; border-style:solid; background-color:white ">
		<table>
            <tr>
							<th>ID|</th>
              <th>setorNome|</th>
              <th>clinicaNome|</th>
            </tr>
                                        
            <?php
				$sql = "SELECT * FROM setor INNER JOIN clinica ON clinica.clinicaid=setor.clinicaid";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
				$row_count = $stmt->rowCount();
                if($row_count>0){
                    $count=0;
                    while($count<$row_count){
                        echo "<tr><td>". $linha[$count]['setorid']. "</td><td>".'|'. $linha[$count]['setornome']. "</td><td>". '|'. $linha[$count]['clinicanome']. 
                            "</td></tr>";
                        $count++;
                    }
                    //echo "</table>";
                }
				
            ?>                                      
        </table>
	</div>
	
	<div id="deletar_setor" class="opt_screen inputt">
		<form method="POST" action="deletar_setor.php">
			<div class="container">
				<label for="">DELETAR setor</label>
				<div style="margin-top: 100px;">
					<input type="text" name="id" placeholder="digite o id do setor a ser deletado" value="">
				</div>
				<input type="submit" class="btn_menuD" name="btn_deletar" value="deletar">
			</div>
		</form>
	</div>
	
	<!--clinica-->
	<div id="clinica_opt" class="opt_screen">
		<div class="container">
			<label for="">Opções clinica</label>
			<div style="margin-top: 100px;">
				<button id="N_clini" class="btn_menu">cadastrar clinica</button>
				<button id="V_clini" class="btn_menu">visualizar clinicas</button>
				<button id="D_clini" class="btn_menu">deletar clinica</button>
			</div>
		</div>
	</div>
	
	<div id="cadastrar_clinica" class="opt_screen inputt" style="display:none; border-style:solid">
		<form method="POST" action="inserir_clinica.php">
			<div class="container">
				<label for="">nova clinica</label>
				<div style="margin-top: 100px;">
					<input type="text" name="clinica" placeholder="clinicaNome" value="">
				</div>
				<input type="submit" class="btn_menuN" name="btn_cadastrar" value="cadastrar">
			</div>
		</form>
	</div>
	
	<div id="visualizar_clinica" class="opt_screen" style="display:none; border-style:solid; background-color:white ">
		<table>
            <tr>
							<th>ID|</th>
              <th>clinicaNome|</th>
            </tr>
                                        
            <?php
				$sql = "SELECT * FROM clinica";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
				$row_count = $stmt->rowCount();
                if($row_count>0){
                    $count=0;
                    while($count<$row_count){
                        echo "<tr><td>". $linha[$count]['clinicaid']. "</td><td>".'|'. $linha[$count]['clinicanome']. 
                            "</td></tr>";
                        $count++;
                    }
                    //echo "</table>";
                }
				
            ?>                                      
        </table>
	</div>
	
	<div id="deletar_clinica" class="opt_screen inputt">
		<form method="POST" action="deletar_clinica.php">
			<div class="container">
				<label for="">DELETAR clinica</label>
				<div style="margin-top: 100px;">
					<input type="text" name="id" placeholder="digite o id da clinica a ser deletada" value="">
				</div>
				<input type="submit" class="btn_menuD" name="btn_deletar" value="deletar">
			</div>
		</form>
	</div>
	
	<!--paciente-->
	<div id="paciente_opt" class="opt_screen">
		<div class="container">
			<label for="">Opções paciente</label>
			<div style="margin-top: 100px;">
				<button id="N_paci" class="btn_menu">cadastrar paciente</button>
				<button id="V_paci" class="btn_menu">visualizar paciente</button>
				<button id="D_paci" class="btn_menu">deletar paciente</button>
			</div>
		</div>
	</div>
	
	<div id="cadastrar_paci" class="opt_screen" style="display:none; border-style:solid">
		<form method="POST" action="inserir_paciente.php">
			<div class="container">
				<label for="">novo paciente</label>
				<div style="margin-top: 100px;">
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
        <th>endereco|</th>
        <th>cidade|</th>
				<th>estado|</th>
				<th>cep|</th>
				<th>data_nasc|</th>
				<th>cpf|</th>
				<th>telefone|</th>
				<th>data_regs</th>
      </tr>
                                        
    <?php
			$sql = "SELECT * FROM paciente INNER JOIN pessoa ON pessoa.pessoaid=paciente.pessoaid";
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
						"</td><td>".'|'. $linha[$count]['telefone']. "</td><td>".'|'. $linha[$count]['datareg'].
          "</td></tr>";
          $count++;
        }
        //echo "</table>";
      }
				
    ?>                                      
    </table>
	</div>
	
	<div id="deletar_paci" class="opt_screen inputt">
		<form method="POST" action="deletar_paciente.php">
			<div class="container">
				<label for="">DELETAR paciente</label>
				<div style="margin-top: 100px;">
					<input type="text" name="id" placeholder="digite o id do paciente a ser deletado" value="">
				</div>
				<input type="submit" class="btn_menuD" name="btn_deletar" value="deletar">
			</div>
		</form>
	</div>
	
	<!--medicamento-->
	<div id="medicamento_opt" class="opt_screen">
		<div class="container">
			<label for="">Opções medicamento</label>
			<div style="margin-top: 100px;">
				<button id="N_medi" class="btn_menu">cadastrar medicamento</button>
				<button id="V_medi" class="btn_menu">visualizar medicamentos</button>
				<button id="B_medi" class="btn_menu">medicamentos em baixa</button>
				<button id="R_medi" class="btn_menu">repor medicamento</button>
			</div>
		</div>
	</div>
	
	<div id="cadastrar_medi" class="opt_screen" style="display:none; border-style:solid">
		<form method="POST" action="inserir_medicamento.php">
			<div class="container">
				<label for="">novo medicamento</label>
				<div style="margin-top: 100px;">
					<input type="text" name="medicamentoNome" placeholder="medicamentoNome" value="">
					<input type="text" name="medicamentoDesc" placeholder="medicamentoDesc" value="">
					<input type="text" name="quantidade" placeholder="quantidade" value="">
					<input type="text" name="preco" placeholder="preco" value="">
				</div>
				<input type="submit" class="btn_menu" name="btn_cadastrar" value="cadastrar">
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
	
	<div id="visualizar_medi_baixa" class="opt_screen" style="display:none; border-style:solid; background-color:white">
		<table>
      <tr>
				<th>ID|</th>
        <th>medicamentoNome|</th>
        <th>medicamentoDesc|</th>
        <th>quantidade|</th>
        <th>preco|</th>
      </tr>
                                        
    <?php
			$sql = "SELECT * FROM medicamento WHERE quantidade<=3";
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
	
	<div id="repor_medi" class="opt_screen inputt">
		<?php
			$sql = "SELECT * FROM medicamento";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$row_count = $stmt->rowCount();
			$count=0;
		?>
		<form method="POST" action="repor_medi.php">
			<div class="container">
				<label for="">repor medicamento</label>
				<div class="selectBox" style="margin-top:100px;">
					<select name="nome_medi" >
						<?php while($count<$row_count):;?> 
						<option><?php echo $linha[$count]['medicamentonome'];?></option>
						<?php $count++; endwhile;?>
					</select>	
				</div>
				<input type="text" name="quantidade" placeholder="quantidade a ser adicionada" value="">
				<input type="submit" class="btn_menuN" name="btn_adicionar" value="adicionar">
			</div>
		</form>
	</div>
	
	<!--quarto-->
	<div id="quarto_opt" class="opt_screen">
		<div class="container">
			<label for="">Opções quarto</label>
			<div style="margin-top: 100px;">
				<button id="N_quarto" class="btn_menu">cadastrar quarto</button>
				<button id="V_quarto" class="btn_menu">visualizar quartos</button>
			</div>
		</div>
	</div>
	
	<div id="cadastrar_quarto" class="opt_screen" style="display:none; border-style:solid">
		<?php
			$sql = "SELECT * FROM setor";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$linha=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$row_count = $stmt->rowCount();
			$count=0;
		?>
		<form method="POST" action="inserir_quarto.php">
			<div class="container">
				<label for="">cadastrar quarto</label>
				<div style="margin-top: 100px;">
					<input type="text" name="quartoDesc" placeholder="descrição quarto" value="">
					<input type="text" name="capacidade" placeholder="capacidade" value="">
					<input type="text" name="quartoNum" placeholder="numero do quarto" value="">
					<div class="selectBox">
						<select name="nome_setor" >
							<?php while($count<$row_count):;?> 
							<option><?php echo $linha[$count]['setornome'];?></option>
							<?php $count++; endwhile;?>
						</select>	
					</div>
				</div>
				<input type="submit" class="btn_menu" name="btn_cadastrar" value="cadastrar">
			</div>
		</form>
	</div>
	
	<div id="visualizar_quartos" class="opt_screen" style="display:none; border-style:solid; background-color:white">
		<table>
      <tr>
				<th>ID|</th>
        <th>quartoDesc|</th>
        <th>capacidad|</th>
        <th>quartoNum|</th>
        <th>setor|</th>
				<th>disponivel|</th>
      </tr>
                                        
    <?php
			$sql = "SELECT * FROM quarto INNER JOIN setor ON setor.setorid=quarto.setorid";
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








