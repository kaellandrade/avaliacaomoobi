<?php

namespace Micaelandrade\Avaliacao\Model\Dao;

use Micaelandrade\Avaliacao\Infrastructure\Persistence\ConnectionCreator;
use Micaelandrade\Avaliacao\Model\Empresa;
use PDO;

/**
 * Dao para Empresa.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial
 */
class DaoEmpresa implements Dao {
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
     * @param Empresa $oEmpresa
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @since  1.0.0 Versão inicial
     * @return bool
     */
    public function save(mixed $oEmpresa): bool {
        $sConsulta = 'INSERT INTO ema_empresa (ema_nome) VALUES (:nome);';

        $oStatement = $this->oConexao->prepare($sConsulta);
        return $oStatement->execute([':nome' => $oEmpresa->getSNome()]);
    }

    /**
     * Atualiza uma empresa no banco.
     *
     * @param Empresa $oEmpresa
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @since  1.0.0 Versão inicial
     * @return bool
     */
    public function update(mixed $oEmpresa): bool {
        $sConsulta = 'UPDATE ema_empresa SET ema_noME = :nome WHERE ema_id = :id;';

        $oStatement = $this->oConexao->prepare($sConsulta);
        return $oStatement->execute([':nome' => $oEmpresa->getSNome(), ':id' => $oEmpresa->getiId()]);

    }

    public function deleteByName(string $sName): bool {
    }

    /**
     * Deleta uma empresa por id.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @param int $iId
     * @return bool
     * @since  1.0.0 Versão inicial
     */
    public function deleteById(int $iId): bool {
        $sConsulta = 'DELETE FROM ema_empresa WHERE ema_id = :id;';
        $oStatement = $this->oConexao->prepare($sConsulta);

        return $oStatement->execute([':id' => $iId]);
    }

    /**
     * Recupera todas empresas.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return array
     * @since  1.0.0 Versão inicial
     */
    public function findAll(): array {
        return $this->oConexao->query('SELECT ema_id AS id, ema_nome AS nome FROM ema_empresa;')->fetchAll(PDO::FETCH_ASSOC);
    }


    public function findById(int $iId): array {
    }
}