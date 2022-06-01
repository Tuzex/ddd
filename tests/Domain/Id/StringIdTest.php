<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Id;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Id\StringId;
use Webmozart\Assert\InvalidArgumentException;

final class StringIdTest extends TestCase
{
    private const ID = 'A1';

    /**
     * @dataProvider provideInvalidIds
     */
    public function testItThrowsExceptionIfValueIsNotValid(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);

        new StringId($value);
    }

    public function provideInvalidIds(): array
    {
        return [
            'empty-string' => [''],
            'long-string' => [str_repeat(uniqid(), 25)],
        ];
    }

    public function testItReturnsValidString(): void
    {
        $validId = new StringId(self::ID);

        $this->assertSame(self::ID, $validId->value);
        $this->assertSame(self::ID, $validId->value());
    }

    public function testItCreatesFromAnother(): void
    {
        $originId = new StringId(self::ID);
        $newId = StringId::from($originId);

        $this->assertSame($originId->value, $newId->value);
    }
}
