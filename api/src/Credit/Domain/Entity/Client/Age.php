<?php
declare(strict_types=1);

namespace App\Credit\Domain\Entity\Client;

use Symfony\Component\Validator\Constraints as Assert;
final readonly class Age
{
    public function __construct(
        #[Assert\Range(
            min: 0,
            max: 199,
        )]
        public int $value,
    ) {}

    public function __toString(): string
    {
        return (string)$this->value;
    }
}