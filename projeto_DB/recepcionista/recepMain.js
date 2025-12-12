function hideAll() {
	$("#medicamento_venda").css("display","none");
	$("#visualizar_medi").css("display","none");
	$("#cadastrar_paci").css("display","none");		
	$("#visualizar_paci").css("display","none");
$("#visualizar_quarto").css("display","none");	
}

$(document).ready(function() {
	//ao clicar em vender medicamento
	$("#btn_vender").click(function() {
		hideAll();
		$("#medicamento_venda").css("display","block");		
	});
	//ao clicar em estoque medicamento
	$("#btn_medi").click(function() {
		hideAll();
		$("#visualizar_medi").css("display","block");		
	});
	//ao clicar em cadastrar paciente
	$("#btn_Npaci").click(function() {
		hideAll();
		$("#cadastrar_paci").css("display","block");		
	});
	//ao clicar em visualizar paciente
	$("#btn_Vpaci").click(function() {
		hideAll();
		$("#visualizar_paci").css("display","block");		
	});
	//ao clicar em visualizar quartos
	$("#btn_Vquarto").click(function() {
		hideAll();
		$("#visualizar_quarto").css("display","block");		
	});
});




