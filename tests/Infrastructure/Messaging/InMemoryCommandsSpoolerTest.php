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
    public function testItSendsCommands(int $count, array $commands): void
    {
        Commands::issue(...$commands);

        $commandBus = $this->mockCommandBus($count);

        $commandSpooler = new InMemoryCommandsSpooler($commandBus);
        $commandSpooler->send();
    }

    public function provideCommands(): iterable
    {
        $command = $this->createMock(Command::class);

        for ($count = 1; $count > 0 && $count < 3; ++$count) {
            yield [
                'count' => $count,
                'commands' => array_fill(0, $count, $command),
            ];
        }
    }

    private function mockCommandBus(int $count): CommandBus
    {
        $dispatcher = $this->createMock(CommandBus::class);
        $dispatcher->expects($this->exactly($count))
            ->method('execute')
            ->with(
                $this->createMock(Command::class)
            );

        return $dispatcher;
    }
}
