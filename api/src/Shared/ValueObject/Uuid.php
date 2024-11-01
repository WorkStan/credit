<?php
declare(strict_types=1);

namespace App\Shared\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class Uuid
{
    public function __construct(
        #[Assert\Uuid]
        public string $value
    ) {}

    public function __toString(): string
    {
        return $this->value;
    }
}