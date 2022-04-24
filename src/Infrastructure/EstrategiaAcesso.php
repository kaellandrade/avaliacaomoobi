<?php

namespace Micaelandrade\Avaliacao\Infrastructure;

/**
 * Classe de controle das rotas.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 *
 * @version 1.0.0 Versão inicial.
 */
class EstrategiaAcesso {
    public static array $aRotas = [
        '/cadastro/usuario' => USUARIO_ADMINISTRADOR,
        '/salva/usuario' => USUARIO_ADMINISTRADOR,
        '/remove/usuario' => USUARIO_ADMINISTRADOR,
        '/listar/usuarios' => USUARIO_ADMINISTRADOR,

        '/painel' => USUARIO,
        '/cadastro/filiado' => USUARIO,
        '/sair' => USUARIO,
        '/salva/filiado' => USUARIO,
        '/cadastro/empresa' => USUARIO,
        '/cadastro/cargo' => USUARIO,
        '/cadastro/situacao' => USUARIO,
        '/salva/empresa' => USUARIO,
        '/salva/cargo' => USUARIO,
        '/salva/situacao' => USUARIO,
        '/visualizar/filiados' => USUARIO,
        '/edita/filiado' => USUARIO,
        '/remove/filiado' => USUARIO,
        '/filiado/filtro' => USUARIO,
        '/cadastro/dependente' => USUARIO,
        '/atualizar/filiado' => USUARIO,
        '/remove/empresa' => USUARIO,
        '/edita/empresa' => USUARIO,
        '/remove/situacao' => USUARIO,
        '/edita/situacao' => USUARIO,
        '/remove/cargo' => USUARIO,
        '/edita/cargo' => USUARIO,
        '/relatorio/aniversariantes' => USUARIO,
        '/visualizar/dependentes' => USUARIO,
        '/remove/dependente' => USUARIO,
        '/relatorio/totaldependentes' => USUARIO,

        '/realiza/login' => PUBLICA,
        '/' => PUBLICA
    ];

    /**
     * Recebe uma rota e verifica se o solicitante possui acesso.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * As rotas podem ser:
     * PUBLICA -> Todos tem acesso;
     * USUARIO -> Tanto adminsitradores quanto usuários comuns possuem acesso, porém precisam está logados.
     * USUARIO_ADMINISTRADOR -> Apenas para adinistradores.
     *
     * @param string $sRota
     * @return bool
     * @since 1.0.0 Versão inicial.
     */
    public static function possuiAcesso(string $sRota): bool {
        $oUsuario = Sistema::getUsuario();
        $sCaminhoSolicidado = $sRota;

        if (self::$aRotas[$sCaminhoSolicidado] == PUBLICA)
            return true;

        if (is_null($oUsuario))
            return false;

        if (self::$aRotas[$sRota] === USUARIO)
            return true;

        if ($oUsuario->isAdministrador())
            return self::$aRotas[$sRota] === USUARIO_ADMINISTRADOR;
        else
            return self::$aRotas[$sRota] === USUARIO;

    }
}