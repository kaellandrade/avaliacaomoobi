<?php

namespace Micaelandrade\Avaliacao\Model;

use Micaelandrade\Avaliacao\Model\Dao\DaoDependentes;
use Micaelandrade\Avaliacao\Model\Dao\DaoFiliado;

/**
 * Entidade filiado do sistema.
 *
 * @author Micael andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial.
 */
class Filiado {
    public string $sNome;
    private ?int $iId;
    private string $sCpf;
    private string $sRg;
    public string $sDataNascimento;
    private ?string $sTelefone;
    private string $sCelular;
    private ?string $sIdSituacao;
    private ?string $sIdEmpresa;
    private ?string $sIdcargo;
    private ?array $aDependentes;


    /**
     * @param int|null $iId
     * @param string $sNome
     * @param string $sCpf
     * @param string $sRg
     * @param string $sDataNascimento
     * @param string|null $sTelefone
     * @param string $sCelular
     * @param string $sIdSituacao
     * @param string $sIdEmpresa
     * @param string $sIdcargo
     * @param array|null $aDependentes
     */
    public function __construct(?int $iId, string $sNome, string $sCpf, string $sRg, string $sDataNascimento, ?string $sTelefone, string $sCelular, ?string $sIdSituacao, ?string $sIdEmpresa, ?string $sIdcargo, ?array $aDependentes) {
        $this->iId = $iId;
        $this->sNome = $sNome;
        $this->sCpf = $sCpf;
        $this->sRg = $sRg;
        $this->sDataNascimento = $sDataNascimento;
        $this->sTelefone = $sTelefone;
        $this->sCelular = $sCelular;
        $this->sIdSituacao = $sIdSituacao;
        $this->sIdEmpresa = $sIdEmpresa;
        $this->sIdcargo = $sIdcargo;
        $this->aDependentes = $aDependentes;
    }

    public static function filtrarDataIntervalo(string $sDataInicio, string $sDataFim): array {
        $oDaoDependente = new DaoFiliado();
        return $oDaoDependente->filterByDataRange($sDataInicio, $sDataFim);
    }

    public static function totalDependentesTodosFiliados(): array {
        $oDaoFiliado = new DaoFiliado();
        return $oDaoFiliado->countAllDepentsAffiliates();
    }

    /**
     * Salva um filiado no banco.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return bool
     * @since 1.0.0 versão inicial
     */
    public function salvar(): bool {
        $oDaoFiliado = new DaoFiliado();
        return $oDaoFiliado->save($this);
    }

    public static function salvarDependente(int $idFiliado, Dependente $dp): bool {
        return (new Dao\DaoFiliado)->addDependent($idFiliado, $dp);
    }

    public static function removerPorId(int $id): bool {
        return (new Dao\DaoFiliado)->deleteById($id);
    }


    /**
     * @return string
     */
    public function getSNome(): string {
        return $this->sNome;
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
    public function getSCpf(): string {
        return $this->sCpf;
    }

    /**
     * @return string
     */
    public function getSRg(): string {
        return $this->sRg;
    }

    /**
     * @return string
     */
    public function getSDataNascimento(): string {
        return $this->sDataNascimento;
    }

    /**
     * @return string|null
     */
    public function getSTelefone(): ?string {
        return $this->sTelefone;
    }

    /**
     * @return string
     */
    public function getSCelular(): string {
        return $this->sCelular;
    }

    /**
     * @return string
     */
    public function getSIdSituacao(): string {
        return $this->sIdSituacao;
    }

    /**
     * @return string
     */
    public function getSIdEmpresa(): string {
        return $this->sIdEmpresa;
    }

    /**
     * @return string
     */
    public function getSIdcargo(): string {
        return $this->sIdcargo;
    }

    /**
     * @return array|null
     */
    public function getADependentes(): ?array {
        return $this->aDependentes;
    }

    /**
     * Atualiza um filiado no banco.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return bool
     * @since 1.0.0 versão inicial
     */
    public function atualizarFiliado(): bool {
        return (new Dao\DaoFiliado)->update($this);

    }

    /**
     * @param int|null $iId
     */
    public function setIId(?int $iId): void {
        $this->iId = $iId;
    }

    public static function recuperarTodosFiliadosPorPagina(int $iPagina): array {
        $oDaoFiliado = new DaoFiliado();
        return $oDaoFiliado->pagination($iPagina);
    }

    public static function totalDeFiliados(): int {
        $oDaoFiliado = new DaoFiliado();
        return $oDaoFiliado->getTotalLines();
    }

    public static function filtrarPorNome(string $nome): array {
        $oDaoFiliado = new DaoFiliado();
        return $oDaoFiliado->filterByName($nome);
    }
    public static function filtrarPorNomeData(string $nome, string $sDataInicio, string $sDatafim): array {
        $oDaoFiliado = new DaoFiliado();
        return $oDaoFiliado->filterByNameAndDataRange($nome, $sDataInicio, $sDatafim);
    }

    /**
     * @param int|null $iMes
     * @return array
     * @since 1.0.0 Versão inicial
     * @since 1.0.1 Modificando nome do método.
     */
    public static function recuperaTodosPorMes(?int $iMes): array {
        $oDaoFiliado = new DaoFiliado();
        $iMesAtual = (int)date('m');
        return $iMes ? $oDaoFiliado->allFiliadosBirthdayMonth($iMes) : $oDaoFiliado->allFiliadosBirthdayMonth($iMesAtual);
    }

    public static function todosDependentes(int $iId): array {
        $oDaoDependente = new DaoDependentes();
        return $oDaoDependente->findByIdFiliado($iId);
    }

    public static function removeDependentePorId(int $Id): bool {
        $oDaoDependente = new DaoDependentes();
        return $oDaoDependente->deleteById($Id);
    }
}