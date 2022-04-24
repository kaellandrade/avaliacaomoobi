<?php

namespace Micaelandrade\Avaliacao;

/**
 * Entidade Rota.
 *
 * @author Micael Andrade Dos Santos micaelandrade@moobi.com.br
 * @version 1.0.0 Primeira versão.
 */
class Rota {
    private string $sController;
    private string $sAcao;

    /**
     * Recebe um Controller e uma determinada ação.
     *
     * @author Micael Andrade Dos Santos micaelandrade@moobi.com.br
     *
     * @param string $sController
     * @param string $sAcao
     */
    public function __construct(string $sController, string $sAcao) {
        $this->sController = $sController;
        $this->sAcao = $sAcao;
    }


    /**
     * Retorna o nome do Controlle.
     * @author Micael Andrade Dos Santos micaelandrade@moobi.com.br
     *
     * @return string
     * @since 1.0.0
     */
    public function getController(): string {
        return $this->sController;
    }

    /**
     * Retorna o nome da Ação.
     * @author Micael Andrade Dos Santos micaelandrade@moobi.com.br
     *
     * @return string
     * @since 1.0.0
     */
    public function getAcao(): string {
        return $this->sAcao;
    }

}