<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Domain\Identifier;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Identifier\UniversalId;
use Tuzex\Ddd\Infrastructure\Domain\Identifier\SymfonyUuidFactory;

final class SymfonyUuidFactoryTest extends TestCase
{
    public function testItReturnsValidUuidString(): void
    {
        $uuidFactory = new SymfonyUuidFactory();

        $this->assertInstanceOf(UniversalId::class, $uuidFactory->next());
    }
}
