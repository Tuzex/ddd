<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

trait OccurrenceTimeAware
{
    private Instant $occurredAt;

    public function occurredAt(): Instant
    {
        return $this->occurredAt;
    }
}
