<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimeUnit;

use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Hour;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Second;

final class SecondTest extends UnitTest
{
    public function provideDataForCreation(): array
    {
        return [
            'low' => [Second::class, -1],
            'high' => [Second::class, 60],
        ];
    }

    public function provideDataForEquality(): iterable
    {
        return [
            'equal' => [Second::of(10), Second::of(10), true],
            'unequal' => [Second::of(10), Second::of(20), false],
            'mismatch' => [Second::of(10), Hour::of(1), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [Second::of(10), 10],
        ];
    }
}
