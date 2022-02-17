<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\DateTime\Unit;

use Tuzex\Ddd\Domain\DateTime\Unit\Day;
use Tuzex\Ddd\Test\Domain\DateTime\UnitTest;

final class DayTest extends UnitTest
{
    public function provideDataForCreation(): array
    {
        return [
            'low' => [\Tuzex\Ddd\Domain\DateTime\Unit\Day::class, 0],
            'high' => [\Tuzex\Ddd\Domain\DateTime\Unit\Day::class, 32],
        ];
    }

    public function provideDataForEquality(): iterable
    {
        return [
            'equal' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Day(10), new Day(10), true],
            'unequal' => [new Day(10), new Day(20), false],
            'mismatch' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Day(10), new \Tuzex\Ddd\Domain\DateTime\Unit\Hour(6), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Day(10), 10],
        ];
    }
}
