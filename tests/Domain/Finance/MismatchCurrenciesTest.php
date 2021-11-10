<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Finance;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Finance\Currency\Euro;
use Tuzex\Ddd\Domain\Finance\MismatchCurrencies;
use Tuzex\Ddd\Domain\Finance\Money;

final class MismatchCurrenciesTest extends TestCase
{
    public function testItReturnsSpecificMessage(): void
    {
        $money = Money::of(12.34, new Euro());
        $exception = new MismatchCurrencies($money, $money);

        $this->assertSame(
            'Mathematical operations are allowed for only the same currency (EUR => EUR).',
            $exception->getMessage(),
        );
    }
}
