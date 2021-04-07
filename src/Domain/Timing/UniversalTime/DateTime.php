<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\UniversalTime;

use DateTimeImmutable;
use DateTimeZone;
use Tuzex\Ddd\Domain\Timing\Clock;
use Tuzex\Ddd\Domain\Timing\Instant;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimePeriod\Seconds;

final class DateTime
{
    public function __construct(
        private Instant $instant,
    ) {}

    public static function by(DateTimeImmutable $dateTime): self
    {
        return new self(
            Instant::of($dateTime->getTimestamp())
        );
    }

    public static function asOf(Clock $clock): self
    {
        return new self($clock->instant());
    }

    public static function sinceThen(self $that): self
    {
        return new self($that->instant());
    }

    public function equals(self $that): bool
    {
        return $this->instant->equals($that->instant);
    }

    public function isLaterThan(self $that): bool
    {
        return 0 < $this->instant->compare($that->instant);
    }

    public function isLaterOrEqualThan(self $that): bool
    {
        return 0 <= $this->instant->compare($that->instant);
    }

    public function isEarlierThan(self $that): bool
    {
        return 0 > $this->instant->compare($that->instant);
    }

    public function isEarlierOrEqualThan(self $that): bool
    {
        return 0 >= $this->instant->compare($that->instant);
    }

    public function isBetweenInclusive(self $from, self $to): bool
    {
        return $this->isLaterOrEqualThan($from) && $this->isEarlierOrEqualThan($to);
    }

    public function isBetweenExclusive(self $from, self $to): bool
    {
        return $this->isLaterThan($from) && $this->isEarlierThan($to);
    }

    public function modify(Seconds $seconds): self
    {
        return new self($this->instant->move($seconds));
    }

    public function difference(self $that): Seconds
    {
        return $this->instant->delta($that->instant);
    }

    public function instant(): Instant
    {
        return $this->instant;
    }

    public function date(): Date
    {
        return Date::by($this->asNative());
    }

    public function time(): Time
    {
        return Time::by($this->asNative());
    }

    private function asNative(): DateTimeImmutable
    {
        return new DateTimeImmutable(sprintf('@%s', $this->instant->epochSeconds()->asNumber()), new DateTimeZone('UTC'));
    }
}
