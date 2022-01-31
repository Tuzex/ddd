<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Core\Application\Service;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Core\Application\DomainEventBus;
use Tuzex\Ddd\Core\Application\Service\DirectDomainEventsPublisher;
use Tuzex\Ddd\Core\Domain\DomainEvent;
use Tuzex\Ddd\Core\Domain\DomainEvents;

final class DirectDomainEventsPublisherTest extends TestCase
{
    /**
     * @dataProvider provideDomainEvents
     */
    public function testItPublishesDomainEvents(int $count, DomainEvents $domainEvents): void
    {
        $domainEventPublisher = new DirectDomainEventsPublisher(
            $this->mockDomainEventBus($count)
        );

        $domainEventPublisher->publish($domainEvents);
    }

    public function provideDomainEvents(): iterable
    {
        $domainEvent = $this->createMock(DomainEvent::class);

        for ($count = 1; $count <= 3; ++$count) {
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
