<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\PresetClock;

final class PresetClockTest extends TestCase
{
    public function testItMeasuresTime(): void
    {
        $timeStamp = time();
        $dateTime = new DateTimeImmutable('@'.$timeStamp);

        $clock = new PresetClock($dateTime);
        $instant = $clock->instant();

        $this->assertSame($timeStamp, $instant->epochSeconds()->asNumber());
    }
}
