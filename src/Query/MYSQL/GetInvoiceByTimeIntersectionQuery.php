<?php


namespace App\Query\MYSQL;


use App\Entity\Invoice;
use App\Query\Interfaces\GetInvoiceByTimeIntersectionQueryInterface;
use Doctrine\ORM\EntityManagerInterface;

class GetInvoiceByTimeIntersectionQuery implements GetInvoiceByTimeIntersectionQueryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute(int $customerId, \DateTime $startDate, \DateTime $endDate) : ?Invoice
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('invoice')
            ->from(Invoice::class, 'invoice')
            ->setMaxResults(1);

        $queryBuilder->orWhere(
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->gte('invoice.startDate', ':start_date'),
                    $queryBuilder->expr()->lt('invoice.startDate', ':end_date')
                ),
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->gt('invoice.endDate', ':start_date'),
                    $queryBuilder->expr()->lte('invoice.endDate', ':end_date')
                ),
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->gte('invoice.startDate', ':start_date'),
                    $queryBuilder->expr()->lte('invoice.endDate', ':end_date')
                ))
            ->andWhere($queryBuilder->expr()->eq('invoice.customer', ':customer_id'))
            ->setParameters([
                'start_date' => $startDate->format('Y-m-d H:i:s'),
                'end_date' => $endDate->format('Y-m-d H:i:s'),
                'customer_id' => $customerId,
            ]);


        $result = $queryBuilder->getQuery()->getResult();

        return count($result) > 0 ? $result[0] : null;
    }
}