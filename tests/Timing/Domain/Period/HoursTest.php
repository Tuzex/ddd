<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Timing\Domain\Period;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Timing\Domain\Period\Hours;
use Tuzex\Ddd\Timing\Domain\Period\Seconds;

final class HoursTest extends TestCase
{
    /**
     * @dataProvider provideDateForCreation
     */
    public function testItCreatesFromSeconds(Seconds $seconds, int $numberOfHours): void
    {
        $hours = Hours::fromSeconds($seconds);

        $this->assertSame($numberOfHours, $hours->value);
    }

    public function provideDateForCreation(): array
    {
        return [
            'zero' => [new Seconds(1700), 0],
            'one' => [new Seconds(3600), 1],
        ];
    }
}
