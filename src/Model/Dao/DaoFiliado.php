<?php

namespace Micaelandrade\Avaliacao\Model\Dao;

use Micaelandrade\Avaliacao\Infrastructure\Persistence\ConnectionCreator;
use Micaelandrade\Avaliacao\Infrastructure\Sistema;
use Micaelandrade\Avaliacao\Model\Dependente;
use Micaelandrade\Avaliacao\Model\Filiado;
use PDO;

/**
 * Dao reponsável por gerenciar os filiados no banco de dados.
 *
 * @author Micael Andrade micaelandrademoobitech.com.br
 * @version 1.0.0 Versão inicial
 */
class DaoFiliado implements Dao {
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
     * @param Filiado $oFiliado
     * @return bool
     */
    function save(mixed $oFiliado): bool {
        $sConsulta = 'INSERT INTO flo_filiado (flo_nome, flo_cpf, flo_rg, flo_nascimento, cro_cargo_id, flo_telefone, flo_celular, uso_usuario_uso_id,  ema_empresa_id, sto_situacao_id) 
VALUES (:nome, :cpf,:rg,:nascimento, :cargo, :telefone, :celular, :idUsuario, :idEmpresa, :idSituacao)';

        $oStatement = $this->oConexao->prepare($sConsulta);

        return $oStatement->execute([':nome' => $oFiliado->getSNome(), ':cpf' => $oFiliado->getSCpf(), ':rg' => $oFiliado->getSRg(), ':nascimento' => $oFiliado->getSDataNascimento(), ':cargo' => $oFiliado->getSIdcargo(), ':telefone' => $oFiliado->getSTelefone(), ':celular' => $oFiliado->getSCelular(), ':idUsuario' => Sistema::getUsuario()->getIId(), ':idEmpresa' => $oFiliado->getSIdEmpresa(), ':idSituacao' => $oFiliado->getSIdSituacao()]);

    }

    /**
     * @param Filiado $oFiliado
     * @return bool
     */
    public function update(mixed $oFiliado): bool {
        $sConsulta = 'UPDATE flo_filiado SET flo_nome = :nome, flo_cpf =:cpf, flo_rg=:rg, flo_nascimento=:nascimento, cro_cargo_id=:cargo, flo_telefone=:telefone, flo_celular=:celular,  ema_empresa_id=:idEmpresa, sto_situacao_id=:idSituacao, flo_utima_atualizacao=CURRENT_TIMESTAMP WHERE flo_id=:id;';

        $oStatement = $this->oConexao->prepare($sConsulta);

        return $oStatement->execute([':nome' => $oFiliado->getSNome(), ':cpf' => $oFiliado->getSCpf(), ':rg' => $oFiliado->getSRg(), ':nascimento' => $oFiliado->getSDataNascimento(), ':cargo' => $oFiliado->getSIdcargo(), ':telefone' => $oFiliado->getSTelefone(), ':celular' => $oFiliado->getSCelular(), ':idEmpresa' => $oFiliado->getSIdEmpresa(), ':idSituacao' => $oFiliado->getSIdSituacao(), ':id' => $oFiliado->getIId(),]);

    }

    public function deleteByName(string $sName): bool {
        // TODO: Implement deleteByName() method.
    }

    /**
     * Recebe um Id de um determinado filiado e remove-o.
     * @param int $iId
     * @return bool
     * @since 1.0.0 Versão inicial.
     */
    public function deleteById(int $iId): bool {
        $sConsulta = 'DELETE  FROM flo_filiado WHERE flo_id = :id;';
        $oStatement = $this->oConexao->prepare($sConsulta);

        return $oStatement->execute([':id' => $iId]);
    }


    public function findAll(): array {
        return $this->oConexao->query('SELECT flo_id AS id, flo_nome AS nome,flo_celular AS celular, flo_nascimento AS nascimento FROM flo_filiado;')->fetchAll(PDO::FETCH_ASSOC);
    }


    public function findById(int $iId): array {
        $sConsulta = 'SELECT * FROM flo_filiado WHERE flo_id = :id;';

        $oStatement = $this->oConexao->prepare($sConsulta);
        $oStatement->execute([':id' => $iId]);

        return $oStatement->fetch(PDO::FETCH_ASSOC) ?: [];

    }

