<?php


namespace App\Repository\MYSQL;


use App\Entity\Customer;
use App\Entity\Vendor;
use App\Repository\Interfaces\CustomerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class CustomerRepository implements CustomerRepositoryInterface
{
    private $entityManager;
    private $objectRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->objectRepository = $entityManager->getRepository(Customer::class);

        $this->entityManager = $entityManager;
    }

    public function getReference(int $id)
    {
        return $this->entityManager->getReference(Customer::class, $id);
    }

    public function find($id): ?Customer
    {
        return $this->objectRepository->find($id);
    }

    public function findAll() : array
    {
        return $this->objectRepository->findAll();
    }

    public function findByEmail($email) : ?Customer
    {
        return $this->objectRepository->findOneBy(['email' => $email]);
    }
    //    TODO: Repository should have update, add, delete, find, findAll methods, i haven't add all of them as i didn't need them, But it should be added in the future

}