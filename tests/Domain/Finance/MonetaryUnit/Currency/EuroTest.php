<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Finance\MonetaryUnit\Currency;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Finance\MonetaryUnit\Currency\Euro;

final class EuroTest extends TestCase
{
    public function testItContainsValidSubUnit(): void
    {
        $euro = new Euro();

        $this->assertSame(100, $euro->fraction());
        $this->assertSame(2, $euro->precision());
    }
}
