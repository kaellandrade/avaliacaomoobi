<?php

namespace Micaelandrade\Avaliacao\Model;
/**
 * Entidade UsuarioComum.
 * @author Micael andrade micaelandrade@moobitech.com.br
 *
 * @version 1.0.0 Versão inicial.
 */
class UsuarioComum extends Usuario {
    /**
     * Atributos de um usuário.
     *
     * @author Micael andrade micaelandrade@moobitech.com.br
     *
     * @param int|null $iId
     * @param string $sNome
     * @param string|null $sDataNascimento
     * @param bool $bAtivo
     * @param string|null $sSenha
     * @param string $sLogin
     * @param int $iPerfil
     */
    public function __construct(?int $iId, string $sNome, ?string $sDataNascimento, bool $bAtivo, ?string $sSenha, string $sLogin, int $iPerfil) {
        parent::__construct($iId, $sNome, $sDataNascimento, $bAtivo, $sSenha, $sLogin, $iPerfil);
    }
}