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
    public function testItCollectsCommands(int $number, array $domainCommands): void
    {
        Commands::issue(...$domainCommands);

        $this->assertCount($number, Commands::release());
    }

    public function provideCommands(): iterable
    {
        $domainCommand = $this->createMock(Command::class);

        for ($n = 1; $n < 3; ++$n) {
            yield [
                'number' => $n,
                'domainCommands' => array_fill(0, $n, $domainCommand),
            ];
        }
    }
}
