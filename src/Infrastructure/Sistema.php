<?php

namespace Micaelandrade\Avaliacao\Infrastructure;

use http\Client\Curl\User;
use Micaelandrade\Avaliacao\Model\Administrador;
use Micaelandrade\Avaliacao\Model\Usuario;
use Micaelandrade\Avaliacao\Model\UsuarioComum;

/**
 * Classe responsável por gerencia o sistema.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial
 */
class Sistema {

    /**
     * Retorna a url path solicidata.
     *
     * http://localhost:8080/cadastro-usuario?id=3 => /cadastro-usuario
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return string
     * @since 1.0.0 - Recuperando o path da url
     */
    static public function getUrlPath(): string {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    /**
     * Recebe um suário e inicializa a sessão para o mesmo.
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @return void
     * @since 1.0.0 Versão inicial
     * @since 1.0.1 Modificando o nome da função de logar para setLogin.
     */
    static public function setLogin(Usuario $usuario): void {
        Sessao::iniciarSessao();
        Sessao::setValor('usuario', $usuario);
    }

    /**
     * Retorna um usuário setado no sistema, null caso não exista.
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @return Administrador|UsuarioComum|null
     * @since 1.0.0 Versão inicial
     */
    static public function getUsuario(): Administrador|UsuarioComum|null {
        return Sessao::getValor('usuario') ?? null;
    }

    /**
     * Destrói asessão.
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @return void
     * @since 1.0.0 Versão inicial
     */
    static public function sair(): void {
        Sessao::destruirSessao();

    }

    /**
     * Método responsável por realizar o redirecionamento de rotas.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param string $sUrl url de destino
     * @return void
     */
    static public function redireciona(string $sUrl) {
        header("Location: $sUrl");
        exit();

    }

    /**
     * Unifica as globais POST e GET.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return array
     *
     * @since 1.0.0 Versão inicial
     */
    static public function getFormulario(): array {
        return array_merge($_POST, $_GET);
    }

    /**
     * Verifica se existe algum usuário logado na aplicação.
     * @author Mciael Andrade micaelandrade@moobitech.com.br
     *
     * @return bool
     * @version 1.0.0 Versão inicial
     */
    static public function estaLogado(): bool {
        return !is_null(Sistema::getUsuario());
    }
}