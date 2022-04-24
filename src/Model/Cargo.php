<?php

namespace Micaelandrade\Avaliacao\Model;

use Micaelandrade\Avaliacao\Model\Dao\DaoCargo;
/**
 * Entidade Cargo.
 *
 * @author Micael Andrade micaelandrademoobitech.com.br
 * @version 1.0.0 Versão inicial
 */
class Cargo {
    public string $sNome;
    public ?int $iId;

    /**
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param string $sNome
     * @param int|null $iId
     */
    public function __construct(string $sNome, ?int $iId) {
        $this->sNome = $sNome;
        $this->iId = $iId;
    }

    /**
     * Retorna o nome do Cargo.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return string
     * @version 1.0.0 Versão inicial
     */
    public function getSNome(): string {
        return $this->sNome;
    }

    /**
     * Retorna o id.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return int|null
     * @version 1.0.0 Versão inicial
     */
    public function getIId(): ?int {
        return $this->iId;
    }

    /**
     * Seta um id ao cargo.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param int|null $iId
     * @return void
     * @version 1.0.0 Versão inicial
     */
    public function setIId(?int $iId): void {
        $this->iId = $iId;
    }

    public static function removerPorId(int $id): bool {
        return (new Dao\DaoCargo())->deleteById($id);
    }

    /**
     * Atualiza um usuário no banco.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return bool|void
     * @version 1.0.0 Versão inicial
     */
    public function atualizar() {
        return (new DaoCargo())->update($this);
    }

}