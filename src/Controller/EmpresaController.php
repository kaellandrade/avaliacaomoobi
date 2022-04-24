<?php

namespace Micaelandrade\Avaliacao\Controller;


use Micaelandrade\Avaliacao\Infrastructure\Sessao;
use Micaelandrade\Avaliacao\Infrastructure\Sistema;
use Micaelandrade\Avaliacao\Infrastructure\ValidaDados;
use Micaelandrade\Avaliacao\Model\Dao\DaoEmpresa;
use Micaelandrade\Avaliacao\Model\Empresa;
use Micaelandrade\Avaliacao\View\ViewCabecalho;
use Micaelandrade\Avaliacao\View\ViewCadastroEmpresa;
use Micaelandrade\Avaliacao\View\ViewRodape;
use PDOException;

/**
 * Controller para empresas.
 *
 * @version 1.0.0 Primeira Versão
 * @version 1.0.3 Ajustes de layouts e documentação.
 */
class EmpresaController {

    /**
     * Ação responsável por mostrar a tela de cadastro de empresas.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return void
     * @since   1.0.0 Versão inicial.
     * @return void
     */
    public function telaCadastroEmpresa() {
        $oDaoEmpresa = new DaoEmpresa();
        $aDados['usuario'] = Sistema::getUsuario();
        $aDados['mensagem'] = Sessao::getMensagem();
        $aDados['titulo'] = 'Cadastro de empresas';
        $aDados['empresas'] = $oDaoEmpresa->findAll();


        ViewCabecalho::render($aDados);
        ViewCadastroEmpresa::render($aDados);
        ViewRodape::render([]);
    }

    /**
     * Ação responsável por remover uma empresa.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return void
     * @since   1.0.0 Versão inicial.
     * @return void
     */
    public function removeEmpresa() {

        try {
            if ($idEmpresa = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT)) {
                Empresa::removerPorId($idEmpresa);
                Sessao::setMensagem('Sucesso!', 'Empresa removida!', STATUS_SUCESSO);
            }

        } catch (PDOException $exceptionType) {
            Sessao::setMensagem('Erro!', 'Não foi possível remover essa empresa!', STATUS_CUIDADO);
        } catch (\TypeError $exceptionType) {
            Sessao::setMensagem("Erro!", "id inválido!", STATUS_CUIDADO);
        } finally {
            Sistema::redireciona('/cadastro/empresa');
        }

    }

    /**
     * Ação responsável por atualizar uma empresa.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return void
     * @since   1.0.0 Versão inicial.
     * @return void
     */
    public function atualizaEmpresa(): void {
        try {
            $sNome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $id = filter_input(INPUT_POST, 'idEmpresa', FILTER_VALIDATE_INT);


            if (!ValidaDados::arrayDadosValidos([$sNome, $id])) {
                Sessao::setMensagem('Erro!', 'Não foi possível atualizar a empresa, dados inválidos.', STATUS_PERIGO);
                Sistema::redireciona('/cadastro/empresa');
                die();
            }

            $oEmpresa = new Empresa($sNome, $id);
            $oEmpresa->atualizar();
            Sessao::setMensagem('Sucesso!', 'Empresa Atualizada!', STATUS_SUCESSO);

        } catch (\PDOException $exceptionPdo) {
            Sessao::setMensagem('Error!', 'Não foi possível atulizar a empresa (Erro interno)!', STATUS_CUIDADO);
        } catch (\Exception $exception) {
            Sessao::setMensagem('Error!', 'Não foi possível salvar a empresa!', STATUS_PERIGO);
        } finally {
            Sistema::redireciona('/cadastro/empresa');
        }
    }

    /**
     * Ação responsável por cadastrar uma nova empresa.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return void
     * @since   1.0.0 Versão inicial.
     * @return void
     */
    public function cadastraEmpresa() {
        $sNome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!ValidaDados::arrayDadosValidos([$sNome])) {
            Sessao::setMensagem('Error!', 'Não foi possível salvar a empresa, dados inválidos.', STATUS_PERIGO);
            Sistema::redireciona('/cadastro/empresa');
            die();
        }

        try {
            (new Empresa($sNome, null))->salvar();
            Sessao::setMensagem('Salvo!', 'Nova empresa cadastrada!.');

        } catch (\PDOException $oEx) {
            Sessao::setMensagem('Erro!', 'Não foi possivel salvar essa empresa.', STATUS_CUIDADO);
        }
        Sistema::redireciona('/cadastro/empresa');

    }
}