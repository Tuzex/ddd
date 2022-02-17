<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\DateTime;

use PHPUnit\Framework\TestCase;

final class DurationTest extends TestCase
{
    public function testItCreatesFromDays(): void
    {
        $duration = \Tuzex\Ddd\Domain\DateTime\Duration::inDays(1);

        $this->assertSame(86400, $duration->length()->value);
    }

    public function testItCreatesFromHours(): void
    {
        $duration = \Tuzex\Ddd\Domain\DateTime\Duration::inHours(20);

        $this->assertSame(72000, $duration->length()->value);
    }

    public function testItCreatesFromMinutes(): void
    {
        $duration = \Tuzex\Ddd\Domain\DateTime\Duration::inMinutes(3600);

        $this->assertSame(216000, $duration->length()->value);
    }

    public function testItCreatesFromSeconds(): void
    {
        $duration = \Tuzex\Ddd\Domain\DateTime\Duration::inSeconds(86400);

        $this->assertSame(86400, $duration->length()->value);
    }

    /**
     * @dataProvider provideDataForEquality
     */
    public function testItIsEqual(\Tuzex\Ddd\Domain\DateTime\Duration $origin, \Tuzex\Ddd\Domain\DateTime\Duration $another, bool $result): void
    {
        $this->assertSame($result, $origin->equals($another));
    }

    public function provideDataForEquality(): iterable
    {
        $circumstances = [
            'same' => [86400, 86400, true],
            'different' => [86400, 72000, false],
        ];

        foreach ($circumstances as $type => $data) {
            yield $type => [
                'origin' => \Tuzex\Ddd\Domain\DateTime\Duration::inSeconds($data[0]),
                'another' => \Tuzex\Ddd\Domain\DateTime\Duration::inSeconds($data[1]),
                'result' => $data[2],
            ];
        }
    }

    /**
     * @dataProvider provideDataForComparisonLongerThan
     */
    public function testItIsLongerThan(\Tuzex\Ddd\Domain\DateTime\Duration $origin, \Tuzex\Ddd\Domain\DateTime\Duration $another, bool $result): void
    {
        $this->assertSame($result, $origin->longerThan($another));
    }

    public function provideDataForComparisonLongerThan(): iterable
    {
        $results = [
            'shorten' => false,
            'same' => false,
            'longer' => true,
        ];

        return $this->generateDataForComparison($results);
    }

    /**
     * @dataProvider provideDataForComparisonLongerThanOrEqualTo
     */
    public function testItIsLongerThanOrEqual(\Tuzex\Ddd\Domain\DateTime\Duration $origin, \Tuzex\Ddd\Domain\DateTime\Duration $another, bool $result): void
    {
        $this->assertSame($result, $origin->longerThanOrEqualTo($another));
    }

    public function provideDataForComparisonLongerThanOrEqualTo(): iterable
    {
        $results = [
            'shorten' => false,
            'same' => true,
            'longer' => true,
        ];

        return $this->generateDataForComparison($results);
    }

    /**
     * @dataProvider provideDataForComparisonShortenThan
     */
    public function testItIsShorterThan(\Tuzex\Ddd\Domain\DateTime\Duration $origin, \Tuzex\Ddd\Domain\DateTime\Duration $another, bool $result): void
    {
        $this->assertSame($result, $origin->shorterThan($another));
    }

    public function provideDataForComparisonShortenThan(): iterable
    {
        $results = [
            'shorten' => true,
            'same' => false,
            'longer' => false,
        ];

        return $this->generateDataForComparison($results);
    }

    /**
     * @dataProvider provideDataForComparisonShorterThanOrEqualTo
     */
    public function testItIsShorterThanOrEqual(\Tuzex\Ddd\Domain\DateTime\Duration $origin, \Tuzex\Ddd\Domain\DateTime\Duration $another, bool $result): void
    {
        $this->assertSame($result, $origin->shorterThanOrEqualTo($another));
    }

    public function provideDataForComparisonShorterThanOrEqualTo(): iterable
    {
        $results = [
            'shorten' => true,
            'same' => true,
            'longer' => false,
        ];

        return $this->generateDataForComparison($results);
    }

    /**
     * @dataProvider provideTimePeriods
     */
    public function testItReturnsValidTimePeriods(\Tuzex\Ddd\Domain\DateTime\Duration $duration, array $periods): void
    {
        $this->assertSame($periods['seconds'], $duration->length()->value);

        $this->assertSame($periods['days'], $duration->days()->value);
        $this->assertSame($periods['hours'], $duration->hours()->value);
        $this->assertSame($periods['minutes'], $duration->minutes()->value);
        $this->assertSame($periods['seconds'], $duration->seconds->value);
    }

    public function provideTimePeriods(): iterable
    {
        $circumstances = [
            'exactly-one-day' => [1, 24, 1440, 86400],
            'about-two-days-and-few-seconds' => [2, 57, 3434, 206054],
        ];

        foreach ($circumstances as $type => $data) {
            yield $type => [
                'duration' => \Tuzex\Ddd\Domain\DateTime\Duration::inSeconds($data[3]),
                'periods' => [
                    'days' => $data[0],
                    'hours' => $data[1],
                    'minutes' => $data[2],
                    'seconds' => $data[3],
                ],
            ];
        }
    }

    /**
     * @dataProvider provideTimeShifts
     */
    public function testItReturnsValidTimeShifts(\Tuzex\Ddd\Domain\DateTime\Duration $duration, array $shitfs): void
    {
        $this->assertSame($shitfs['forward'], $duration->forward()->value);
        $this->assertSame($shitfs['backward'], $duration->backward()->value);
    }

    public function provideTimeShifts(): iterable
    {
        $circumstances = [
            'positive' => [86400, 86400, -86400],
            'negative' => [-206054, 206054, -206054],
        ];

        foreach ($circumstances as $type => $data) {
            yield $type => [
                'duration' => \Tuzex\Ddd\Domain\DateTime\Duration::inSeconds($data[0]),
                'shifts' => [
                    'forward' => $data[1],
                    'backward' => $data[2],
                ],
            ];
        }
    }

    private function generateDataForComparison(array $results): iterable
    {
        $circumstances = [
            'shorten' => [86400, -97000],
            'same' => [86400, 86400],
            'longer' => [86400, 45200],
        ];

        foreach ($circumstances as $type => $data) {
            yield $type => [
                'origin' => \Tuzex\Ddd\Domain\DateTime\Duration::inSeconds($data[0]),
                'another' => \Tuzex\Ddd\Domain\DateTime\Duration::inSeconds($data[1]),
                'result' => $results[$type],
            ];
        }
    }
}
