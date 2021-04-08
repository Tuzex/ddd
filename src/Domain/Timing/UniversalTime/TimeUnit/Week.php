<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit;

use Webmozart\Assert\Assert;

final class Week extends Unit
{
    public const SECONDS_PER_WEEK = 604800;
    public const DAYS_PER_WEEK = 7;

    public static function of(int $value): self
    {
        Assert::range($value, 1, Year::WEEKS_PER_YEAR, 'The week of the year is out of the range (from %2$s to %3$s), "%s" given.');

        return new self($value);
    }
}
