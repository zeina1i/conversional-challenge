<?php


namespace App\Query\Interfaces;


use App\DTO\EventFrequencyDTO;

interface GetInvoiceEventsFrequenciesQueryInterface
{
    public function execute(int $customerId, \DateTime $startDate, \DateTime $endDate): EventFrequencyDTO;

}