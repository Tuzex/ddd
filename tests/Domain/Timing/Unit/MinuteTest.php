<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\Unit;

use Tuzex\Ddd\Domain\Timing\Unit\Minute;
use Tuzex\Ddd\Domain\Timing\Unit\Second;
use Tuzex\Ddd\Test\Domain\Timing\UnitTest;

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
            'equal' => [new Minute(10), new Minute(10), true],
            'unequal' => [new Minute(10), new Minute(20), false],
            'mismatch' => [new Minute(10), new Second(30), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [new Minute(10), 10],
        ];
    }
}