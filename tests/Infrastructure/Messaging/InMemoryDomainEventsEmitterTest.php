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
    public function testItEmitsDomainEvents(array $domainEvents): void
    {
        DomainEvents::occur(...$domainEvents);

        $domainEventBus = $this->mockDomainEventBus(...$domainEvents);

        $domainEventEmitter = new InMemoryDomainEventsEmitter($domainEventBus);
        $domainEventEmitter->emit();
    }

    public function provideDomainEvents(): iterable
    {
        $domainEvent = $this->createMock(DomainEvent::class);

        for ($n = 1; $n < 3; ++$n) {
            yield [
                'domainEvents' => array_fill(0, $n, $domainEvent),
            ];
        }
    }

    private function mockDomainEventBus(DomainEvent ...$domainEvents): DomainEventBus
    {
        $countOfDomainEvents = count($domainEvents);

        $dispatcher = $this->createMock(DomainEventBus::class);
        $dispatcher->expects($this->exactly($countOfDomainEvents))
            ->method('publish')
            ->with(
                $this->createMock(DomainEvent::class)
            );

        return $dispatcher;
    }
}
