<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime\Unit;

use Webmozart\Assert\Assert;

final class Minute
{
    public const SECONDS_PER_MINUTE = 60;

    public function __construct(
        private int $value
    ) {
        Assert::range($this->value, 0, Hour::MINUTES_PER_HOUR - 1, 'The minute of the hour is out of the range (from %2$s to %3$s), "%s" given.');
    }

    public function value(): int
    {
        return $this->value;
    }
}
