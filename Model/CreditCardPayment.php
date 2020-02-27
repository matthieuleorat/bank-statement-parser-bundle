<?php declare(strict_types=1);

namespace Matleo\BankStatementParserBundle\Model;

class CreditCardPayment
{
    const NAME = 'credit_card_payement';
    const PATTERN = '/^CARTE\s{1}(X\d{4})\s{1}(\d{2}\/\d{2})\s{1}(.*)/s';

    /**
     * @var string
     */
    private $cardId;

    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $merchant;

    private function __construct() {}

    public static function create(array $matches) : CreditCardPayment
    {
        list (, $cardId, $date, $merchant) = $matches;
        $obj = new self();
        $obj->cardId = $cardId;
        $obj->date = $date;
        $obj->merchant = $merchant;

        return $obj;
    }

    /**
     * @return string
     */
    public function getCardId(): string
    {
        return $this->cardId;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getMerchant(): string
    {
        return $this->merchant;
    }
}
