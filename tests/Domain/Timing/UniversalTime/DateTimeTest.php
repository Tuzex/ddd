<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime;

use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\Clock;
use Tuzex\Ddd\Domain\Timing\Instant;
use Tuzex\Ddd\Domain\Timing\UniversalTime\DateTime;

final class DateTimeTest extends TestCase
{
    private const PAST = 1617892857;
    private const PRESENT = 1617894106;
    private const FUTURE = 1617894114;

    public function testItCreatesFromClock(): void
    {
        $dateTime = DateTime::asOf($this->mockClock());

        $this->assertSame(self::PRESENT, $dateTime->instant()->epochSeconds()->asNumber());
    }

    public function testItCreatesFromAnotherDateTime(): void
    {
        $origin = DateTime::sinceThen(
            DateTime::asOf($this->mockClock())
        );

        $this->assertSame(self::PRESENT, $origin->instant()->epochSeconds()->asNumber());
    }

    public function testItReturnsValidInstant(): void
    {
        $dateTime = DateTime::by(
            $dateTimeImmutable = $this->setupDateTimeImmutable()
        );

        $this->assertSame(self::PRESENT, $dateTime->instant()->epochSeconds()->asNumber());
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

    public function testItReturnsValidDateAndTime(): void
    {
        $dateTime = DateTime::by(
            $dateTimeImmutable = $this->setupDateTimeImmutable()
        );

        $date = $dateTime->date();
        $time = $dateTime->time();

        $this->assertSame(
            $dateTimeImmutable->format('Y-m-d H:i:s'),
            vsprintf('%s-%02d-%02d %02d:%02d:%02d', [
                $date->year()->asNumber(),
                $date->month()->asNumber(),
                $date->day()->asNumber(),
                $time->hour()->asNumber(),
                $time->minute()->asNumber(),
                $time->second()->asNumber(),
            ])
        );
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

    private function setupDateTimeImmutable(): DateTimeImmutable
    {
        return new DateTimeImmutable('@'.self::PRESENT, new DateTimeZone('UTC'));
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
