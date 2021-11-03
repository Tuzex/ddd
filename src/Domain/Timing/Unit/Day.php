<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\Unit;

use Tuzex\Ddd\Domain\Timing\Unit;
use Webmozart\Assert\Assert;

final class Day extends Unit
{
    public const SECONDS_PER_DAY = 86400;
    public const MINUTES_PER_DAY = 1440;
    public const HOURS_PER_DAY = 24;

    public function __construct(int $value)
    {
        Assert::range($value, 1, 31, 'The day of the month is out of the range (from %2$s to %3$s), "%s" given.');

        parent::__construct($value);
    }
}
