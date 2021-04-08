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
    private const TIMESTAMP = 1617892857;

    public function testItCreatesFromClock(): void
    {
        $dateTime = DateTime::asOf($this->mockClock());

        $this->assertSame(self::TIMESTAMP, $dateTime->instant()->epochSeconds()->asNumber());
    }

    public function testItCreatesFromAnotherDateTime(): void
    {
        $origin = DateTime::sinceThen(
            DateTime::asOf($this->mockClock())
        );

        $this->assertSame(self::TIMESTAMP, $origin->instant()->epochSeconds()->asNumber());
    }

    public function testItReturnsValidInstant(): void
    {
        $dateTime = DateTime::by(
            $dateTimeImmutable = $this->setupDateTimeImmutable()
        );

        $this->assertSame(self::TIMESTAMP, $dateTime->instant()->epochSeconds()->asNumber());
    }

    /**
     * @dataProvider provideDataForEquality
     */
    public function testItIsEqual(Instant $origin, Instant $another, bool $result): void
    {
        $this->assertSame($result, $origin->equals($another));
    }

    public function provideDataForEquality(): array
    {
        $origin = Instant::of(self::TIMESTAMP);
        $another = Instant::of(self::TIMESTAMP + 10);

        return [
            'equal' => [$origin, $origin, true],
            'unequal' => [$origin, $another, false]
        ];
    }

    public function testItReturnsValidDateAndTime(): void
    {
        $dateTime = DateTime::by(
            $dateTimeImmutable = $this->setupDateTimeImmutable()
        );

        $date = $dateTime->date();
        $time = $dateTime->time();

        $this->assertSame($dateTimeImmutable->format('Y-m-d H:i:s'), vsprintf('%s-%02d-%02d %02d:%02d:%02d', [
                $date->year()->asNumber(),
                $date->month()->asNumber(),
                $date->day()->asNumber(),
                $time->hour()->asNumber(),
                $time->minute()->asNumber(),
                $time->second()->asNumber(),
            ])
        );
    }

    private function mockClock(): Clock
    {
        $clock = $this->createMock(Clock::class);
        $clock->expects($this->once())
            ->method('instant')
            ->willReturn(
                Instant::of(self::TIMESTAMP)
            );

        return $clock;
    }

    private function setupDateTimeImmutable(): DateTimeImmutable
    {
        return new DateTimeImmutable('@'.self::TIMESTAMP, new DateTimeZone('UTC'));
    }
}
