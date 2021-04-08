<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\UniversalTime;

use DateTimeImmutable;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Day;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\DayOfWeek;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Month;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Week;
use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Year;

final class Date
{
    public function __construct(
        private Year $year,
        private Month $month,
        private Week $week,
        private DayOfWeek $dayOfWeek,
        private Day $day,
    ) {}

    public static function by(DateTimeImmutable $dateTime): self
    {
        $units = [
            [Year::class, 'Y'],
            [Month::class, 'm'],
            [Week::class, 'W'],
            [DayOfWeek::class, 'N'],
            [Day::class, 'd'],
        ];

        return new self(
            ...array_map(fn (array $unit) => $unit[0]::of((int) $dateTime->format($unit[1])), $units)
        );
    }

    public function year(): Year
    {
        return $this->year;
    }

    public function month(): Month
    {
        return $this->month;
    }

    public function week(): Week
    {
        return $this->week;
    }

    public function dayOfWeek(): DayOfWeek
    {
        return $this->dayOfWeek;
    }

    public function day(): Day
    {
        return $this->day;
    }
}
