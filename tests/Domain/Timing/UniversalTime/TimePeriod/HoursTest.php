<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\UniversalTime\TimePeriod;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimePeriod\Hours;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimePeriod\Seconds;

final class HoursTest extends TestCase
{
    /**
     * @dataProvider provideDateForCreation
     */
    public function testItCreatesFromSeconds(Seconds $seconds, int $numberOfHours): void
    {
        $hours = Hours::fromSeconds($seconds);

        $this->assertSame($numberOfHours, $hours->asNumber());
    }

    public function provideDateForCreation(): array
    {
        return [
            'zero' => [new Seconds(1700), 0],
            'one' => [new Seconds(3600), 1],
        ];
    }
}
