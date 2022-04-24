<?php

namespace Micaelandrade\Avaliacao\View;

/**
 * View Cabeçalho.
 * @author Micael Andrade micaelandrademoobitech.com.br
 *
 * @version   1.0.0 Versão inicial.
 * @version    1.0.1 Renderizando cabecalhos diferentes.
 * @version   1.0.2 Utilizando apenas um cabeçalho.
 * @version   1.0.2 Tornando render estático.
 */
class ViewCabecalho implements View {

    /**
     * Método responsável por renderizar o cabeçalho.
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @param array $aDados
     * @return void
     */
    public static function render(array $aDados): void {
        include '../src/View/template/cabecalho.php';
    }
}