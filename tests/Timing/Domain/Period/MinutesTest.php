<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Timing\Domain\Period;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Timing\Domain\Period\Minutes;
use Tuzex\Ddd\Timing\Domain\Period\Seconds;

final class MinutesTest extends TestCase
{
    /**
     * @dataProvider provideDateForCreation
     */
    public function testItCreatesFromSeconds(Seconds $seconds, int $numberOfMinutes): void
    {
        $minutes = Minutes::fromSeconds($seconds);

        $this->assertSame($numberOfMinutes, $minutes->value);
    }

    public function provideDateForCreation(): array
    {
        return [
            'zero' => [new Seconds(30), 0],
            'one' => [new Seconds(60), 1],
        ];
    }
}
