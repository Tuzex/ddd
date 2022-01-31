<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Timing\Domain\Clock;

use DateTimeImmutable;
use Tuzex\Ddd\Timing\Domain\Clock;
use Tuzex\Ddd\Timing\Domain\Instant;

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
