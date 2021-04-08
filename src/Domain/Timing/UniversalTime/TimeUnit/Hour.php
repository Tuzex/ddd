<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit;

use Webmozart\Assert\Assert;

final class Hour extends Unit
{
    public const SECONDS_PER_HOUR = 3600;
    public const MINUTES_PER_HOUR = 60;

    public static function of(int $value): self
    {
        Assert::range($value, 0, Day::HOURS_PER_DAY - 1, 'The hour of the day is out of the range (from %2$s to %3$s), "%s" given.');

        return new self($value);
    }
}
