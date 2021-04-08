<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimeUnit;

use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Month;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Year;

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
            'equal' => [new Year(2020), new Year(2020), true],
            'unequal' => [new Year(2020), new Year(2021), false],
            'mismatch' => [new Year(2020), new Month(6), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [new Year(2021), 2021],
        ];
    }
}
