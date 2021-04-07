<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Domain;

use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Infrastructure\Domain\Timing\SystemClock;
use Tuzex\Timekeeper\TimeService;

final class SystemClockTest extends TestCase
{
    public function testItMeasuresTime(): void
    {
        $dateTime = new DateTimeImmutable('now', new DateTimeZone('UTC'));

        $timeService = $this->createMock(TimeService::class);
        $timeService->expects($this->once())
            ->method('measure')
            ->willReturn($dateTime);

        $clock = new SystemClock($timeService);
        $instant = $clock->instant();

        $this->assertSame($dateTime->getTimestamp(), $instant->epochSeconds()->asNumber());
    }
}
