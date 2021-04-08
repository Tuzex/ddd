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
            'equal' => [Week::of(10), Week::of(10), true],
            'unequal' => [Week::of(10), Week::of(20), false],
            'mismatch' => [Week::of(10), Day::of(6), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [Week::of(10), 10],
        ];
    }
}