    public function pagination(int $iPage = 1): array {
        $paginaAtual = ($iPage - 1) * LIMITE_POR_PAGINA;
        $aData = $this->oConexao->query("SELECT * FROM flo_filiado LIMIT $paginaAtual ," . LIMITE_POR_PAGINA . ';')->fetchAll(PDO::FETCH_ASSOC);
        return self::hydrateFiliado($aData);
    }

    /**
     * Filtra por nome.
     * Busca por um nome no banco.
     * @param int $sNome
     * @return void
     */
    public function filterByName(string $sNome): array {
        $aData = $this->oConexao->query("SELECT * FROM flo_filiado WHERE flo_nome LIKE '%$sNome%';")->fetchAll(PDO::FETCH_ASSOC);
        return self::hydrateFiliado($aData);
    }

    /**
     * Retorna o total de linhas da tabela filiado.
     * @return int
     */
    public function getTotalLines(): int {
        $aLinha = $this->oConexao->query("SELECT COUNT(*) AS numero_de_linhas FROM flo_filiado")->fetch(PDO::FETCH_ASSOC);
        return ($aLinha['numero_de_linhas']);

    }

    /**
     * Recebe um id do filiado e adiciona um determinado dependen ao mesmo.
     * @param int $idFiliado
     * @param Dependente $oDp
     * @return bool
     */
    public function addDependent(int $idFiliado, Dependente $oDp) {

        $sConsulta = 'INSERT INTO dps_dependentes (dps_nome, dps_nascimento, dps_grau_parentesco, flo_id) 
VALUES (:nome, :nascimento, :grau, :idFiliado)';

        $oStatement = $this->oConexao->prepare($sConsulta);

        return $oStatement->execute([':nome' => $oDp->getSNome(), ':nascimento' => $oDp->getSDatanascimento(), ':grau' => $oDp->getIParentesco(), ':idFiliado' => $idFiliado]);

    }

    /**
     * Recebe uma lista de filiados do banco e retorna os objetos.
     * @param $aData
     * @return array
     */
    private function hydrateFiliado(array $aData): array {
        return array_map(fn(array $filiado) => new Filiado($filiado['flo_id'], $filiado['flo_nome'], $filiado['flo_cpf'], $filiado['flo_rg'], $filiado['flo_nascimento'], $filiado['flo_telefone'], $filiado['flo_celular'], $filiado['sto_situacao_id'], $filiado['ema_empresa_id'], $filiado['cro_cargo_id'], null), $aData);

    }

    public function allFiliadosBirthdayMonth(int $iMes): array {
        $sQuery = "SELECT * FROM flo_filiado WHERE MONTH(flo_nascimento) = :mes;";
        $oStmt = $this->oConexao->prepare($sQuery);
        $oStmt->execute([':mes' => $iMes]);

        $aFiliados = $oStmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
        return self::hydrateFiliado($aFiliados);
    }


    public function filterByNameAndDataRange(string $nome, string $sDataInicio, string $sDatafim) {
        $query = "SELECT * FROM flo_filiado WHERE flo_nome LIKE '%:nome%' AND  flo_nascimento BETWEEN :dataInicio AND :dataFim";
        $stmt = $this->oConexao->prepare($query);
        $stmt->execute([':nome' => $nome, ':dataInicio' => $sDataInicio, ':dataFim' => $sDatafim]);
        $aDados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return self::hydrateFiliado($aDados);
    }

    public function filterByDataRange(string $sDataInicio, string $sDataFim) {
        $query = "SELECT * FROM flo_filiado WHERE flo_nascimento BETWEEN :dataInicio AND :dataFim ORDER BY flo_nascimento ;";
        $stmt = $this->oConexao->prepare($query);
        $stmt->execute([':dataInicio' => $sDataInicio, ':dataFim' => $sDataFim]);
        $aDados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return self::hydrateFiliado($aDados);
    }

    /**
     * Lista todos os filiados e o numero e o numero de dependentes.
     * @return array
     */
    public function countAllDepentsAffiliates(): array {
        $sQuery = "SELECT flo_nome,flo_celular, count(*) AS contagem FROM flo_filiado 
                        JOIN dps_dependentes dd on flo_filiado.flo_id = dd.flo_id
                    GROUP BY flo_nome, flo_celular;";

        return $this->oConexao->query($sQuery)->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }

}