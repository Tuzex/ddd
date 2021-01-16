<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Application;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Application\DomainEventDispatcher;
use Tuzex\Ddd\Domain\DomainEvent;
use Tuzex\Ddd\Domain\DomainEvents;
use Tuzex\Ddd\Infrastructure\Application\MemoryDomainEventsPublisher;

final class MemoryDomainEventsPublisherTest extends TestCase
{
    /**
     * @dataProvider provideDomainEvents
     */
    public function testItPropagatesDomainEvents(array $domainEvents): void
    {
        DomainEvents::occur(...$domainEvents);

        $dispatcher = $this->mockDispatcher($domainEvents);

        $propagator = new MemoryDomainEventsPublisher($dispatcher);
        $propagator->propagate();
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

    private function mockDispatcher(array $domainEvents): DomainEventDispatcher
    {
        $countOfDomainEvents = count($domainEvents);

        $dispatcher = $this->createMock(DomainEventDispatcher::class);
        $dispatcher->expects($this->exactly($countOfDomainEvents))
            ->method('dispatch')
            ->with($this->createMock(DomainEvent::class));

        return $dispatcher;
    }
}
