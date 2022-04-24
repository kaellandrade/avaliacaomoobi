<?php

namespace Micaelandrade\Avaliacao\Model;

use Micaelandrade\Avaliacao\Model\Dao\DaoUsuario;

/**
 * Entidade Administrador.
 *
 * @author Micael Andrade micaelandrademoobitech.com.br
 * @version 1.0.0 Versão inicial
 */
class Administrador extends Usuario {
    /**
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @param string $sNome
     * @param string|null $sDataNascimento
     * @param bool $bAtivo
     * @param string|null $sSenha
     * @param string $sLogin
     * @param int $iPerfil
     * @param int|null $iId
     * @since 1.0.0 Versão inicial.
     */
    public function __construct(?int $iId, string $sNome, ?string $sDataNascimento, bool $bAtivo, ?string $sSenha, string $sLogin, int $iPerfil) {
        parent::__construct($iId, $sNome, $sDataNascimento, $bAtivo, $sSenha, $sLogin, $iPerfil);
    }


    /**
     * Salva um usuário no banco.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param Usuario $oUsuario
     * @return bool
     * @version 1.0.0 Versão inicial
     */
    public function salvarUsuario(Usuario $oUsuario): bool {
        $oUsuarioDao = new DaoUsuario();
        return $oUsuarioDao->save($oUsuario);
    }

    /**
     * Salva um usuário no banco.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return array
     * @version 1.0.0 Versão inicial
     */
    public static function recuperaTodosusuarios(): array {
        $oDaousuario = new DaoUsuario();
        return $oDaousuario->findAll();
    }

    /**
     * Remove um usuário por id.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param int $iId
     * @return bool
     * @version 1.0.0 Versão inicial
     */
    public static function removePorId(int $iId): bool {
        $oUsuarioDao = new DaoUsuario();
        return $oUsuarioDao->deleteById($iId);
    }

    /**
     * Encontra um usuário por id.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param int $iId
     * @return array
     * @version 1.0.0 Versão inicial
     */
    public static function encontraUsuarioPorId(int $iId): array {
        $oUsuarioDao = new DaoUsuario();
        return $oUsuarioDao->findById($iId);
    }

}