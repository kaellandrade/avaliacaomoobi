<?php

namespace Micaelandrade\Avaliacao\View;

use Micaelandrade\Avaliacao\Infrastructure\Sessao;
use Micaelandrade\Avaliacao\Infrastructure\Sistema;

/**
 * View Rodapé.
 *
 * @author Micael Andrade micaelandrademoobitech.com.br
 *
 * @version   1.0.0 Versão inicial.
 * @version    1.0.1 Renderizando cabecalhos diferentes.
 * @version   1.0.2 Utilizando apenas um cabeçalho.
 * @version   1.0.2 Tornando render estático.
 */
class ViewRodape implements View {

    /**
     * Método responsável por renderizar o rodapé da aplicação.
     *
     * Além de renderizar o rodapé também limpamos o Cache de mensagens salvas na sessão.
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @param array $aDados
     * @return void
     */
    public static function render(array $aDados): void {
        Sessao::limpaMensagem();
        include '../src/View/template/rodape.php';

    }
}