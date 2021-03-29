<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\TimePeriod;

use Tuzex\Ddd\Domain\Timing\TimeUnit\Minute;

final class Minutes extends Period
{
    public static function fromSeconds(Seconds $seconds): self
    {
        return new self(intdiv($seconds->value, Minute::SECONDS_PER_MINUTE));
    }
}
