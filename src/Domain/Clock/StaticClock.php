<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Clock;

use DateTimeImmutable;
use InvalidArgumentException;
use Tuzex\Ddd\Domain\DateTime\PointOfTime;

final class StaticClock implements Clock
{
    public function __construct(
        private DateTimeImmutable $dateTime
    ) {}

    public static function determine(string $statement, string $format = DateTimeImmutable::ISO8601): self
    {
        $dateTime = DateTimeImmutable::createFromFormat($statement, $format);
        if (!$dateTime) {
            throw new InvalidArgumentException($statement, $format);
        }

        return new self($dateTime);
    }

    public function measure(): PointOfTime
    {
        return PointOfTime::set($this->dateTime->getTimestamp());
    }
}
