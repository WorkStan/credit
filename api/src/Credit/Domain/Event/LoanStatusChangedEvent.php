<?php

namespace App\Credit\Domain\Event;

use App\Credit\Domain\Enum\LoanStatus;
use App\Shared\Event\DomainEventInterface;

final readonly class LoanStatusChangedEvent implements DomainEventInterface
{
    public function __construct(
        public LoanStatus $oldStatus,
        public LoanStatus $newStatus,
    ) {}
}