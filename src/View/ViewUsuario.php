<?php

namespace Micaelandrade\Avaliacao\View;

use Micaelandrade\Avaliacao\Infrastructure\Sistema;
use Micaelandrade\Avaliacao\Model\Usuario;

/**
 * View Responsável pela tela de cadastro de Usuário.
 *
 * @author Micael andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial.
 * @version 1.0.0 Tornando métodos render e update estáticos.
 */
class ViewUsuario implements View {

    /**
     * Método responsável por renderizar o templete de cadastro.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param array $aDados
     * @return void
     * @since 1.0.0 Versionamento inicial.
     */
    public static function render(array $aDados): void {
        require '../src/View/template/cadastroUsuario.php';
    }

    /**
     * Método responsável por listar os usuários conforme o template da tabela.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param array $aDados
     * @return void
     * @since 1.0.0 Versionamento inicial.
     */
    public static function listar(array $aDados): void {
        require '../src/View/template/tabelaUsuarios.php';
    }

    /**
     * Renderiza todos os usuários do banco de dados.
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param array $aDados
     * @return void
     *
     * @since 1.0.0 Renderiza usários.
     */
    public static function renderTable(array $aDados): void {
        /**
         * @var  int $key
         * @var  Usuario $oUsuario
         */
        foreach ($aDados as $oUsuario) {
            $sId = (string)$oUsuario->getIId();
            $sNome = Sistema::getUsuario()->getIId() === $oUsuario->getIId() ? 'Você' : $oUsuario->getSNome();
            $sAtivo = $oUsuario->isBAtivo() ? 'Sim' : 'Não';
            $sPerfil = $oUsuario->isAdministrador() ? 'Administrador' : 'Normal';
            $sLogin = $oUsuario->getSLogin();

            $classAtivo = $oUsuario->isBAtivo() ? 'ativo' : 'desativado';


            echo "<tr>
                        <th scope='row'>$sId</th>
                        <td>$sNome</td>
                        <td class='$classAtivo text-center'>$sAtivo</td>
                        <td class='text-center'>$sPerfil</td>
                        <td class='text-center'>$sLogin</td>
                         <td class='text-center'>  
                         <a data-bs-toggle='modal' data-tipo='usuario' data-id='$sId' data-bs-target='#modalExcluir'  type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='' data-remover='$sNome'><i class='bi bi-trash'></i></a>
                        </td>
                    </tr>";
        }
    }
}