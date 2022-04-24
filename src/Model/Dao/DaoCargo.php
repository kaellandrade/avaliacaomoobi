<?php

namespace Micaelandrade\Avaliacao\Model\Dao;

use Micaelandrade\Avaliacao\Infrastructure\Persistence\ConnectionCreator;
use Micaelandrade\Avaliacao\Model\Cargo;
use PDO;

/**
 * Dao para Cargos.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial
 */
class DaoCargo implements Dao {
    private \PDO $oConexao;

    /**
     * Inicializando uma conexão com o banco.
     * @version 1.0.0 Versão inicial.
     */
    public function __construct() {
        $this->oConexao = ConnectionCreator::createConnection();
    }

    /**
     * Salva um cargo no banco.
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @param mixed $oData
     * @return bool
     * @since 1.0.0 Versão inicial
     * @since 1.0.1 Modificando o nome da função de logar para setLogin.
     */
    public function save(mixed $oData): bool {
        $sConsulta = 'INSERT INTO cro_cargo (cro_nome) VALUES (:nome);';

        $oStatement = $this->oConexao->prepare($sConsulta);
        return $oStatement->execute([':nome' => $oData]);
    }

    /**
     * Atualizar um cargo no banco.
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @return void
     * @since 1.0.0 Versão inicial
     * @since 1.0.1 Modificando o nome da função de logar para setLogin.
     */
    public function update(mixed $oCargo): bool {
        $sConsulta = 'UPDATE cro_cargo SET cro_nome = :nome WHERE cro_id = :id;';

        $oStatement = $this->oConexao->prepare($sConsulta);
        return $oStatement->execute([':nome' => $oCargo->getSNome(), ':id' => $oCargo->getIId()]);

    }

    public function deleteByName(string $sName): bool {

    }

    /**
     * Remove um cargo por id.
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @param int $iId
     * @return bool
     * @since 1.0.0 Versão inicial
     * @since 1.0.1 Modificando o nome da função de logar para setLogin.
     */
    public function deleteById(int $iId): bool {
        $sConsulta = 'DELETE FROM cro_cargo WHERE cro_id = :id;';
        $oStatement = $this->oConexao->prepare($sConsulta);

        return $oStatement->execute([':id' => $iId]);
    }

    /**
     * Recupera todos os cargos.
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @return array
     * @since 1.0.0 Versão inicial
     * @since 1.0.1 Modificando o nome da função de logar para setLogin.
     */
    public function findAll(): array {
        return $this->oConexao->query('SELECT cro_id AS id, cro_nome AS nome FROM cro_cargo;')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $iId): array {

    }
}