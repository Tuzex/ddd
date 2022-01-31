<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Timing\Domain\Period;

use Tuzex\Ddd\Test\Timing\Domain\PeriodTest;
use Tuzex\Ddd\Timing\Domain\Period\Days;
use Tuzex\Ddd\Timing\Domain\Period\Hours;
use Tuzex\Ddd\Timing\Domain\Period\Minutes;
use Tuzex\Ddd\Timing\Domain\Period\Seconds;

final class SecondsTest extends PeriodTest
{
    public function testItCreatesFromDays(): void
    {
        $numberOfDays = 1;

        $days = new Days($numberOfDays);
        $seconds = Seconds::fromDays($days);

        $this->assertSame($numberOfDays * 24 * 60 * 60, $seconds->value);
    }

    public function testItCreatesFromHours(): void
    {
        $numberOfHours = 1;

        $hours = new Hours($numberOfHours);
        $seconds = Seconds::fromHours($hours);

        $this->assertSame($numberOfHours * 60 * 60, $seconds->value);
    }

    public function testItCreatesFromMinutes(): void
    {
        $numberOfMinutes = 1;

        $minutes = new Minutes($numberOfMinutes);
        $seconds = Seconds::fromMinutes($minutes);

        $this->assertSame($numberOfMinutes * 60, $seconds->value);
    }

    /**
     * @dataProvider provideDataForComparison
     */
    public function testItCompares(Seconds $origin, Seconds $another, int $result): void
    {
        $this->assertSame($result, $origin->compare($another));
    }

    public function provideDataForComparison(): iterable
    {
        $circumstances = [
            'less-than' => [10, 100, -1],
            'equal-to' => [100, 100, 0],
            'greater-than' => [1000, 100, 1],
        ];

        return $this->generateDataForOperations($circumstances);
    }

    /**
     * @dataProvider provideDataForIncreasing
     */
    public function testItIncreases(Seconds $origin, Seconds $another, int $result): void
    {
        $this->assertSame($result, $origin->increase($another)->value);
    }

    public function provideDataForIncreasing(): iterable
    {
        $circumstances = [
            'positive-both' => [100, 50, 150],
            'negative-first' => [-100, 50, -50],
            'negative-second' => [100, -50, 50],
            'negative-both' => [-100, -50, -150],
        ];

        return $this->generateDataForOperations($circumstances);
    }

    /**
     * @dataProvider provideDataForDecreasing
     */
    public function testItDecreases(Seconds $origin, Seconds $another, int $result): void
    {
        $this->assertSame($result, $origin->decrease($another)->value);
    }

    public function provideDataForDecreasing(): iterable
    {
        $circumstances = [
            'positive-both' => [100, 50, 50],
            'negative-first' => [-100, 50, -150],
            'negative-second' => [100, -50, 150],
            'negative-both' => [-100, -50, -50],
        ];

        return $this->generateDataForOperations($circumstances);
    }

    public function testItDecrease(): void
    {
        $origin = new Seconds(100);
        $another = new Seconds(50);

        $this->assertSame(150, $origin->increase($another)->value);
    }

    public function provideDataForEquality(): array
    {
        return [
            'equal' => [new Seconds(100), new Seconds(100), true],
            'unequal' => [new Seconds(100), new Seconds(200), false],
            'mismatch' => [new Seconds(100), new Minutes(100), false],
        ];
    }

    public function providePositivePeriod(): array
    {
        return [
            'positive' => [new Seconds(100)],
        ];
    }

    public function provideNegativePeriod(): array
    {
        return [
            'negative' => [new Seconds(-100)],
        ];
    }

    public function provideData(): array
    {
        return [
            'hundred' => [new Seconds(100), 100],
        ];
    }

    private function generateDataForOperations(array $circumstances): iterable
    {
        foreach ($circumstances as $type => $data) {
            yield $type => [
                'origin' => new Seconds($data[0]),
                'another' => new Seconds($data[1]),
                'result' => $data[2],
            ];
        }
    }
}