<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Finance\Domain\Currency;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Finance\Domain\Currency\UsDollar;

final class UsdDollarTest extends TestCase
{
    public function testItContainsValidSubUnit(): void
    {
        $dollar = new UsDollar();

        $this->assertSame(100, $dollar->fraction());
        $this->assertSame(2, $dollar->precision());
    }

    public function testItReturnsValidIsoCode(): void
    {
        $dollar = new UsDollar();

        $this->assertSame('USD', $dollar->isoCode());
    }
}
