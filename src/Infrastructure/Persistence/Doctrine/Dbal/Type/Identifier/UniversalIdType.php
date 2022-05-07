<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Persistence\Doctrine\Dbal\Type\Identifier;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\GuidType;
use Tuzex\Ddd\Domain\Identifier\UniversalId;

final class UniversalIdType extends GuidType
{
    public const NAME = 'tuzex.uid';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return ($value instanceof UniversalId)
            ? $value->value
            : throw ConversionException::conversionFailed($value, self::NAME);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UniversalId
    {
        if (! is_string($value) || ! preg_match('{^[0-9a-f]{8}(?:-[0-9a-f]{4}){3}-[0-9a-f]{12}$}Di', $value)) {
            throw ConversionException::conversionFailed($value, self::NAME);
        }

        return new UniversalId($value);
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
