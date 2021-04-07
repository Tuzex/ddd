<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Finance\MonetaryUnit\Currency;

use Tuzex\Ddd\Domain\Finance\MonetaryUnit\Currency;

final class Euro extends Currency
{
    public function __construct()
    {
        parent::__construct(
            new MainUnit('EUR', '€'),
            new SubUnit('cent', 'c', 100),
        );
    }
}
