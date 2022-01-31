<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Finance\Domain\Currency;

use Tuzex\Ddd\Finance\Domain\Currency;
use Tuzex\Ddd\Finance\Domain\MainUnit;
use Tuzex\Ddd\Finance\Domain\SubUnit;

final class UsDollar extends Currency
{
    public function __construct()
    {
        parent::__construct(
            new MainUnit('USD', '$'),
            new SubUnit('cent', 'c', 100),
        );
    }
}
