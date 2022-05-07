<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

use DateTimeImmutable;
use DateTimeZone;
use DomainException;
use Tuzex\Ddd\Domain\DateTime\Date;
use Tuzex\Ddd\Domain\DateTime\DateTimeInterval;
use Tuzex\Ddd\Domain\DateTime\Period\Seconds;
use Tuzex\Ddd\Domain\DateTime\Time;

final class DateTime
{
    public function __construct(
        public readonly Instant $instant,
    ) {}

    public static function by(DateTimeImmutable $dateTime): self
    {
        $timeZoneOffsetInSeconds = $dateTime->getOffset();
        if (0 !== $timeZoneOffsetInSeconds) {
            throw new DomainException(sprintf('Time zone must be UTC (offset = 0 seconds), "%s" seconds given .', $timeZoneOffsetInSeconds));
        }

        return new self(Instant::of($dateTime->getTimestamp()));
    }

    public static function asOf(Clock $clock): self
    {
        return new self($clock->instant());
    }

    public static function sinceThen(self $that): self
    {
        return new self($that->instant);
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
        return $this->asNative()->format(DATE_ATOM);
    }

    private function asNative(): DateTimeImmutable
    {
        $nativeDateTime = new DateTimeImmutable(sprintf('@%s', $this->instant->epochSeconds->value));

        return $nativeDateTime->setTimezone(new DateTimeZone('UTC'));
    }
}
