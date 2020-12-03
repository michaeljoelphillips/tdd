<?php

declare(strict_types=1);

namespace AcmeBank\Test;

use PHPUnit\Framework\TestCase;
use AcmeBank\Account;
use AcmeBank\InsufficientFunds;
use AcmeBank\Deposit;
use AcmeBank\StartingBalance;
use InvalidArgumentException;

class AccountTest extends TestCase
{
    public function testGetBalance(): void
    {
        $subject = new Account(new StartingBalance(9000));

        $result = $subject->getBalance();

        self::assertEquals(9000, $result);
    }

    public function testDeposit(): void
    {
        $subject = new Account(new StartingBalance(1000));

        $subject->deposit(new Deposit(2000));
        $result = $subject->getBalance();

        self::assertEquals(3000, $result);
    }

    public function testDepositThrowsExceptionWhenAmountIsNegative(): void
    {
        $subject = new Account(1000);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Deposits can only be made for positive numbers');

        $subject->deposit(-2000);
    }

    public function testWithdraw(): void
    {
        $subject = new Account(15000);

        $amount  = $subject->withdraw(5000);
        $balance = $subject->getBalance();

        self::assertEquals(5000, $amount);
        self::assertEquals(10000, $balance);
    }

    public function testWithdrawWithInsufficientFunds(): void
    {
        $subject = new Account(5000);

        $this->expectException(InsufficientFunds::class);
        $this->expectExceptionMessage('You do not have sufficent funds for this transaction');

        $subject->withdraw(10000);
    }
}
