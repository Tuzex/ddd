<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Core\Domain;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Core\Domain\DomainCommand;
use Tuzex\Ddd\Core\Domain\DomainCommands;

final class DomainCommandsTest extends TestCase
{
    /**
     * @dataProvider provideCommands
     */
    public function testItCollectsCommands(int $count, array $commands): void
    {
        $commands = new DomainCommands(...$commands);

        $this->assertCount($count, $commands);
    }

    public function provideCommands(): iterable
    {
        $command = $this->createMock(DomainCommand::class);

        for ($count = 1; $count <= 3; ++$count) {
            yield [
                'count' => $count,
                'commands' => array_fill(0, $count, $command),
            ];
        }
    }
}
