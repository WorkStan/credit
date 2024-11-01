<?php
declare(strict_types=1);

namespace App\Credit\Domain\Entity;

use App\Credit\Domain\Entity\Client\Client;
use App\Credit\Domain\Entity\Product\ClientProduct;
use App\Credit\Domain\Enum\LoanStatus;
use App\Credit\Domain\Event\ClientProductChangedEvent;
use App\Credit\Domain\Event\LoanApplicationCreatedEvent;
use App\Credit\Domain\Event\LoanStatusChangedEvent;
use App\Credit\Domain\Exception\ProductCantBeChangedException;
use App\Credit\Domain\Exception\StatusCantBeChangedException;
use App\Shared\Aggregate\AggregateRoot;
use App\Shared\ValueObject\Uuid;

final class LoanApplication extends AggregateRoot
{
    /** @var array<string, string[]> */
    private array $availableStatusChanges = [
        LoanStatus::New->value => [LoanStatus::Allow->value, LoanStatus::Disallow->value],
        LoanStatus::Allow->value => [LoanStatus::Issued->value, LoanStatus::Disallow->value],
        LoanStatus::Issued->value => [LoanStatus::Repaid->value],
    ];

    private function __construct(
        private Uuid $id,
        private readonly Client $client,
        private ClientProduct $clientProduct,
        private LoanStatus $status = LoanStatus::New
    ) {}

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getClientProduct(): ClientProduct
    {
        return $this->clientProduct;
    }

    public function getStatus(): LoanStatus
    {
        return $this->status;
    }

    public static function create(
        Uuid           $id,
        Client         $client,
        ClientProduct  $clientProduct,
    ): LoanApplication
    {
        $loanApplication = new self($id, $client, $clientProduct);
        $loanApplication->recordDomainEvent(new LoanApplicationCreatedEvent($loanApplication));
        return $loanApplication;
    }

    /**
     * @throws ProductCantBeChangedException
     */
    public function changeProduct(ClientProduct $clientProduct): void
    {
        if ($this->status !== LoanStatus::New) {
            throw new ProductCantBeChangedException('Loan status is not New');
        }
        $oldClientProduct = $this->clientProduct;
        $newClientProduct = $clientProduct;
        $this->clientProduct = $clientProduct;
        $this->recordDomainEvent(new ClientProductChangedEvent($oldClientProduct, $newClientProduct));
    }

    /**
     * @throws StatusCantBeChangedException
     */
    public function changeStatus(LoanStatus $status): void
    {
        if (
            !in_array($this->status->value, $this->availableStatusChanges)
            && !in_array($status->value, $this->availableStatusChanges[$this->status->value])
        ) {
            throw new StatusCantBeChangedException('Status can\'t changed');
        }
        $oldStatus = $this->status;
        $newStatus = $status;
        $this->status = $status;
        $this->recordDomainEvent(new LoanStatusChangedEvent($oldStatus, $newStatus));
    }
}