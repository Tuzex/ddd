<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\Instant;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimePeriod\Seconds;

final class InstantTest extends TestCase
{
    public function testItReturnsValidEpochSeconds(): void
    {
        $seconds = new Seconds(time());
        $instant = new Instant($seconds);

        $this->assertSame($seconds, $instant->epochSeconds());
    }

    public function testItCreatesFromTimeStamp(): void
    {
        $seconds = time();
        $instant = Instant::of($seconds);

        $this->assertSame($seconds, $instant->epochSeconds()->asNumber());
    }

    /**
     * @dataProvider provideDataForEquality
     */
    public function testItIsEquals(Instant $origin, Instant $another, bool $result): void
    {
        $this->assertSame($result, $origin->equals($another));
    }

    public function provideDataForEquality(): iterable
    {
        $presence = new Seconds(time());
        $past = new Seconds(1617802039);

        $circumstances = [
            'identical' => [$presence, $presence, true],
            'mismatched' => [$presence, $past, false],
        ];

        return $this->generateDataForComparison($circumstances);
    }

    /**
     * @dataProvider provideDataForComparison
     */
    public function testItCompares(Instant $origin, Instant $another, int $result): void
    {
        $this->assertSame($result, $origin->compare($another));
    }

    public function provideDataForComparison(): iterable
    {
        $presence = new Seconds(time());
        $past = new Seconds(1617802039);

        $circumstances = [
            'less' => [$past, $presence, -1],
            'equal' => [$presence, $presence, 0],
            'greater' => [$presence, $past, 1],
        ];

        return $this->generateDataForComparison($circumstances);
    }

    /**
     * @dataProvider provideDataForTimeShifting
     */
    public function testItShiftsInTime(Instant $origin, Seconds $shift, int $result): void
    {
        $shifted = $origin->shift($shift);

        $this->assertSame($result, $shifted->epochSeconds()->asNumber());
    }

    public function provideDataForTimeShifting(): iterable
    {
        $presence = new Seconds(1617802039);
        $circumstances = [
            'to-the-future' => [$presence, 11253251, 1629055290],
            'to-the-past' => [$presence, -11253251, 1606548788],
        ];

        foreach ($circumstances as $type => $data) {
            yield $type => [
                'origin' => new Instant($data[0]),
                'shift' => new Seconds($data[1]),
                'result' => $data[2],
            ];
        }
    }

    /**
     * @dataProvider provideDataForTimeDifferentiation
     */
    public function testItDifferencesTimePoint(Instant $origin, Instant $another, int $result): void
    {
        $this->assertSame($result, $origin->delta($another)->asNumber());
    }

    public function provideDataForTimeDifferentiation(): iterable
    {
        $presence = new Seconds(1617802039);
        $circumstances = [
            'future' => [$presence, new Seconds(1606548788), 11253251],
            'past' => [$presence, new Seconds(1617803851), -1812],
        ];

        return $this->generateDataForComparison($circumstances);
    }

    private function generateDataForComparison(array $circumstances): iterable
    {
        foreach ($circumstances as $type => $data) {
            yield $type => [
                'origin' => new Instant($data[0]),
                'another' => new Instant($data[1]),
                'result' => $data[2],
            ];
        }
    }
}
