<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing;

use DateTimeImmutable;
use Tuzex\Ddd\Domain\Timing\TimeUnit\Hour;
use Tuzex\Ddd\Domain\Timing\TimeUnit\Minute;
use Tuzex\Ddd\Domain\Timing\TimeUnit\Second;

final class Time
{
    public function __construct(
        private Hour $hour,
        private Minute $minute,
        private Second $second,
    ) {}

    public static function by(DateTimeImmutable $dateTime): self
    {
        $units = [
            [Hour::class, 'H'],
            [Minute::class, 'i'],
            [Second::class, 's'],
        ];

        return new self(
            ...array_map(fn (array $unit) => new $unit[0]((int) $dateTime->format($unit[1])), $units)
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
