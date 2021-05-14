<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Command;
use Tuzex\Ddd\Domain\CommandAbility;
use Tuzex\Ddd\Domain\Commands;

final class CommandAbilityTest extends TestCase
{
    public function testItCollectsCommand(): void
    {
        $command = $this->createMock(Command::class);
        $processManager = new class() {
            use CommandAbility;

            public function issue(Command $command): void
            {
                $this->issueCommand($command);
            }
        };

        $processManager->issue($command);

        $this->assertCount(1, Commands::release());
    }
}
