<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\DateTime\Period;

use Tuzex\Ddd\Domain\DateTime\Period\Days;
use Tuzex\Ddd\Domain\DateTime\Period\Minutes;
use Tuzex\Ddd\Domain\DateTime\Period\Seconds;
use Tuzex\Ddd\Test\Domain\DateTime\PeriodTest;

final class SecondsTest extends PeriodTest
{
    public function testItCreatesFromDays(): void
    {
        $numberOfDays = 1;

        $days = new Days($numberOfDays);
        $seconds = \Tuzex\Ddd\Domain\DateTime\Period\Seconds::fromDays($days);

        $this->assertSame($numberOfDays * 24 * 60 * 60, $seconds->value);
    }

    public function testItCreatesFromHours(): void
    {
        $numberOfHours = 1;

        $hours = new \Tuzex\Ddd\Domain\DateTime\Period\Hours($numberOfHours);
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
    public function testItCompares(Seconds $origin, \Tuzex\Ddd\Domain\DateTime\Period\Seconds $another, int $result): void
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
    public function testItIncreases(Seconds $origin, \Tuzex\Ddd\Domain\DateTime\Period\Seconds $another, int $result): void
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
    public function testItDecreases(\Tuzex\Ddd\Domain\DateTime\Period\Seconds $origin, Seconds $another, int $result): void
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
        $origin = new \Tuzex\Ddd\Domain\DateTime\Period\Seconds(100);
        $another = new \Tuzex\Ddd\Domain\DateTime\Period\Seconds(50);

        $this->assertSame(150, $origin->increase($another)->value);
    }

    public function provideDataForEquality(): array
    {
        return [
            'equal' => [new Seconds(100), new \Tuzex\Ddd\Domain\DateTime\Period\Seconds(100), true],
            'unequal' => [new Seconds(100), new Seconds(200), false],
            'mismatch' => [new \Tuzex\Ddd\Domain\DateTime\Period\Seconds(100), new Minutes(100), false],
        ];
    }

    public function providePositivePeriod(): array
    {
        return [
            'positive' => [new \Tuzex\Ddd\Domain\DateTime\Period\Seconds(100)],
        ];
    }

    public function provideNegativePeriod(): array
    {
        return [
            'negative' => [new \Tuzex\Ddd\Domain\DateTime\Period\Seconds(-100)],
        ];
    }

    public function provideData(): array
    {
        return [
            'hundred' => [new \Tuzex\Ddd\Domain\DateTime\Period\Seconds(100), 100],
        ];
    }

    private function generateDataForOperations(array $circumstances): iterable
    {
        foreach ($circumstances as $type => $data) {
            yield $type => [
                'origin' => new \Tuzex\Ddd\Domain\DateTime\Period\Seconds($data[0]),
                'another' => new Seconds($data[1]),
                'result' => $data[2],
            ];
        }
    }
}
