<?php
declare(strict_types=1);

namespace App\Shared\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class MoneyAmount
{
    public function __construct(
        #[Assert\GreaterThan(
            value: 0,
        )]
        public int $intValue,
        #[Assert\Range(
            min: -5,
            max: 5,
        )]
        public int $pow,
    ) {}

    public function getValue(): float
    {
        return $this->intValue * pow(10, $this->pow);
    }
}