<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime\Unit;

use Tuzex\Ddd\Domain\DateTime\Unit;
use Webmozart\Assert\Assert;

final class DayOfWeek extends Unit
{
    public function __construct(int $value)
    {
        Assert::range($value, 1, Week::DAYS_PER_WEEK, 'The day of the week is out of the range (from %2$s to %3$s), "%s" given.');

        parent::__construct($value);
    }
}
