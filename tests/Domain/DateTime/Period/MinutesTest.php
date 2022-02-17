<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\DateTime\Period;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\DateTime\Period\Seconds;

final class MinutesTest extends TestCase
{
    /**
     * @dataProvider provideDateForCreation
     */
    public function testItCreatesFromSeconds(\Tuzex\Ddd\Domain\DateTime\Period\Seconds $seconds, int $numberOfMinutes): void
    {
        $minutes = \Tuzex\Ddd\Domain\DateTime\Period\Minutes::fromSeconds($seconds);

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
