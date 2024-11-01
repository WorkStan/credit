<?php
declare(strict_types=1);

namespace App\Credit\Domain\Entity\Client;

use App\Shared\Enum\State;
use Symfony\Component\Validator\Constraints as Assert;
final readonly class Address
{
    public function __construct(
        #[Assert\Regex('/^[a-zA-Z\s]+$/')]
        public string $city,
        public State  $state,
        public ZIP    $zip,
    ) {}

    public function __toString(): string
    {
        return $this->city . ', ' . $this->state->value . ', ' . $this->zip;
    }
}