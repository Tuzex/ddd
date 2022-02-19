<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\DomainCommand;
use Tuzex\Ddd\Domain\DomainCommandAbility;

final class DomainCommandAbilityTest extends TestCase
{
    /**
     * @dataProvider provideCommands
     */
    public function testItCollectsCommand(array $domainCommands): void
    {
        $processManager = new class() {
            use DomainCommandAbility;

            public function doChange(DomainCommand ...$domainCommands): void
            {
                foreach ($domainCommands as $domainCommand) {
                    $this->issue($domainCommand);
                }
            }
        };

        $processManager->doChange(...$domainCommands);

        $this->assertCount(count($domainCommands), $processManager->domainCommands());
    }

    public function provideCommands(): iterable
    {
        $domainCommand = $this->createMock(DomainCommand::class);
        $testCases = [
            'one' => [
                $domainCommand,
            ],
            'two' => [
                $domainCommand,
                $domainCommand,
            ],
        ];

        foreach ($testCases as $useCase => $domainCommands) {
            yield $useCase => [
                'domainCommands' => $domainCommands,
            ];
        }
    }
}
