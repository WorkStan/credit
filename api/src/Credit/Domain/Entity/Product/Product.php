<?php
declare(strict_types=1);

namespace App\Credit\Domain\Entity\Product;

use App\Credit\Domain\Enum\InterestRateType;
use App\Credit\Domain\Exception\InterestRateAlreadyExistException;
use App\Credit\Domain\Exception\InterestRateDoesNotExistException;
use App\Credit\Domain\Exception\InterestRateNegativeException;
use App\Shared\ValueObject\Money;
use App\Shared\ValueObject\Uuid;

abstract class Product
{
    public function __construct(
        protected Uuid $id,
        protected Name $name,
        protected LoanTerm $loanTerm,
        /** @var InterestRate[] */
        protected array $interestRates,
        protected Money $money,
    ) {}

    /**
     * @throws InterestRateAlreadyExistException
     * @throws InterestRateNegativeException
     */
    public function addInterestRate(InterestRate $interestRate): void
    {
        if (array_key_exists($interestRate->key->value, $this->interestRates)) {
            throw new InterestRateAlreadyExistException('Interest rate already exists');
        }
        $this->interestRates[$interestRate->key->value] = $interestRate;
        if ($this->getTotalInterestRate() < 0) {
            unset($this->interestRates[$interestRate->key->value]);
            throw new InterestRateNegativeException('Total interest rate must be greater than 0');
        }
    }

    /**
     * @throws InterestRateDoesNotExistException
     */
    public function removeInterestRate(InterestRate $interestRate): void
    {
        if (!array_key_exists($interestRate->key->value, $this->interestRates)) {
            throw new InterestRateDoesNotExistException('Interest rate already exists');
        }
        unset($this->interestRates[$interestRate->key->value]);
    }

    public function getTotalInterestRate(): float
    {
        $total = 0;
        foreach ($this->interestRates as $interestRate) {
            if ($interestRate->type === InterestRateType::Add) {
                $total += $interestRate->value;
            }
            if ($interestRate->type === InterestRateType::Sub) {
                $total -= $interestRate->value;
            }
        }
        return $total;
    }
}