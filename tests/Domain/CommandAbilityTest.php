<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Command;
use Tuzex\Ddd\Domain\CommandAbility;

final class CommandAbilityTest extends TestCase
{
    /**
     * @dataProvider provideCommands
     */
    public function testItCollectsCommand(array $commands): void
    {
        $processManager = new class() {
            use CommandAbility;

            public function doChange(Command ...$commands): void
            {
                foreach ($commands as $command) {
                    $this->issue($command);
                }
            }
        };

        $processManager->doChange(...$commands);

        $this->assertCount(count($commands), $processManager->commands());
    }

    public function provideCommands(): iterable
    {
        $command = $this->createMock(Command::class);
        $testCases = [
            'one' => [
                $command,
            ],
            'two' => [
                $command,
                $command,
            ],
        ];

        foreach ($testCases as $useCase => $commands) {
            yield $useCase => [
                'commands' => $commands,
            ];
        }
    }
}
