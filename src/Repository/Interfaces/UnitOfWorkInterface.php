<?php


namespace App\Repository\Interfaces;


interface UnitOfWorkInterface
{
    public function flush(): void;
    public function clear(): void;
    public function commit(): void;
    public function beginTransaction(): void;
    public function rollback(): void;
    public function refresh($entity);
}