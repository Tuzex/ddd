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
        $commands = new Commands(...$commands);

        $this->assertCount($count, $commands);
//        for ($loop = 1; $loop > 0 && $loop <= $count; ++$loop) {
//            $this->assertEquals($loop--, $commands->key());
//            $this->assertTrue($commands->valid());
//            $this->assertInstanceOf(Command::class, $commands->current());
//        }
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
