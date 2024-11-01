<?php

namespace App\Credit\Domain\Event;

use App\Credit\Domain\Entity\Product\ClientProduct;
use App\Credit\Domain\Entity\Product\Product;
use App\Shared\Event\DomainEventInterface;

final readonly class ClientProductChangedEvent implements DomainEventInterface
{
    public function __construct(
        public Product $oldProduct,
        public ClientProduct $newProduct,
    ) {}
}