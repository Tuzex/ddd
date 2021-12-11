<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing;

use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\Clock;
use Tuzex\Ddd\Domain\Timing\DateTime;
use Tuzex\Ddd\Domain\Timing\Instant;
use Tuzex\Ddd\Domain\Timing\Period\Seconds;

final class DateTimeTest extends TestCase
{
    private const PAST = 1617892857;
    private const PRESENT = 1617894106;
    private const FUTURE = 1617894114;

    public function testItCreatesFromClock(): void
    {
        $dateTime = DateTime::asOf($this->mockClock());

        $this->assertSame(self::PRESENT, $dateTime->instant()->epochSeconds->value);
    }

    public function testItCreatesFromAnotherDateTime(): void
    {
        $origin = DateTime::sinceThen(
            DateTime::asOf($this->mockClock())
        );

        $this->assertSame(self::PRESENT, $origin->instant()->epochSeconds->value);
    }

    /**
     * @dataProvider provideNativeDateTime
     */
    public function testItReturnsValidInstant(DateTimeImmutable $present): void
    {
        $dateTime = DateTime::by($present);

        $this->assertSame(self::PRESENT, $dateTime->instant()->epochSeconds->value);
    }

    public function provideNativeDateTime(): array
    {
        return [
            'present' => [new DateTimeImmutable('@'.self::PRESENT, new DateTimeZone('UTC'))],
        ];
    }

    /**
     * @dataProvider provideDataForEquality
     */
    public function testItIsEqual(DateTime $origin, DateTime $another, bool $result): void
    {
        $this->assertSame($result, $origin->equals($another));
    }

    public function provideDataForEquality(): iterable
    {
        $circumstances = [
            'equal' => [self::PRESENT, self::PRESENT, true],
            'unequal' => [self::PRESENT, self::FUTURE, false],
        ];

        foreach ($circumstances as $type => $data) {
            yield $type => [
                'origin' => new DateTime(Instant::of($data[0])),
                'another' => new DateTime(Instant::of($data[1])),
                'result' => $data[2],
            ];
        }
    }

    /**
     * @dataProvider provideDataForComparisonLaterThan
     */
    public function testItIsLaterThan(DateTime $origin, DateTime $another, bool $result): void
    {
        $this->assertSame($result, $origin->laterThan($another));
    }

    public function provideDataForComparisonLaterThan(): iterable
    {
        $results = [
            'earlier-than' => false,
            'equal-to' => false,
            'later-than' => true,
        ];

        return $this->generateDataForComparison($results);
    }

    /**
     * @dataProvider provideDataForComparisonLaterThanOrEqualTo
     */
    public function testItIsLaterThanOrEqualTo(DateTime $origin, DateTime $another, bool $result): void
    {
        $this->assertSame($result, $origin->laterThanOrEqualTo($another));
    }

    public function provideDataForComparisonLaterThanOrEqualTo(): iterable
    {
        $results = [
            'earlier-than' => false,
            'equal-to' => true,
            'later-than' => true,
        ];

        return $this->generateDataForComparison($results);
    }

    /**
     * @dataProvider provideDataForComparisonEarlierThan
     */
    public function testItIsEarlierThan(DateTime $origin, DateTime $another, bool $result): void
    {
        $this->assertSame($result, $origin->earlierThan($another));
    }

    public function provideDataForComparisonEarlierThan(): iterable
    {
        $results = [
            'earlier-than' => true,
            'equal-to' => false,
            'later-than' => false,
        ];

        return $this->generateDataForComparison($results);
    }

    /**
     * @dataProvider provideDataForComparisonEarlierThanOrEqualTo
     */
    public function testItIsEarlierThanOrEqualTo(DateTime $origin, DateTime $another, bool $result): void
    {
        $this->assertSame($result, $origin->earlierThanOrEqualTo($another));
    }

    public function provideDataForComparisonEarlierThanOrEqualTo(): iterable
    {
        $results = [
            'earlier-than' => true,
            'equal-to' => true,
            'later-than' => false,
        ];

        return $this->generateDataForComparison($results);
    }

    /**
     * @dataProvider provideDataForComparisonInclusiveBetween
     */
    public function testItIsBetweenInclusive(DateTime $origin, DateTime $start, DateTime $end, bool $result): void
    {
        $this->assertSame($result, $origin->isBetweenInclusive($start, $end));
    }

