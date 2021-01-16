<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Application;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Tuzex\Ddd\Domain\DomainEvent;
use Tuzex\Ddd\Infrastructure\Application\MessengerDomainEventDispatcher;

final class MessengerDomainEventDispatcherTest extends TestCase
{
    public function testItDispatchesDomainEventToMessageBus(): void
    {
        $domainEvent = $this->createMock(DomainEvent::class);
        $domainEventDispatcher = new MessengerDomainEventDispatcher($this->mockMessageBus($domainEvent));

        $domainEventDispatcher->dispatch($domainEvent);
    }

    private function mockMessageBus(DomainEvent $domainEvent): MessageBusInterface
    {
        $messageBus = $this->createMock(MessageBusInterface::class);
        $messageBus->expects($this->once())
            ->method('dispatch')
            ->with($domainEvent)
            ->willReturn(new Envelope($domainEvent));

        return $messageBus;
    }
}
