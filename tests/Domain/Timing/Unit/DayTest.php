<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\Unit;

use Tuzex\Ddd\Domain\Timing\Unit\Day;
use Tuzex\Ddd\Domain\Timing\Unit\Hour;
use Tuzex\Ddd\Test\Domain\Timing\UnitTest;

final class DayTest extends UnitTest
{
    public function provideDataForCreation(): array
    {
        return [
            'low' => [Day::class, 0],
            'high' => [Day::class, 32],
        ];
    }

    public function provideDataForEquality(): iterable
    {
        return [
            'equal' => [new Day(10), new Day(10), true],
            'unequal' => [new Day(10), new Day(20), false],
            'mismatch' => [new Day(10), new Hour(6), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [new Day(10), 10],
        ];
    }
}
