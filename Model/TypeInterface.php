<?php declare(strict_types=1);

namespace Matleo\BankStatementParser\Model;

interface TypeInterface
{
    /**
     * @param string $data
     *
     * @return TypeInterface|null
     */
    public static function createFromString(string $data) : ? TypeInterface;

    /**
     * @param Operation $operation
     *
     * @return TypeInterface|null
     */
    public static function createFormOperation(Operation $operation) : ? TypeInterface;

    /**
     * @param array $matches
     *
     * @return TypeInterface
     */
    public static function create(array $matches) : TypeInterface;
}
