<?php

namespace App\Credit\Domain\Event;

use App\Credit\Domain\Entity\Client\Client;
use App\Shared\Event\DomainEventInterface;

final readonly class ClientUpdatedEvent implements DomainEventInterface
{
    public function __construct(
        public Client $oldClient,
        public Client $newClient
    ) {}
}