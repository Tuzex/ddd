<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\DomainEvent;
use Tuzex\Ddd\Domain\DomainEvents;

final class DomainEventsTest extends TestCase
{
    /**
     * @dataProvider provideDomainEvents
     */
    public function testItCollectsDomainEvents(int $count, array $domainEvents): void
    {
        DomainEvents::occur(...$domainEvents);

        $this->assertCount($count, DomainEvents::release());
    }

    public function provideDomainEvents(): iterable
    {
        $domainEvent = $this->createMock(DomainEvent::class);

        for ($count = 1; $count > 0 && $count < 3; ++$count) {
            yield [
                'count' => $count,
                'domainEvents' => array_fill(0, $count, $domainEvent),
            ];
        }
    }
}
