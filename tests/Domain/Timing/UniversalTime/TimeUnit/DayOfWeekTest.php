<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimeUnit;

use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\DayOfWeek;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Day;

final class DayOfWeekTest extends UnitTest
{
    public function provideDataForCreation(): array
    {
        return [
            'low' => [DayOfWeek::class, 0],
            'high' => [DayOfWeek::class, 8],
        ];
    }

    public function provideDataForEquality(): iterable
    {
        return [
            'equal' => [DayOfWeek::of(5), DayOfWeek::of(5), true],
            'unequal' => [DayOfWeek::of(5), DayOfWeek::of(3), false],
            'mismatch' => [DayOfWeek::of(5), Day::of(5), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [DayOfWeek::of(5), 5],
        ];
    }
}
