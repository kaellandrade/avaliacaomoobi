<?php

namespace Micaelandrade\Avaliacao\View;

/**
 * View Responsável pela tela do painel de Controle.
 *
 * @author Micael andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial.
 * @version 1.0.0 Tornando métodos render e update estáticos.
 */
class ViewPainel implements View {

    /**
     * Rendiriza o painel de Controle.
     *
     * @author Micael andrade micaelandrade@moobitech.com.br
     *
     * @param array $aDados
     * @return void
     *
     * @since 1.0.0 Renderiza dependentes.
     */
    public static function render(array $aDados): void {
        require '../src/View/template/painelDeControle.php';
    }
}