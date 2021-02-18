<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Time\Unit;

final class TimeShift
{
    public function __construct(
        private int $value
    ) {}

    public function value(): string
    {
        return sprintf('%+02d:00', floor($this->value / Hour::SECONDS_PER_HOUR));
    }
}
