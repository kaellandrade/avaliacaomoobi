/**
 * Função do jquery que será lida assim que a página
 * for carregada. (Iniciando todas a outras funções);
 */
$(document).ready(_ => {
    recuperavalorDoModal();
    toggleBtnFiltro();


    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.celular').mask('(00) 0-0000-0000');
    $('.telefone').mask('0#');
    $('.rg').mask('0#');
    $('.nome').mask('0000000000000000000000000000000000000000000000000000', {'translation': {0: {pattern: /[a-z]|[A-Z]|\W/}}});
});