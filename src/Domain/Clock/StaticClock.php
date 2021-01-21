<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Clock;

use DateTimeImmutable;
use DateTimeZone;
use Tuzex\Ddd\Domain\Clock\Exception\DateTimeStatementIsNotValid;
use Tuzex\Ddd\Domain\DateTime\Instant;

final class StaticClock implements Clock
{
    public function __construct(
        private DateTimeImmutable $dateTime
    ) {}

    public static function determine(string $statement, string $format = DateTimeImmutable::ISO8601): self
    {
        $dateTime = DateTimeImmutable::createFromFormat($format, $statement, new DateTimeZone('UTC'));
        if (!$dateTime) {
            throw new DateTimeStatementIsNotValid($statement, $format);
        }

        return new self($dateTime);
    }

    public function measure(): Instant
    {
        return Instant::of($this->dateTime->getTimestamp());
    }
}
