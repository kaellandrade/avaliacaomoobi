<?php

namespace Micaelandrade\Avaliacao\Infrastructure;

/**
 * Classe responsável por validação de dados.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial
 */
class  ValidaDados {
    /**
     * Recebe um array de valores e caso um desses seja uma string vazia, false, ou null
     * será retornado false;
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @return void
     * @since 1.0.0 Versão inicial
     * @since 1.0.1 Modificando o nome da função de logar para setLogin.
     */
    public static function arrayDadosValidos(array $aDados) {
        foreach ($aDados as $data) {
            if (empty($data)) return false;
        }

        return true;
    }

    /**
     * Recebe um suário e inicializa a sessão para o mesmo.
     *
     * @author Micael Andrade micaelandrademoobitech.com.br
     * @param $sSenhaA
     * @param $sSenhaB
     * @return bool
     * @since 1.0.0 Versão inicial
     * @since 1.0.1 Modificando o nome da função de logar para setLogin.
     */
    static public function validaSenhas($sSenhaA, $sSenhaB): bool {
        return !(empty($sSenhaA) || empty($sSenhaB)) && $sSenhaA === $sSenhaB;
    }

}