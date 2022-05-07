<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Persistence\Doctrine\Dbal\Type;

use DateTimeImmutable;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Tuzex\Ddd\Domain\Instant;
use Tuzex\Ddd\Infrastructure\Persistence\Doctrine\Dbal\Type\InstantType;

final class InstantTypeTest extends TypeTest
{
    private const TIMESTAMP = 1646408086;
    private const SQL_DATETIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * @dataProvider provideDataForDatabaseConversion
     */
    public function testItConvertsValueObjectToDatabaseValue(?Instant $instant, ?string $result): void
    {
        $instantType = $this->getType();
        $databaseInstant = $instantType->convertToDatabaseValue($instant, $this->mockPlatform());

        $this->assertSame($result, $databaseInstant);
    }

    public function provideDataForDatabaseConversion(): array
    {
        return [
            'null-as-instant' => [
                'instant' => null,
                'result' => null,
            ],
            'object-as-instant' => [
                'instant' => Instant::of(self::TIMESTAMP),
                'result' => $this->fakeDateTime()->format(self::SQL_DATETIME_FORMAT),
            ],
        ];
    }

    /**
     * @dataProvider provideDataForPhpConversion
     */
    public function testItConvertsDatabaseValueToValueObject(?DateTimeImmutable $dateTime, ?int $result): void
    {
        $instantType = $this->getType();
        $instant = $instantType->convertToPHPValue($dateTime, $this->mockPlatform());

        $this->assertSame($result, $instant?->epochSeconds->value);
    }

    public function provideDataForPhpConversion(): array
    {
        $dateTime = $this->fakeDateTime();

        return [
            'null-as-datetime' => [
                'dateTime' => null,
                'result' => null,
            ],
            'object-as-dateTime' => [
                'dateTime' => $dateTime,
                'result' => (int) $dateTime->format('U'),
            ],
        ];
    }

    protected function getType(): InstantType
    {
        return new InstantType();
    }

    protected function getTypeName(): string
    {
        return 'tuzex.instant';
    }

    protected function mockPlatform(): AbstractPlatform
    {
        $platform = $this->createMock(AbstractPlatform::class);
        $platform->expects($this->atMost(1))
            ->method('getDateTimeFormatString')
            ->willReturn(self::SQL_DATETIME_FORMAT);

        return $platform;
    }

    private function fakeDateTime(): DateTimeImmutable
    {
        return new DateTimeImmutable(sprintf('@%s', self::TIMESTAMP));
    }
}
