<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\DateTime\Unit;

use Tuzex\Ddd\Domain\DateTime\Unit\Day;
use Tuzex\Ddd\Domain\DateTime\Unit\Month;
use Tuzex\Ddd\Test\Domain\DateTime\UnitTest;

final class MonthTest extends UnitTest
{
    public function provideDataForCreation(): array
    {
        return [
            'low' => [\Tuzex\Ddd\Domain\DateTime\Unit\Month::class, 0],
            'high' => [\Tuzex\Ddd\Domain\DateTime\Unit\Month::class, 13],
        ];
    }

    public function provideDataForEquality(): iterable
    {
        return [
            'equal' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Month(10), new \Tuzex\Ddd\Domain\DateTime\Unit\Month(10), true],
            'unequal' => [new Month(10), new Month(12), false],
            'mismatch' => [new Month(10), new Day(6), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Month(10), 10],
        ];
    }
}
