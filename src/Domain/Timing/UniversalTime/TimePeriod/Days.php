<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\UniversalTime\TimePeriod;

use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Day;

final class Days extends Period
{
    public static function fromSeconds(Seconds $seconds): self
    {
        return new self(intdiv($seconds->value, Day::SECONDS_PER_DAY));
    }
}
