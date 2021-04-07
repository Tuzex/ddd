<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit;

use Webmozart\Assert\Assert;

final class Second
{
    public function __construct(
        private int $value
    ) {
        Assert::range($this->value, 0, Minute::SECONDS_PER_MINUTE - 1, 'The second of the minute is out of the range (from %2$s to %3$s), "%s" given.');
    }
}
