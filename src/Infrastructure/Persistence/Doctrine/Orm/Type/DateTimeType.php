<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Persistence\Doctrine\Orm\Type;

use DateTimeImmutable;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Tuzex\Ddd\Domain\Timing\UniversalTime\DateTime;

final class DateTimeType extends DateTimeImmutableType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (! $value instanceof DateTime) {
            return null;
        }

        $dateTime = new DateTimeImmutable(
            sprintf('@%s', $value->instant()->epochSeconds()->asNumber())
        );

        return parent::convertToDatabaseValue($dateTime, $platform);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?DateTime
    {
        $dateTime = parent::convertToPHPValue($value, $platform);
        if (! $dateTime instanceof DateTimeImmutable) {
            return null;
        }

        return DateTime::by($dateTime);
    }
}
