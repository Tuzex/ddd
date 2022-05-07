<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Identifier;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Identifier\UniversalId;
use Webmozart\Assert\InvalidArgumentException;

final class UniversalIdTest extends TestCase
{
    private const UUID = 'a1506ff1-62f4-4377-a0c5-8baab8342219';

    public function testItCreatesWithValidValue(): void
    {
        $newId = new UniversalId(self::UUID);

        $this->assertInstanceOf(UniversalId::class, $newId);
    }

    public function testItCreatesFromAnother(): void
    {
        $originId = new UniversalId(self::UUID);

        $this->assertInstanceOf(UniversalId::class, UniversalId::from($originId));
    }

    /**
     * @dataProvider provideInvalidIds
     */
    public function testItThrowsExceptionIfValueIsNotValid(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);

        new UniversalId($value);
    }

    public function provideInvalidIds(): array
    {
        return [
            'empty-string' => [''],
            'invalid-string' => ['hello-world'],
        ];
    }

    public function testItReturnsValidString(): void
    {
        $validId = new UniversalId(self::UUID);

        $this->assertSame(self::UUID, $validId->value);
        $this->assertSame(self::UUID, $validId->value());
    }
}
