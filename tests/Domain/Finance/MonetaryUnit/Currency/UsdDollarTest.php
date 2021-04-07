<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Finance\MonetaryUnit\Currency;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Finance\MonetaryUnit\Currency\UsDollar;

final class UsdDollarTest extends TestCase
{
    public function testItContainsValidSubUnit(): void
    {
        $dollar = new UsDollar();

        $this->assertSame(100, $dollar->fraction());
        $this->assertSame(2, $dollar->precision());
    }
}
