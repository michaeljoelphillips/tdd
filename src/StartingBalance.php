<?php

declare(strict_types=1);

namespace AcmeBank;

use InvalidArgumentException;

class StartingBalance implements Transaction
{
    private $amount;

    public function __construct(int $amount)
    {
        if ($amount < 0) {
            throw new InvalidArgumentException();
        }

        $this->amount = $amount;
    }

    public function getValue(): int
    {
        return $this->amount;
    }
}
