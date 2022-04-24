<?php

namespace Micaelandrade\Avaliacao\Controller;


use Micaelandrade\Avaliacao\Infrastructure\Sessao;
use Micaelandrade\Avaliacao\Infrastructure\Sistema;
use Micaelandrade\Avaliacao\Infrastructure\ValidaDados;
use Micaelandrade\Avaliacao\Model\Dao\DaoSituacao;
use Micaelandrade\Avaliacao\Model\Situacao;
use Micaelandrade\Avaliacao\View\ViewCabecalho;
use Micaelandrade\Avaliacao\View\ViewCadastroSituacao;
use Micaelandrade\Avaliacao\View\ViewRodape;
use PDOException;

/**
 * Controller para Situações dos Filiados.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 *
 * @version 1.0.0 Versão inicial.
 * @version 1.0.1 Ajustes layout.
 */
class SituacaoController {

    /**
     * Mostra a tela de cadastro para novas Situações possíveis
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @since 1.0.0 Versão inicial
     */
    public function telaCadastroSituacao() {
        $oDaoSituacoes = new DaoSituacao();
        $aDados['usuario'] = Sistema::getUsuario();
        $aDados['mensagem'] = Sessao::getMensagem();
        $aDados['titulo'] = 'Cadastro de situações';

        $aDados['situacoes'] = $oDaoSituacoes->findAll();

        ViewCabecalho::render($aDados);
        ViewCadastroSituacao::render($aDados);
        ViewRodape::render($aDados);
    }

    /**
     * Remove uma Situação.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @since 1.0.0 Versão inicial
     */
    public function removeSituacao() {

        try {
            if ($id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)) {
                Situacao::removerPorId($id);
                Sessao::setMensagem('Sucesso!', 'Situação removida!', STATUS_SUCESSO);
            }

        } catch (PDOException $exceptionType) {
            Sessao::setMensagem('Erro!', 'Não foi possivel remover a situação!', STATUS_CUIDADO);
        } catch (\TypeError $exceptionType) {
            Sessao::setMensagem('Erro!', 'id inválido!', STATUS_CUIDADO);
        } finally {
            Sistema::redireciona('/cadastro/situacao');
        }

    }

    /**
     * Cadastra uma Situação.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @since 1.0.0 Versão inicial
     */
    public function cadastraSituacao() {
        $sNome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!ValidaDados::arrayDadosValidos([$sNome])) {
            Sessao::setMensagem('Erro!', 'Não foi possível cadastar, dados inválidos.', STATUS_PERIGO);
            Sistema::redireciona('/cadastro/situacao');
            die();
        }

        try {
            $oSituacao = new Situacao($sNome, null);
            $oSituacao->salvar();
            Sessao::setMensagem('Salvo!', 'Situação cadastrada com sucesso!.');

        } catch (\PDOException $oEx) {
            Sessao::setMensagem('Erro!', 'Não foi possivel salvar essa situação.', STATUS_CUIDADO);
        }
        Sistema::redireciona('/cadastro/situacao');

    }

    /**
     * Atualiza uma Situação.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @since 1.0.0 Versão inicial
     */
    public function atualizaSituacao(): void {
        try {
            $sNome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $id = filter_input(INPUT_POST, 'idSituacao', FILTER_SANITIZE_NUMBER_INT);


            if (!ValidaDados::arrayDadosValidos([$sNome, $id])) {
                Sessao::setMensagem('Erro!', 'Não foi possível atualizar esta situação, dados inválidos.', STATUS_PERIGO);
                Sistema::redireciona('/cadastro/situacao');
                die();
            }

            $oSituacao = new Situacao($sNome, $id);
            $oSituacao->atualizar();
            Sessao::setMensagem('Sucesso!', 'Situação Atualizada!', STATUS_SUCESSO);

        } catch (\PDOException $exceptionPdo) {
            Sessao::setMensagem('Erro!', 'Não foi possível atulizar a situação (Erro interno)!', STATUS_CUIDADO);
        } catch (\Exception $exception) {
            Sessao::setMensagem('Erro!', 'Não foi possível atualizar a situação!', STATUS_PERIGO);
        } finally {
            Sistema::redireciona('/cadastro/situacao');
        }
    }

}