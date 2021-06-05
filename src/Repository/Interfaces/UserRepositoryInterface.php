<?php


namespace App\Repository\Interfaces;


use App\Entity\User;

interface UserRepositoryInterface
{
    public function getReference(int $id);
    public function update(User $user);
    public function findByEmail($email);
}