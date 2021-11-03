<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

trait CommandAbility
{
    /**
     * @var array<int, Command>
     */
    private array $commands = [];

    public function commands(): Commands
    {
        $commands = new Commands(...$this->commands);
        $this->commands = [];

        return $commands;
    }

    private function issue(Command ...$commands): void
    {
        $this->commands = array_merge($this->commands, $commands);
    }
}
