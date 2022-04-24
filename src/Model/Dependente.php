<?php

namespace Micaelandrade\Avaliacao\Model;
/**
 * Entidade Dependente.
 *
 * @author Micael Andrade micaelandrademoobitech.com.br
 *
 * @version 1.0.0 Versão inicial
 */
class Dependente {
    private ?int $iId;
    private string $sNome;
    private int $iParentesco;
    private string $sDatanascimento;

    /**
     * @param int|null $iId
     * @param string $sNome
     * @param int $iParentesco
     * @param string $sDatanascimento
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     *
     */
    public function __construct(?int $iId, string $sNome, int $iParentesco, string $sDatanascimento) {
        $this->iId = $iId;
        $this->sNome = $sNome;
        $this->iParentesco = $iParentesco;
        $this->sDatanascimento = $sDatanascimento;
    }


    /**
     * @return string
     */
    public function getSNome(): string {
        return $this->sNome;
    }

    /**
     * @return int
     */
    public function getIParentesco(): int {
        return $this->iParentesco;
    }

    /**
     * @return int|null
     */
    public function getIId(): ?int {
        return $this->iId;
    }

    /**
     * @return string
     */
    public function getSDatanascimento(): string {
        return $this->sDatanascimento;
    }


}