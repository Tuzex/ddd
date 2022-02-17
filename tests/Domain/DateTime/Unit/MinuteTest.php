<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\DateTime\Unit;

use Tuzex\Ddd\Domain\DateTime\Unit\Minute;
use Tuzex\Ddd\Domain\DateTime\Unit\Second;
use Tuzex\Ddd\Test\Domain\DateTime\UnitTest;

final class MinuteTest extends UnitTest
{
    public function provideDataForCreation(): array
    {
        return [
            'low' => [\Tuzex\Ddd\Domain\DateTime\Unit\Minute::class, -1],
            'high' => [\Tuzex\Ddd\Domain\DateTime\Unit\Minute::class, 60],
        ];
    }

    public function provideDataForEquality(): iterable
    {
        return [
            'equal' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Minute(10), new Minute(10), true],
            'unequal' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Minute(10), new \Tuzex\Ddd\Domain\DateTime\Unit\Minute(20), false],
            'mismatch' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Minute(10), new Second(30), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Minute(10), 10],
        ];
    }
}
