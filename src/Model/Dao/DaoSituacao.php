<?php

namespace Micaelandrade\Avaliacao\Model\Dao;

use Micaelandrade\Avaliacao\Infrastructure\Persistence\ConnectionCreator;
use Micaelandrade\Avaliacao\Model\Situacao;
use PDO;

/**
 * Dao reponsável por gerenciar as Situações.
 *
 * @author Micael Andrade micaelandrademoobitech.com.br
 * @version 1.0.0 Versão inicial
 */
class DaoSituacao implements Dao {
    private \PDO $oConexao;
    /**
     * Inicializa a conexao com o banco.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @since  1.0.0 Versão inicial
     */
    public function __construct() {
        $this->oConexao = ConnectionCreator::createConnection();
    }

    /**
     * Recebe um nome de empresa e persiste no banco.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @param Situacao $oSituacao
     * @return bool
     */
    public function save(mixed $oSituacao): bool {
        $sConsulta = 'INSERT INTO sto_situacao (sto_nome) VALUES (:nome);';

        $oStatement = $this->oConexao->prepare($sConsulta);
        return $oStatement->execute([':nome' => $oSituacao->getSNome()]);
    }

    /**
     * Recebe um situação e atualiza a mesma no banco.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @param Situacao $oSituacao
     * @return bool
     */
    public function update(mixed $oSituacao): bool {
        $sConsulta = 'UPDATE sto_situacao SET sto_nome = :nome WHERE sto_id = :id;';

        $oStatement = $this->oConexao->prepare($sConsulta);
        return $oStatement->execute([':nome' => $oSituacao->getSNome(), ':id' => $oSituacao->getiId()]);
    }

    public function deleteByName(string $sName): bool {
    }

    /**
     * Deleta uma situação por Id.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @param int $iId
     * @return bool
     */
    public function deleteById(int $iId): bool {
        $sConsulta = 'DELETE  FROM sto_situacao WHERE sto_id = :id;';
        $oStatement = $this->oConexao->prepare($sConsulta);

        return $oStatement->execute([':id' => $iId]);
    }

    /**
     * Retorna todas situações.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return array
     */
    public function findAll(): array {
        return $this->oConexao->query('SELECT sto_id AS id, sto_nome AS nome FROM sto_situacao;')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $iId): array {
    }
}