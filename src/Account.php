<?php

declare(strict_types=1);

namespace AcmeBank;

use InvalidArgumentException;

class Account
{
    private int $startingBalance;

    private array $transactions = [];

    public function __construct(StartingBalance $startingBalance)
    {
        $this->transactions[] = $startingBalance;
    }

    public function getBalance(): int
    {
        return array_reduce(
            $this->transactions,
            static function (int $carry, Transaction $item) {
                return $carry += $item->getValue();
            },
            0
        );
    }

    public function deposit(Deposit $amount): void
    {
        if ($amount->getValue() < 0) {
            throw new InvalidArgumentException('Deposits can only be made for positive numbers');
        }

        $this->transactions[] = $amount;
    }

    public function withdraw(int $amount): int
    {
        if ($this->getBalance() < $amount) {
            throw new InsufficientFunds();
        }

        $this->transactions[] = $amount * -1;

        return $amount;
    }
}
