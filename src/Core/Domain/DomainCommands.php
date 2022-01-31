<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Core\Domain;

use Countable;
use Iterator;
use LogicException;

/**
 * @implements Iterator<int|string, DomainCommand>
 */
final class DomainCommands implements Countable, Iterator
{
    private array $domainCommands;

    public function __construct(DomainCommand ...$domainCommands)
    {
        $this->domainCommands = $domainCommands;
        $this->rewind();
    }

    public function count(): int
    {
        return count($this->domainCommands);
    }

    public function current(): DomainCommand
    {
        $command = current($this->domainCommands);
        if (! $command instanceof DomainCommand) {
            throw new LogicException(sprintf('Domain command must implement interface %s', DomainCommand::class));
        }

        return $command;
    }

    public function next(): void
    {
        next($this->domainCommands);
    }

    public function key(): int|string|null
    {
        return key($this->domainCommands);
    }

    public function valid(): bool
    {
        return null !== $this->key();
    }

    public function rewind(): void
    {
        reset($this->domainCommands);
    }
}
