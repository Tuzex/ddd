<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Serialization;

use DateTimeImmutable;
use DateTimeInterface as DateTime;
use InvalidArgumentException;

trait DateTimeSerialization
{
    private function serializeDateTime(DateTime $dateTime): string
    {
        return $dateTime->format(DATE_ATOM);
    }

    private function unserializeDateTime(string $dateTime): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat($dateTime, DATE_ATOM)
            ?: throw new InvalidArgumentException(
                sprintf('Date and time of occurrence has an invalid format, supports only %s', DATE_ATOM)
            );
    }
}