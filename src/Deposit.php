<?php

declare(strict_types=1);

namespace AcmeBank;

class Deposit implements Transaction
{
    public function getValue(): int
    {
        return 100;
    }
}
