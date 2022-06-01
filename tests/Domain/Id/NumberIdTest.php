<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Id;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Id\NumberId;
use Webmozart\Assert\InvalidArgumentException;

final class NumberIdTest extends TestCase
{
    private const ID = 1;

    /**
     * @dataProvider provideInvalidIds
     */
    public function testItThrowsExceptionIfValueIsNotValid(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);

        new NumberId($value);
    }

    public function provideInvalidIds(): array
    {
        return [
            'zero' => [0],
            'negative' => [-1],
        ];
    }

    public function testItReturnsValidString(): void
    {
        $validId = new NumberId(self::ID);

        $this->assertSame(self::ID, $validId->value);
        $this->assertSame(self::ID, $validId->value());
    }

    public function testItIsStringable(): void
    {
        $id = new NumberId(self::ID);

        $this->assertSame(sprintf('%s', self::ID), (string) $id);
    }

    /**
     * @dataProvider provideIdsForEquality
     */
    public function testItEquality(NumberId $first, NumberId $second, bool $expected): void
    {
        $this->assertSame($expected, $first->equals($second));
    }

    public function provideIdsForEquality(): array
    {
        return [
            'equal' => [
                'first' => new NumberId(self::ID),
                'second' => new NumberId(self::ID),
                'expected' => true,
            ],
            'inequality' => [
                'first' => new NumberId(self::ID),
                'second' => new NumberId(2),
                'expected' => false,
            ],
        ];
    }

    public function testItCreatesFromAnother(): void
    {
        $originId = new NumberId(self::ID);
        $newId = NumberId::from($originId);

        $this->assertSame($originId->value, $newId->value);
    }
}
