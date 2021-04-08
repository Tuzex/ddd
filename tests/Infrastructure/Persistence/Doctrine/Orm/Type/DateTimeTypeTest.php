<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Persistence\Doctrine\Orm\Type;

use DateTimeImmutable;
use DateTimeZone;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Timing\UniversalTime\DateTime;
use Tuzex\Ddd\Infrastructure\Persistence\Doctrine\Orm\Type\DateTimeType;

final class DateTimeTypeTest extends TestCase
{
    private const SQL_FORMAT = 'Y-m-d H:i:s';

    /**
     * @dataProvider provideDataForDatabase
     */
    public function testItConvertsValueObjectToDatabaseValue($dateTime, $result): void
    {
        $dateTimeType = new DateTimeType();
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
    public function testItConvertsDatabaseValueToValueObject($dateTime, $result): void
    {
        $dateTimeType = new DateTimeType();
        $domainDateTime = $dateTimeType->convertToPHPValue($dateTime, $this->mockPlatform());

        $this->assertSame($result, $domainDateTime?->instant()->epochSeconds()->asNumber());
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

    private function mockPlatform(): AbstractPlatform
    {
        $platform = $this->createMock(AbstractPlatform::class);
        $platform->expects($this->atMost(1))
            ->method('getDateTimeFormatString')
            ->willReturn(self::SQL_FORMAT);

        return $platform;
    }
}
