<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Timing\Domain\Unit;

use Tuzex\Ddd\Test\Timing\Domain\UnitTest;
use Tuzex\Ddd\Timing\Domain\Unit\Hour;
use Tuzex\Ddd\Timing\Domain\Unit\Second;

final class HourTest extends UnitTest
{
    public function provideDataForCreation(): array
    {
        return [
            'low' => [Hour::class, -1],
            'high' => [Hour::class, 24],
        ];
    }

    public function provideDataForEquality(): iterable
    {
        return [
            'equal' => [new Hour(10), new Hour(10), true],
            'unequal' => [new Hour(10), new Hour(20), false],
            'mismatch' => [new Hour(10), new Second(30), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [new Hour(10), 10],
        ];
    }
}
