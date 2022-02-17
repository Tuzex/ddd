<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\DateTime\Unit;

use Tuzex\Ddd\Domain\DateTime\Unit\Week;
use Tuzex\Ddd\Test\Domain\DateTime\UnitTest;

final class WeekTest extends UnitTest
{
    public function provideDataForCreation(): array
    {
        return [
            'low' => [Week::class, 0],
            'high' => [\Tuzex\Ddd\Domain\DateTime\Unit\Week::class, 54],
        ];
    }

    public function provideDataForEquality(): iterable
    {
        return [
            'equal' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Week(10), new \Tuzex\Ddd\Domain\DateTime\Unit\Week(10), true],
            'unequal' => [new Week(10), new Week(20), false],
            'mismatch' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Week(10), new \Tuzex\Ddd\Domain\DateTime\Unit\Day(6), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [new Week(10), 10],
        ];
    }
}
