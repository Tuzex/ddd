<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\UniversalTime\Time;

final class TimeTest extends TestCase
{
    public function testItReturnsValidUnits(): void
    {
        $time = Time::by(
            $dateTime = new DateTimeImmutable()
        );

        $this->assertSame((int) $dateTime->format('H'), $time->hour()->asNumber());
        $this->assertSame((int) $dateTime->format('i'), $time->minute()->asNumber());
        $this->assertSame((int) $dateTime->format('s'), $time->second()->asNumber());
    }
}
