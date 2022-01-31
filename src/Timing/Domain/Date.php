<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Timing\Domain;

use DateTimeImmutable;
use Tuzex\Ddd\Timing\Domain\Unit\Day;
use Tuzex\Ddd\Timing\Domain\Unit\DayOfWeek;
use Tuzex\Ddd\Timing\Domain\Unit\Month;
use Tuzex\Ddd\Timing\Domain\Unit\Week;
use Tuzex\Ddd\Timing\Domain\Unit\Year;

final class Date
{
    public function __construct(
        public readonly Year $year,
        public readonly Month $month,
        public readonly Week $week,
        public readonly DayOfWeek $dayOfWeek,
        public readonly Day $day,
    ) {}

    public static function by(DateTimeImmutable $dateTime): self
    {
        return new self(
            new Year((int) $dateTime->format('Y')),
            new Month((int) $dateTime->format('m')),
            new Week((int) $dateTime->format('W')),
            new DayOfWeek((int) $dateTime->format('N')),
            new Day((int) $dateTime->format('d')),
        );
    }
}
