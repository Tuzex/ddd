<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\DomainEvent;
use Tuzex\Ddd\Domain\DomainEvents;

final class DomainEventsTest extends TestCase
{
    /**
     * @dataProvider provideDomainEvents
     */
    public function testItCollectsDomainEvents(int $number, array $domainEvents): void
    {
        DomainEvents::occur(...$domainEvents);

        $this->assertCount($number, DomainEvents::release());
    }

    public function provideDomainEvents(): iterable
    {
        $domainEvent = $this->createMock(DomainEvent::class);

        for ($n = 1; $n < 3; ++$n) {
            yield [
                'number' => $n,
                'domainEvents' => array_fill(0, $n, $domainEvent),
            ];
        }
    }
}
