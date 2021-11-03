<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Timing\Period;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\Period\Minutes;
use Tuzex\Ddd\Domain\Timing\Period\Seconds;

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
