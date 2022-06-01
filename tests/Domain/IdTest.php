<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Id;

final class IdTest extends TestCase
{
    private const ID = 1;

    public function testItIsStringable(): void
    {
        $id = $this->fakeId(self::ID);

        $this->assertSame(sprintf('%s', self::ID), (string) $id);
    }

    /**
     * @dataProvider provideIdsForEquality
     */
    public function testItEquality(Id $first, Id $second, bool $expected): void
    {
        $this->assertSame($expected, $first->equals($second));
    }

    public function provideIdsForEquality(): array
    {
        return [
            'equal' => [
                'first' => $this->fakeId(self::ID),
                'second' => $this->fakeId(self::ID),
                'expected' => true,
            ],
            'inequality' => [
                'first' => $this->fakeId(self::ID),
                'second' => $this->fakeId(2),
                'expected' => false,
            ],
        ];
    }

    private function fakeId(int $value): Id
    {
        return new class($value) extends Id {
            public function __construct(
                public readonly int $value
            ) {
            }

            public function value(): int
            {
                return $this->value;
            }
        };
    }
}
