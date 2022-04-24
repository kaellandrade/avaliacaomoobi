<?php

namespace Micaelandrade\Avaliacao\View;

/**
 * View Responsável pela tela de cadastro de filiado.
 *
 * @author Micael andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial.
 * @version 1.0.2 Tornando a view estática.
 */
class ViewCadastroFiliado implements View {

    /**
     * Método responsável por renderizar a tela de castro.
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @param array $aDados
     * @return void
     */
    public static function render(array $aDados): void {
        require '../src/View/template/cadastroFiliado.php';
    }

}