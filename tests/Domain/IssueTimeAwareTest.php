<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Clock;
use Tuzex\Ddd\Domain\DateTime;
use Tuzex\Ddd\Domain\DomainCommand;
use Tuzex\Ddd\Domain\IssueTimeAware;

final class IssueTimeAwareTest extends TestCase
{
    public function testItReturnsIssuedDateTime(): void
    {
        $domainCommand = new class(FakeClock::present()) implements DomainCommand {
            use IssueTimeAware;

            public function __construct(Clock $clock)
            {
                $this->issuedOn = DateTime::asOf($clock);
            }
        };

        $this->assertSame(FakeClock::PRESENT, $domainCommand->issuedOn()->instant->epochSeconds->value);
    }
}
