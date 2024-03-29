<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\DateTime\Unit;

use Tuzex\Ddd\Domain\DateTime\Unit\Second;
use Tuzex\Ddd\Test\Domain\DateTime\UnitTest;

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
            'equal' => [new Second(10), new Second(10), true],
            'unequal' => [new Second(10), new Second(20), false],
            'mismatch' => [new Second(10), new \Tuzex\Ddd\Domain\DateTime\Unit\Hour(1), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [new Second(10), 10],
        ];
    }
}
