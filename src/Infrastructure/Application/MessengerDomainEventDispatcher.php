<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Application;

use Symfony\Component\Messenger\MessageBusInterface;
use Tuzex\Ddd\Application\DomainEventDispatcher;
use Tuzex\Ddd\Domain\DomainEvent;

final class MessengerDomainEventDispatcher implements DomainEventDispatcher
{
    public function __construct(
        private MessageBusInterface $messageBus
    ) {}

    public function dispatch(DomainEvent $domainEvent): void
    {
        $this->messageBus->dispatch($domainEvent);
    }
}
