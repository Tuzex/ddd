<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Command;
use Tuzex\Ddd\Domain\Commands;

final class CommandsTest extends TestCase
{
    /**
     * @dataProvider provideCommands
     */
    public function testItCollectsCommands(int $count, array $commands): void
    {
        Commands::issue(...$commands);

        $this->assertCount($count, Commands::release());
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
}
