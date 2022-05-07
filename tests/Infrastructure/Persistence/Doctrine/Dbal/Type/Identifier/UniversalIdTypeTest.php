<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Persistence\Doctrine\Dbal\Type\Identifier;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Tuzex\Ddd\Domain\Identifier\UniversalId;
use Tuzex\Ddd\Infrastructure\Persistence\Doctrine\Dbal\Type\Identifier\UniversalIdType;
use Tuzex\Ddd\Test\Infrastructure\Persistence\Doctrine\Dbal\Type\TypeTest;

final class UniversalIdTypeTest extends TypeTest
{
    private const UUID = 'a1506ff1-62f4-4377-a0c5-8baab8342219';

    public function testItConvertsToDatabaseValue(): void
    {
        $universalId = new UniversalId(self::UUID);
        $universalIdType = $this->getType();

        $databaseUniversalId = $universalIdType->convertToDatabaseValue(
            $universalId,
            $this->mockPlatform()
        );

        $this->assertSame(self::UUID, $databaseUniversalId);
    }

    public function testItThrowsExceptionIfPhpValueIsInvalid(): void
    {
        $universalIdType = $this->getType();

        $this->expectException(ConversionException::class);

        $universalIdType->convertToDatabaseValue('non-uuid', $this->mockPlatform());
    }

    public function testItConvertsToValueObject(): void
    {
        $universalIdType = $this->getType();
        $universalId = $universalIdType->convertToPHPValue(self::UUID, $this->mockPlatform());

        $this->assertInstanceOf(UniversalId::class, $universalId);
    }

    public function testItThrowsExceptionIfDatabaseValueIsInvalid(): void
    {
        $universalIdType = $this->getType();

        $this->expectException(ConversionException::class);

        $universalIdType->convertToPHPValue('non-uuid', $this->mockPlatform());
    }

    protected function getType(): \Tuzex\Ddd\Infrastructure\Persistence\Doctrine\Dbal\Type\Identifier\UniversalIdType
    {
        return new UniversalIdType();
    }

    protected function getTypeName(): string
    {
        return 'tuzex.uid';
    }

    protected function mockPlatform(): AbstractPlatform
    {
        return $this->createMock(AbstractPlatform::class);
    }
}
