<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Finance\Domain;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Finance\Domain\Currency\Euro;
use Tuzex\Ddd\Finance\Domain\MismatchCurrencies;
use Tuzex\Ddd\Finance\Domain\Money;

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
