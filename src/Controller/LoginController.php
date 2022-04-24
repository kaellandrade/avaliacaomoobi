<?php

namespace Micaelandrade\Avaliacao\Controller;

use Micaelandrade\Avaliacao\Infrastructure\Sessao;
use Micaelandrade\Avaliacao\Infrastructure\Sistema;
use Micaelandrade\Avaliacao\Infrastructure\ValidaDados;
use Micaelandrade\Avaliacao\Model\Dao\DaoUsuario;
use Micaelandrade\Avaliacao\View\Login\ViewLogin;
use Micaelandrade\Avaliacao\View\ViewCabecalho;
use Micaelandrade\Avaliacao\View\ViewPainel;
use Micaelandrade\Avaliacao\View\ViewRodape;

/**
 * Controller de Login.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 *
 * @version 1.0.0 Versão inicial.
 * @version 1.0.1 Ajustes layout.
 */
class LoginController {

    /**
     * Método reponsável por realizar o login.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     *
     * @see https://www.php.net/manual/pt_BR/function.filter-input.php
     * @return void
     * @since 1.0.0 Versão inicial
     * @since 1.0.2 Deixando apenas uma única rota para painel de controle.
     * @since 1.0.3 utilizando filter_input e arrayDadosValidos para tratar os dados.
     */
    public function realizaLogin(): void {
        $sLogin = filter_input(INPUT_POST, 'login', FILTER_DEFAULT);
        $sSenha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

        try {

            if(!ValidaDados::arrayDadosValidos([$sLogin, $sSenha])){
                Sessao::setMensagem('Campos obrigatórios.', 'Por favor, digite o usuário e senha.', STATUS_CUIDADO);
                Sistema::redireciona('/');
            }

            $oUsuarioDao = new DaoUsuario();
            $oUsuario = $oUsuarioDao->findByLogin($sLogin, $sSenha);

            if (is_null($oUsuario)) {
                Sessao::setMensagem('Error!', 'Usuário não encontrado.', STATUS_CUIDADO);
                Sistema::redireciona('/');
                die();
            }

            Sistema::setLogin($oUsuario);
            Sistema::redireciona('/painel');

        }catch (\PDOException $exception){
            Sessao::setMensagem('Erro!.', 'Por favor, verifique seus dados.', STATUS_CUIDADO);
            Sistema::redireciona('/');
        }

    }

    /**
     * Método responsável por mostrar a tela de login.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return void
     * @since 1.0.0 Primeira versão.
     * @since 1.0.2 Redirecionando para o painel de controle caso já esteja logado.
     */
    public function telaLogin(): void {
        if (Sistema::estaLogado()) {
            Sistema::redireciona('/painel');
        }

        $aDados['mensagem'] = Sessao::getMensagem();
        ViewLogin::render($aDados);
        Sessao::limpaMensagem();
    }

    /**
     * Destrói a sessão e redireciona o usuário para tela de login.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return void
     * @since 1.0.0 Versão inicial
     */
    public function sair(): void {
        Sistema::sair();
        Sistema::redireciona('/');
    }

    /**
     * Método responsável por renderizar o Painel Principal.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return void
     * @since 1.0.0 Primeira versão.
     */
    public function telaPainel(): void {
        $aDados['usuario'] = Sistema::getUsuario();
        $aDados['titulo'] = 'Painel de controle';

        ViewCabecalho::render($aDados);
        ViewPainel::render($aDados);
        ViewRodape::render($aDados);

    }

}