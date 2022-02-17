<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Clock;

use DateTimeImmutable;
use Tuzex\Ddd\Domain\Clock;
use Tuzex\Ddd\Domain\Instant;

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
