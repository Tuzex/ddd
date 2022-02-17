<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime\Unit;

use Tuzex\Ddd\Domain\DateTime\Unit;
use Webmozart\Assert\Assert;

final class Year extends Unit
{
    public const SECONDS_PER_YEAR = 31556926;
    public const MONTHS_PER_YEAR = 12;
    public const WEEKS_PER_YEAR = 53;

    public function __construct(int $value)
    {
        Assert::range($value, 1000, 2999, 'The year is out of the range (from %2$s to %3$s), "%s" given.');

        parent::__construct($value);
    }
}
