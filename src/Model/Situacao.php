<?php

namespace Micaelandrade\Avaliacao\Model;

use Micaelandrade\Avaliacao\Model\Dao\DaoEmpresa;
use Micaelandrade\Avaliacao\Model\Dao\DaoSituacao;

/**
 * Entidade Situação do sistema.
 *
 * @author Micael andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial.
 */
class Situacao {
    public string $sNome;
    public ?int $iId;

    /**
     * Recebe um nome e um id opcional.
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @param string $sNome
     * @param int|null $iId
     * @since 1.0.0
     */
    public function __construct(string $sNome, ?int $iId) {
        $this->sNome = $sNome;
        $this->iId = $iId;
    }

    /**
     * Recebe um nome e seta no Objeto.
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @param string $sNome
     * @return void
     * @since 1.0.0
     */
    public function setSNome(string $sNome): void {
        $this->sNome = $sNome;
    }

    /**
     * Retorna o nome da situação.
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @return string
     * @since 1.0.0
     */
    public function getSNome(): string {
        return $this->sNome;
    }

    /**
     * Retorna o Id da situação.
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @return int
     * @since 1.0.0
     */
    public function getiId(): int {
        return $this->iId;
    }

    /**
     * Recebe um id e remove determinada Situação.
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @param int $id
     * @return bool
     * @since 1.0.0
     */
    public static function removerPorId(int $id): bool {
        return (new Dao\DaoSituacao())->deleteById($id);
    }
    /**
     * Atualiza uma situação no banco.
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @return bool
     * @since 1.0.0
     */
    public function atualizar(): bool {
        return (new DaoSituacao())->update($this);
    }
    /**
     * Salva uma situação no banco.
     * @author Micael andrade micaelandrade@moobitech.com.br
     * @return bool
     * @since 1.0.0
     */
    public function salvar(): bool {
        return (new DaoSituacao())->save($this);
    }

}