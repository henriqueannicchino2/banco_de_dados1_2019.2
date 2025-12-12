function hideAll() {
	$("#usuario_opt").css("display","none");
	$("#cadastrar_usu").css("display","none");
	$("#departamento_opt").css("display","none");
	$("#visualizar_usu").css("display","none");
	$("#deletar_usu").css("display","none");
	$("#cadastrar_dept").css("display","none");
	$("#visualizar_dpt").css("display","none");
	$("#deletar_dpt").css("display","none");
	$("#setor_opt").css("display","none");
	$("#cadastrar_setor").css("display","none");
	$("#visualizar_setor").css("display","none");
	$("#deletar_setor").css("display","none");
	$("#clinica_opt").css("display","none");
	$("#cadastrar_clinica").css("display","none");
	$("#visualizar_clinica").css("display","none");
	$("#deletar_clinica").css("display","none");
	$("#paciente_opt").css("display","none");
	$("#cadastrar_paci").css("display","none");
	$("#visualizar_paci").css("display","none");
	$("#deletar_paci").css("display","none");
	$("#medicamento_opt").css("display","none");
	$("#cadastrar_medi").css("display","none");
	$("#visualizar_medi").css("display","none");
	$("#visualizar_medi_baixa").css("display","none");
	$("#repor_medi").css("display","none");
	$("#quarto_opt").css("display","none");
	$("#cadastrar_quarto").css("display","none");
	$("#visualizar_quartos").css("display","none");
}

$(document).ready(function() {
	//ao clicar em usuario
	$("#btn_usu").click(function() {
		hideAll();
		$("#usuario_opt").css("display","block");		
	});
	//ao clicar em cadastrar_usuario
	$("#N_usu").click(function() {
		hideAll();
		$("#cadastrar_usu").css("display","block");	
	});
	//ao clicar em visualizar usuarios
	$("#V_usu").click(function() {
			hideAll();
			$("#visualizar_usu").css("display","block");	
	});
	//ao clicar em deletar usuario
	$("#D_usu").click(function() {
		hideAll();
		$("#deletar_usu").css("display","block");	
	});
	//ao clicar em departamento
	$("#btn_dpt").click(function() {
		hideAll();
		$("#departamento_opt").css("display","block");
	});
	//ao clicar em cadastrar_departamento
	$("#N_dpt").click(function() {
		hideAll();
		$("#cadastrar_dept").css("display","block");	
	});
	//ao clicar em visualizar departamento
	$("#V_dpt").click(function() {
		hideAll();
		show1=0;
		$("#visualizar_dpt").css("display","block");		
	});
	//ao clicar em deletar departamento
	$("#D_dpt").click(function() {
		hideAll();
		$("#deletar_dpt").css("display","block");		
	});
	//ao clicar setor
	$("#btn_setor").click(function() {
		hideAll();
		$("#setor_opt").css("display","block");			
	});
	//ao clicar em cadastrar setor
	$("#N_setor").click(function() {
		hideAll();
		$("#cadastrar_setor").css("display","block");		
	});
	//ao clicar em visualizar setores
	$("#V_setor").click(function() {
		hideAll();
		$("#visualizar_setor").css("display","block");		
	});
	//ao clicar em deletar setor
	$("#D_setor").click(function() {
		hideAll();
		$("#deletar_setor").css("display","block");	
	});
	//ao clicar em clinica
	$("#btn_clini").click(function() {
		hideAll();
		$("#clinica_opt").css("display","block");	
	});
	//ao clicar em cadastrar clinica
	$("#N_clini").click(function() {
		hideAll();
		$("#cadastrar_clinica").css("display","block");			
	});
	//ao clicar em visualizar clinicas
	$("#V_clini").click(function() {
		hideAll();
		$("#visualizar_clinica").css("display","block");		
	});
	//ao clicar em deletar clinica
	$("#D_clini").click(function() {
		hideAll();
		$("#deletar_clinica").css("display","block");	
	});
	//ao clicar em pacientes
	$("#btn_paci").click(function() {
		hideAll();
		$("#paciente_opt").css("display","block");			
	});
	//ao clicar em cadastrar paciente
	$("#N_paci").click(function() {
		hideAll();
		$("#cadastrar_paci").css("display","block");		
	});
	//ao clicar em visualizar paciente
	$("#V_paci").click(function() {
		hideAll();
		$("#visualizar_paci").css("display","block");		
	});
	//ao clicar em deletar paciente
	$("#D_paci").click(function() {
		hideAll();
		$("#deletar_paci").css("display","block");		
	});
	//ao clicar em medicamento
	$("#btn_medicamento").click(function() {
		hideAll();
		$("#medicamento_opt").css("display","block");	
	});
	//ao clicar em cadastrar medicamento
	$("#N_medi").click(function() {
		hideAll();
		$("#cadastrar_medi").css("display","block");		
	});
	//ao clicar em visualizar medicamentos
	$("#V_medi").click(function() {
		hideAll();
		$("#visualizar_medi").css("display","block");	
	});
	//ao clicar em visualizar medicamentos
	$("#B_medi").click(function() {
		hideAll();
		$("#visualizar_medi_baixa").css("display","block");		
	});
	//ao clicar em repor medicamento
	$("#R_medi").click(function() {
		hideAll();
		$("#repor_medi").css("display","block");	
	});
	//ao clicar em quartos
	$("#btn_quarto").click(function() {
		hideAll();
		$("#quarto_opt").css("display","block");	
	});
	//ao clicar em cadastrar quarto
	$("#N_quarto").click(function() {
		hideAll();
		$("#cadastrar_quarto").css("display","block");	
	});
	//ao clicar em visualizar quartos
	$("#V_quarto").click(function() {
		hideAll();
		$("#visualizar_quartos").css("display","block");	
	});
});

function UcheckAll(){
	document.getElementById('rd1').checked = false;
	document.getElementById('rd2').checked = false;
	document.getElementById('rd3').checked = false;
	document.getElementById('rd4').checked = false;
}

function show_input(X){
	if(X==0){
		UcheckAll();
		document.getElementById('rd1').checked = true;
		$("#dataCon").css("display","none");
		$("#anosXp").css("display","none");
		$("#setor").css("display","none");
		$("#dept").css("display","none");
		$("#descAb").css("display","none");
	}
	else if(X==1){
		UcheckAll();
		document.getElementById('rd2').checked = true;
		$("#dataCon").css("display","inline-block");
		$("#anosXp").css("display","inline-block");
		$("#setor").css("display","inline-block");
		$("#dept").css("display","inline-block");
		$("#descAb").css("display","inline-block");
	}
	else if(X==2){
		UcheckAll();
		document.getElementById('rd3').checked = true;
		$("#dataCon").css("display","inline-block");
		$("#anosXp").css("display","inline-block");
		$("#setor").css("display","inline-block");
		$("#dept").css("display","inline-block");
		$("#descAb").css("display","inline-block");
	}
	else if(X==3){
		UcheckAll();
		document.getElementById('rd4').checked = true;
		$("#dataCon").css("display","inline-block");
		$("#anosXp").css("display","inline-block");
		$("#setor").css("display","none");
		$("#dept").css("display","none");
	}
}



