<?php


namespace App\Repository\MYSQL;


use App\Entity\InvoiceItem;
use App\Repository\Interfaces\InvoiceItemRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class InvoiceItemRepository implements InvoiceItemRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(InvoiceItem $invoiceItem)
    {
        $this->entityManager->persist($invoiceItem);
    }

//    TODO: Repository should have update, add, delete, find, findAll methods, i haven't add all of them as i didn't need them, But it should be added in the future
}