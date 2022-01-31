<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Core\Application\Service;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Core\Application\DomainCommandBus;
use Tuzex\Ddd\Core\Application\Service\DirectDomainCommandsDispatcher;
use Tuzex\Ddd\Core\Domain\DomainCommand;
use Tuzex\Ddd\Core\Domain\DomainCommands;

final class DirectDomainCommandsDispatcherTest extends TestCase
{
    /**
     * @dataProvider provideCommands
     */
    public function testItDispatchesCommands(int $count, DomainCommands $domainCommands): void
    {
        $domainCommandsDispatcher = new DirectDomainCommandsDispatcher(
            $this->mockCommandBus($count)
        );

        $domainCommandsDispatcher->dispatch($domainCommands);
    }

    public function provideCommands(): iterable
    {
        $domainCommand = $this->createMock(DomainCommand::class);

        for ($count = 1; $count <= 3; ++$count) {
            yield [
                'count' => $count,
                'domainCommands' => new DomainCommands(...array_fill(0, $count, $domainCommand)),
            ];
        }
    }

    private function mockCommandBus(int $count): DomainCommandBus
    {
        $commandBus = $this->createMock(DomainCommandBus::class);
        $commandBus->expects($this->exactly($count))
            ->method('dispatch')
            ->with(
                $this->createMock(DomainCommand::class)
            );

        return $commandBus;
    }
}
