<?php

namespace Micaelandrade\Avaliacao\View;

use Micaelandrade\Avaliacao\Model\Dependente;
/**
 * View Responsável pela tela Dependentes.
 *
 * @author Micael andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial.
 * @version 1.0.1 Tornando os métodos estático.
 */
class ViewDependente implements View {

    /**
     * Rendiriza a tela de dependentes.
     *
     * @author Micael andrade micaelandrade@moobitech.com.br
     *
     * @param array $aDados
     * @return void
     *
     * @since 1.0.0 Renderiza dependentes.
     */
    public static function render(array $aDados): void {
        require '../src/View/template/listaDependentes.php';

    }


    /**
     * Rendiriza dependentes.
     *
     * @author Micael andrade micaelandrade@moobitech.com.br
     *
     * @param array $aDados
     * @return void
     *
     * @since 1.0.0 Renderiza dependentes.
     */
    public static function renderTable(array $aDados): void {
        /**
         * @var  int $key
         * @var  Dependente $oDependente
         */
        foreach ($aDados as $key => $oDependente) {
            $sId = (string)$oDependente->getIId();
            $sNome = $oDependente->getSNome();
            $sGrau = $oDependente->getIParentesco();

            echo "<tr>
                        <th scope='row'>$sId</th>
                        <td>$sNome</td>
                        <td class='text-center'>$sGrau</td>
                         <td class='text-center'>  
                         <a  data-bs-toggle='modal' data-tipo='dependente' data-id='$sId' data-bs-target='#modalExcluir'  type='button' class='btn btn-danger btn-sm text-center' data-toggle='modal' data-target='' data-remover='$sNome'><i class='bi bi-trash'></i></a>
                        </td>
                    </tr>";
        }
    }
}