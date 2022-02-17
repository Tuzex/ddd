<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime\Unit;

use Tuzex\Ddd\Domain\DateTime\Unit;
use Webmozart\Assert\Assert;

final class Month extends Unit
{
    public const SECONDS_PER_MONTH = 2629743;

    public function __construct(int $value)
    {
        Assert::range($value, 1, Year::MONTHS_PER_YEAR, 'The month of the year is out of the range (from %2$s to %3$s), "%s" given.');

        parent::__construct($value);
    }
}
