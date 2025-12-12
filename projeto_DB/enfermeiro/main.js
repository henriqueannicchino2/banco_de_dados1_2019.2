$(document).ready(function() {
 var botao = $('.bt1');//classe no "a" que vai ser clicado
 var dropDown = $('.ul-noticias');//classe do submenu que vai abrir

    botao.on('click', function(event){
        dropDown.stop(true,true).slideToggle();
        event.stopPropagation();
    });
});

$(document).ready(function() {
 var botao = $('.bt2');//classe no "a" que vai ser clicado
 var dropDown = $('.ul-entret');//classe do submenu que vai abrir

    botao.on('click', function(event){
        dropDown.stop(true,true).slideToggle();
        event.stopPropagation();
    });
});

$(document).ready(function() {
 var botao = $('.bt3');//classe no "a" que vai ser clicado
 var dropDown = $('.ul-fale-c');//classe do submenu que vai abrir

    botao.on('click', function(event){
        dropDown.stop(true,true).slideToggle();
        event.stopPropagation();
    });
});