<?php

namespace App\Credit\Domain\Event;

use App\Credit\Domain\Entity\LoanApplication;
use App\Shared\Event\DomainEventInterface;

final readonly class LoanApplicationCreatedEvent implements DomainEventInterface
{
    public function __construct(
        public LoanApplication $loanApplication
    ) {}
}