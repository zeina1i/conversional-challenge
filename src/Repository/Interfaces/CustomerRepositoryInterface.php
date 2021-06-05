<?php


namespace App\Repository\Interfaces;


use App\Entity\Customer;

interface CustomerRepositoryInterface
{
    public function getReference(int $id);
    public function find($id) : ?Customer;
    public function findAll() : array;
    public function findByEmail($email) : ?Customer;
}