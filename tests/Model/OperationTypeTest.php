<?php declare(strict_types=1);

namespace Matleo\BankStatementParserBundle\tests\Model;

use Matleo\BankStatementParserBundle\Model\CreditCardPayment;
use Matleo\BankStatementParserBundle\Model\EuropeanDirectDebit;
use Matleo\BankStatementParserBundle\Model\Operation;
use Matleo\BankStatementParserBundle\Model\OperationType;
use Matleo\BankStatementParserBundle\Model\PermanentTransfert;
use Matleo\BankStatementParserBundle\Model\TransferReceived;
use Matleo\BankStatementParserBundle\Model\TransferSended;
use PHPUnit\Framework\TestCase;

final class OperationTypeTest extends TestCase
{
    public function testGuessCreditCard() : void
    {
        $mockOperationCreditCard = $this->createMock(Operation::class);
        $mockOperationCreditCard->method('getDetails')
            ->willReturn(CreditCardPaymentTest::MODEL_1);

        $type = OperationType::guess($mockOperationCreditCard);
        $this->assertInstanceOf(CreditCardPayment::class, $type);
    }

    public function testGuessEuropeanDirectDebit() : void
    {
        $mockOperationCreditCard = $this->createMock(Operation::class);
        $mockOperationCreditCard->method('getDetails')
            ->willReturn(EuropeanDirectDebitTest::MODEL_1);

        $type = OperationType::guess($mockOperationCreditCard);
        $this->assertInstanceOf(EuropeanDirectDebit::class, $type);
    }

    public function testGuessPermanentTransfert() : void
    {
        $mockOperationCreditCard = $this->createMock(Operation::class);
        $mockOperationCreditCard->method('getDetails')
            ->willReturn(PermanentTransfertTest::MODEL_1);

        $type = OperationType::guess($mockOperationCreditCard);
        $this->assertInstanceOf(PermanentTransfert::class, $type);
    }

    public function testGuessTransferReceived() : void
    {
        $mockOperationCreditCard = $this->createMock(Operation::class);
        $mockOperationCreditCard->method('getDetails')
            ->willReturn(TransferReceivedTest::MODEL_1);

        $type = OperationType::guess($mockOperationCreditCard);
        $this->assertInstanceOf(TransferReceived::class, $type);
    }

    public function testGuessTransferSended() : void
    {
        $mockOperationCreditCard = $this->createMock(Operation::class);
        $mockOperationCreditCard->method('getDetails')
            ->willReturn(TransferSendedTest::MODEL_1);

        $type = OperationType::guess($mockOperationCreditCard);
        $this->assertInstanceOf(TransferSended::class, $type);
    }

    public function testGuessWithoutMatch() : void
    {
        $mockOperationCreditCard = $this->createMock(Operation::class);
        $mockOperationCreditCard->method('getDetails')
            ->willReturn('unmatched operation');

        $type = OperationType::guess($mockOperationCreditCard);
        $this->assertNull($type);
    }
}
