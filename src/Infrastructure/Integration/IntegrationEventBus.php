<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Integration;

interface IntegrationEventBus
{
    public function publish(IntegrationEvent ...$events): void;
}
