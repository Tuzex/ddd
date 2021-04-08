<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit;

use Webmozart\Assert\Assert;

final class Minute extends Unit
{
    public const SECONDS_PER_MINUTE = 60;

    public static function of(int $value): self
    {
        Assert::range($value, 0, Hour::MINUTES_PER_HOUR - 1, 'The minute of the hour is out of the range (from %2$s to %3$s), "%s" given.');

        return new self($value);
    }
}
