<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit;

use Webmozart\Assert\Assert;

final class DayOfWeek extends Unit
{
    public static function of(int $value): self
    {
        Assert::range($value, 1, Week::DAYS_PER_WEEK, 'The day of the week is out of the range (from %2$s to %3$s), "%s" given.');

        return new self($value);
    }
}
