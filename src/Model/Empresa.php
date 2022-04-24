<?php

namespace Micaelandrade\Avaliacao\Model;

use Micaelandrade\Avaliacao\Model\Dao\DaoEmpresa;

class Empresa {
    public string $sNome;
    public ?int $iId;
    /**
     * @param string $sNome
     */
    public function __construct(string $sNome, ?int $iId) {
        $this->sNome = $sNome;
        $this->iId = $iId;
    }

    /**
     * @param string $sNome
     */
    public function setSNome(string $sNome): void {
        $this->sNome = $sNome;
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
    public function getiId(): int {
        return $this->iId;
    }

    /**
     * @param int $iId
     */
    public function setIId(int $iId): void {
        $this->iId = $iId;
    }


    public static function removerPorId(int $id): bool {
        return (new Dao\DaoEmpresa())->deleteById($id);
    }

    public function atualizar() {
        return (new DaoEmpresa())->update($this);
    }
    public function salvar() {
        return (new DaoEmpresa())->save($this);
    }

}