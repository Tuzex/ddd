<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimeUnit;

use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Day;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Week;

final class WeekTest extends UnitTest
{
    public function provideDataForCreation(): array
    {
        return [
            'low' => [Week::class, 0],
            'high' => [Week::class, 54],
        ];
    }

    public function provideDataForEquality(): iterable
    {
        return [
            'equal' => [new Week(10), new Week(10), true],
            'unequal' => [new Week(10), new Week(20), false],
            'mismatch' => [new Week(10), new Day(6), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [new Week(10), 10],
        ];
    }
}
