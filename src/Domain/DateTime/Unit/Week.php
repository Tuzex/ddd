<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime\Unit;

use Webmozart\Assert\Assert;

final class Week
{
    public const DAYS_PER_WEEK = 7;

    public function __construct(
        private int $value
    ) {
        Assert::range($this->value, 1, Year::WEEKS_PER_YEAR, 'The week of the year is out of the range (from %2$s to %3$s), "%s" given.');
    }

    public function value(): int
    {
        return $this->value;
    }
}
