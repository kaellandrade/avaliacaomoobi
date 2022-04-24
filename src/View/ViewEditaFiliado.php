<?php

namespace Micaelandrade\Avaliacao\View;
/**
 * View Responsável pela tela de edição de filiado.
 *
 * @author Micael andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial.
 * @version 1.0.2 Tornando a View estática.
 */
class ViewEditaFiliado implements View {

    /**
     * Rendiriza a tela de filiados para edição.
     *
     * @author Micael andrade micaelandrade@moobitech.com.br
     *
     * @param array $aDados
     * @return void
     *
     * @since 1.0.0 Renderiza dependentes.
     */
    public static function render(array $aDados): void {
        require '../src/View/template/editaFiliado.php';

    }
}