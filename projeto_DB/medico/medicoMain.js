function hideAll() {
	$("#prescricao").css("display","none");	
	$("#visualizar_paci").css("display","none");
	$("#visualizar_tpaci").css("display","none");
	$("#visualizar_medi").css("display","none");
$("#visualizar_pres").css("display","none");			
}

$(document).ready(function() {
	//ao clicar em vender medicamento
	$("#btn_pres").click(function() {
		hideAll();
		$("#prescricao").css("display","block");		
	});
	//ao clicar em visualizar pacientes
	$("#btn_paci").click(function() {
		hideAll();
		$("#visualizar_paci").css("display","block");		
	});
	//ao clicar em visualizar todos os pacientes
	$("#btn_tpaci").click(function() {
		hideAll();
		$("#visualizar_tpaci").css("display","block");		
	});
	//ao clicar em visualizar medicamentos
	$("#btn_medi").click(function() {
		hideAll();
		$("#visualizar_medi").css("display","block");		
	});
	//ao clicar em visualizar prescricao
	$("#btn_Vpres").click(function() {
		hideAll();
		$("#visualizar_pres").css("display","block");		
	});
});