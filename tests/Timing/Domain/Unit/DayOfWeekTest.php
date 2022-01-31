<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Timing\Domain\Unit;

use Tuzex\Ddd\Test\Timing\Domain\UnitTest;
use Tuzex\Ddd\Timing\Domain\Unit\Day;
use Tuzex\Ddd\Timing\Domain\Unit\DayOfWeek;

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
            'equal' => [new DayOfWeek(5), new DayOfWeek(5), true],
            'unequal' => [new DayOfWeek(5), new DayOfWeek(3), false],
            'mismatch' => [new DayOfWeek(5), new Day(5), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [new DayOfWeek(5), 5],
        ];
    }
}
