<?php

namespace App\Credit\Domain\Event;

use App\Credit\Domain\Entity\Client\Client;
use App\Shared\Event\DomainEventInterface;

final readonly class ClientCreatedEvent implements DomainEventInterface
{
    public function __construct(
        public Client $client
    ) {}
}