    public function provideDataForComparisonInclusiveBetween(): iterable
    {
        $results = [
            'earlier-than-start' => false,
            'equal-to-start' => true,
            'later-than-start' => true,
            'earlier-than-end' => true,
            'equal-to-end' => true,
            'later-than-end' => false,
        ];

        return $this->generateDataForDetermination($results);
    }

    /**
     * @dataProvider provideDataForComparisonExclusiveBetween
     */
    public function testItIsBetweenExclusive(DateTime $origin, DateTime $start, DateTime $end, bool $result): void
    {
        $this->assertSame($result, $origin->isBetweenExclusive($start, $end));
    }

    public function provideDataForComparisonExclusiveBetween(): iterable
    {
        $results = [
            'earlier-than-start' => false,
            'equal-to-start' => false,
            'later-than-start' => true,
            'earlier-than-end' => true,
            'equal-to-end' => false,
            'later-than-end' => false,
        ];

        return $this->generateDataForDetermination($results);
    }

    /**
     * @dataProvider provideDataForModification
     */
    public function testItModifies(DateTime $origin, Seconds $modifier, int $result): void
    {
        $modified = $origin->modify($modifier);

        $this->assertSame($result, $modified->instant()->epochSeconds->value);
    }

    public function provideDataForModification(): iterable
    {
        $present = Instant::of(self::PRESENT);
        $circumstances = [
            'to-the-future' => [$present, 11253251, 1629147357],
            'to-the-past' => [$present, -11253251, 1606640855],
        ];

        foreach ($circumstances as $type => $data) {
            yield $type => [
                'origin' => new DateTime($data[0]),
                'modifier' => new Seconds($data[1]),
                'result' => $data[2],
            ];
        }
    }

    /**
     * @dataProvider provideNativeDateTime
     */
    public function testItReturnsValidDateAndTime(DateTimeImmutable $present): void
    {
        $dateTime = DateTime::by($present);

        $date = $dateTime->date();
        $time = $dateTime->time();

        $this->assertSame(
            $present->format('Y-m-d H:i:s'),
            vsprintf('%s-%02d-%02d %02d:%02d:%02d', [
                $date->year->value,
                $date->month->value,
                $date->day->value,
                $time->hour->value,
                $time->minute->value,
                $time->second->value,
            ])
        );
    }

    /**
     * @dataProvider provideNativeDateTime
     */
    public function testItReturnsValidIsoFormatedDateTime(DateTimeImmutable $present): void
    {
        $dateTime = DateTime::by($present);

        $this->assertMatchesRegularExpression('/^(\d{4}-\d{2}-\d{2})[A-Z]+(\d{2}:\d{2}:\d{2}).([0-9+-:]+)$/', $dateTime->iso6801());
    }

    private function generateDataForComparison(array $results): iterable
    {
        $circumstances = [
            'earlier-than' => [self::PRESENT, self::FUTURE],
            'equal-to' => [self::PRESENT, self::PRESENT],
            'later-than' => [self::PRESENT, self::PAST],
        ];

        foreach ($circumstances as $type => $data) {
            yield $type => [
                'origin' => new DateTime(Instant::of($data[0])),
                'another' => new DateTime(Instant::of($data[1])),
                'result' => $results[$type],
            ];
        }
    }

    private function generateDataForDetermination(array $results): iterable
    {
        $circumstances = [
            'earlier-than-start' => [self::PAST, self::PRESENT, self::FUTURE],
            'equal-to-start' => [self::PRESENT, self::PRESENT, self::FUTURE],
            'later-than-start' => [self::PRESENT, self::PAST, self::FUTURE],
            'earlier-than-end' => [self::PRESENT, self::PAST, self::FUTURE],
            'equal-to-end' => [self::FUTURE, self::PRESENT, self::FUTURE],
            'later-than-end' => [self::FUTURE, self::PAST, self::PRESENT],
        ];

        foreach ($circumstances as $type => $data) {
            yield $type => [
                'origin' => new DateTime(Instant::of($data[0])),
                'start' => new DateTime(Instant::of($data[1])),
                'end' => new DateTime(Instant::of($data[2])),
                'result' => $results[$type],
            ];
        }
    }

    private function mockClock(): Clock
    {
        $clock = $this->createMock(Clock::class);
        $clock->expects($this->once())
            ->method('instant')
            ->willReturn(
                Instant::of(self::PRESENT)
            );

        return $clock;
    }
}
