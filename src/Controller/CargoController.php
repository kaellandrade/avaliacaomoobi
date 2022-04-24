<?php

namespace Micaelandrade\Avaliacao\Controller;

use Micaelandrade\Avaliacao\Infrastructure\Sessao;
use Micaelandrade\Avaliacao\Infrastructure\Sistema;
use Micaelandrade\Avaliacao\Infrastructure\ValidaDados;
use Micaelandrade\Avaliacao\Model\Cargo;
use Micaelandrade\Avaliacao\Model\Dao\DaoCargo;
use Micaelandrade\Avaliacao\View\ViewCabecalho;
use Micaelandrade\Avaliacao\View\ViewCadastroCargo;
use Micaelandrade\Avaliacao\View\ViewRodape;
use PDOException;

/**
 * Controller para cargos.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 *
 * @version 1.0.0 Versão inicial.
 * @version 1.0.1 Ajustes layout dos métodos.
 */
class CargoController {

    /**
     * Ação responsável por mostrar o cadastro de novos cargos.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @version  1.0.0 Versão inicial.
     */
    public function telaCadastroCargo() {
        $oDaoCargo = new DaoCargo();

        $aDados['usuario'] = Sistema::getUsuario();
        $aDados['mensagem'] = Sessao::getMensagem();
        $aDados['titulo'] = 'Cadastro de cargos';
        $aDados['cargo'] = $oDaoCargo->findAll();

        ViewCabecalho::render($aDados);
        ViewCadastroCargo::render($aDados);
        ViewRodape::render([]);

    }

    /**
     * Ação responsável por cadastrar um novo cargo.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @version  1.0.0 Versão inicial.
     * @version  1.0.1 Definindo a cláusula finally.
     */
    public function cadastraCargo() {
        ['nome' => $sNomeCargo] = Sistema::getFormulario();
        $oDaoCargo = new DaoCargo();

        try {
            $oDaoCargo->save($sNomeCargo);
            Sessao::setMensagem('Salvo!', 'Cargo cadastrada com sucesso!.');

        } catch (\PDOException $oEx) {
            Sessao::setMensagem('Erro ao cadastrar o cargo', 'Não foi possivel salvar esse cargo.', STATUS_CUIDADO);
        } finally {
            Sistema::redireciona('/cadastro/cargo');
        }
    }

    /**
     * Ação responsável por remover um novo cargo.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @version  1.0.0 Versão inicial.
     */
    public function removeCargo() {

        try {
            if ($id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)) {
                Cargo::removerPorId($id);
                Sessao::setMensagem('Sucesso!', 'Cargo removido!', STATUS_SUCESSO);
            }

        } catch (PDOException $exceptionType) {
            Sessao::setMensagem('Erro!', 'Não foi possivel remover o cargo!', STATUS_CUIDADO);
        } catch (\TypeError $exceptionType) {
            Sessao::setMensagem("Erro!", "id inválido!", STATUS_CUIDADO);
        } finally {
            Sistema::redireciona('/cadastro/cargo');
        }

    }

    /**
     * Ação responsável por atualizar um cargo.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @version  1.0.0 Versão inicial.
     */
    public function atualizaCargo(): void {
        try {
            $sNome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $id = filter_input(INPUT_POST, 'idCargo', FILTER_VALIDATE_INT);


            if (!ValidaDados::arrayDadosValidos([$sNome, $id])) {
                Sessao::setMensagem('Error!', 'Não foi possível atualizar este cargo. Dados inválidos.', STATUS_PERIGO);
                Sistema::redireciona('/cadastro/cargo');
                die();
            }

            $oCargo = new Cargo($sNome, $id);
            $oCargo->atualizar();
            Sessao::setMensagem('Sucesso!', 'Cargo Atualizado!', STATUS_SUCESSO);

        } catch (\PDOException $exceptionPdo) {
            Sessao::setMensagem('Error!', 'Não foi possível atulizar o cargo (Erro interno)!', STATUS_CUIDADO);
        } catch (\Exception $exception) {
            Sessao::setMensagem('Error!', 'Não foi possível atualizar o cargo!', STATUS_PERIGO);
        } finally {
            Sistema::redireciona('/cadastro/cargo');
        }
    }

}