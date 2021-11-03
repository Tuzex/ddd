<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\Clock;

use DateTimeImmutable;
use Tuzex\Ddd\Domain\Timing\Clock;
use Tuzex\Ddd\Domain\Timing\Instant;

final class PresetClock implements Clock
{
    public function __construct(
        private DateTimeImmutable $dateTime
    ) {}

    public function instant(): Instant
    {
        return Instant::of($this->dateTime->getTimestamp());
    }
}
