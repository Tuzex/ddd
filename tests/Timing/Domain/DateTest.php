<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Timing\Domain;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Timing\Domain\Date;

final class DateTest extends TestCase
{
    private array $structure = [
        'year' => 'Y',
        'month' => 'm',
        'week' => 'W',
        'dayOfWeek' => 'N',
        'day' => 'd',
    ];

    public function testItReturnsValidUnits(): void
    {
        $date = Date::by(
            $dateTime = new DateTimeImmutable()
        );

        foreach ($this->structure as $type => $format) {
            $this->assertSame((int) $dateTime->format($format), $date->{$type}->value);
        }
    }
}
