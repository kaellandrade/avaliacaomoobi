<?php

namespace Micaelandrade\Avaliacao\Infrastructure\Persistence;
use PDO;

/**
 * Singleton responsável pela conxão com o banco.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 *
 * @version 1.0.0 Versão inicial.
 * @version 1.0.1 Utilizando o parão Singleton
 */
class ConnectionCreator
{
    public static $pConexao;


    /**
     * Realiza a conexão com o banco (apenas uma vez);
     *
     * Método responsável por realizar e retorna a conexão
     * com o banco de dados.
     *
     * @return PDO
     * @see https://www.php.net/manual/pt_BR/book.pdo.php
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     * @since 1.0.0 Versão inicial.
     */
    public static function createConnection(): PDO
    {
        if (!isset(self::$pConexao)) {
            self::$pConexao = new PDO('mysql:host=mysqlDb;port=3306;dbname=micaelandrade', 'moobi', '123');
            self::$pConexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$pConexao;
    }
}