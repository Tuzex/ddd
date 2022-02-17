<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\DateTime\Period;

use PHPUnit\Framework\TestCase;

final class HoursTest extends TestCase
{
    /**
     * @dataProvider provideDateForCreation
     */
    public function testItCreatesFromSeconds(\Tuzex\Ddd\Domain\DateTime\Period\Seconds $seconds, int $numberOfHours): void
    {
        $hours = \Tuzex\Ddd\Domain\DateTime\Period\Hours::fromSeconds($seconds);

        $this->assertSame($numberOfHours, $hours->value);
    }

    public function provideDateForCreation(): array
    {
        return [
            'zero' => [new \Tuzex\Ddd\Domain\DateTime\Period\Seconds(1700), 0],
            'one' => [new \Tuzex\Ddd\Domain\DateTime\Period\Seconds(3600), 1],
        ];
    }
}
