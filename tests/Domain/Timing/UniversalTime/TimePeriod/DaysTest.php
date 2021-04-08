<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimePeriod;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimePeriod\Days;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimePeriod\Seconds;

final class DaysTest extends TestCase
{
    /**
     * @dataProvider provideDateForCreation
     */
    public function testItCreatesFromSeconds(Seconds $seconds, int $numberOfDays): void
    {
        $days = Days::fromSeconds($seconds);

        $this->assertSame($numberOfDays, $days->asNumber());
    }

    public function provideDateForCreation(): array
    {
        return [
            'zero' => [new Seconds(33200), 0],
            'one' => [new Seconds(86400), 1],
        ];
    }
}
