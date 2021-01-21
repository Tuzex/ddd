<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime\Unit;

use Webmozart\Assert\Assert;

final class Hour
{
    public const MINUTES_PER_HOUR = 60;
    public const SECONDS_PER_HOUR = 3600;

    public function __construct(
        private int $value
    ) {
        Assert::range($this->value, 1, Day::HOURS_PER_DAY - 1, 'The hour of the day is out of the range (from %2$s to %3$s), "%s" given.');
    }

    public function value(): int
    {
        return $this->value;
    }
}
