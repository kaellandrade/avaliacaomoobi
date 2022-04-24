<?php

namespace Micaelandrade\Avaliacao\View;


use DateTime;
use Micaelandrade\Avaliacao\Model\Filiado;

/**
 * View Responsável pela tela de listagem dos Filiados.
 *
 * @author Micael andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial.
 * @version 1.0.0 Tornando métodos render e update estáticos.
 */
class ViewListagemFiliado implements View {

    /**
     * Rendiriza a teabela de edição de filiados.
     *
     * @author Micael andrade micaelandrade@moobitech.com.br
     *
     * @param array $aDados
     * @return void
     *
     * @since 1.0.0 Renderiza dependentes.
     */
    public static function render(array $aDados): void {
        require '../src/View/template/tabelaFiliado.php';
    }

    /**
     * Renderiza todos os filiados do banco de dados.
     *
     * @param array $aDados
     * @return void
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @throws \Exception
     * @since 1.0.0 Renderiza filiados.
     */
    public static function renderTable(array $aDados): void {
        /**
         * @var  int $key
         * @var  Filiado $aFiliado
         */
        foreach ($aDados as $key => $aFiliado) {
            $dataFormatada = date_format(new DateTime($aFiliado->getSDataNascimento()), 'd/m/Y');
            $sId = (string)$aFiliado->getIId();
            $sCelular = $aFiliado->getSCelular();
            $sNome = $aFiliado->getSNome();

            echo "<tr>
                        <th scope='row'>$sId</th>
                        <td>$sNome</td>
                        <td class='celular'>$sCelular</td>
                        <td>$dataFormatada</td>
                        <td class='text-center'> 
                            <a href='/edita/filiado?id=$sId' type='button' class='btn btn-warning btn-sm' > 
                                <i class='bi bi-pencil-square'></i>
                            </a>
                        </td>
                         <td class='text-center'>  
                         <a data-bs-toggle='modal' data-tipo='filiado' data-id='$sId' data-bs-target='#modalExcluir'  type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='' data-remover='$sNome'><i class='bi bi-trash'></i></a>
                        </td>
                        <td class='text-center'>
                            <a data-bs-toggle='modal'  data-filiado='$sId' data-bs-target='#modalFiliado' data-nome='$sNome'  class='btn btn-success btn-sm'><i class='bi bi-plus'></i></a>
                        </td>
                        <td class='text-center'>
                            <a href='/visualizar/dependentes?idFlo=$sId'   class='btn btn-primary btn-sm'><i class='bi bi-person-lines-fill'></i></a>
                        </td>

                    </tr>";
        }
    }


    /**
     * Função responsável por renderizar os links de paginação.
     * 
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param int $iNumeroDePaginas
     * @param int $iPaginaAtual
     * @return void
     * @since  1.0.0 Versão inicial
     * @Since 1.0.1 Passando o numero de páginas ao invés de linhas.
     */
    public static function renderPagination(int $iNumeroDePaginas, int $iPaginaAtual): void {
        $TOTAL_LINKS = $iNumeroDePaginas > LIMITE_MAXIMO_LINKS_PAGINACAO - 2 ? LIMITE_MAXIMO_LINKS_PAGINACAO - 2 : $iNumeroDePaginas;
        if ($iPaginaAtual > 2) { // Renderizando os links anteriores.
            $iUtima = $iPaginaAtual - 1;
            $iPenultima = $iPaginaAtual - 2;
            echo "<li class='page-item'><a class='page-link' href='/visualizar/filiados?pagina=$iPenultima'>$iPenultima</a></li>";
            echo "<li class='page-item'><a class='page-link' href='/visualizar/filiados?pagina=$iUtima'>$iUtima</a></li>";
        }

        if ($iPaginaAtual >= $iNumeroDePaginas) return; // não há mais links para ser renderizados.

        for ($i = 1; $i <= $TOTAL_LINKS; $i++) {
            $valor = $i + $iPaginaAtual;
            if ($valor <= $iNumeroDePaginas) echo "<li class='page-item'><a class='page-link' href='/visualizar/filiados?pagina=$valor'>$valor</a></li>";
        }

    }
}