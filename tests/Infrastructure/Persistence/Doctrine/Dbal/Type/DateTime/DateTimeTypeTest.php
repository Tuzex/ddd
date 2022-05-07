<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Persistence\Doctrine\Dbal\Type;

use DateTimeImmutable;
use DateTimeZone;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Tuzex\Ddd\Domain\DateTime;
use Tuzex\Ddd\Infrastructure\Persistence\Doctrine\Dbal\DateTime\DateTimeType;

final class DateTimeTypeTest extends TypeTest
{
    private const SQL_FORMAT = 'Y-m-d H:i:s';

    /**
     * @dataProvider provideDataForDatabase
     */
    public function testItConvertsValueObjectToDatabaseValue(?DateTime $dateTime, ?string $result): void
    {
        $dateTimeType = $this->getType();
        $databaseDateTime = $dateTimeType->convertToDatabaseValue($dateTime, $this->mockPlatform());

        $this->assertSame($result, $databaseDateTime);
    }

    public function provideDataForDatabase(): array
    {
        $dateTime = new DateTimeImmutable('now', new DateTimeZone('UTC'));

        return [
            'null-as-datetime' => [
                'dateTime' => null,
                'result' => null,
            ],
            'object-as-dateTime' => [
                'dateTime' => DateTime::by($dateTime),
                'result' => $dateTime->format(self::SQL_FORMAT),
            ],
        ];
    }

    /**
     * @dataProvider provideDataForDomain
     */
    public function testItConvertsDatabaseValueToValueObject(?DateTimeImmutable $dateTime, ?int $result): void
    {
        $dateTimeType = $this->getType();
        $domainDateTime = $dateTimeType->convertToPHPValue($dateTime, $this->mockPlatform());

        $this->assertSame($result, $domainDateTime?->instant->epochSeconds->value);
    }

    public function provideDataForDomain(): array
    {
        $dateTime = new DateTimeImmutable('now', new DateTimeZone('UTC'));

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

    protected function getType(): DateTimeType
    {
        return new DateTimeType();
    }

    protected function getTypeName(): string
    {
        return 'tuzex.date_time';
    }

    protected function mockPlatform(): AbstractPlatform
    {
        $platform = $this->createMock(AbstractPlatform::class);
        $platform->expects($this->atMost(1))
            ->method('getDateTimeFormatString')
            ->willReturn(self::SQL_FORMAT);

        return $platform;
    }
}
