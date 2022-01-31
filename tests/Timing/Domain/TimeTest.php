<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Timing\Domain;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Timing\Domain\Time;

final class TimeTest extends TestCase
{
    private array $structure = [
        'hour' => 'H',
        'minute' => 'i',
        'second' => 's',
    ];

    public function testItReturnsValidUnits(): void
    {
        $time = Time::by(
            $dateTime = new DateTimeImmutable()
        );

        foreach ($this->structure as $type => $format) {
            $this->assertSame((int) $dateTime->format($format), $time->{$type}->value);
        }
    }
}
