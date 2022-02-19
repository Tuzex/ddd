<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Clock;
use Tuzex\Ddd\Domain\DateTime;
use Tuzex\Ddd\Domain\DomainEvent;
use Tuzex\Ddd\Domain\OccurrenceTimeAware;

final class OccurrenceTimeAwareTest extends TestCase
{
    public function testItReturnsIssuedDateTime(): void
    {
        $domainEvent = new class(FakeClock::present()) implements DomainEvent {
            use OccurrenceTimeAware;

            public function __construct(Clock $clock)
            {
                $this->occurredOn = DateTime::asOf($clock);
            }
        };

        $this->assertSame(FakeClock::PRESENT, $domainEvent->occurredOn()->instant->epochSeconds->value);
    }
}
