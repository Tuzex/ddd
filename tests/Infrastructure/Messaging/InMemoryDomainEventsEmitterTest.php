<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Messaging;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Application\DomainEventBus;
use Tuzex\Ddd\Domain\DomainEvent;
use Tuzex\Ddd\Domain\DomainEvents;
use Tuzex\Ddd\Infrastructure\Messaging\InMemoryDomainEventsEmitter;

final class InMemoryDomainEventsEmitterTest extends TestCase
{
    /**
     * @dataProvider provideDomainEvents
     */
    public function testItEmitsDomainEvents(int $count, array $domainEvents): void
    {
        DomainEvents::occur(...$domainEvents);

        $domainEventBus = $this->mockDomainEventBus($count);

        $domainEventEmitter = new InMemoryDomainEventsEmitter($domainEventBus);
        $domainEventEmitter->emit();
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

    private function mockDomainEventBus(int $count): DomainEventBus
    {
        $dispatcher = $this->createMock(DomainEventBus::class);
        $dispatcher->expects($this->exactly($count))
            ->method('publish')
            ->with(
                $this->createMock(DomainEvent::class)
            );

        return $dispatcher;
    }
}
