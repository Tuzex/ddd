<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Time;

abstract class TimeRange
{
    final private function __construct(
        private Interval $interval
    ) {}

    public static function from(TimePoint $beginning, Duration $duration): static
    {
        return new static(
            Interval::from($beginning->instant(), $duration)
        );
    }

    public static function to(TimePoint $end, Duration $duration): static
    {
        return new static(
            Interval::to($end->instant(), $duration)
        );
    }

    public function equals(self $that): bool
    {
        return $this->interval->equals($that->interval);
    }

    public function duration(): Duration
    {
        return $this->interval->duration();
    }

    protected function beginning(): DateTime
    {
        return DateTime::from($this->interval->beginning());
    }

    protected function end(): DateTime
    {
        return DateTime::from($this->interval->end());
    }
}
