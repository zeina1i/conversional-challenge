<?php


namespace App\Service;


use App\DTO\EventFrequencyDTO;
use App\Query\Interfaces\GetInvoiceEventsFrequenciesQueryInterface;

class SessionService
{
    private $getCustomerUsersEventsFrequenciesQuery;

    public function __construct(
        GetInvoiceEventsFrequenciesQueryInterface $getCustomerUsersEventsFrequenciesQuery
    )
    {
        $this->getCustomerUsersEventsFrequenciesQuery = $getCustomerUsersEventsFrequenciesQuery;
    }

    public function getInvoiceEventsFrequencies(int $customerId, \DateTime $startDate, \DateTime $endDate) : EventFrequencyDTO
    {
        return $this->getCustomerUsersEventsFrequenciesQuery->execute($customerId, $startDate, $endDate);
    }
}
