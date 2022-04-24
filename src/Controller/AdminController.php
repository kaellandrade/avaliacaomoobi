<?php

namespace Micaelandrade\Avaliacao\Controller;

use Exception;
use Micaelandrade\Avaliacao\Infrastructure\ValidaDados;
use Micaelandrade\Avaliacao\Model\Usuario;
use Micaelandrade\Avaliacao\Infrastructure\Sessao;
use Micaelandrade\Avaliacao\Infrastructure\Sistema;
use Micaelandrade\Avaliacao\Model\Administrador;
use Micaelandrade\Avaliacao\Model\UsuarioComum;
use Micaelandrade\Avaliacao\View\ViewCabecalho;
use Micaelandrade\Avaliacao\View\ViewRodape;
use Micaelandrade\Avaliacao\View\ViewUsuario;

/**
 * Controller do Administrador.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 *
 * @version 1.0.0 Versão inicial.
 * @version 1.0.1 Deixando de passar a conexão pelo construtor.
 * @version 1.0.2 O Painel de controle é renderizado agora pelo Controller de login.
 * @version 1.0.3 Ações para listar e remover usuários.
 * @version 1.0.4 Ajustes na documentação e layout dos métodos.
 */
class AdminController {

    /**
     * Ação responsável pela tela de cadastro de usuários.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @version  1.0.0 Versão inicial.
     */
    public function telaCadastroUsuario() {
        $aDados['usuario'] = Sistema::getUsuario();
        $aDados['mensagem'] = Sessao::getMensagem();
        $aDados['titulo'] = 'Cadastro de novos usuários';
        ViewCabecalho::render($aDados);
        ViewUsuario::render($aDados);
        ViewRodape::render([]);
    }

    /**
     * Trata o formulário de cadastro/edição de novos Usuários.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @see https://www.php.net/manual/pt_BR/function.filter-input.php
     *
     * @return Usuario
     *
     * @throws Exception
     *
     * @since 1.0.0 Utilizando filter_input para capturar os dados do form.
     * @since 1.0.0 Deixando de lançar um Exception genérico.
     */
    private static function higienizarDadosAdmin(): Usuario {
        $sNome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $sLogin = filter_input(INPUT_POST, 'login', FILTER_DEFAULT);
        $sSenha = filter_input(INPUT_POST, 'senha');
        $sSenhaComfirmacao = filter_input(INPUT_POST, 'senha-confirmacao');
        $sDataNascimento = filter_input(INPUT_POST, 'dataNascimento', FILTER_DEFAULT);
        $iPerfil = filter_input(INPUT_POST, 'usuario-perfil', FILTER_VALIDATE_INT);


        if (!ValidaDados::arrayDadosValidos([$sNome, $sLogin, $sSenha, $sSenhaComfirmacao, $sDataNascimento, $iPerfil])) {
            return throw new Exception('Dados estão inválidos.');
        }

        if (!ValidaDados::validaSenhas($sSenha, $sSenhaComfirmacao)) {
            return throw new Exception('Senhas diferentes.');
        }

        return ($iPerfil === USUARIO_ADMINISTRADOR)
            ? new Administrador(null, $sNome, $sDataNascimento, 1, $sSenha, $sLogin, $iPerfil)
            : new UsuarioComum(null, $sNome, $sDataNascimento, 1, $sSenha, $sLogin, $iPerfil);
    }

    /**
     * Ação resposável por cadastrar um novo usuário.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @since 1.0.0 Utilizando filter_input para capturar os dados do form.
     */
    public function cadastraUsuario() {
        /** @var $oAdministrador Administrador */
        $oAdministrador = Sistema::getUsuario();


        /** @var  $oUsuario Administrador|UsuarioComum */

        try {
            $oUsuario = self::higienizarDadosAdmin();
            $oAdministrador->salvarUsuario($oUsuario);

            Sessao::setMensagem('Salvo!', 'Usuário inserido com sucesso.');
        } catch (\PDOException $oEx) {
            Sessao::setMensagem('Erro ao cadastrar usuário', 'Não foi possivel salvar esse usuário.', STATUS_CUIDADO);
        } catch (Exception $e) {
            Sessao::setMensagem('Erro ao cadastrar usuário', $e->getMessage(), STATUS_CUIDADO);
        } finally {
            Sistema::redireciona('/cadastro/usuario');
        }


    }

    /**
     * Ação resposável por listar todos os usuários na tela.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @since 1.0.0 Versão inicial.
     * @return void
     */
    public function visualizarUsuarios() {
        $aDados['usuario'] = Sistema::getUsuario();
        $aDados['mensagem'] = Sessao::getMensagem();
        $aDados['titulo'] = 'Listagem usuários';

        try {
            $aDados['usuarios'] = Administrador::recuperaTodosusuarios();

        } catch (\PDOException $exception) {
            Sessao::setMensagem('Error', 'Não foi possível trazer todos os usários do banco.', STATUS_PERIGO);
        } finally {
            ViewCabecalho::render($aDados);
            ViewUsuario::listar($aDados);
            ViewRodape::render([]);
        }
    }

    /**
     * Ação resposável por remover um usuário.
     *
     * Captura o id do usuário no formulário e o remove.
     * (PS: Um usuário admim só pode remover outro adm, caso este esteja invativo no sistema.)
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @since 1.0.0 Versão inicial.
     * @since 1.0.2 Proibindo administradores remover outros adm ativos.
     *
     * @return void
     * @throws Exception
     */
    public function removeUsuario() {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        try {
            $aUsuarioAserRemovido = Administrador::encontraUsuarioPorId($id);

            // Impedindo que adms remova outros adms ativos.
            if ($aUsuarioAserRemovido['uso_perfil'] == USUARIO_ADMINISTRADOR && $aUsuarioAserRemovido['uso_ativo'])
                throw new Exception('Administradores não podem remover outros administradores ativos!');

            Administrador::removePorId((int)$id);
            Sessao::setMensagem('Sucesso', 'Usuário removido com sucesso!.', STATUS_SUCESSO);

        } catch (\PDOException $oEx) {
            Sessao::setMensagem('Erro', 'Não foi possivel remover esse usuário.', STATUS_CUIDADO);
        } catch (Exception $exError) {
            Sessao::setMensagem('Erro', $exError->getMessage(), STATUS_CUIDADO);
        } finally {
            Sistema::redireciona('/listar/usuarios');
        }
    }

}

