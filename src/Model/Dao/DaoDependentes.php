<?php

namespace Micaelandrade\Avaliacao\Model\Dao;

use Micaelandrade\Avaliacao\Infrastructure\Persistence\ConnectionCreator;
use Micaelandrade\Avaliacao\Model\Dependente;
use PDO;

/**
 * Dao do Dependente.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial
 */
class DaoDependentes implements Dao {
    private \PDO $oConexao;

    /**
     * Inicializando a conexão.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @version 1.0.0 Versão inicial.
     */
    public function __construct() {
        $this->oConexao = ConnectionCreator::createConnection();
    }

    public function save(mixed $oData): bool {
    }

    public function update(mixed $oData): bool {
    }

    public function deleteByName(string $sName): bool {
    }

    /**
     * Remove um dependente por id.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @version 1.0.0 Versão inicial.
     */
    public function deleteById(int $iId): bool {
        $sConsulta = 'DELETE  FROM dps_dependentes WHERE dps_id = :id;';
        $oStatement = $this->oConexao->prepare($sConsulta);

        return $oStatement->execute([':id' => $iId]);
    }

    public function findAll(): array {
    }

    public function findById(int $iId): array {
    }

    /**
     * Retorna todos os dependentes de um determinado filiado.
     * @param int $idId
     * @return array
     */
    public function findByIdFiliado(int $idId): array {
        $sConsulta = 'SELECT * FROM dps_dependentes WHERE flo_id = :id;
';
        $oStatement = $this->oConexao->prepare($sConsulta);
        $oStatement->execute([':id' => $idId]);
        $adependenetes = $oStatement->fetchAll(PDO::FETCH_ASSOC) ?? [];
        return self::hydrateDependentes($adependenetes);
    }

    /**
     * Recebe um array de dependentes do baco e retorna uma lista de objetos Dependentes.
     * @param array $aData
     * @return array
     */
    private function hydrateDependentes(array $aData): array {
        return array_map(fn(array $aDependente) => new Dependente($aDependente['dps_id'], $aDependente['dps_nome'], $aDependente['dps_grau_parentesco'], $aDependente['dps_nascimento']), $aData);
    }

}