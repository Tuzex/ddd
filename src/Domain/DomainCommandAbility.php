<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

trait DomainCommandAbility
{
    /**
     * @var array<int|string, DomainCommand>
     */
    private array $commands = [];

    public function domainCommands(): DomainCommands
    {
        $commands = new DomainCommands(...$this->commands);
        $this->commands = [];

        return $commands;
    }

    private function issue(DomainCommand ...$commands): void
    {
        $this->commands = array_merge($this->commands, $commands);
    }
}
