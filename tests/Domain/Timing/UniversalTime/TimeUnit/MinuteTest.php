<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimeUnit;

use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Minute;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Second;

final class MinuteTest extends UnitTest
{
    public function provideDataForCreation(): array
    {
        return [
            'low' => [Minute::class, -1],
            'high' => [Minute::class, 60],
        ];
    }

    public function provideDataForEquality(): iterable
    {
        return [
            'equal' => [Minute::of(10), Minute::of(10), true],
            'unequal' => [Minute::of(10), Minute::of(20), false],
            'mismatch' => [Minute::of(10), Second::of(30), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [Minute::of(10), 10],
        ];
    }
}
