<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\DateTime\Period;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\DateTime\Period\Seconds;

final class DaysTest extends TestCase
{
    /**
     * @dataProvider provideDateForCreation
     */
    public function testItCreatesFromSeconds(\Tuzex\Ddd\Domain\DateTime\Period\Seconds $seconds, int $numberOfDays): void
    {
        $days = \Tuzex\Ddd\Domain\DateTime\Period\Days::fromSeconds($seconds);

        $this->assertSame($numberOfDays, $days->value);
    }

    public function provideDateForCreation(): array
    {
        return [
            'zero' => [new \Tuzex\Ddd\Domain\DateTime\Period\Seconds(33200), 0],
            'one' => [new Seconds(86400), 1],
        ];
    }
}
