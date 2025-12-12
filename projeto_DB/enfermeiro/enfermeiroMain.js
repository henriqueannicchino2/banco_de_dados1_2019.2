function hideAll() {
	$("#visualizar_paci").css("display","none");
	$("#visualizar_medi").css("display","none");
	$("#medicamento_retirar").css("display","none");
}

$(document).ready(function() {
	//ao clicar em visualizar pacientes
	$("#btn_paci").click(function() {
		hideAll();
		$("#visualizar_paci").css("display","block");		
	});
	//ao clicar em visualizar medicamentos
	$("#btn_medi").click(function() {
		hideAll();
		$("#visualizar_medi").css("display","block");		
	});
	//ao clicar em visualizar retirar medicamento
	$("#btn_Rmedi").click(function() {
		hideAll();
		$("#medicamento_retirar").css("display","block");		
	});
});