<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimeUnit;

use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Day;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Hour;

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
            'equal' => [Day::of(10), Day::of(10), true],
            'unequal' => [Day::of(10), Day::of(20), false],
            'mismatch' => [Day::of(10), Hour::of(6), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [Day::of(10), 10],
        ];
    }
}
