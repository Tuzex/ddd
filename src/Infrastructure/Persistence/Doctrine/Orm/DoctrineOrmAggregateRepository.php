<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Persistence\Doctrine\Orm;

use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Tuzex\Ddd\Domain\AggregateRoot;
use Tuzex\Ddd\Domain\Identifier;

abstract class DoctrineOrmAggregateRepository
{
    public function __construct(
        protected EntityManager $entityManager,
    ) {
    }

    protected function save(AggregateRoot $aggregate): void
    {
        $this->entityManager->persist($aggregate);
        $this->entityManager->flush();
    }

    abstract protected function find(Identifier $id): ?AggregateRoot;
}
