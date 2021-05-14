<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

final class Commands
{
    private static array $domainCommands = [];

    public static function issue(Command ...$domainCommands): void
    {
        self::$domainCommands = array_merge(self::$domainCommands, $domainCommands);
    }

    public static function release(): array
    {
        $domainCommands = self::$domainCommands;
        self::$domainCommands = [];

        return $domainCommands;
    }
}
