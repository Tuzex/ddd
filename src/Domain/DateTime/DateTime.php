<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime;

use DateTimeImmutable;
use DateTimeZone;
use Tuzex\Ddd\Domain\DateTime\Format\Iso8601DateTimeFormat;
use Tuzex\Ddd\Domain\DateTime\Unit\Day;
use Tuzex\Ddd\Domain\DateTime\Unit\DayOfWeek;
use Tuzex\Ddd\Domain\DateTime\Unit\Epoch;
use Tuzex\Ddd\Domain\DateTime\Unit\Hour;
use Tuzex\Ddd\Domain\DateTime\Unit\Minute;
use Tuzex\Ddd\Domain\DateTime\Unit\Month;
use Tuzex\Ddd\Domain\DateTime\Unit\Second;
use Tuzex\Ddd\Domain\DateTime\Unit\TimeOffset;
use Tuzex\Ddd\Domain\DateTime\Unit\Week;
use Tuzex\Ddd\Domain\DateTime\Unit\Year;

final class DateTime
{
    public function __construct(
        private Epoch $epoch,
        private Year $year,
        private Month $month,
        private Week $week,
        private DayOfWeek $dayOfWeek,
        private Day $day,
        private Hour $hour,
        private Minute $minute,
        private Second $second,
        private TimeOffset $timeOffset,
    ) {}

    public static function from(Instant $instant): self
    {
        $dateTime = new DateTimeImmutable('@'.$instant->seconds()->value(), new DateTimeZone('UTC'));
        $transferMap = [
            [Epoch::class, 'U'],
            [Year::class, 'Y'],
            [Month::class, 'm'],
            [Week::class, 'W'],
            [DayOfWeek::class, 'N'],
            [Day::class, 'd'],
            [Hour::class, 'H'],
            [Minute::class, 'i'],
            [Second::class, 's'],
            [TimeOffset::class, 'Z'],
        ];

        return new self(
            ...array_map(fn (array $transfer) => new $transfer[0]((int) $dateTime->format($transfer[1])), $transferMap)
        );
    }

    public function instant(): Instant
    {
        return Instant::of($this->epoch->value());
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

    public function timeOffset(): TimeOffset
    {
        return $this->timeOffset;
    }

    public function iso8601Format(): Iso8601DateTimeFormat
    {
        return new Iso8601DateTimeFormat($this);
    }
}
