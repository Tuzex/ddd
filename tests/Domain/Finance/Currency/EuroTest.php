<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Finance\Currency;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Finance\Currency\Euro;

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
