<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimePeriod;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimePeriod\Period;

abstract class PeriodTest extends TestCase
{
    /**
     * @dataProvider provideDataForEquality
     */
    public function testItIsEqual(Period $origin, Period $another, bool $result): void
    {
        $this->assertSame($result, $origin->equals($another));
    }

    abstract public function provideDataForEquality(): iterable;

    /**
     * @dataProvider providePositivePeriod
     */
    public function testItIsPositive(Period $period): void
    {
        $this->assertTrue($period->positive());
    }

    abstract public function providePositivePeriod(): array;

    /**
     * @dataProvider provideNegativePeriod
     */
    public function testItIsNegative(Period $period): void
    {
        $this->assertTrue($period->negative());
    }

    abstract public function provideNegativePeriod(): array;

    /**
     * @dataProvider provideData
     */
    public function testItReturnsValidNumber(Period $period, int $number): void
    {
        $positiveNumber = abs($number);
        $negativeNumber = abs($number) * -1;

        $this->assertSame($number, $period->asNumber());

        $this->assertSame($positiveNumber, $period->absolute()->asNumber());
        $this->assertSame($negativeNumber, $period->negated()->asNumber());
    }

    abstract public function provideData(): array;
}
