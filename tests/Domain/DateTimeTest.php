<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain;

use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Clock;
use Tuzex\Ddd\Domain\DateTime;
use Tuzex\Ddd\Domain\DateTime\Period\Seconds;
use Tuzex\Ddd\Domain\Instant;

final class DateTimeTest extends TestCase
{
    public function testItCreatesFromClock(): void
    {
        $presentClock = FakeClock::present();

        $dateTime = DateTime::asOf($presentClock);

        $this->assertSame(FakeClock::PRESENT, $dateTime->instant->epochSeconds->value);
    }

    public function testItCreatesFromAnotherDateTime(): void
    {
        $presentClock = FakeClock::present();

        $dateTime = DateTime::sinceThen(
            DateTime::asOf($presentClock)
        );

        $this->assertSame(FakeClock::PRESENT, $dateTime->instant->epochSeconds->value);
    }

    /**
     * @dataProvider provideNativeDateTime
     */
    public function testItReturnsValidInstant(DateTimeImmutable $present): void
    {
        $dateTime = DateTime::by($present);

        $this->assertSame(FakeClock::PRESENT, $dateTime->instant->epochSeconds->value);
    }

    public function provideNativeDateTime(): array
    {
        return [
            'present' => [new DateTimeImmutable('@'.FakeClock::PRESENT, new DateTimeZone('UTC'))],
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
            'equal' => [FakeClock::PRESENT, FakeClock::PRESENT, true],
            'unequal' => [FakeClock::PRESENT, FakeClock::FUTURE, false],
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

        $this->assertSame($result, $modified->instant->epochSeconds->value);
    }

    public function provideDataForModification(): iterable
    {
        $present = Instant::of(FakeClock::PRESENT);
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
            'earlier-than' => [FakeClock::PRESENT, FakeClock::FUTURE],
            'equal-to' => [FakeClock::PRESENT, FakeClock::PRESENT],
            'later-than' => [FakeClock::PRESENT, FakeClock::PAST],
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
            'earlier-than-start' => [FakeClock::PAST, FakeClock::PRESENT, FakeClock::FUTURE],
            'equal-to-start' => [FakeClock::PRESENT, FakeClock::PRESENT, FakeClock::FUTURE],
            'later-than-start' => [FakeClock::PRESENT, FakeClock::PAST, FakeClock::FUTURE],
            'earlier-than-end' => [FakeClock::PRESENT, FakeClock::PAST, FakeClock::FUTURE],
            'equal-to-end' => [FakeClock::FUTURE, FakeClock::PRESENT, FakeClock::FUTURE],
            'later-than-end' => [FakeClock::FUTURE, FakeClock::PAST, FakeClock::PRESENT],
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
                Instant::of(FakeClock::PRESENT)
            );

        return $clock;
    }
}
