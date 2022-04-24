<?php
namespace Micaelandrade\Avaliacao\View;

/**
 * Interface para as Views
 *
 * @author Micael Andrade micaelandrademoobitech.com.br
 * @version 1.0.0 Versão inicial
 * @version 1.0.1 Tornando os métodos estáticos.
 */
interface View
{
    public static function render(array $aDados):void;
}