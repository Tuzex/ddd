<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\UniversalTime\Duration;

final class DurationTest extends TestCase
{
    public function testItCreatesFromDays(): void
    {
        $duration = Duration::inDays(1);

        $this->assertSame(86400, $duration->length()->asNumber());
    }

    public function testItCreatesFromHours(): void
    {
        $duration = Duration::inHours(20);

        $this->assertSame(72000, $duration->length()->asNumber());
    }

    public function testItCreatesFromMinutes(): void
    {
        $duration = Duration::inMinutes(3600);

        $this->assertSame(216000, $duration->length()->asNumber());
    }

    public function testItCreatesFromSeconds(): void
    {
        $duration = Duration::inSeconds(86400);

        $this->assertSame(86400, $duration->length()->asNumber());
    }

    /**
     * @dataProvider provideDataForEquality
     */
    public function testItIsEqual(Duration $origin, Duration $another, bool $result): void
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
                'origin' => Duration::inSeconds($data[0]),
                'another' => Duration::inSeconds($data[1]),
                'result' => $data[2],
            ];
        }
    }

    /**
     * @dataProvider provideDataForComparisonLongerThan
     */
    public function testItIsLongerThan(Duration $origin, Duration $another, bool $result): void
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
    public function testItIsLongerThanOrEqual(Duration $origin, Duration $another, bool $result): void
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
    public function testItIsShorterThan(Duration $origin, Duration $another, bool $result): void
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
    public function testItIsShorterThanOrEqual(Duration $origin, Duration $another, bool $result): void
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
    public function testItReturnsValidTimePeriods(Duration $duration, array $periods): void
    {
        $this->assertSame($periods['seconds'], $duration->length()->asNumber());

        $this->assertSame($periods['days'], $duration->days()->asNumber());
        $this->assertSame($periods['hours'], $duration->hours()->asNumber());
        $this->assertSame($periods['minutes'], $duration->minutes()->asNumber());
        $this->assertSame($periods['seconds'], $duration->seconds()->asNumber());
    }

    public function provideTimePeriods(): iterable
    {
        $circumstances = [
            'exactly-one-day' => [1, 24, 1440, 86400],
            'about-two-days-and-few-seconds' => [2, 57, 3434, 206054],
        ];

        foreach ($circumstances as $type => $data) {
            yield $type => [
                'duration' => Duration::inSeconds($data[3]),
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
    public function testItReturnsValidTimeShifts(Duration $duration, array $shitfs): void
    {
        $this->assertSame($shitfs['forward'], $duration->forward()->asNumber());
        $this->assertSame($shitfs['backward'], $duration->backward()->asNumber());
    }

    public function provideTimeShifts(): iterable
    {
        $circumstances = [
            'positive' => [86400, 86400, -86400],
            'negative' => [-206054, 206054, -206054],
        ];

        foreach ($circumstances as $type => $data) {
            yield $type => [
                'duration' => Duration::inSeconds($data[0]),
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
                'origin' => Duration::inSeconds($data[0]),
                'another' => Duration::inSeconds($data[1]),
                'result' => $results[$type],
            ];
        }
    }
}
