<?php declare(strict_types=1);

namespace Matleo\BankStatementParser\Model;

class OperationType
{
    const PATTERNS = [
        CreditCardPayment::class,
        EuropeanDirectDebit::class,
        PermanentTransfert::class,
        TransferReceived::class,
        TransferSended::class,
        HomeLoan::class,
    ];

    public static function guess(Operation $operation)
    {
        foreach (self::PATTERNS as $type) {
            preg_match($type::PATTERN, $operation->getDetails(), $matches);
            if (count($matches)) {
                return $type::create($matches);
            }
        }

        return null;
    }
}
