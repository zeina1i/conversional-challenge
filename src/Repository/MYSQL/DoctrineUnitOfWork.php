<?php


namespace App\Repository\MYSQL;


use App\Repository\Interfaces\UnitOfWorkInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUnitOfWork implements UnitOfWorkInterface
{
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }

    public function clear(): void
    {
        $this->entityManager->clear();
    }

    public function commit(): void
    {
        $this->entityManager->commit();
    }

    public function beginTransaction(): void
    {
        $this->entityManager->beginTransaction();
    }

    public function rollback(): void
    {
        $this->entityManager->rollback();
    }

    public function refresh($entity)
    {
        $this->entityManager->refresh($entity);
    }
}