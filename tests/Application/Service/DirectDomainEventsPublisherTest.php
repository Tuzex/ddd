<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Applicaton\Service;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Application\DomainEventBus;
use Tuzex\Ddd\Application\Service\DirectDomainEventsPublisher;
use Tuzex\Ddd\Domain\DomainEvent;
use Tuzex\Ddd\Domain\DomainEvents;

final class DirectDomainEventsPublisherTest extends TestCase
{
    /**
     * @dataProvider provideDomainEvents
     */
    public function testItEmitsDomainEvents(int $count, DomainEvents $domainEvents): void
    {
        $domainEventPublisher = new DirectDomainEventsPublisher(
            $this->mockDomainEventBus($count)
        );

        $domainEventPublisher->publish($domainEvents);
    }

    public function provideDomainEvents(): iterable
    {
        $domainEvent = $this->createMock(DomainEvent::class);

        for ($count = 1; $count > 0 && $count < 3; ++$count) {
            yield [
                'count' => $count,
                'domainEvents' => new DomainEvents(...array_fill(0, $count, $domainEvent)),
            ];
        }
    }

    private function mockDomainEventBus(int $count): DomainEventBus
    {
        $domainEventBus = $this->createMock(DomainEventBus::class);
        $domainEventBus->expects($this->exactly($count))
            ->method('publish')
            ->with(
                $this->createMock(DomainEvent::class)
            );

        return $domainEventBus;
    }
}
