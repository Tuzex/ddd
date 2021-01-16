<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime;

use Tuzex\Ddd\Domain\Clock\Clock;
use Tuzex\Ddd\Domain\TimeZone\UtcTimeZone;

abstract class UtcDateTime implements DateTime
{
    final private function __construct(
        private PointOfTime $pointOfTime,
        private UtcTimeZone $timeZone
    ) {}

    public static function sinceThen(Clock $clock): static
    {
        return new static($clock->measure(), new UtcTimeZone());
    }

    public static function asOf(self $that): static
    {
        return new static($that->pointOfTime, $that->timeZone);
    }

    public function isPresent(Clock $clock): bool
    {
        //return $this->equals($clock->measure());
        return true;
    }

    public function isFuture(Clock $clock): bool
    {
        //return $this->isLaterThan($clock->measure());
        return true;
    }

    public function isPast(Clock $clock): bool
    {
        //return $this->isEarlierThan($clock->measure());
        return true;
    }
}
