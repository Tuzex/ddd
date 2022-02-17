<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\DateTime;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\DateTime\Time;

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
