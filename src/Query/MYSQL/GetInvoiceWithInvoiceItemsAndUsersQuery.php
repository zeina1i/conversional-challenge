<?php


namespace App\Query\MYSQL;


use App\Entity\Invoice;
use App\Query\Interfaces\GetInvoiceWithInvoiceItemsAndUsersQueryInterface;
use Doctrine\ORM\EntityManagerInterface;

class GetInvoiceWithInvoiceItemsAndUsersQuery implements GetInvoiceWithInvoiceItemsAndUsersQueryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function execute(int $invoiceId) : ?Invoice
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('invoice')
            ->from(Invoice::class, 'invoice')
            ->leftJoin('invoice.invoiceItems', 'invoiceItems')
            ->leftJoin('invoice.customer', 'customer')
            ->where($queryBuilder->expr()->eq('invoice.id', ':invoice_id'))
            ->setMaxResults(1)
            ->setParameter('invoice_id', $invoiceId);

        $result = $queryBuilder->getQuery()->getResult();

        return count($result) > 0 ? $result[0] : null;
    }
}