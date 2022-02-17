<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime\Unit;

use Tuzex\Ddd\Domain\DateTime\Unit;
use Webmozart\Assert\Assert;

final class Hour extends Unit
{
    public const SECONDS_PER_HOUR = 3600;
    public const MINUTES_PER_HOUR = 60;

    public function __construct(int $value)
    {
        Assert::range($value, 0, Day::HOURS_PER_DAY - 1, 'The hour of the day is out of the range (from %2$s to %3$s), "%s" given.');

        parent::__construct($value);
    }
}
