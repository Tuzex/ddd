<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimeUnit;

use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Year;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Month;

final class YearTest extends UnitTest
{
    public function provideDataForCreation(): array
    {
        return [
            'low' => [Year::class, 999],
            'high' => [Year::class, 3000],
        ];
    }

    public function provideDataForEquality(): iterable
    {
        return [
            'equal' => [Year::of(2020), Year::of(2020), true],
            'unequal' => [Year::of(2020), Year::of(2021), false],
            'mismatch' => [Year::of(2020), Month::of(6), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [Year::of(2021), 2021],
        ];
    }
}
