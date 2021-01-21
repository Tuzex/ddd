<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime\Period;

use Tuzex\Ddd\Domain\DateTime\Unit\Minute;

final class Minutes extends Period
{
    public static function fromSeconds(Seconds $seconds): self
    {
        return new self(intdiv($seconds->value, Minute::SECONDS_PER_MINUTE));
    }
}
