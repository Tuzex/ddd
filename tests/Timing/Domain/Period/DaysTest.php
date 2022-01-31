<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Timing\Domain\Period;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Timing\Domain\Period\Days;
use Tuzex\Ddd\Timing\Domain\Period\Seconds;

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
