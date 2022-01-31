<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Core\Domain;

use Countable;
use Iterator;
use LogicException;

/**
 * @implements Iterator<int|string, DomainEvent>
 */
final class DomainEvents implements Countable, Iterator
{
    private array $domainEvents;

    public function __construct(DomainEvent ...$domainEvents)
    {
        $this->domainEvents = $domainEvents;
        $this->rewind();
    }

    public function count(): int
    {
        return count($this->domainEvents);
    }

    public function current(): DomainEvent
    {
        $domainEvent = current($this->domainEvents);
        if (! $domainEvent instanceof DomainEvent) {
            throw new LogicException(sprintf('Domain event must implement interface %s', DomainEvent::class));
        }

        return $domainEvent;
    }

    public function next(): void
    {
        next($this->domainEvents);
    }

    public function key(): int|string|null
    {
        return key($this->domainEvents);
    }

    public function valid(): bool
    {
        return null !== $this->key();
    }

    public function rewind(): void
    {
        reset($this->domainEvents);
    }
}
