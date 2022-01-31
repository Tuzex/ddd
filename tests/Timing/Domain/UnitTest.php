<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Timing\Domain;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Timing\Domain\Unit;
use Webmozart\Assert\InvalidArgumentException;

abstract class UnitTest extends TestCase
{
    /**
     * @dataProvider provideDataForCreation
     */
    public function testItTrowsExceptionIfValueIsInvalid(string $unit, int $value): void
    {
        $this->expectException(InvalidArgumentException::class);

        new $unit($value);
    }

    abstract public function provideDataForCreation(): array;

    /**
     * @dataProvider provideDataForEquality
     */
    public function testItIsEqual(Unit $origin, Unit $another, bool $result): void
    {
        $this->assertSame($result, $origin->equals($another));
    }

    abstract public function provideDataForEquality(): iterable;

    /**
     * @dataProvider provideData
     */
    public function testItReturnsValidNumber(Unit $unit, int $number): void
    {
        $this->assertSame($number, $unit->value);
    }

    abstract public function provideData(): array;
}
