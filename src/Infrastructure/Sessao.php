<?php

namespace Micaelandrade\Avaliacao\Infrastructure;

/**
 * Classe responsável por manipular a sessão e suas possíveis variáveis.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 *
 * @version 1.0.0 Versão inicial
 * @version 1.0.1 Criando o método limpaMensagem.
 */
class Sessao {
    /**
     * Inicializa um sessão caso a mesma não exista.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @since 1.0.0 Versão inicial
     */
    public static function iniciarSessao(): void {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

    }

    /**
     * Destrói um sessão.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @since 1.0.0 Versão inicial
     */
    public static function destruirSessao(): void {
        session_destroy();

    }

    /**
     * Recebe uma determinada chave e um determinado valor e seta na variável global SESSION.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return void
     * @since 1.0.0 Versão inicial
     */
    public static function setValor(string $sChave, mixed $mValor) {
        self::iniciarSessao();
        $_SESSION[$sChave] = $mValor;
    }

    /**
     * Acessa um determinado índice da sessão, retorna null caso não exista.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param string $sChave
     * @return mixed
     * @since 1.0.0 Versão inicial
     */
    public static function getValor(string $sChave): mixed {
        self::iniciarSessao();
        return $_SESSION[$sChave] ?? null;
    }

    /**
     * Seta uma determinada mensagem na sessão.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param string $sTitulo
     * @param string $sConteudo
     * @param string $iStatus
     * @return void
     * @since 1.0.0 Versão inicial
     */
    public static function setMensagem(string $sTitulo, string $sConteudo, string $iStatus = STATUS_SUCESSO) {
        self::iniciarSessao();
        $_SESSION['mensagem'] = ['titulo' => $sTitulo, 'conteudo' => $sConteudo, 'status' => $iStatus];
    }

    /**
     * Limpa o array de mensagens.
     *
     * @author Micael Andrade micealandrade@moobitech.com.br
     * @return void
     * @since 1.0.0 Limpa a mensagem armazenada na super global.
     */
    public static function limpaMensagem(): void {
        self::iniciarSessao();
        unset($_SESSION['mensagem']);
    }

    /**
     * Retorna a mensagem guardada na global SESSION.
     *
     * @author Micael Andrade micealandrade@moobitech.com.br
     * @return array
     * @since 1.0.0 Limpa a mensagem armazenada na super global.
     */
    public static function getMensagem(): array {
        self::iniciarSessao();
        return $_SESSION['mensagem'] ?? [];
    }

}