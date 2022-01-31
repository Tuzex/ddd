<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Timing\Domain;

use DateTimeImmutable;
use DateTimeZone;
use Tuzex\Ddd\Timing\Domain\Period\Seconds;

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

    public function laterThan(self $that): bool
    {
        return 0 < $this->instant->compare($that->instant);
    }

    public function laterThanOrEqualTo(self $that): bool
    {
        return 0 <= $this->instant->compare($that->instant);
    }

    public function earlierThan(self $that): bool
    {
        return 0 > $this->instant->compare($that->instant);
    }

    public function earlierThanOrEqualTo(self $that): bool
    {
        return 0 >= $this->instant->compare($that->instant);
    }

    public function isBetweenInclusive(self $from, self $to): bool
    {
        return $this->laterThanOrEqualTo($from) && $this->earlierThanOrEqualTo($to);
    }

    public function isBetweenExclusive(self $from, self $to): bool
    {
        return $this->laterThan($from) && $this->earlierThan($to);
    }

    public function modify(Seconds $seconds): self
    {
        return new self($this->instant->shift($seconds));
    }

    public function difference(self $that): DateTimeInterval
    {
        return new DateTimeInterval($this, $that);
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

    public function iso6801(): string
    {
        return $this->asNative()->format(DATE_ISO8601);
    }

    private function asNative(): DateTimeImmutable
    {
        return new DateTimeImmutable(sprintf('@%s', $this->instant->epochSeconds->value), new DateTimeZone('UTC'));
    }
}
