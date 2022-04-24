/**
 * Recupera os valores da tabela para o Modal na hora da excluir filiado.
 */
function recuperavalorDoModal() {
    //Modal genérico
    $('#modalExcluir').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var dados = button.data('remover') ;
        var id = button.data('id');
        var tipo = button.data('tipo'); // Pode ser uma empresa, usuário, filiado, cargo, situação.

        var modalExcluir = $(this);
        modalExcluir.find('#inputHidden').val(id);
        modalExcluir.find('.modal-title').text('Cuidado!');
        modalExcluir.find('#nome').text(dados);
        modalExcluir.find('#delete-form').attr('action', `/remove/${tipo}`);
    });

    //Modal add Dependentes
    $('#modalFiliado').on('show.bs.modal', function (event) {
        var btnEditarFiliado = $(event.relatedTarget);
        var nomeFiliado = btnEditarFiliado.data('nome') ;
        var idFiliado = btnEditarFiliado.data('filiado');

        var modalFiliado = $(this);

        modalFiliado.find('#idFiliadoHidden').val(idFiliado);

        modalFiliado.find('#nomeFiliado').text(nomeFiliado);
        modalFiliado.find('#dependente-form').attr('action', `/cadastro/dependente?id=${idFiliado}`);

    })

//    Modal Atualiza empresa
    $('#modalEmpresa').on('show.bs.modal', function (event) {
        const btnEditar = $(event.relatedTarget);
        const nomeEmpresa = btnEditar.data('nome') ;
        const empresaId = btnEditar.data('empresa');

        const modalEmpresa = $(this);

        modalEmpresa.find('#idEmpresaHidden').val(empresaId);
        modalEmpresa.find('#empresa-input').val(nomeEmpresa);
        modalEmpresa.find('#empresa-form').attr('action', `/edita/empresa`);

    })
//    Modal Atualizar situação
    $('#modalSituacao').on('show.bs.modal', function (event) {
        const btnEditarSituacao = $(event.relatedTarget);
        const situacao = btnEditarSituacao.data('nome') ;
        const situacaoId = btnEditarSituacao.data('situacao');

        const modalSituacao = $(this);

        modalSituacao.find('#idSituacaoHidden').val(situacaoId);
        modalSituacao.find('#idSituacao').val(situacaoId);
        modalSituacao.find('#situacao-input').val(situacao);
        modalSituacao.find('#situacao-form').attr('action', `/edita/situacao?id=${situacaoId}`);

    })

    //    Modal Atualizar cargo
    $('#modalCargo').on('show.bs.modal', function (event) {
        const btnEditarCargo = $(event.relatedTarget);
        const cargo = btnEditarCargo.data('nome') ;
        const cargoId = btnEditarCargo.data('cargo');

        const modalSituacao = $(this);

        modalSituacao.find('#idCargoHidden').val(cargoId);
        modalSituacao.find('#idSituacao').val(cargoId);
        modalSituacao.find('#cargo-input').val(cargo);
        modalSituacao.find('#cargo-form').attr('action', `/edita/cargo`);

    })


}


/**
 * Toogle O botão filtro só estará disponível caso um dos dois checkbox for ativado.
 */
function toggleBtnFiltro() {
    let btnSubmit = $('.btn-filter');

    let checkBoxName = $('#nome-checkbox');
    let checkBoxDate = $('#data-checkbox');
    let nameFilter = $('#name-filter');

    checkBoxName.on('change', function (event) {
        if (event.target.checked || checkBoxDate.is(':checked')) {
            btnSubmit.removeClass('disabled');
        } else {
            btnSubmit.addClass('disabled');
        }
    })
    checkBoxDate.on('change', function (event) {
        if (event.target.checked || checkBoxName.is(':checked')) {
            checkBoxDate.prop('checked',true);
            btnSubmit.removeClass('disabled');
        } else {
            btnSubmit.addClass('disabled');
        }
    })
    nameFilter.on('input', function (event){
        if(event.target.value.length > 0){
            checkBoxName.prop('checked',true);
            btnSubmit.removeClass('disabled');
        }else{
            checkBoxName.prop('checked',false);

        }
    })
}
