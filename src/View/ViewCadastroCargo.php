<?php

namespace Micaelandrade\Avaliacao\View;

/**
 * View Responsável pela tela de cadastro de filiado.
 *
 * @author Micael andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial.
 * @version 1.0.2 Tornando a view estática.
 */
class ViewCadastroCargo implements View {

    /**
     * Método responsável por renderizar o templete.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param array $aDados
     * @return void
     * @since 1.0.0 Versionamento inicial.
     */
    public static function render(array $aDados): void {
        require '../src/View/template/cadastroCargo.php';
        require '../src/View/template/tabelaCargo.php';
    }

    /**
     * Renderizando os cargos como opções para cadasatro de filiados.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @param array $aCargos
     * @return void
     * @since 1.0.0
     */
    public static function renderCargos(array $aCargos = []): void {
        foreach ($aCargos as $key => $cargo) {
            echo "<option name='$cargo[id]' value='$cargo[id]'>$cargo[nome]</option>" . PHP_EOL;
        }
    }

    /**
     * Renderiza todos os cargos cadastrado no banco.
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param array $aDados
     * @return void
     * @since 1.0.0
     */
    public static function renderTableCargo(array $aDados): void {
        foreach ($aDados as $key => $aCargo) {
            ['id' => $sId, 'nome' => $sNome] = $aCargo;
            echo "<tr>
                        <th scope='row'>$sId</th>
                        <td>$sNome</td>
                        <td class='text-center' > 
                            <a data-bs-toggle='modal'  data-cargo='$sId' data-bs-target='#modalCargo' data-nome='$sNome'  class='btn btn-warning btn-sm'> 
                                <i class='bi bi-pencil-square'></i>
                            </a>
                        </td>
                         <td class='text-center'>  
                         <a data-tipo='cargo' data-bs-toggle='modal' data-id='$sId' data-bs-target='#modalExcluir'  type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='' data-remover='$sNome'><i class='bi bi-trash'></i></a>
                        </td>
                    </tr>";
        }
    }
}