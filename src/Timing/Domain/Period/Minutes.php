<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Timing\Domain\Period;

use Tuzex\Ddd\Timing\Domain\Period;
use Tuzex\Ddd\Timing\Domain\Unit\Minute;

final class Minutes extends Period
{
    public static function fromSeconds(Seconds $seconds): self
    {
        return new self(intdiv($seconds->value, Minute::SECONDS_PER_MINUTE));
    }
}
