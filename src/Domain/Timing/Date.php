<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing;

use DateTimeImmutable;
use Tuzex\Ddd\Domain\Timing\Unit\Day;
use Tuzex\Ddd\Domain\Timing\Unit\DayOfWeek;
use Tuzex\Ddd\Domain\Timing\Unit\Month;
use Tuzex\Ddd\Domain\Timing\Unit\Week;
use Tuzex\Ddd\Domain\Timing\Unit\Year;

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
