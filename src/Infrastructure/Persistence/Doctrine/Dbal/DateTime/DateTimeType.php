<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Persistence\Doctrine\Dbal\DateTime;

use DateTimeImmutable;
use DateTimeZone;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Tuzex\Ddd\Domain\DateTime;

final class DateTimeType extends DateTimeImmutableType
{
    public const NAME = 'tuzex.date_time';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (! $value instanceof DateTime) {
            return null;
        }

        $dateTime = new DateTimeImmutable(sprintf('@%s', $value->instant->epochSeconds->value));

        return $dateTime->format($platform->getDateTimeFormatString());
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?DateTime
    {
        $dateTime = parent::convertToPHPValue($value, $platform);
        if (! $dateTime instanceof DateTimeImmutable) {
            return null;
        }

        return DateTime::by(
            $dateTime->setTimezone(new DateTimeZone('UTC'))
        );
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getMappedDatabaseTypes(AbstractPlatform $platform): array
    {
        return [self::NAME];
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
