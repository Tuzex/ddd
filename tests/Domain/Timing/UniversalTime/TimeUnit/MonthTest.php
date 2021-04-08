<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimeUnit;

use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Day;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Month;

final class MonthTest extends UnitTest
{
    public function provideDataForCreation(): array
    {
        return [
            'low' => [Month::class, 0],
            'high' => [Month::class, 13],
        ];
    }

    public function provideDataForEquality(): iterable
    {
        return [
            'equal' => [new Month(10), new Month(10), true],
            'unequal' => [new Month(10), new Month(12), false],
            'mismatch' => [new Month(10), new Day(6), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [new Month(10), 10],
        ];
    }
}
