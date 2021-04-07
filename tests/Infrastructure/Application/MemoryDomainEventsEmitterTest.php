<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Application;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Application\DomainEventBus;
use Tuzex\Ddd\Domain\DomainEvent;
use Tuzex\Ddd\Domain\DomainEvents;
use Tuzex\Ddd\Infrastructure\Application\MemoryDomainEventsEmitter;

final class MemoryDomainEventsEmitterTest extends TestCase
{
    /**
     * @dataProvider provideDomainEvents
     */
    public function testItPropagatesDomainEvents(array $domainEvents): void
    {
        DomainEvents::occur(...$domainEvents);

        $domainEventBus = $this->mockDomainEventBus(...$domainEvents);

        $domainEventEmitter = new MemoryDomainEventsEmitter($domainEventBus);
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
