<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Clock;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Clock\PresetClock;
use Tuzex\Ddd\Domain\Instant;

final class PresetClockTest extends TestCase
{
    private const TIMESTAMP = 1652974976;

    public function testItMeasuresTime(): void
    {
        $clock = new PresetClock(
            Instant::of(self::TIMESTAMP)
        );

        $instant = $clock->instant();

        $this->assertSame(self::TIMESTAMP, $instant->epochSeconds->value);
    }
}
