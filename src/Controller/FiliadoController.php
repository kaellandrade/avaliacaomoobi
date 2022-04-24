<?php

namespace Micaelandrade\Avaliacao\Controller;

use Exception;
use Micaelandrade\Avaliacao\Infrastructure\PdfFiliados;
use Micaelandrade\Avaliacao\Infrastructure\Sessao;
use Micaelandrade\Avaliacao\Infrastructure\Sistema;
use Micaelandrade\Avaliacao\Infrastructure\ValidaDados;
use Micaelandrade\Avaliacao\Model\Dao\DaoCargo;
use Micaelandrade\Avaliacao\Model\Dao\DaoFiliado;
use Micaelandrade\Avaliacao\Model\Dao\DaoSituacao;
use Micaelandrade\Avaliacao\Model\Dao\DaoEmpresa;
use Micaelandrade\Avaliacao\Model\Filiado;
use Micaelandrade\Avaliacao\View\ViewCabecalho;
use Micaelandrade\Avaliacao\View\ViewCadastroFiliado;
use Micaelandrade\Avaliacao\View\ViewEditaFiliado;
use Micaelandrade\Avaliacao\View\ViewListagemFiliado;
use Micaelandrade\Avaliacao\View\ViewRodape;
use PDOException;

/**
 * Controller para Filiados.
 *
 * @author Micael Andrade mciaelandrade@moobitech.com.br
 *
 * @version  1.0.0 - Criando o controller.
 * @version 1.0.0 - Retirando conexão no construtor;
 */
class FiliadoController {


    /**
     * Cadastra um novo filiado.
     *
     * Processa a requisição do formulário e captura os dados para
     * persistência no banco, caso os mesmo sejam válidos.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return void
     *
     * @since 1.0.0 - Salvando um filiado.
     */
    public function cadastraFiliado(): void {
        try {
            $oFiliado = self::higienizarDadosFiliado();
            $oFiliado->salvar();
            Sessao::setMensagem('Salvo!', 'Filiado inserido com sucesso!.',);
        } catch (PDOException $oPdoError) {
            if ($oPdoError->getCode() === '23000') Sessao::setMensagem('Erro ao cadastrar filiado!', 'Já existe um filiado com esses dados.', STATUS_PERIGO); else
                Sessao::setMensagem('Erro ao cadastrar filiado!', 'Não foi possivel salvar esse filiado.', STATUS_PERIGO);
        } catch (Exception $ex) {
            Sessao::setMensagem('Erro ao cadastrar filiado!', $ex->getMessage(), STATUS_CUIDADO);
        } finally {
            Sistema::redireciona('/cadastro/filiado');
        }

    }

    /**
     * Mostra a tela de cadastro para filiados.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return void
     *
     * @since 1.0.0 - Versão inicial.
     */
    public function telaCadastroFiliado() {
        $oDaoEmpresa = new DaoEmpresa();
        $oDaoCargo = new DaoCargo();
        $oDaoSituacao = new DaoSituacao();


        $aDados['usuario'] = Sistema::getUsuario();
        $aDados['mensagem'] = Sessao::getMensagem();
        $aDados['titulo'] = 'Cadastro de Filiados';

        $aDados['empresas'] = $oDaoEmpresa->findAll();
        $aDados['cargos'] = $oDaoCargo->findAll();
        $aDados['situacoes'] = $oDaoSituacao->findAll();


        ViewCabecalho::render($aDados);
        ViewCadastroFiliado::render($aDados);
        ViewRodape::render([]);

    }

    /**
     * Higieniza e verifica o formulário de filiados.
     *
     * Método reponsável por higienizar os dados vindo da tela de
     * cadastro de novos filiados. Caso os dados sejam válidos, será
     * retorna um instância do Filidoa a ser persistido no banco.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return Filiado
     * @throws Exception
     */
    private static function higienizarDadosFiliado(): Filiado {

        $sNome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $sCpf = filter_input(INPUT_POST, 'cpf', FILTER_DEFAULT);
        $sRg = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_NUMBER_INT);
        $sDataNascimento = filter_input(INPUT_POST, 'dataNascimento', FILTER_DEFAULT);
        $sIdEmpresa = filter_input(INPUT_POST, 'empresa', FILTER_VALIDATE_INT);
        $sIdSituacao = filter_input(INPUT_POST, 'situacao', FILTER_VALIDATE_INT);
        $sTelefone = filter_input(INPUT_POST, 'tel', FILTER_DEFAULT);
        $sCelular = filter_input(INPUT_POST, 'cel', FILTER_DEFAULT);
        $sIdCargo = filter_input(INPUT_POST, 'cargo', FILTER_DEFAULT);

