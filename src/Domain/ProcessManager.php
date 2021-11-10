<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

interface ProcessManager
{
    public function id(): Identifier;

    public function domainEvents(): DomainEvents;

    public function commands(): Commands;
}
