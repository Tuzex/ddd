<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Persistence\Doctrine\Type;

use DateTimeInterface;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeTzImmutableType;
use Tuzex\Ddd\Domain\DateTime\Instant;
use Tuzex\Ddd\Domain\DateTime\TimePoint;

abstract class TimePointType extends DateTimeTzImmutableType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (!$value instanceof TimePoint) {
            return null;
        }

        $dateTime = $value->dateTime();
        $iso8601DateTimeFormat = $dateTime->iso8601Format();

        return parent::convertToDatabaseValue(sprintf('%s %s', $iso8601DateTimeFormat->date(), $iso8601DateTimeFormat->time()), $platform);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?TimePoint
    {
        $dateTime = parent::convertToPHPValue($value, $platform);
        if (!$dateTime instanceof DateTimeInterface) {
            return null;
        }

        $timePoint = $this->getClass();

        return new $timePoint(
            Instant::of((int) $dateTime->format('U'))
        );
    }

    abstract protected function getClass(): string;
}
