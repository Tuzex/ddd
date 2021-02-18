<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Persistence\Doctrine\Orm\Type;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeTzImmutableType;
use Tuzex\Ddd\Domain\Time\Instant;
use Tuzex\Ddd\Domain\Time\TimePoint;

abstract class TimePointType extends DateTimeTzImmutableType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (!$value instanceof TimePoint) {
            return null;
        }

        $timeStamp = $value->instant()->stamp();
        $dateTime = new DateTimeImmutable('@'.$timeStamp->value(), new DateTimeZone('UTC'));

        return parent::convertToDatabaseValue($dateTime, $platform);
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
