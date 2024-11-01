<?php
declare(strict_types=1);

namespace App\Shared\ValueObject;

use App\Shared\Enum\Currency;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class Money
{
    public function __construct(
        public MoneyAmount $amount,
        public Currency $currency
    ) {}

    public function __toString(): string
    {
        return $this->amount->getValue() . ' ' . $this->currency->value;
    }
}