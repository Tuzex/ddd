<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Messaging;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Application\CommandBus;
use Tuzex\Ddd\Domain\Command;
use Tuzex\Ddd\Domain\Commands;
use Tuzex\Ddd\Infrastructure\Messaging\InMemoryCommandsSpooler;

final class InMemoryCommandsSpoolerTest extends TestCase
{
    /**
     * @dataProvider provideCommands
     */
    public function testItSendsCommands(array $domainCommands): void
    {
        Commands::issue(...$domainCommands);

        $domainCommandBus = $this->mockCommandBus(...$domainCommands);

        $domainCommandSpooler = new InMemoryCommandsSpooler($domainCommandBus);
        $domainCommandSpooler->send();
    }

    public function provideCommands(): iterable
    {
        $domainCommand = $this->createMock(Command::class);

        for ($n = 1; $n < 3; ++$n) {
            yield [
                'domainCommands' => array_fill(0, $n, $domainCommand),
            ];
        }
    }

    private function mockCommandBus(Command ...$domainCommands): CommandBus
    {
        $countOfCommands = count($domainCommands);

        $dispatcher = $this->createMock(CommandBus::class);
        $dispatcher->expects($this->exactly($countOfCommands))
            ->method('execute')
            ->with(
                $this->createMock(Command::class)
            );

        return $dispatcher;
    }
}
