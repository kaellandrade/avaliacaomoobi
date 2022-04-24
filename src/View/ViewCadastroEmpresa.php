<?php

namespace Micaelandrade\Avaliacao\View;


/**
 * View Responsável pela tela de cadastro de Empresas.
 *
 * @author Micael andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial.
 * @version 1.0.2 Tornando a view estática.
 */
class ViewCadastroEmpresa implements View {

    /**
     * Método responsável por renderizar o templete.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param array $aDados
     * @return void
     * @since 1.0.0 Versionamento inicial.
     */
    public static function render(array $aDados): void {
        include '../src/View/template/cadastroEmpresas.php';
        include '../src/View/template/tabelaEmpresa.php';
    }

    /**
     * Recebe uma lista de empresas e lista na tela como opções (select).
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @param array $aEmpresas
     * @return void
     */
    public static function renderEmpresas(array $aEmpresas = []): void {
        foreach ($aEmpresas as $key => $empresa) {
            echo "<option name='$empresa[id]' value='$empresa[id]'>$empresa[nome]</option>" . PHP_EOL;
        }
    }

    /**
     * Rendiriza todas empresas do banco de dados.
     *
     * @param array $aDados
     * @return void
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @since 1.0.0 Renderiza empresas.
     */
    public static function renderTableEmpresas(array $aDados): void {
        foreach ($aDados as $key => $aEmpresa) {
            ['id' => $sId, 'nome' => $sNome] = $aEmpresa;
            echo "<tr>
                        <th scope='row'>$sId</th>
                        <td>$sNome</td>
                        <td class='text-center'> 
                            <a data-bs-toggle='modal'  data-empresa='$sId' data-bs-target='#modalEmpresa' data-nome='$sNome'  class='btn btn-warning btn-sm' > 
                                <i class='bi bi-pencil-square'></i>
                            </a>
                        </td>
                         <td class='text-center'>  
                         <a data-bs-toggle='modal' data-id='$sId' data-bs-target='#modalExcluir' type='button' class='btn btn-danger btn-sm btn-block' data-toggle='modal' data-target='' data-tipo='empresa' data-remover='$sNome'><i class='bi bi-trash'></i></a>
                        </td>
                    </tr>";
        }
    }
}