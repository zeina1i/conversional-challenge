<?php


namespace App\Repository\MYSQL;


use App\Entity\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository implements UserRepositoryInterface
{
    private $entityManager;
    private $objectRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->objectRepository = $entityManager->getRepository(User::class);

        $this->entityManager = $entityManager;
    }

    public function getReference(int $id)
    {
        return $this->entityManager->getReference(User::class, $id);
    }

    public function update(User $user)
    {
        $this->entityManager->persist($user);
    }

    public function findByEmail($email)
    {
        return $this->objectRepository->findOneBy(['email' => $email]);
    }
    //    TODO: Repository should have update, add, delete, find, findAll methods, i haven't add all of them as i didn't need them, But it should be added in the future

}