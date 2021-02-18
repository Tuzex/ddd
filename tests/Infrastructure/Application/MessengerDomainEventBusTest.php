<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Application;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Tuzex\Ddd\Domain\DomainEvent;
use Tuzex\Ddd\Infrastructure\Application\MessengerDomainEventBus;

final class MessengerDomainEventBusTest extends TestCase
{
    public function testItPublishesDomainEventToMessageBus(): void
    {
        $domainEvent = $this->createMock(DomainEvent::class);
        $domainEventBus = new MessengerDomainEventBus($this->mockMessageBus($domainEvent));

        $domainEventBus->publish($domainEvent);
    }

    private function mockMessageBus(DomainEvent $domainEvent): MessageBusInterface
    {
        $messageBus = $this->createMock(MessageBusInterface::class);
        $messageBus->expects($this->once())
            ->method('dispatch')
            ->with($domainEvent)
            ->willReturn(
                new Envelope($domainEvent)
            );

        return $messageBus;
    }
}
