<?php

namespace Micaelandrade\Avaliacao;

use Micaelandrade\Avaliacao\Infrastructure\EstrategiaAcesso;
use Micaelandrade\Avaliacao\Infrastructure\Sistema;

/**
 * Classe responsável por tratar as rotas da aplicação.
 *
 * @author Micael Andrade Dos Santos micaelandrade@moobi.com.br
 * @version 1.0.0 Primeira versão.
 *
 */
class Rotas
{
    private static array $aRotas;

    public function __construct()
    {

        $this->initRotas();
        $this->executar(Sistema::getUrlPath());
    }

    /**
     * @param array $aRotas
     */
    public function setARotas(array $aRotas): void
    {
        self::$aRotas = $aRotas;
    }

    /**
     * Inicia o mapeamento das rotas para seus devidos controllers.
     *
     *
     * @return void
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @since 1.0.0 - Recuperando o path da url
     * @since 1.0.1 - Definindo rotas para usuario comum.
     * @since 1.0.2 Definindo novas rotas.
     */
    private function initRotas(): void
    {
        /** @var  array $aRotas */
        $aRotas =
            [
                '/' => new Rota('LoginController', 'telaLogin'),
                '/painel' => new Rota('LoginController', 'telaPainel'),
                '/sair' => new Rota('LoginController', 'sair'),
                '/realiza/login' => new Rota('LoginController', 'realizaLogin'),

                '/salva/filiado' => new Rota('FiliadoController', 'cadastraFiliado'),
                '/cadastro/filiado' => new Rota('FiliadoController', 'telaCadastroFiliado'),
                '/visualizar/filiados' => new Rota('FiliadoController', 'listaFiliados'),
                '/edita/filiado' => new Rota('FiliadoController', 'telaEditaFiliado'),
                '/remove/filiado' => new Rota('FiliadoController', 'removeFiliado'),
                '/relatorio/aniversariantes' => new Rota('FiliadoController', 'anivesariantes'),
                '/relatorio/totaldependentes' => new Rota('FiliadoController','relatorioFiliadosDependentes'),
                '/filiado/filtro' => new Rota('FiliadoController', 'listaFiliadosComFiltro'),
                '/atualizar/filiado' => new  Rota ('FiliadoController', 'atualizarFiliado'),

                '/cadastro/empresa' => new Rota('EmpresaController', 'telaCadastroEmpresa'),
                '/salva/empresa' => new Rota('EmpresaController', 'cadastraEmpresa'),
                '/remove/empresa' => new Rota ('EmpresaController', 'removeEmpresa'),
                '/edita/empresa' => new Rota ('EmpresaController', 'atualizaEmpresa'),

                '/cadastro/cargo' => new Rota('CargoController', 'telaCadastroCargo'),
                '/salva/cargo' => new Rota('CargoController', 'cadastraCargo'),
                '/remove/cargo' => new Rota('CargoController', 'removeCargo'),
                '/edita/cargo' => new Rota('CargoController', 'atualizaCargo'),

                '/salva/situacao' => new Rota('SituacaoController', 'cadastraSituacao'),
                '/remove/situacao' => new Rota('SituacaoController', 'removeSituacao'),
                '/edita/situacao' => new Rota('SituacaoController', 'atualizaSituacao'),
                '/cadastro/situacao' => new Rota('SituacaoController', 'telaCadastroSituacao'),

                '/cadastro/dependente' => new Rota('DependenteController', 'cadastrarDependente'),
                '/visualizar/dependentes' => new Rota('DependenteController', 'visualizarDependentes'),
                '/remove/dependente' => new Rota('DependenteController', 'removerDependente'),

                '/cadastro/usuario' => new Rota('AdminController', 'telaCadastroUsuario'),
                '/salva/usuario' => new Rota('AdminController', 'cadastraUsuario'),
                '/listar/usuarios'=>new Rota('AdminController', 'visualizarUsuarios'),
                '/remove/usuario'=>new Rota('AdminController', 'removeUsuario')


            ];

        $this->setARotas($aRotas);
    }

    /**
     * Cria um Controller de forma dinâmica.
     *
     * Caso a url requisitada faça parte da nossa aplicação
     * seu devido controller será intanciado e sua ação chamada.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @param string $sUrl url requisitada.
     *
     * @return void
     *
     * @since 1.0.0 Versão inicial.
     */
    public function executar(string $sUrl): void
    {
        /** @var $rRotaSolicidata Rota */
        $rRotaSolicidata = null;

        if (isset(self::$aRotas[$sUrl])) {
            $rRotaSolicidata = self::$aRotas[$sUrl];
        }

        if (is_null($rRotaSolicidata)) {
            http_response_code(404);
            exit();
        }

        if (!EstrategiaAcesso::possuiAcesso($sUrl)) {
            Sistema::redireciona('/');
        } else {
            $cClasseController = 'Micaelandrade\\Avaliacao\\Controller\\' . ucfirst($rRotaSolicidata->getController());
            $cController = new $cClasseController;

            $cAcao = $rRotaSolicidata->getAcao();
            $cController->$cAcao();
        }

    }


}