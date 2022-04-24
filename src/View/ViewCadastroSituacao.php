<?php

namespace Micaelandrade\Avaliacao\View;


/**
 * View Responsável pela tela de cadastro das situações do filiado.
 *
 * @author Micael andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial.
 * @version 1.0.1 Tornando os métodos estático.
 */
class ViewCadastroSituacao implements View {

    /**
     * Método responsável por renderizar o templete.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param array $aDados
     * @return void
     * @since 1.0.0 Versionamento inicial.
     */
    public static function render(array $aDados): void {
        require '../src/View/template/cadastroSituacao.php';
        require '../src/View/template/tabelaSituacoes.php';
    }

    /**
     * Recebe uma lista de situacoes e renderiza na tela.
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param array $aSituacao
     * @return void
     */
    public static function renderSituacoes(array $aSituacao = []): void {
        foreach ($aSituacao as $key => $situacao) {
            echo "<option name='$situacao[id]' value='$situacao[id]'>$situacao[nome]</option>" . PHP_EOL;
        }
    }

    /**
     * Rendiriza todas situações do banco de dados.
     *
     * @param array $aDados
     * @return void
     *
     * @since 1.0.0 Renderiza situações.
     */
    public static function renderTableSituacoes(array $aDados): void {
        foreach ($aDados as $key => $aSituacao) {
            ['id' => $sId, 'nome' => $sNome] = $aSituacao;
            echo "<tr>
                        <th scope='row'>$sId</th>
                        <td>$sNome</td>
                        <td  class='text-center'> 
                            <a data-bs-toggle='modal'  data-situacao='$sId' data-bs-target='#modalSituacao' data-nome='$sNome' class='btn btn-warning btn-sm' > 
                                <i class='bi bi-pencil-square'></i>
                            </a>
                        </td>
                         <td class='text-center'>  
                         <a data-tipo='situacao' data-bs-toggle='modal' data-id='$sId' data-bs-target='#modalExcluir'  type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='' data-remover='$sNome'><i class='bi bi-trash'></i></a>
                        </td>
                    </tr>";
        }
    }
}