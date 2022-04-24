<?php

namespace Micaelandrade\Avaliacao\Controller;

use Micaelandrade\Avaliacao\Infrastructure\Sessao;
use Micaelandrade\Avaliacao\Infrastructure\Sistema;
use Micaelandrade\Avaliacao\Infrastructure\ValidaDados;
use Micaelandrade\Avaliacao\Model\Dependente;
use Micaelandrade\Avaliacao\Model\Filiado;
use Micaelandrade\Avaliacao\View\ViewCabecalho;
use Micaelandrade\Avaliacao\View\ViewDependente;
use Micaelandrade\Avaliacao\View\ViewRodape;

/**
 * Controller para os dependentes.
 *
 * @version 1.0.0 Primeira Versão
 * @version 1.0.2 Listando dependentes.
 * @version 1.0.3 Ajustes de layouts e documentação.
 */
class DependenteController {

    /**
     * Ação responsável por salvar um novo dependente.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @since   1.0.0 Versão inicial.
     */
    public function cadastrarDependente(): void {
        $sNome = filter_input(INPUT_GET, 'nome', FILTER_DEFAULT);
        $sDataNascimento = filter_input(INPUT_GET, 'nascimento', FILTER_DEFAULT);
        $iGrau = filter_input(INPUT_GET, 'grauDeparentesco', FILTER_SANITIZE_NUMBER_INT);
        $iIdFiliado = filter_input(INPUT_GET, 'idFiliado', FILTER_SANITIZE_NUMBER_INT);

        if (!ValidaDados::arrayDadosValidos([$sNome, $sDataNascimento, $iGrau, $iIdFiliado])) {
            Sessao::setMensagem('Error!', 'Dados inválidos!', STATUS_CUIDADO);
            Sistema::redireciona('/visualizar/filiados');
            die();
        }
        try {
            $oDependente = new Dependente(null, $sNome, $iGrau, $sDataNascimento);

            Filiado::salvarDependente((int)$iIdFiliado, $oDependente);
            Sessao::setMensagem('Sucesso!', 'Dependente cadastrado!', STATUS_SUCESSO);

        } catch (\PDOException $exception) {
            Sessao::setMensagem('Error!', 'Não foi possível salvar o dependente verifique os dados e tenten novamente.', STATUS_PERIGO);
        } finally {
            Sistema::redireciona('/visualizar/filiados');
        }


    }

    /**
     * Ação responsável pela tela de listagem de dependentes.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @since   1.0.0 Versão inicial.
     */
    public function visualizarDependentes(): void {
        $aDados['usuario'] = Sistema::getUsuario();
        $aDados['titulo'] = 'Ver dependentes';

        $idFiliado = filter_input(INPUT_GET, 'idFlo', FILTER_VALIDATE_INT);

        if (!$idFiliado) {
            Sessao::setMensagem('Error!', "Id inválido.", STATUS_CUIDADO);
            Sistema::redireciona('/visualizar/filiados');
            die();
        }
        try {
            $dePendentes = Filiado::todosDependentes($idFiliado);
            $aDados['dependentes'] = $dePendentes;
        } catch (\PDOException $exception) {
            Sessao::setMensagem('Error!', 'Não foi possível listar os dependentes!', STATUS_CUIDADO);
            Sistema::redireciona('/visualizar/filiados');
            die();
        }

        ViewCabecalho::render($aDados);
        ViewDependente::render($aDados);
        ViewRodape::render([]);
    }

    /**
     * Ação responsável por remover um dependente.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @since   1.0.0 Versão inicial.
     */
    public function removerDependente(): void {

        $idDependente = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if (!$idDependente) {
            Sessao::setMensagem('Error!', "Id inválido.", STATUS_CUIDADO);
            Sistema::redireciona("/visualizar/filiados");
            die();
        }

        try {
            Filiado::removeDependentePorId($idDependente);
            Sessao::setMensagem('Sucesso!', 'Dependente removido!', STATUS_SUCESSO);
        } catch (\PDOException $exception) {
            Sessao::setMensagem('Erro!', 'Não foi possível remover o dependente!', STATUS_CUIDADO);
            die();
        } finally {
            Sistema::redireciona('/visualizar/filiados');
        }

    }
}