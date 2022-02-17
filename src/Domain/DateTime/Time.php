<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime;

use DateTimeImmutable;
use Tuzex\Ddd\Domain\DateTime\Unit\Hour;
use Tuzex\Ddd\Domain\DateTime\Unit\Minute;
use Tuzex\Ddd\Domain\DateTime\Unit\Second;

final class Time
{
    public function __construct(
        public readonly Hour $hour,
        public readonly Minute $minute,
        public readonly Second $second,
    ) {}

    public static function by(DateTimeImmutable $dateTime): self
    {
        return new self(
            new Hour((int) $dateTime->format('H')),
            new Minute((int) $dateTime->format('i')),
            new Second((int) $dateTime->format('s')),
        );
    }
}
