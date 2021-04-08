<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\UniversalTime\Date;

final class DateTest extends TestCase
{
    public function testItReturnsValidUnits(): void
    {
        $time = Date::by(
            $dateTime = new DateTimeImmutable()
        );

        $this->assertSame((int) $dateTime->format('Y'), $time->year()->asNumber());
        $this->assertSame((int) $dateTime->format('m'), $time->month()->asNumber());
        $this->assertSame((int) $dateTime->format('W'), $time->week()->asNumber());
        $this->assertSame((int) $dateTime->format('N'), $time->dayOfWeek()->asNumber());
        $this->assertSame((int) $dateTime->format('d'), $time->day()->asNumber());
    }
}
