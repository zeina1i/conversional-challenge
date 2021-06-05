<?php


namespace App\Query\MYSQL;


use App\DTO\EventFrequencyDTO;
use App\Entity\Session;
use App\Factory\EventFrequencyDTOFactory;
use App\Query\Interfaces\GetInvoiceEventsFrequenciesQueryInterface;
use Doctrine\ORM\EntityManagerInterface;

class GetInvoiceEventsFrequenciesQuery implements GetInvoiceEventsFrequenciesQueryInterface
{
    private $entityManager;
    private $eventFrequencyDTOFactory;

    public function __construct(EntityManagerInterface $entityManager, EventFrequencyDTOFactory $eventFrequencyDTOFactory)
    {
        $this->entityManager = $entityManager;
        $this->eventFrequencyDTOFactory = $eventFrequencyDTOFactory;
    }

    public function execute(int $customerId, \DateTime $startDate, \DateTime $endDate): EventFrequencyDTO
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('SUM(CASE WHEN (session.appointmentTime >= :start_date and session.appointmentTime < :end_date) THEN 1 ELSE 0 END) AS appointment_frequency')
            ->addSelect('SUM(CASE WHEN (session.activationTime >= :start_date and session.activationTime < :end_date) THEN 1 ELSE 0 END) as activation_frequency')
            ->addSelect('SUM(CASE WHEN (user.registeredAt >= :start_date and user.registeredAt < :end_date) THEN 1 ELSE 0 END) as registration_frequency')
            ->from(Session::class, 'session')
            ->innerJoin('session.user', 'user')
            ->innerJoin('user.customer', 'customer');
        $queryBuilder->orWhere(
            $queryBuilder->expr()->andX(
                $queryBuilder->expr()->gte('session.appointmentTime', ':start_date'),
                $queryBuilder->expr()->lt('session.appointmentTime', ':end_date')
            ),
            $queryBuilder->expr()->andX(
                $queryBuilder->expr()->gte('session.activationTime', ':start_date'),
                $queryBuilder->expr()->lt('session.activationTime', ':end_date')
            ))
            ->andwhere($queryBuilder->expr()->eq('user.customer', ':customer_id'))
            ->setParameters([
                'start_date' => $startDate->format('Y-m-d H:i:s'),
                'end_date' => $endDate->format('Y-m-d H:i:s'),
                'customer_id' => $customerId,
            ]);

        $result = $queryBuilder->getQuery()->getSingleResult();

        return $this->eventFrequencyDTOFactory->create(
            intval($result['registration_frequency']),
            intval($result['activation_frequency']),
            intval($result['appointment_frequency']));
    }
}
