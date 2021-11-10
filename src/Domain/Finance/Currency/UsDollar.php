<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Finance\Currency;

use Tuzex\Ddd\Domain\Finance\Currency;
use Tuzex\Ddd\Domain\Finance\MainUnit;
use Tuzex\Ddd\Domain\Finance\SubUnit;

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
