<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\DomainEvent;
use Tuzex\Ddd\Domain\DomainEventOccurrence;
use Tuzex\Ddd\Domain\DomainEvents;

final class DomainEventOccurrenceTest extends TestCase
{
    /**
     * @dataProvider provideDomainEvents
     */
    public function testItCollectsDomainEvents(array $domainEvents, int $numberOfDomainEvents): void
    {
        $aggregate = new class() {
            use DomainEventOccurrence;

            public function raise(DomainEvent ...$domainEvents): void
            {
                $this->raiseDomainEvents(...$domainEvents);
            }
        };

        $aggregate->raise(...$domainEvents);

        $this->assertCount($numberOfDomainEvents, DomainEvents::release());
    }

    public function provideDomainEvents(): iterable
    {
        $domainEvent = $this->createMock(DomainEvent::class);
        $testCases = [
            'one' => [
                $domainEvent,
            ],
            'two' => [
                $domainEvent,
                $domainEvent,
            ],
        ];

        foreach ($testCases as $useCase => $domainEvents) {
            yield $useCase => [
                'domainEvents' => $domainEvents,
                'numberOfDomainEvents' => count($domainEvents),
            ];
        }
    }
}
