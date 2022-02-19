<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

trait OccurrenceTimeAware
{
    private DateTime $occurredOn;

    public function occurredOn(): DateTime
    {
        return $this->occurredOn;
    }
}
