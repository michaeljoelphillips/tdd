<?php

declare(strict_types=1);

namespace AcmeBank;

use RuntimeException;

class InsufficientFunds extends RuntimeException
{
    private const MESSAGE = 'You do not have sufficent funds for this transaction';

    public function __construct()
    {
        parent::__construct(self::MESSAGE);
    }
}
