<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Timing\Domain\Unit;

use Tuzex\Ddd\Test\Timing\Domain\UnitTest;
use Tuzex\Ddd\Timing\Domain\Unit\Day;
use Tuzex\Ddd\Timing\Domain\Unit\Week;

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
