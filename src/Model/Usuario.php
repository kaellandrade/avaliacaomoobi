<?php

namespace Micaelandrade\Avaliacao\Model;


/**
 * Entidade Usuário.
 * @author Micael andrade micaelandrade@moobitech.com.br
 *
 * @version 1.0.0 Versão inicial.
 */
abstract class  Usuario {
    public ?int $iId;
    public string $sNome;
    public ?string $sDataNascimento;
    public bool $bAtivo;
    private ?string $sSenha;
    public string $sLogin;
    public int $iPerfil;

    /**
     * Atributos de um usuário genérico.
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
        $this->iId = $iId;
        $this->sNome = $sNome;
        $this->sDataNascimento = $sDataNascimento;
        $this->bAtivo = $bAtivo;
        $this->sSenha = $sSenha;
        $this->sLogin = $sLogin;
        $this->iPerfil = $iPerfil;
    }

    /**
     * Retorna o id do usuário.
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @return int|null
     * @since 1.0.0
     */
    public function getIId(): ?int {
        return $this->iId;
    }

    /**
     * @return string
     */
    public function getSNome(): string {
        return $this->sNome;
    }

    /**
     * Retorna a data de nascimento.
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @return string|null
     * @since 1.0.0
     */
    public function getSDataNascimento(): ?string {
        return $this->sDataNascimento;
    }

    /**
     * retorna o status do usuário. (Ativo, ou inativo).
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @return bool
     * @since 1.0.0
     */
    public function isBAtivo(): bool {
        return $this->bAtivo;
    }

    /**
     * Retorna a senha do usuário.
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @return string
     * @since 1.0.0
     */
    public function getSSenha(): string {
        return $this->sSenha;
    }

    /**
     * Retorna o Login do usuário.
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @return string
     * @since 1.0.0
     */
    public function getSLogin(): string {
        return $this->sLogin;
    }

    /**
     * Retorna o perfil do usuário.
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @return int
     * @since 1.0.0
     */
    public function getSPerfil(): int {
        return $this->iPerfil;
    }

    /**
     * Retorna se o usuário é adm ou não.
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @return bool
     * @since 1.0.0
     */
    public function isAdministrador(): bool {
        return $this->iPerfil === USUARIO_ADMINISTRADOR;

    }


}