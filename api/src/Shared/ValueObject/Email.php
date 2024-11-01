<?php
declare(strict_types=1);

namespace App\Shared\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class Email
{
    public function __construct(
        #[Assert\Email]
        public string $value
    ) {}

    public function __toString(): string
    {
        return $this->value;
    }
}