<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime\Unit;

use Webmozart\Assert\Assert;

final class Day
{
    public const HOURS_PER_DAY = 24;
    public const MINUTES_PER_DAY = 1440;
    public const SECONDS_PER_DAY = 86400;

    public function __construct(
        private int $value
    ) {
        Assert::range($this->value, 1, 31, 'The day of the month is out of the range (from %2$s to %3$s), "%s" given.');
    }

    public function value(): int
    {
        return $this->value;
    }
}
