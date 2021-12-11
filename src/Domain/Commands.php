<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

use Countable;
use Iterator;
use LogicException;

/**
 * @implements Iterator<int|string, Command>
 */
final class Commands implements Countable, Iterator
{
    private array $commands;

    public function __construct(Command ...$commands)
    {
        $this->commands = $commands;
        $this->rewind();
    }

    public function count(): int
    {
        return count($this->commands);
    }

    public function current(): Command
    {
        $command = current($this->commands);
        if (! $command instanceof Command) {
            throw new LogicException(sprintf('Domain event must implement interface %s', Command::class));
        }

        return $command;
    }

    public function next(): void
    {
        next($this->commands);
    }

    public function key(): int|string|null
    {
        return key($this->commands);
    }

    public function valid(): bool
    {
        return null !== $this->key();
    }

    public function rewind(): void
    {
        reset($this->commands);
    }
}
