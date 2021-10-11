<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\UniversalTime;

use DateTimeImmutable;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Hour;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Minute;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Second;

final class Time
{
    public function __construct(
        private Hour $hour,
        private Minute $minute,
        private Second $second,
    ) {}

    public static function by(DateTimeImmutable $dateTime): self
    {
        return new self(
            new Hour((int) $dateTime->format('H')),
            new Minute((int) $dateTime->format('i')),
            new Second((int) $dateTime->format('s')),
        );
    }

    public function hour(): Hour
    {
        return $this->hour;
    }

    public function minute(): Minute
    {
        return $this->minute;
    }

    public function second(): Second
    {
        return $this->second;
    }
}
