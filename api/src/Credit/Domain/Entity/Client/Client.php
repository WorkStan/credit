<?php
declare(strict_types=1);

namespace App\Credit\Domain\Entity\Client;

use App\Credit\Domain\Event\ClientCreatedEvent;
use App\Shared\Aggregate\AggregateRoot;
use App\Shared\ValueObject\Email;
use App\Shared\ValueObject\PhoneNumber;
use App\Shared\ValueObject\Uuid;

final class Client extends AggregateRoot
{
    private function __construct(
        public Uuid $id,
        public Name $name,
        public Age $age,
        public Address $address,
        public SSN $ssn,
        public FICO $fico,
        public Email $email,
        public PhoneNumber $phoneNumber
    ) {}

    public function create(
        Uuid $id,
        Name $name,
        Age $age,
        Address $address,
        SSN $ssn,
        FICO $fico,
        Email $email,
        PhoneNumber $phoneNumber
    ): self
    {
        $client = new self($id, $name, $age, $address, $ssn, $fico, $email, $phoneNumber);
        $this->recordDomainEvent(new ClientCreatedEvent($client));
        return $client;
    }
}