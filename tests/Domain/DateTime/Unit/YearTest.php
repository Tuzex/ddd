<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\DateTime\Unit;

use Tuzex\Ddd\Test\Domain\DateTime\UnitTest;

final class YearTest extends UnitTest
{
    public function provideDataForCreation(): array
    {
        return [
            'low' => [\Tuzex\Ddd\Domain\DateTime\Unit\Year::class, 999],
            'high' => [\Tuzex\Ddd\Domain\DateTime\Unit\Year::class, 3000],
        ];
    }

    public function provideDataForEquality(): iterable
    {
        return [
            'equal' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Year(2020), new \Tuzex\Ddd\Domain\DateTime\Unit\Year(2020), true],
            'unequal' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Year(2020), new \Tuzex\Ddd\Domain\DateTime\Unit\Year(2021), false],
            'mismatch' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Year(2020), new \Tuzex\Ddd\Domain\DateTime\Unit\Month(6), false],
        ];
    }

    public function provideData(): array
    {
        return [
            'ten' => [new \Tuzex\Ddd\Domain\DateTime\Unit\Year(2021), 2021],
        ];
    }
}
