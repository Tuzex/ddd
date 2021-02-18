<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Time;

use DateTimeImmutable;
use DateTimeZone;
use Tuzex\Ddd\Domain\Time\Unit\Day;
use Tuzex\Ddd\Domain\Time\Unit\DayOfWeek;
use Tuzex\Ddd\Domain\Time\Unit\Hour;
use Tuzex\Ddd\Domain\Time\Unit\Minute;
use Tuzex\Ddd\Domain\Time\Unit\Month;
use Tuzex\Ddd\Domain\Time\Unit\Second;
use Tuzex\Ddd\Domain\Time\Unit\TimeShift;
use Tuzex\Ddd\Domain\Time\Unit\Week;
use Tuzex\Ddd\Domain\Time\Unit\Year;

final class DateTime
{
    public function __construct(
        private Year $year,
        private Month $month,
        private Week $week,
        private DayOfWeek $dayOfWeek,
        private Day $day,
        private Hour $hour,
        private Minute $minute,
        private Second $second,
        private TimeShift $timeShift,
    ) {}

    public static function from(Instant $instant): self
    {
        $dateTime = new DateTimeImmutable('@'.$instant->stamp()->value(), new DateTimeZone('UTC'));
        $dateTimeUnits = [
            [Year::class, 'Y'],
            [Month::class, 'm'],
            [Week::class, 'W'],
            [DayOfWeek::class, 'N'],
            [Day::class, 'd'],
            [Hour::class, 'H'],
            [Minute::class, 'i'],
            [Second::class, 's'],
            [TimeShift::class, 'Z'],
        ];

        return new self(
            ...array_map(fn (array $unit) => new $unit[0]((int) $dateTime->format($unit[1])), $dateTimeUnits)
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

    public function timeShift(): TimeShift
    {
        return $this->timeShift;
    }
}
