<?php


namespace App\Query\MYSQL;


use App\Entity\User;
use App\Enum\EventEnum;
use App\Query\Interfaces\GetUsersThatHaveToBeInvoicedQueryInterface;
use App\Service\EventService;
use Doctrine\ORM\EntityManagerInterface;

class GetUsersThatHaveToBeInvoicedQuery implements GetUsersThatHaveToBeInvoicedQueryInterface
{
    private $entityManager;
    private $eventService;

    public function __construct(EntityManagerInterface $entityManager, EventService $eventService)
    {
        $this->entityManager = $entityManager;
        $this->eventService = $eventService;
    }

    public function execute(\DateTime $from, \DateTime $to, int $customerId, array $eventPriceMap = []): array
    {
        if ($eventPriceMap == null) {
            $eventPriceMap = $this->eventService->getEventsNamePriceMap();

        }
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('user')
            ->from(User::class, 'user')
            ->leftJoin('user.invoiceItems', 'invoiceItem')
            ->orWhere(
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->gte('user.registeredAt', ':from'),
                    $queryBuilder->expr()->lt('user.registeredAt', ':to'),
                    $queryBuilder->expr()->lt('user.paid', ':registration_price')
                ),
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->gte('user.firstActivationTime', ':from'),
                    $queryBuilder->expr()->lt('user.firstActivationTime', ':to'),
                    $queryBuilder->expr()->lt('user.paid', ':activation_price')
                ),
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->gte('user.firstAppointmentTime', ':from'),
                    $queryBuilder->expr()->lt('user.firstAppointmentTime', ':to'),
                    $queryBuilder->expr()->lt('user.paid', ':appointment_price')
                )
            )->andWhere($queryBuilder->expr()->eq('user.customer', ':customer_id'))
            ->groupBy('user.id')
            ->setParameters(
                [
                    'from' => $from->format('Y-m-d H:i:s'),
                    'to' => $to->format('Y-m-d H:i:s'),
                    'activation_price' => $eventPriceMap[EventEnum::EVENT_ACTIVATION],
                    'appointment_price' => $eventPriceMap[EventEnum::EVENT_APPOINTMENT],
                    'registration_price' => $eventPriceMap[EventEnum::EVENT_REGISTRATION],
                    'customer_id' => $customerId,
                ]
            );
        $result = $queryBuilder->getQuery()->getResult();

        return $result;
    }
}