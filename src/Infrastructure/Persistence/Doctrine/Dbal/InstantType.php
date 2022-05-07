<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Persistence\Doctrine\Dbal;

use DateTimeImmutable;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Tuzex\Ddd\Domain\Instant;

final class InstantType extends DateTimeImmutableType
{
    public const NAME = 'tuzex.instant';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (! $value instanceof Instant) {
            return null;
        }

        $dateTime = new DateTimeImmutable(sprintf('@%s', $value->epochSeconds->value));

        return $dateTime->format($platform->getDateTimeFormatString());
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Instant
    {
        $dateTime = parent::convertToPHPValue($value, $platform);
        if (! $dateTime instanceof DateTimeImmutable) {
            return null;
        }

        return Instant::of((int) $dateTime->format('U'));
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
