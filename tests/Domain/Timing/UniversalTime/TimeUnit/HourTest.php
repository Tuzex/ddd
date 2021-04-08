<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimeUnit;

use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Hour;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Second;

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
            'equal' => [Hour::of(10), Hour::of(10), true],
            'unequal' => [Hour::of(10), Hour::of(20), false],
            'mismatch' => [Hour::of(10), Second::of(30), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [Hour::of(10), 10],
        ];
    }
}
