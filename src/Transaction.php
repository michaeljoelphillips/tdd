<?php

declare(strict_types=1);

namespace AcmeBank;

interface Transaction
{
    public function getValue(): int;
}
