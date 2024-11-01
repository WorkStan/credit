<?php
declare(strict_types=1);

namespace App\Credit\Domain\Entity\Client;

use Symfony\Component\Validator\Constraints as Assert;
final readonly class Name
{
    public function __construct(
        #[Assert\Regex('/^[a-zA-Z]+$/')]
        public string $firstName,
        #[Assert\Regex('/^[a-zA-Z]+$/')]
        public string $lastName
    ) {}

    public function __toString(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}