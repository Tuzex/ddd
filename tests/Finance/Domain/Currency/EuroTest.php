<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Finance\Domain\Currency;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Finance\Domain\Currency\Euro;

final class EuroTest extends TestCase
{
    public function testItContainsValidSubUnit(): void
    {
        $euro = new Euro();

        $this->assertSame(100, $euro->fraction());
        $this->assertSame(2, $euro->precision());
    }

    public function testItReturnsValidIsoCode(): void
    {
        $euro = new Euro();

        $this->assertSame('EUR', $euro->isoCode());
    }
}