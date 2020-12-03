<?php

declare(strict_types=1);

namespace AcmeBank\Test;

use PHPUnit\Framework\TestCase;
use AcmeBank\StartingBalance;
use InvalidArgumentException;

class StartingBalanceTest extends TestCase
{
    public function testGetValue(): void
    {
        $subject = new StartingBalance(20000);

        $result = $subject->getValue();

        self::assertEquals(20000, $result);
    }

    public function testStartingBalanceCannotBeNegative(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new StartingBalance(-20000);
    }
}
