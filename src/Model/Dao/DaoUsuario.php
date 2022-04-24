<?php

namespace Micaelandrade\Avaliacao\Model\Dao;

use Micaelandrade\Avaliacao\Infrastructure\Persistence\ConnectionCreator;
use Micaelandrade\Avaliacao\Model\Administrador;
use Micaelandrade\Avaliacao\Model\Usuario;
use Micaelandrade\Avaliacao\Model\UsuarioComum;
use PDO;

/**
 * Dao reponsável por gerenciar os usuário no banco de dados.
 *
 * @author Micael Andrade micaelandrademoobitech.com.br
 * @version 1.0.0 Versão inicial
 */
class DaoUsuario implements Dao {
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
     * Verifica se um determinado usuário e senha existe no banco.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param string $sLogin
     * @param string $sSenha
     * @return Usuario|null
     * @since  1.0.0 Versão inicial
     */
    public function findByLogin(string $sLogin, string $sSenha): Usuario|null {

        $sConsulta = 'SELECT * FROM uso_usuario WHERE uso_login=:uso_login AND uso_senha=:senha';
        $oStatement = $this->oConexao->prepare($sConsulta);
        $oStatement->execute([':uso_login' => $sLogin, ':senha' => $sSenha,]);
        $aLinha = $oStatement->fetch(\PDO::FETCH_ASSOC);
        if (!$aLinha) {
            return null;
        }

        ['uso_id' => $iId, 'uso_nome' => $sNome, 'uso_data_nascimento' => $sDataNascimento, 'uso_ativo' => $bAtivo, 'uso_senha' => $sSenha, 'uso_login' => $sLogin, 'uso_perfil' => $iPerfil,] = $aLinha;

        if ($iPerfil === USUARIO_ADMINISTRADOR) {
            return new Administrador($iId, $sNome, $sDataNascimento, $bAtivo, $sSenha, $sLogin, $iPerfil);
        } else {
            return new UsuarioComum($iId, $sNome, $sDataNascimento, $bAtivo, $sSenha, $sLogin, $iPerfil);
        }
    }

    /**
     * Salva um determinado usuário no banco.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param mixed $oUsuario
     * @return bool
     * @since  1.0.0 Versão inicial
     */
    function save(mixed $oUsuario): bool {
        $sConsulta = 'INSERT INTO uso_usuario (uso_nome,uso_login,uso_senha, uso_ativo, uso_perfil, uso_data_nascimento) VALUES (:nome, :login,:senha, :ativo, :perfil, :data);';

        $oStatement = $this->oConexao->prepare($sConsulta);
        return $oStatement->execute([':nome' => $oUsuario->getSNome(), ':login' => $oUsuario->getSLogin(), ':senha' => $oUsuario->getSSenha(), ':ativo' => $oUsuario->isBAtivo(), ':perfil' => $oUsuario->getSPerfil(), ':data' => $oUsuario->getSDataNascimento()]);

    }

    public function update(mixed $oData): bool {
    }

    public function deleteByName(string $sName): bool {
    }

    /**
     * Deleta um usuário por id.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param int $iId
     * @return bool
     * @since  1.0.0 Versão inicial
     */
    public function deleteById(int $iId): bool {
        return $this->oConexao->exec("DELETE FROM uso_usuario WHERE uso_id = $iId");
    }

    /**
     * Retorna todos os usuários do banco.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @return array
     * @since  1.0.0 Versão inicial
     */
    public function findAll(): array {
        $aDados = $this->oConexao->query('SELECT * from uso_usuario')->fetchAll(PDO::FETCH_ASSOC);
        return self::hydrateUsuario($aDados);
    }

    /**
     * Encontra um usuário por id.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @param int $iId
     * @return array
     * @since  1.0.0 Versão inicial
     */
    public function findById(int $iId): array {
        return $this->oConexao->query("SELECT * FROM uso_usuario WHERE uso_id = $iId")->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Recebe uma lista de usuários do banco e retorna os objetos.
     * 
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * 
     * @param array $aData
     * @return array
     */
    private function hydrateUsuario(array $aData): array {
        /**
         * Recebe um array representando um usuário e cria um Usuário Admin ou Normal.
         *
         * @author Micael Andrade micaelandrade@moobitech.com.br
         * @return Usuario
         */
        $callbackCriaObjetoUsuario = function (array $aUser)
        {
            $iid = $aUser['uso_id'];
            $sNome = $aUser['uso_nome'];
            $sNascimento = $aUser['uso_data_nascimento'];
            $iAtivo = $aUser['uso_ativo'];
            $sLogin = $aUser['uso_login'];
            $iPerfil = $aUser['uso_perfil'];

            return (int)$iPerfil === USUARIO_ADMINISTRADOR ? new Administrador((int)$iid, $sNome, $sNascimento, (bool)$iAtivo, null, $sLogin, (int)$iPerfil) : new UsuarioComum((int)$iid, $sNome, $sNascimento, (bool)$iAtivo, null, $sLogin, (int)$iPerfil);
        };

        return array_map($callbackCriaObjetoUsuario, $aData);

    }
}