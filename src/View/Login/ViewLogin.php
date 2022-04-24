<?php
namespace Micaelandrade\Avaliacao\View\Login;

use Micaelandrade\Avaliacao\View\View;
/**
 * View Login.
 *
 * @author Micael Andrade micaelandrademoobitech.com.br
 * @version 1.0.0 Versão inicial
 */
class ViewLogin implements View
{

    /**
     * Método responsável por renderizar a tela de login.
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @param array $aDados
     * @return void
     */
    public static function render(array $aDados): void
    {
        require '../src/View/template/telaLogin.php';
    }

    public static function update(array $aDados): void
    {
        require '../src/View/template/telaLogin.php';
    }
}