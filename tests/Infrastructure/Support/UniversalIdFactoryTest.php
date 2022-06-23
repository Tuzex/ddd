<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Domain\Id;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Id\UniversalId;
use Tuzex\Ddd\Infrastructure\Support\Symfony\Uuid\UuidGenerator\UuidV4Generator;
use Tuzex\Ddd\Infrastructure\Support\UniversalIdFactory;

final class UniversalIdFactoryTest extends TestCase
{
    public function testItReturnsValidUuidString(): void
    {
        $uuidFactory = new UniversalIdFactory(
            new UuidV4Generator()
        );

        $this->assertInstanceOf(UniversalId::class, $uuidFactory->next());
    }
}
