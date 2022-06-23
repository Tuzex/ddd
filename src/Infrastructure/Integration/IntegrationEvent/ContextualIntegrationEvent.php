<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Integration\IntegrationEvent;

use DateTimeImmutable as DateTime;
use Symfony\Component\Uid\Uuid;
use Tuzex\Ddd\Infrastructure\Integration\IntegrationEvent;
use Tuzex\Ddd\Infrastructure\Serialization\DateTimeSerialization;
use Tuzex\Ddd\Infrastructure\Serialization\Symfony\Uuid\UuidSerialization;

abstract class ContextualIntegrationEvent implements IntegrationEvent
{
    use DateTimeSerialization;
    use UuidSerialization;

    public function __construct(
        private readonly Uuid $id,
        private readonly array $payload,
        private readonly DateTime $occurredAt,
    ) {
    }

    public function __serialize(): array
    {
        $id = $this->id->toRfc4122();
        $occurredAt = $this->occurredAt->format(DATE_ATOM);

        return [
            'id' => $this->serializeUuid($this->id),
            'occurred_at' => $this->serializeDateTime($this->occurredAt),
            'payload' => $this->payload,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->id = $this->unserializeUuid($data['id']);
        $this->occurredAt = $this->unserializeDateTime($data['occurred_at']);
        $this->payload = $data['payload'];
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function occurredAt(): DateTime
    {
        return $this->occurredAt;
    }

    public function payload(): array
    {
        return $this->payload;
    }
}
