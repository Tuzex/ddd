<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\Period;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\Period\Days;
use Tuzex\Ddd\Domain\Timing\Period\Seconds;

final class DaysTest extends TestCase
{
    /**
     * @dataProvider provideDateForCreation
     */
    public function testItCreatesFromSeconds(Seconds $seconds, int $numberOfDays): void
    {
        $days = Days::fromSeconds($seconds);

        $this->assertSame($numberOfDays, $days->value);
    }

    public function provideDateForCreation(): array
    {
        return [
            'zero' => [new Seconds(33200), 0],
            'one' => [new Seconds(86400), 1],
        ];
    }
}
