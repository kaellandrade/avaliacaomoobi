<?php

namespace Micaelandrade\Avaliacao\Model\Dao;

/**
 * Interface Dao para Acesso de dados no banco.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 * @version 1.0.0 Versão inicial
 */
interface Dao {
    public function save(mixed $oData): bool;
    public function update(mixed $oData): bool;

    public function deleteByName(string $sName): bool;
    public function deleteById(int $iId): bool;

    public function findAll(): array;
    public function findById(int $iId): array;
}