        preg_match_all('/\d/', $sCpf, $matcheCpf, PREG_PATTERN_ORDER);
        preg_match_all('/\d/', $sCelular, $matcheCelular, PREG_PATTERN_ORDER);
        preg_match_all('/\d/', $sTelefone, $matchesTelefone, PREG_PATTERN_ORDER);
        $sCpf = implode('', $matcheCpf[0]);
        $sCelular = implode('', $matcheCelular[0]);
        $sTelefone = implode('', $matchesTelefone[0]);

        if (!ValidaDados::arrayDadosValidos([$sNome, $sCpf, $sRg, $sDataNascimento, $sIdEmpresa, $sIdSituacao, $sTelefone, $sCelular, $sIdCargo]))
            return throw new Exception('Dados estão inválidos.');
        else
            return new Filiado(null, $sNome, $sCpf, $sRg, $sDataNascimento, $sTelefone, $sCelular, $sIdSituacao, $sIdEmpresa, $sIdCargo, null);
    }

    /**
     * Ação responsável por atualizar um filiado.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return void
     *
     * @since 1.0.0 - Atualizan um filiado.
     */
    public function atualizarFiliado() {

        try {
            $oFiliado = self::higienizarDadosFiliado();
            $oFiliado->setIId(Sistema::getFormulario()['id']);
            $oFiliado->atualizarFiliado();

            Sessao::setMensagem('Editado!', 'Filiado editado com sucesso.',);
        } catch (PDOException $oPdoEx) {
            Sessao::setMensagem('Erro!', 'Não foi possível atualizar esse filiado.', STATUS_PERIGO);
        } catch (Exception $oError) {
            Sessao::setMensagem('Erro!', $oError->getMessage(), STATUS_CUIDADO);
            Sistema::redireciona("/edita/filiado?id=" . Sistema::getFormulario()['id']);
        } finally {
            Sistema::redireciona("/visualizar/filiados");
        }

    }

    /**
     * Mostra a tela de edição para filiados.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return void
     *
     * @since 1.0.0 - Salvando um filiado um filiado.
     */
    public function telaEditaFiliado() {
        $oDaoFiliado = new DaoFiliado();
        $oDaoEmpresa = new DaoEmpresa();
        $oDaoCargo = new DaoCargo();
        $oDaoSituacao = new DaoSituacao();
        ['id' => $aIdFiliado] = Sistema::getFormulario();


        $aDados['usuario'] = Sistema::getUsuario();
        $aDados['mensagem'] = Sessao::getMensagem();
        $aDados['id'] = $aIdFiliado;
        $aDados['filiado'] = [];

        try {
            $aDados['filiado'] = $oDaoFiliado->findById($aIdFiliado);
            $aDados['empresas'] = $oDaoEmpresa->findAll();
            $aDados['cargos'] = $oDaoCargo->findAll();
            $aDados['situacoes'] = $oDaoSituacao->findAll();

            ViewCabecalho::render($aDados);
            ViewEditaFiliado::render($aDados);
            ViewRodape::render([]);

        } catch (PDOException $exceptionType) {
            Sessao::setMensagem('Erro!', 'Erro ao editar filiado.', STATUS_CUIDADO);
            Sistema::redireciona('/visualizar/filiados');
        } catch (\TypeError $exceptionType) {
            Sessao::setMensagem("Erro!", 'Por favor entre com id válido.', STATUS_CUIDADO);
            Sistema::redireciona('/visualizar/filiados');

        }

    }

    /**
     * Lista os filiados por páginas.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @since Lista os filiados por páginas
     * @since tratando parâmetro inválidos.
     * @return void
     */
    public function listaFiliados() {
        $aDados['usuario'] = Sistema::getUsuario();
        $aDados['mensagem'] = Sessao::getMensagem();
        $aDados['filiados'] = [];
        $aDados['totalPaginas'] = ceil((Filiado::totalDeFiliados() / LIMITE_POR_PAGINA));
        $aDados['titulo'] = 'Controle de filiados';

        $iPagina = (int) filter_input(INPUT_GET, 'pagina',FILTER_SANITIZE_NUMBER_INT);

        if ($iPagina <= 0) $iPagina = 1;

        $aDados['paginaAtual'] = $iPagina;


        try {
            $aDados['filiados'] = Filiado::recuperarTodosFiliadosPorPagina($iPagina);

        } catch (PDOException$exception) {
            Sessao::setMensagem('Error', 'Erro ao recuperar os dados do banco, tente mais tarde.');
        } finally {
            ViewCabecalho::render($aDados);
            ViewListagemFiliado::render($aDados);
            ViewRodape::render([]);
        }

    }

    /**
     * Remove um Filiado.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @since Remove um filiado de um determinado id.
     *
     * @return void
     */
    public function removeFiliado() {
        try {
            if ($iIdFiliado = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT)) {
                Filiado::removerPorId($iIdFiliado);
                Sessao::setMensagem('Sucesso!', 'Filiado removido!', STATUS_SUCESSO);
            }else{
                Sessao::setMensagem('Erro!', 'Id inválido!', STATUS_CUIDADO);
            }
        } catch (PDOException $exceptionType) {
            if ($exceptionType->getCode() === '23000') {
                Sessao::setMensagem('Erro!', 'Não é possivel remover um filiado que possui dependentes. Remova seus dependentes e tente novamente.', STATUS_PERIGO);
            } else {
                Sessao::setMensagem('Erro!', 'Erro ao remover filiado!', STATUS_CUIDADO);

            }
        } catch (\TypeError $exceptionType) {
            Sessao::setMensagem("Erro!", "id inválido!", STATUS_CUIDADO);
        } finally {
            Sistema::redireciona('/visualizar/filiados');
        }
    }

    /**
     * Lista os filiados aplicando filtros por nome ou datas.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @return void
     *
     * @since 1.0.0 Filtrando apenas por nomes.
     * @since 1.0.1 Filtrando por data.
     * @since 1.0.2 Filtrando por nome e data.
     *
     * @throws Exception
     */
    public function listaFiliadosComFiltro(): void {


        $aDados['usuario'] = Sistema::getUsuario();
        $aDados['mensagem'] = Sessao::getMensagem();
        $aDados['filiados'] = [];
        $aDados['totalPaginas'] = 0;
        $aDados['paginaAtual'] = 1;
        $aDados['proximaPagina'] = 0;
        $aDados['paginaAnterior'] = 0;


        $bCheckName = filter_input(INPUT_GET, 'checkName', FILTER_DEFAULT);
        $bCheckData = filter_input(INPUT_GET, 'checkDate', FILTER_DEFAULT);

        $sNome = filter_input(INPUT_GET, 'nome', FILTER_DEFAULT);
        $sDataInicio = filter_input(INPUT_GET, 'dataInicio', FILTER_DEFAULT);
        $sDataFim = filter_input(INPUT_GET, 'dataFim', FILTER_DEFAULT);


        try {
            // Nenhum campo foi macado.
            if (!($bCheckName || $bCheckData)) throw new Exception('Por favor, escolha uma opção para o filtro.');

            // CheckboxName marcado, porém o nome não foi informado.
            if ($bCheckName && !$sNome) throw new Exception('Campo nome não pode ser vazio');

            // CheckboxDade marcado, as datatas não foram informadas.
            if ($bCheckData && !($sDataInicio && $sDataFim)) throw new Exception('Informe a data de início e fim.');

            // Filtra por nome e data, apenas data, ou apenas nome.
            if ($bCheckName && $bCheckData) {
                $aDados['filiados'] = Filiado::filtrarPorNomeData($sNome, $sDataInicio, $sDataFim);
            } elseif ($bCheckData) {
                $aDados['filiados'] = Filiado::filtrarDataIntervalo($sDataInicio, $sDataFim);
            } else {
                $aDados['filiados'] = Filiado::filtrarPorNome($sNome);
            }


        } catch (PDOException$exception) {
            Sessao::setMensagem('Error', 'Erro ao recuperar os dados do banco, tente mais tarde.');
        } catch (Exception $ex) {
            Sessao::setMensagem('Error', $ex->getMessage(), STATUS_CUIDADO);
            Sistema::redireciona('/visualizar/filiados');

        } finally {
            ViewCabecalho::render($aDados);
            ViewListagemFiliado::render($aDados);
            ViewRodape::render([]);
        }


    }

    /**
     * Ação reponsável por montar um relatórios dos Filiados aniversariantes.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @since Montando um PDF com os aniversarientes do mês.
     * @return void
     */
    public function anivesariantes(): void {
        $loFiliados = Filiado::recuperaTodosPorMes(null); // null = Mês atual.

        $oPdf = new PdfFiliados("Filiados aniversariantes :)", '../src/assets/logo.png');
        $cabecalho = array('Nome', 'Dia', 'Celular'); // Cabeçalho da minha tabela.
        $oPdf->SetFont('Arial', '', 14);
        $oPdf->AddPage();
        $oPdf->tabelaFiliadosAniversariantes($cabecalho, $loFiliados);

        $oPdf->Output();
    }

    /**
     * Ação reponsável por montar um relatório do total de dependentes que cada filiado possui.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @since Montando um PDF do total de dependentes por filiados.
     * @return void
     */
    public function relatorioFiliadosDependentes(): void {
        $aFiliados = Filiado::totalDependentesTodosFiliados();
        $oPdf = new PdfFiliados("Filiados e seus dependentes", '../src/assets/logoPadrao.png');

        $cabecalho = array('Nome do Filiado', 'Celular', 'Total de pendentes');
        $oPdf->SetFont('Arial', '', 14);
        $oPdf->AddPage();
        $oPdf->tabelaFiliadosTotalDependentes($cabecalho, $aFiliados);
        $oPdf->Output();
    }

}