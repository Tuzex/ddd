<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime;

use Tuzex\Ddd\Domain\Clock\Clock;

abstract class TimePoint
{
    final private function __construct(
        private Instant $instant,
    ) {}

    public static function from(Clock $clock): static
    {
        return new static($clock->measure());
    }

    public static function asOf(self $that): static
    {
        return new static($that->instant);
    }

    public function equals(self $that): bool
    {
        return $this->instant->equals($that->instant);
    }

    public function dateTime(): DateTime
    {
        return DateTime::from($this->instant);
    }
}
