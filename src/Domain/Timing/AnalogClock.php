<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing;

use DateTimeImmutable;

final class AnalogClock implements Clock
{
    public function __construct(
        private DateTimeImmutable $dateTime
    ) {}

    public function instant(): Instant
    {
        return Instant::of($this->dateTime->getTimestamp());
    }
}
