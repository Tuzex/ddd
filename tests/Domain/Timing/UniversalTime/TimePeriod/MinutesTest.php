<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimePeriod;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimePeriod\Minutes;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimePeriod\Seconds;

final class MinutesTest extends TestCase
{
    /**
     * @dataProvider provideDateForCreation
     */
    public function testItCreatesFromSeconds(Seconds $seconds, int $numberOfMinutes): void
    {
        $minutes = Minutes::fromSeconds($seconds);

        $this->assertSame($numberOfMinutes, $minutes->asNumber());
    }

    public function provideDateForCreation(): array
    {
        return [
            'zero' => [new Seconds(30), 0],
            'one' => [new Seconds(60), 1],
        ];
    }
}
