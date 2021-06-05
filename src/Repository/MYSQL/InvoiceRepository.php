<?php


namespace App\Repository\MYSQL;


use App\Entity\Customer;
use App\Entity\Invoice;
use App\Repository\Interfaces\InvoiceRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    private $entityManager;
    private $objectRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->objectRepository = $entityManager->getRepository(Invoice::class);

        $this->entityManager = $entityManager;
    }

    public function add(Invoice $invoice)
    {
        $this->entityManager->persist($invoice);
    }

    public function update(Invoice $invoice)
    {
        $this->entityManager->persist($invoice);
    }

    public function find(int $id) {
        return $this->objectRepository->find($id);
    }

    public function findByCustomerAndTimeRange($customerId, \DateTime $startDate, \DateTime $endDate)
    {
        return $this->objectRepository->findOneBy([
            'customer' => $customerId,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
    //    TODO: Repository should have update, add, delete, find, findAll methods, i haven't add all of them as i didn't need them, But it should be added in the future

}