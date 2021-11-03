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
    public function testItCollectsDomainEvents(int $count, array $domainEvents): void
    {
        $domainEvents = new DomainEvents(...$domainEvents);

        $this->assertCount($count, $domainEvents);
//        for ($loop = 1; $loop > 0 && $loop <= $count; ++$loop) {
//            $this->assertEquals($loop--, $domainEvents->key());
//            $this->assertTrue($domainEvents->valid());
//            $this->assertInstanceOf(DomainEvent::class, $domainEvents->current());
//        }
    }

    public function provideDomainEvents(): iterable
    {
        $domainEvent = $this->createMock(DomainEvent::class);

        for ($count = 1; $count > 0 && $count < 3; ++$count) {
            yield [
                'count' => $count,
                'domainEvents' => array_fill(0, $count, $domainEvent),
            ];
        }
    }
}
