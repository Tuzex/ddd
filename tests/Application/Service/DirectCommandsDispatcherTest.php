<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Application\Service;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Application\CommandBus;
use Tuzex\Ddd\Application\Service\DirectCommandsDispatcher;
use Tuzex\Ddd\Domain\Command;
use Tuzex\Ddd\Domain\Commands;

final class DirectCommandsDispatcherTest extends TestCase
{
    /**
     * @dataProvider provideCommands
     */
    public function testItDispatchesCommands(int $count, Commands $commands): void
    {
        $commandsDispatch = new DirectCommandsDispatcher(
            $this->mockCommandBus($count)
        );

        $commandsDispatch->dispatch($commands);
    }

    public function provideCommands(): iterable
    {
        $command = $this->createMock(Command::class);

        for ($count = 1; $count > 0 && $count < 3; ++$count) {
            yield [
                'count' => $count,
                'commands' => new Commands(...array_fill(0, $count, $command)),
            ];
        }
    }

    private function mockCommandBus(int $count): CommandBus
    {
        $commandBus = $this->createMock(CommandBus::class);
        $commandBus->expects($this->exactly($count))
            ->method('execute')
            ->with(
                $this->createMock(Command::class)
            );

        return $commandBus;
    }
}
