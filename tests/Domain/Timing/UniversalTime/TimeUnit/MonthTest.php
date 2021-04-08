<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimeUnit;

use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Month;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Day;

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
            'equal' => [Month::of(10), Month::of(10), true],
            'unequal' => [Month::of(10), Month::of(12), false],
            'mismatch' => [Month::of(10), Day::of(6), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [Month::of(10), 10],
        ];
    }
}
